<?php

class DefaultController extends Controller
{
    public function __construct()
    {
        parent::__construct(__CLASS__);
    }

    public function index()
    {
        //echo "Index of default page.";
    }
}