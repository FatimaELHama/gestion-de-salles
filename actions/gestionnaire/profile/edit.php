<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$id = htmlspecialchars(strip_tags($_SESSION['gestionnaire']));
$nom = htmlspecialchars(strip_tags($_POST["nom"]));
$prenom = htmlspecialchars(strip_tags($_POST["prenom"]));

$response = $user->updateGestionnaireProfile($id, $nom, $prenom);
echo json_encode($response);
