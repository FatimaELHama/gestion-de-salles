<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["agStagID"]));
$groupe = htmlspecialchars(strip_tags($_POST["groupeSelect"]));

$response = $user->assignGroupe($id, $groupe);
echo json_encode($response);
