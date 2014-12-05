<?php
/**
 * Created by PhpStorm.
 * User: langstra
 * Date: 25-11-14
 * Time: 1:45
 */

class HtmlModel {

    private $html_pure = null;

    function __construct()
    {
        require LIBS_PATH . 'HtmlPurifier/HTMLPurifier.auto.php';
        $config = HTMLPurifier_Config::createDefault();
        $this->html_pure = new HTMLPurifier($config);
    }

    public function out($string)
    {
        echo $this->html_pure->purify($string);
    }
}