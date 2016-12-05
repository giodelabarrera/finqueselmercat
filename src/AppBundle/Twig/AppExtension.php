<?php

namespace AppBundle\Twig;

/**
 * Class AppExtension
 */
class AppExtension extends \Twig_Extension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('ceil', array($this, 'ceil')),
        );
    }

    /**
     * @param $value
     * @return float
     */
    public function ceil($value)
    {
        return ceil($value);
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_extension';
    }
}