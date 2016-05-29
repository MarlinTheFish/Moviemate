<?php

/*
 * Base class for all the controllers of the application
 */
abstract class Controller
{
    protected $model;

    public function __construct()
    {
        $model = str_replace("Controller", "Model", get_class($this));
        $this->model = new $model();
    }

    public function index() {}
}