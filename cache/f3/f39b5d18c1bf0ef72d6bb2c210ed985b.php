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

/* one.html */
class __TwigTemplate_bd46c296cfe865081c676bc90621cc30 extends Template
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
        echo ($context["h1"] ?? null);
        echo "</h1>
<p>It would seem, as if ";
        // line 2
        echo ($context["gibberish"] ?? null);
        echo " and ";
        echo ($context["text"] ?? null);
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "one.html";
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
        return new Source("", "one.html", "D:\\php\\xampp\\htdocs\\tinycms\\templates\\one.html");
    }
}
