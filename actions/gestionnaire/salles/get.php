<?php
session_start();
require_once "../../../inc/User.php";
require_once "../../../inc/config.php";

$page = $_GET['p'];
$limit = 9;
$paginationStart = ($page - 1) * $limit;
$modules = $user->getModulesPaginated($paginationStart, $limit);
echo json_encode($modules);
