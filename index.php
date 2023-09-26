<?php
ini_set('display_errors',1); # uncomment if you need debugging

define("DIR_CONTENTS", __DIR__ . "/contents.json");
define("DIR_TEMPLATES", __DIR__ . "/templates/");

require __DIR__ . '/vendor/autoload.php';require __DIR__ . '/vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader( __DIR__ . '/templates');
$twig = new \Twig\Environment($loader, [
    'cache' =>  __DIR__ . '/cache',
    'debug ' => 'true',
    'auto_reload' => 'true', 
    'autoescape' => false
]);

echo $twig->render('index.php', ['name' => 'Tomas']);

echo "<br><br>";

if(!is_file(DIR_CONTENTS)) exception("Contents file not found");
$contents = json_decode(file_get_contents(DIR_CONTENTS), true);
if(!$contents) exception("Contents file not valid");

interface Editable {
  function getEditHTML();
}

interface Displayable {
  function getDisplayHTML();
}

abstract class ItemList {
  protected $items = array();

  protected function constructItems($structure) {
    if(!$structure["items"]??false) exception("No items present in web structure");
    foreach ($structure["items"] as $id => $data) {
      if(!$data["type"]??false) exception("Class of item $id not specified");
      $object = new $data["type"]($id, $data);
      $this->items[$id] = $object;
    }
  }

  function getItem($id) {
    return $this->items[$id]??null;
  }

  protected function setItem($id, $object) {
    $this->items[$id] = $object;
  }

  function getEditHTMLArray() {
    $htmls = array();
    foreach ($this->items as $id => $object) {
      if($object->locked??false) continue;
      if(!method_exists($object, "getEditHTML")) continue;
      array_push($htmls, $object->getEditHTML());
    }
    return $htmls;
  }

  function getPhraseArray() {
    $htmls = array();
    foreach ($this->items as $id => $object) {
      if(!method_exists($object, "getDisplayHTML")) continue;
      $htmls[$id] = $object->getDisplayHTML();
    }
    return $htmls;
  }
} 

class Web extends ItemList implements Editable  {
  function __construct($structure) {
    $this->constructItems($structure);
  }

  function getEditHTML() {
    $htmls = $this->getEditHTMLArray();
    return implode("<br><b>New Section</b><br>",$htmls);
  }

  public function getGlobalPhraseArray() {
    $globals = $this->getItem("global");
    if(!$globals) exception("No global content database is present in web structure");
    return $globals->getPhraseArray();
  }

  function getPageHTML($pageId) {
    $page = $this->items[$pageId];
    if(!$page) exception("Requested page $pageId not present in web structure",404);
    return $page->getDisplayHTML($this->getGlobalPhraseArray());
  }
}

class Database extends ItemList implements Editable {
  public $id;

  function __construct($id, $structure) {
    $this->id = $id;
    $this->constructItems($structure);
  }

  function getEditHTML() {
    $htmls = $this->getEditHTMLArray();
    return implode("<br>",$htmls);
  }
}


class Page extends Database implements Displayable {
  public $id;

  function __construct($id, $structure) {
    $this->id = $id;
    $this->constructItems($structure);
  }
  function getTemplateName() {
    $name = $this->id . ".html";
    if(!is_file(DIR_TEMPLATES . $name)) exception("Template with name $name not found",200);
    return $name;
  }

  function getTemplatePath() {
    $path = DIR_TEMPLATES . $this->getTemplateName();
    if(!is_file($path)) exception("Template with path $path not found",200);
    return $path;
  }

  function getDisplayHTML($globalPhrases = [], $overwritePhrases = []) {
    global $twig;
    $pagePhrases = $this->getPhraseArray();
    $phrases = array_merge($globalPhrases, $pagePhrases, $overwritePhrases);
    return $twig->render($this->getTemplateName(), $phrases);
  }
}

abstract class Element implements Editable, Displayable {
    protected $id;
    protected $text;

    public $attributes;
    public function getDisplayHTML() {
      return $this->text;
    }  

    function __construct($id, $structure) {
      $this->text = $structure["text"]??"";
      $this->attributes = $structure["attributes"]??[];
      $this->id = $id;
    }

    public function getId() {
      return $this->id;
    }

    public function getText() {
      return $this->text;
    }

    public function setText($text) {
      $this->text = $text;
    }

    public function getLabel() {
      $label = <<<EOT
        <label for="{$this->id}">{$this->id}:</label>
      EOT;
      return  $label;
    }
}

class Paragraph extends Element {
    function getEditHTML()
    {
      return <<<EOT
      {$this->getLabel()}
      <textarea id="{$this->id}" name="w3review" rows="4" cols="50">{$this->text}</textarea>
      EOT;
    }
}

class Text extends Element {
  function getEditHTML()
  {
    return <<<EOT
    {$this->getLabel()}
    <input id="{$this->id}" value="{$this->text}">
    EOT;
  }
}

/*
Web
  f getHTML for editing
    check credentials →  redirect
    get global HTML template
    fill attributes


  f getHTML for web
    get global HTML template
    fill attributes
    prepare JSON for all Pages
      call Page getHTML() from structure
    include by id correct one -  include full HTML code
    send rest as JSON to JS

  f getGlobal()
  f getTemplate()
  f getPageId()
  f createPage()

Page 
  f getHTML for page
      getPageTemplate based on id
      fill variables from repo global, then page local

  f getText
  f createElements
      
Element * 
  f getSelfEdit
*/
 

$web = new Web($contents);

info("try:");
echo $web->getEditHTML();
echo $web->getPageHTML("one");

  
/*$str = 'Paragraph';
$parameters = ['haf', ["text" => 'Text text text']];
$object = new $str(...$parameters);
echo $object->getEditHTML();*/

function info($text) {
  echo "<br/>" . nl2br($text);
}

function exception($text) {
    //Log exception
    throw new Exception($text);
}
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]>      <html class="no-js"> <!--<![endif]-->
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="#">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->
        <br><br>Hello world!
        <script src="" async defer></script>
      </body>
</html>