<?php
require dirname(__DIR__).DIRECTORY_SEPARATOR."initialize.php";

App::run($_SERVER["REQUEST_URI"]);
