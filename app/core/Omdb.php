<?php

class Omdb
{
    private $request = "http://www.omdbapi.com/?";
    
    /*
     * Returns associative array with info on the movie from IMDb
     * and Rotten Tomatoes. gets the movie by IMDb ID (e.g. tt0137523)
     */
    public function getByID($id)
    {
        return json_decode(file_get_contents($this->request."i=".$id."&tomatoes=true"), true);
    }

    /*
     * Returns associative array with info on the movie from IMDb
     * and Rotten Tomatoes. gets the movie by IMDb title (e.g. Fight+Club)
     */
    public function getByTitle($title)
    {
        return json_decode(file_get_contents($this->request."t=".urlencode($title)."&tomatoes=true"), true);
    }

    /*
     * Returns two-dimensional associative array with up to 10 results of search input
     * of basic info about the found titles (e.g. title, year, imdb id, type and poster)
     */
    public function search($search)
    {
        $result = json_decode(file_get_contents($this->request."s=".urlencode($search)."&type=movie"), true);

        if (array_key_exists("Error", $result)) {
            $error["Error"] = "Movie not found.";
            return $error;
        }

        return $result;
    }
}