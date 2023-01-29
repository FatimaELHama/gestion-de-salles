<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["id"]));
$title = htmlspecialchars(strip_tags($_POST["nGroupe"]));

$response = $user->updateGroupe($id, $title);
echo json_encode($response);
