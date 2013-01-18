<?php
require("Common.php");


if (isset($_REQUEST["userid"])) {
	$userid = $_REQUEST["userid"];	
} else {
	header("location:login.php");
}

$user = $dbService->getUserByID($userid);
$user->setID($userid);

$user->setPassword(base64_encode($_REQUEST["newPassword"]));	

$returnString = "";
if ($userid == 0) {
	if ($user->store()) {
		$returnString =  "The password for ".$user->getUsername()." has been changed.";
	} else {
		$returnString =  "An Error Occurred while changing your password.";
	}
} else {
	if ($user->update()) {
		$returnString =  "The password for ".$user->getUsername()." has been changed.";
	} else {
		$returnString =  "An Error Occurred while changing your password.";
	}
	
}

echo "<center><b><h2>".$returnString."</h2></b></center>";

?>

<?php
$dbService->closeConnection();
?>