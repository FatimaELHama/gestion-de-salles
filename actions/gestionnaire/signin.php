<?php
session_start();
require_once "../../inc/User.php";
require_once "../../inc/config.php";

$email = htmlspecialchars(strip_tags($_POST["email"]));
$password = htmlspecialchars(strip_tags($_POST["password"]));

$response = $user->loginGest($email, $password);
echo json_encode($response);
