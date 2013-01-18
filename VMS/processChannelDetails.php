<?php
require("Common.php");

$id = $_REQUEST["id"];
$name =  $_REQUEST["name"];

if (isset($_REQUEST["published"])) {
	$published = "1";
} else {
	$published = "0";
}


$description = $_REQUEST["description"];
$ordering = $_REQUEST["ordering"];
$parentID = $_REQUEST["parentID"];


$currentDateTime = date("Y-m-d H:i:s");

$channel = $dbService->getChannelByID($id);
$channel->setID($id);
$channel->setName($name);
$channel->setTitle($name);
$channel->setPublished($published);
$channel->setDescription($description);
$channel->setOrdering($ordering);
$channel->setParentid($parentID);

$returnString = "";
if ($id == 0) {
	if ($channel->store()) {
		$returnString =  "The channel (".$channel->getTitle().") has been added.";
	} else {
		$returnString =  "An Error Occurred while adding your channel.";
	}
} else {
	if ($channel->update()) {
		$returnString =  "The channel (".$channel->getTitle().") has been updated.";
	} else {
		$returnString =  "An Error Occurred while updating your channel.";
	}
	
}

echo "<center><b><h2>".$returnString."</h2></b></center>";

?>

<?php
$dbService->closeConnection();
?>