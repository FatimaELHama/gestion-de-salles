<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_POST["id"]));
$cne = htmlspecialchars(strip_tags($_POST['cne']));
$nom = htmlspecialchars(strip_tags($_POST["nom"]));
$prenom = htmlspecialchars(strip_tags($_POST["prenom"]));
$dateNaiss = htmlspecialchars(strip_tags($_POST["dateNaiss"]));
$email = htmlspecialchars(strip_tags($_POST["email"]));
$telephone = htmlspecialchars(strip_tags($_POST["telephone"]));

$response = $user->updateStagiaire($id, $cne, $nom, $prenom, $dateNaiss, $email, $telephone);
echo json_encode($response);
