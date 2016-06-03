<?php

// Website title
Config::set("title", "Moviemate");

// Available directions
Config::set("directions", ["movies", "users", "search"]);
Config::set("special_directions", "search");

// Database credentials
Config::set("db_host", "localhost");
Config::set("db_user", "root");
Config::set("db_pwd", "");
Config::set("db_name", "moviemate");