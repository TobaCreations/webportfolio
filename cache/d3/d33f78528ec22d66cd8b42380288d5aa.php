<?php

use Twig\Environment;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Extension\SandboxExtension;
use Twig\Markup;
use Twig\Sandbox\SecurityError;
use Twig\Sandbox\SecurityNotAllowedTagError;
use Twig\Sandbox\SecurityNotAllowedFilterError;
use Twig\Sandbox\SecurityNotAllowedFunctionError;
use Twig\Source;
use Twig\Template;

/* one.php */
class __TwigTemplate_65ea96c1feac976e94d43a83a30d3f80 extends Template
{
    private $source;
    private $macros = [];

    public function __construct(Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = [
        ];
    }

    protected function doDisplay(array $context, array $blocks = [])
    {
        $macros = $this->macros;
        // line 1
        echo "<h1>Quality of life is determined by ";
        echo twig_escape_filter($this->env, ($context["h1"] ?? null), "html", null, true);
        echo "</h1>
<p>It would seem, as if ";
        // line 2
        echo twig_escape_filter($this->env, ($context["gibberish"] ?? null), "html", null, true);
        echo " and ";
        echo twig_escape_filter($this->env, ($context["text"] ?? null), "html", null, true);
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "one.php";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  42 => 2,  37 => 1,);
    }

    public function getSourceContext()
    {
        return new Source("", "one.php", "/data/web/virtuals/261915/virtual/www/subdom/provide/tinycms/templates/one.php");
    }
}
