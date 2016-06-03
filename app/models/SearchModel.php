<?php

class SearchModel
{
    private $omdb;

    public function __construct()
    {
        $this->omdb = new Omdb();
    }
}