<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";


$id_groupe = htmlspecialchars(strip_tags($_POST["groupeID"]));
$lundi_m = htmlspecialchars(strip_tags($_POST["lundi_matin"]));
$lundi_a = htmlspecialchars(strip_tags($_POST["lundi_apres"]));
$mardi_m = htmlspecialchars(strip_tags($_POST["mardi_matin"]));
$mardi_a = htmlspecialchars(strip_tags($_POST["mardi_apres"]));
$mercredi_m = htmlspecialchars(strip_tags($_POST["mercredi_matin"]));
$mercredi_a = htmlspecialchars(strip_tags($_POST["mercredi_apres"]));
$jeudi_m = htmlspecialchars(strip_tags($_POST["jeudi_matin"]));
$jeudi_a = htmlspecialchars(strip_tags($_POST["jeudi_apres"]));
$vendredi_m = htmlspecialchars(strip_tags($_POST["vendredi_matin"]));
$vendredi_a = htmlspecialchars(strip_tags($_POST["vendredi_apres"]));
$samedi_m = htmlspecialchars(strip_tags($_POST["samedi_matin"]));
$samedi_a = htmlspecialchars(strip_tags($_POST["samedi_apres"]));


$response = $user->updateGroupeEmploi($id_groupe, $lundi_m, $lundi_a, $mardi_m, $mardi_a, $mercredi_m, $mercredi_a, $jeudi_m, $jeudi_a, $vendredi_m, $vendredi_a, $samedi_m, $samedi_a);
echo json_encode($response);
