<?php

class View
{
    // Paths to the global header and footer
    const HEADER_PATH = VIEWS.DS."layout".DS."header.html";
    const FOOTER_PATH = VIEWS.DS."layout".DS."footer.html";

    private static $reports = [];
    
    private static $data;

    public static function render($template)
    {
        ob_start();
        self::getPath($template);
        $result = ob_get_clean();
        return $result;
    }
    
    public static function setData(array $input)
    {
        self::$data = $input;
    }
    
    public static function addReport($key, $value)
    {
        self::$reports[$key] = $value;
    }

    // Gets the HTML template corresponding to the controller and method
    private static function getPath($template)
    {
        include_once(VIEWS.DS.$template.".html");
    }
    
    // Calls header in the HTML template
    private static function getHeader()
    {
        include_once(self::HEADER_PATH);
    }

    // Calls footer in the HTML template
    private static function getFooter()
    {
        include_once(self::FOOTER_PATH);
    }
}