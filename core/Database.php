<?php

class Database
{
    private $connection;

    public function __construct()
    {
        // Get database credentials from config.php
        $host = Config::get("db_host");
        $user = Config::get("db_user");
        $password = Config::get("db_pwd");
        $database = Config::get("db_name");
        $this->connection = new mysqli($host, $user, $password, $database);
    }
    
    public function getConnection()
    {
        return $this->connection;
    }
}