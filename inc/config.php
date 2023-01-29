<?php
if (!isset($_SESSION)) {
    session_start();
}

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Database credentials
$server = "localhost";
$username = "root";
$password = "root";
$database = "gestionnotes";

$user = new User();
$user->connectDB($server, $username, $password, $database);
