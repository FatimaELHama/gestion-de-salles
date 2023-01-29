<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$title = htmlspecialchars(strip_tags($_POST["nGroupe"]));

$response = $user->addGroupe($title);
echo json_encode($response);
