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
class __TwigTemplate_459885747b7dd3de6d4c8a8ae2276c8b extends Template
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
        echo twig_escape_filter($this->env, ($context["h1"] ?? null), "false", null, true);
        echo "</h1>
<p>It would seem, as if ";
        // line 2
        echo ($context["gibberish"] ?? null);
        echo " and ";
        echo twig_escape_filter($this->env, ($context["text"] ?? null), "false", null, true);
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
        return new Source("", "one.html", "/data/web/virtuals/261915/virtual/www/subdom/provide/tinycms/templates/one.html");
    }
}
