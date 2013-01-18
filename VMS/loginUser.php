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
if ($user = $loginService->loginUser($username,$password)) {	
	//session_start();
	$_SESSION["userID"] = $user->getID();
	$_SESSION["username"] = $user->getUsername();
	$_SESSION["firstname"] = $user->getFirstName();
	$_SESSION["databaseID"] = $user->getDatabaseID();
	$_SESSION["userType"] = $user->getUserType();
echo "USER: id = ".$user->getID()." username = ".$user->getUsername()."<br/>";	
	//$_SESSION["database"] = serialize($loginService->getDatabase($user->getDatabaseID()));
	$db = $loginService->getDatabase($user->getDatabaseID());
	$_SESSION["organization"] = $db->getOrganization();
	$_SESSION["database"] = serialize($db);
	$dbService = new DBService();
	$dbService->connectToDB($db->getHost(), $db->getUser(), $db->getPwd(), $db->getName());
	//header("location:home.php");
	echo 1;
} else {
	echo "The login information you entered was incorrect"; 
}
$loginService->closeConnection();

?>