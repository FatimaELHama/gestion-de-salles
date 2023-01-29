<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["afStagID"]));
$module = htmlspecialchars(strip_tags($_POST["moduleSelect"]));

$response = $user->assignModule($id, $module);
echo json_encode($response);
