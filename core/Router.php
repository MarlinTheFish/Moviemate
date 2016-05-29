<?php

class Router
{
    private $uri;
    private $controller;
    private $action;
    private $params;
    private $directions;

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
        // Get the list of the available controllers from the config
        $this->directions = Config::get("controllers");

        // Make lowercase, decode special symbols and trim forward slashes
        $this->uri = strtolower(urldecode(trim($uri, "/")));

        // Record request in the array
        $path_parts = explode("/", $this->uri);
        //pre_print($path_parts, "Exploded URI (Router class)");

        // Extracting the controller from exploded URI
        if ($this->setController($path_parts)) {
            // Stop the constructor if controller was empty or unexisting
            return true;
        }

        // Extract action
        $this->setAction($path_parts);

        // Set all that left in $path_parts as parametres
        $this->setParams($path_parts);
    }

    // Returns the associative array of routing result
    public function getResult()
    {
        $result = ["controller" => $this->controller, "action" => $this->action, "params" => $this->params];
        return $result;
    }

    private function setController($uri_parts)
    {
        // If the first element of the URI is in directions list, set it to it
        if (in_array($uri_parts[0], $this->directions)) {
            $this->controller = ucfirst($uri_parts[0]);
            return false;

        // If the first element is empty or is not set in directions, set it to "Pages" and action to "index"
        } elseif ((empty($uri_parts[0]) || !in_array($uri_parts[0], $this->directions))) {
            $this->controller = "Default";
            $this->action = "index";
            return true;
        }
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
}