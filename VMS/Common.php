<?php
session_start();
require_once 'SystemComponent.php';
require_once 'databaseService.php';
require_once 'Utility.php';
//require_once 'Constants.php';
require_once 'Video.php';
require_once 'VideoFormat.php';
//require_once 'Article.php';
require_once 'Channel.php';
require_once 'Content.php';
require_once 'Comment.php';
require_once 'User.php';
require_once 'UserType.php';
require_once 'Database.php';

$organization = $_SESSION["organization"];
$dbService = new DBService();

$db = unserialize($_SESSION["database"]);
$dbService->setDBHost($db->getHost());
$dbService->setDBUser($db->getUser());
$dbService->setDBPass($db->getPwd());
$dbService->setDBName($db->getName());

$dbService->connect();
$util = new Utility();

$userType = $_SESSION["userType"];


?>