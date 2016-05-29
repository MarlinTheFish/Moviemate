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
    
    public function selectById($id)
    {
        $sql = "SELECT id, username, date_joined FROM users WHERE id='{$id}'";
        $result = $this->conn->query($sql);
        $result = $result->fetch_assoc();

        // Return an associative array of user by ID
        return $result;
    }
}