<?php

class SearchController extends Controller
{
    private $search;
    private $result;

    public function __construct()
    {
        parent::__construct();
        $this->search = isset($_POST["search"]) ? strip_tags($_POST["search"]) : null;
    }

    public function index()
    {
        $result = $this->model->search($this->search);

        if (array_key_exists("Error", $result)) {
            View::setData($result);
            return null;
        }

        View::setData($result["Search"]);
    }
}