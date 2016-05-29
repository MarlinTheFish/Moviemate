<?php
define("ROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);
define("VIEWS", ROOT.DS."app".DS."views");

require_once ROOT.DS."app".DS."config.php";

function __autoload ($class)
{
    // Paths
    $core = ROOT.DS."core".DS.$class.".php";
    $controller = ROOT.DS."app".DS."controllers".DS.$class.".php";
    $model = ROOT.DS."app".DS."models".DS.$class.".php";

    // Autoload
    if (file_exists($core)) {
        require_once $core;
    } elseif (file_exists($controller)) {
        require_once $controller;
    } elseif (file_exists($model)) {
        require_once $model;
    } else {
        throw new Exception("Class {$class} doesn't exist.");
    }
}

function pre_print($input, $info = null)
{
    echo "<pre>";
    if ($info) {
        echo "<b style='background-color:greenyellow'>[".$info."]</b> ";
    }
    print_r($input);
    echo "</pre>";
}