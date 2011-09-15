<?php

/* test_twig.html */
class __TwigTemplate_d8b5881fceb4efd24859f2adbf999cdf extends Twig_Template
{
    protected function doGetParent(array $context)
    {
        return false;
    }

    protected function doDisplay(array $context, array $blocks = array())
    {
        $context = array_merge($this->env->getGlobals(), $context);

        // line 1
        echo "<h1>Twig test</h1>

";
        // line 3
        echo twig_escape_filter($this->env, base_url(), "html");
        echo "
<script type=\"text/javascript\" charset=\"utf-8\">
\t\$(document).ready(function(){
\t\t\$.ajax({
\t\t\tdata : {id : ";
        // line 7
        echo twig_escape_filter($this->env, mod_run("tester/kampret"), "html");
        echo " };
\t\t\turl : ";
        // line 8
        echo twig_escape_filter($this->env, base_url(), "html");
        echo "
\t\t})
\t});
</script>
";
        // line 12
        $context['_parent'] = (array) $context;
        $context['_seq'] = twig_ensure_traversable($this->getContext($context, 'array'));
        foreach ($context['_seq'] as $context['_key'] => $context['item']) {
            // line 13
            echo "\t<li>";
            echo twig_escape_filter($this->env, $this->getAttribute($this->getContext($context, 'item'), "kampret", array(), "any", false), "html");
            echo "</li>
";
        }
        $_parent = $context['_parent'];
        unset($context['_seq'], $context['_iterated'], $context['_key'], $context['item'], $context['_parent'], $context['loop']);
        $context = array_merge($_parent, array_intersect_key($context, $_parent));
    }

    public function getTemplateName()
    {
        return "test_twig.html";
    }

    public function isTraitable()
    {
        return false;
    }
}
