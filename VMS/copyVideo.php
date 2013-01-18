<?php
require("Common.php");

$id = $_REQUEST["videoID"];
$channel =  $_REQUEST["newChannelID"];
$currentDateTime = date("Y-m-d H:i:s");
$newChannelID = 0;

$video = $dbService->getSpecificVideo($id);
$video->setID($newChannelID);
$video->setChannelID($channel);
$video->setModified($currentDateTime);

if ($dbService->addNewVideo($video)) {
	echo "1";
} else {
	echo "0";
}

?>