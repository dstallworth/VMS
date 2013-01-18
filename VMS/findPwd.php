<?php
session_start();
//require("Common.php");
require("LoginService.php");
require("databaseService.php");

$username = "";
$password = "";

if (isset($_REQUEST["username"])) {
	$username = $_REQUEST["username"];
} 

if (isset($_REQUEST["password"])) {
	$password = $_REQUEST["password"];
}

$loginService = new LoginService();
$loginService->connect();
echo "<br/>".base64_decode($loginService->getPassword($username))."<br/>".$loginService->getPassword($username); 

$loginService->closeConnection();

?>