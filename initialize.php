<?php
define("ROOT", __DIR__);
define("DS", DIRECTORY_SEPARATOR);
define("VIEWS", ROOT.DS."app".DS."views");

require_once ROOT.DS."app".DS."config.php";

function __autoload ($class)
{
    // Core path
    $core = ROOT.DS."core".DS.$class.".php";
    
    // Application paths
    $controller = ROOT.DS."app".DS."controllers".DS.$class.".php";
    $model = ROOT.DS."app".DS."models".DS.$class.".php";
    $app_core = ROOT.DS."app".DS."core".DS.$class.".php";

    // Autoload
    if (file_exists($core)) {
        require_once $core;
    } elseif (file_exists($controller)) {
        require_once $controller;
    } elseif (file_exists($model)) {
        require_once $model;
    } elseif (file_exists($app_core)) {
        require_once $app_core;
    } else {
        throw new Exception("Class {$class} doesn't exist.");
    }
}

/*function pre_print($input, $info = null)
{
    echo "<pre>";
    if ($info) {
        echo "<b style='background-color:greenyellow'>[".$info."]</b> ";
    }
    print_r($input);
    echo "</pre>";
}*/

function pre_print($input, $comment = null, $class = null)
{
    echo "<pre>";
    echo "<b style='background-color:greenyellow'>[[{$comment}] Called in {$class}]</b><br>";
    print_r($input);
    echo "</pre>";
}