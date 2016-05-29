<?php

class UsersController extends Controller
{
    public function index()
    {
        $result = $this->model->index();
        //pre_print($result, "Result in Controller");
    }

    public function login()
    {
        
    }

    public function signup()
    {
        
    }
    
    // Open user's page by ID
    public function id($id)
    {
        $result = $this->model->selectById($id);

        pre_print($result, "Result in Controller");
    }
}