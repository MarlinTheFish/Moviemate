<?php

class UsersModel extends Model
{
    public function index()
    {
        $sql = "SELECT id, username, date_joined FROM users";
        $result = $this->conn->query($sql);
        $result = $result->fetch_all(MYSQLI_ASSOC);

        // Return a two-dimensional associative array of all users
        return $result;
    }
    
    public function login(array $credentials)
    {
        
    }

    // Takes in POST from controller
    public function signUp(array $credentials)
    {
        // Parse credentials
        if (is_array($errors = $this->parseCredentials($credentials))) {
            // Return the array with errors
            return $errors;
        }

        $errors = []; // Container array for errors
        extract($credentials); // Extract credentials variables from array

        // Check if username is taken
        if ($this->searchByUsername($username)) {
            $errors["username"] = "This username is already taken.";
        }

        // Check if e-mail is already registered
        if ($this->searchByEmail($email)) {
            $errors["email"] = "This e-mail is already registered.";
        }

        // Return the array with errors if username and/or e-mail are/is taken
        if (!empty($errors)) {
            return $errors;
        }

        // Get current date, hash password and insert everything in database
        $date = date("Y-m-d H:i:s");
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->conn->query(
            "INSERT INTO users (username, email, password, date_joined) VALUES ('{$username}', 
            '{$email}', '{$password}', '{$date}')");
        
        // Return boolean true after making the database record
        return true;
    }

    public function searchByUsername($username)
    {
        $result = $this->conn->query("SELECT username FROM users where username = '{$username}'");
        $result = $result->fetch_assoc();

        if (!$result) {
            return false;
        }

        return $result;
    }

    public function searchByEmail($email)
    {
        $result = $this->conn->query("SELECT username FROM users where email = '{$email}'");
        $result = $result->fetch_assoc();

        if (!$result) {
            return false;
        }

        return $result;
    }

    public function selectById($id)
    {
        $sql = "SELECT id, username, date_joined FROM users WHERE id='{$id}'";
        $result = $this->conn->query($sql);
        $result = $result->fetch_assoc();

        // Return an associative array of user by ID
        return $result;
    }

    private function parseCredentials(array $credentials)
    {
        $errors = []; // Container array for errors
        extract($credentials); // Extract credentials variables from array

        // Parse username
        if (!preg_match("/^[A-Za-z][A-Za-z0-9]{5,31}$/", $username)) {
            $errors["username"] = "Wrong name format!";
        }

        // Parse e-mail
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors["email"] = "Wrong e-mail format!";
        }

        // Parse password
        if (strlen($password) > 16) {
            $errors["password"] = "Password is too long!";
        } elseif (strlen($password) < 6) {
            $errors["password"] = "Password is too short!";
        }

        // Return errors if there were any
        if (!empty($errors)) {
            return $errors;
        }
        
        // Return boolean true if everything is ok
        return true;
    }
}