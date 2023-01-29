<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$page = $_GET['p'];
$limit = 10;
$paginationStart = ($page - 1) * $limit;
$groupes = $user->getGroupesPaginated($paginationStart, $limit);
echo json_encode($groupes);
