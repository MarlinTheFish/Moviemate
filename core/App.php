<?php

class App
{
    private static $connection;
    private static $router;

    public static function run($uri)
    {
        $database = new Database();
        self::$connection = $database->getConnection();
        self::$router = new Router($uri);

        //pre_print(self::$router->getResult(), self::class);

        $controller_class = self::$router->getController()."Controller";
        $controller_method = self::$router->getAction();
        $params = !empty(self::$router->getParams()) ? self::$router->getParams() : null;
        //pre_print($params);
        
        $htmlTemplate = str_replace("Controller", "", $controller_class).DS.$controller_method;

        // Calling controller's method
        $controller_object = new $controller_class();
        if (method_exists($controller_object, $controller_method)) {
            if (!$params) {
                $controller_object->$controller_method();
            } else {
                $controller_object->$controller_method($params[0]);
            }

            echo View::render($htmlTemplate);
            
        } else {
            echo "404 Page Not Found";
        }
    }
}