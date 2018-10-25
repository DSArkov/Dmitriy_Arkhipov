<?php

/* card.twig */
class __TwigTemplate_7daf2c1070b6a3a11abae88b906756796ab4110a4b9109ee3d31a024c367d02a extends Twig_Template
{
    private $source;

    public function __construct(Twig_Environment $env)
    {
        parent::__construct($env);

        $this->source = $this->getSourceContext();

        $this->parent = false;

        $this->blocks = array(
        );
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        // line 1
        echo "<h1>";
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "title", array()), "html", null, true);
        echo "</h1>
<p>";
        // line 2
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "description", array()), "html", null, true);
        echo "</p>
<p>";
        // line 3
        echo twig_escape_filter($this->env, twig_get_attribute($this->env, $this->source, ($context["model"] ?? null), "price", array()), "html", null, true);
        echo "</p>";
    }

    public function getTemplateName()
    {
        return "card.twig";
    }

    public function isTraitable()
    {
        return false;
    }

    public function getDebugInfo()
    {
        return array (  32 => 3,  28 => 2,  23 => 1,);
    }

    public function getSourceContext()
    {
        return new Twig_Source("", "card.twig", "C:\\Users\\Dmitriy\\Desktop\\Dmitriy_Arkhipov\\PHP_prof\\Lesson_5\\views\\twig\\card.twig");
    }
}
