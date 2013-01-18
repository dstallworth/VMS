<?php
require("Common.php");

if (isset($_REQUEST["channelID"])) {
	$channelID = $_REQUEST["channelID"];
} else {
	$channelID = 0;
}

$channel =  $dbService->getChannelByID($channelID);


echo $channel->getXML();
?>