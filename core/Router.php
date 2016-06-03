<?php

class Router
{
    private $uri;
    private $controller;
    private $action;
    private $params;

    private $directions; // Available directions (controllers) from config
    private $special_directions; // Special directions that DON'T have any actions

    public function getController()
    {
        return $this->controller;
    }

    public function getAction()
    {
        return $this->action;
    }

    public function getParams()
    {
        return $this->params;
    }
    
    public function __construct($uri)
    {
        $omdb = new Omdb();
        pre_print($omdb->serach(urlencode("Spy Kids")));
        die();

        // Get the list of the available directions
        $this->directions = Config::get("directions");
        $this->special_directions = Config::get("special_directions");

        // Make lowercase, decode special symbols, strip HTML tags and trim forward slashes
        $this->uri = strip_tags(strtolower(urldecode(trim($uri, "/"))));
        pre_print($this->uri, "Formatted URI", self::class);
        
        // Record request in the array
        $uri_parts = explode("/", $this->uri);
        pre_print($uri_parts, "Exploded URI", self::class);

        // Extracting the controller from exploded URI
        if ($this->setController($uri_parts)) {
            // Stop the constructor if controller was empty or unexisting
            return false;
        }

        // Extract action
        $this->setAction($uri_parts);

        // Set all that left in $uri_parts as parametres
        $this->setParams($uri_parts);
    }

    // Returns the associative array of routing result
    public function getResult()
    {
        $result = ["controller" => $this->controller, "action" => $this->action, "params" => $this->params];
        return $result;
    }
    
    public static function redirect($location)
    {
        header("Location: {$location}");
    }

    /*
     * Checks the $directions property to get the available controllers
     * and sets the $uri_parts first element to one of these controllers.
     * If
     */
    private function setController($uri_parts)
    {
        // If the first element of the URI is in directions list, set it to it
        if (in_array($uri_parts[0], $this->directions)) {
            $this->controller = ucfirst($uri_parts[0]);
            return false;
        }

        // Set the controller and action to default ones
        $this->controller = "Default";
        $this->action = "index";
        return true;
    }

    private function setAction($uri_parts)
    {
        if (isset($uri_parts[1])) {
            if ($uri_parts[1] != "__construct") {
                $this->action = $uri_parts[1];
            }
        } else {
            $this->action = "index";
        }
    }

    private function setParams($uri_parts)
    {
        $size = count($uri_parts);

        if ($size >= 3) {
            for ($i = 2; $i <= ($size-1); $i++) {
                $this->params[$i-2] = $uri_parts[$i];
            }
        }
    }

    private function checkIfSpecial($uri_parts)
    {

    }
}