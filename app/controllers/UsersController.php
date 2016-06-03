<?php

class UsersController extends Controller
{
    private $username;
    private $email;
    private $password;

    public function index()
    {
        $result = $this->model->index();
        //pre_print($result, "Result in Controller");
    }

    public function login()
    {
        // Stop the script if $_POST is not set
        if (empty($_POST)) {
            return false;
        }
        
        $errors = []; // Container array for errors

        // Check if all the values in POST are set
        if (!$_POST["username"]) {
            $errors["username"] = "  is not set.";
        }
        if (!$_POST["password"]) {
            $errors["password"] = " is not set.";
        }

        // Send errors to view if there were any
        if ($this->sendErrors($errors)) {
            // Stop the script
            return false;
        }
    }

    public function signup()
    {
        // Stop the script if $_POST is not set
        if (empty($_POST)) {
            return false;
        }
        
        $errors = []; // Container array for errors

        // Check if all the values in POST are set
        if (!$_POST["username"]) {
            $errors["username"] = "  is not set.";
        }
        if (!$_POST["email"]) {
            $errors["email"] = " is not set.";
        }
        if (!$_POST["password"]) {
            $errors["password"] = " is not set.";
        }

        // Send errors to view if there were any
        if ($this->sendErrors($errors)) {
            // Stop the script
            return false;
        }

        // Send credentials to the model
        $errors = $this->model->signUp($_POST);

        // Send errors to view if there were any
        if ($this->sendErrors($errors)) {
            // Stop the script
            return false;
        }

        Router::redirect("index");
        // Smth here
    }
    
    // Open user's page by ID
    public function id($id)
    {
        $result = $this->model->selectById($id);

        pre_print($result, "Result in Controller");
    }

    // Send errors to view reporter array
    private function sendErrors(array $errors)
    {
        if (!empty($errors)) {
            foreach ($errors as $type => $error) {
                View::addReport($type, $error);
            }
            return true;
        }
        return false;
    }

    private function checkIfSet($value)
    {
        if (isset($value) && !empty($value)) {
            return true;
        }
        return false;
    }
}