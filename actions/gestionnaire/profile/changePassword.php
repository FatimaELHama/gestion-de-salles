<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_SESSION['gestionnaire']));
$currentPassword = htmlspecialchars(strip_tags($_POST["current_password"]));
$newPassword = htmlspecialchars(strip_tags($_POST["new_password"]));
$confirmNewPassword = htmlspecialchars(strip_tags($_POST["confirm_password"]));

$response = $user->gestChangePassword($id, $currentPassword, $newPassword, $confirmNewPassword);
echo json_encode($response);
