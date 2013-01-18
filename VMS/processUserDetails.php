<?php
require("Common.php");

$id = $_REQUEST["id"];
if (isset($_REQUEST["changePassword"])) {
	$changePassword = $_REQUEST["changePassword"];	
} else {
	$changePassword = false;
}

$username =  $_REQUEST["username"];
$password = $_REQUEST["password"];
$firstname = $_REQUEST["firstname"];
$lastname = $_REQUEST["lastname"];
$email = $_REQUEST["email"];
if (isset($_REQUEST["registerDate"])) {
	$registerDate = $_REQUEST["registerDate"];
} else {
	$registerDate = date("m/d/Y");
}

$usertype = $_REQUEST["usertype"];

$user = $dbService->getUserByID($id);
$user->setID($id);
$user->setUsername($username);
if ($changePassword) {
	$user->setPassword(base64_encode($password));	
}
$user->setFirstName($firstname);
$user->setLastName($lastname);
$user->setEmail($email);
$user->setRegisterDate($registerDate);
$user->setUserType($usertype);

$returnString = "";
if ($id == 0) {
	if ($user->store()) {
		$returnString =  "The user (".$user->getUsername().") has been added.";
	} else {
		$returnString =  "An Error Occurred while adding this user.";
	}
} else {
	if ($user->update()) {
		$returnString =  "The user (".$user->getUsername().") has been updated.";
	} else {
		$returnString =  "An Error Occurred while updating this user.";
	}
	
}

echo "<center><b><h2>".$returnString."</h2></b></center>";

?>

<?php
$dbService->closeConnection();
?>