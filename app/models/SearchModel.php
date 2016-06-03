<?php

class SearchModel
{
    private $omdb;

    public function __construct()
    {
        $this->omdb = new Omdb();
    }

    /**
     * Uses OMDb object to perform a search
     * @return array with results or errors
     */
    public function search($search)
    {
        $return = [];

        if (!$search) {
            $return["Error"] = "Enter a word or phrase to search on.";
            return $return;
        }
        
        $return = $this->omdb->serach($search);

        return $return;
    }
}