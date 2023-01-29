<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["stagiaireID"]));

$response = $user->deleteStagiare($id);
echo json_encode($response);
