<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["id"]));
$nom = htmlspecialchars(strip_tags($_POST["nSalle"]));
$location = htmlspecialchars(strip_tags($_POST["location"]));

$response = $user->updateSalle($id, $nom, $location);
echo json_encode($response);
