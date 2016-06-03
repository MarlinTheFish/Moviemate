<?php

class SearchController
{
    public function index($search = null)
    {
        var_dump($search);
        pre_print($_POST, "POST", self::class);
    }
}