<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["salleID"]));

$response = $user->deleteSalle($id);
echo json_encode($response);
