<?php
require("Common.php");

if (isset($_REQUEST["channelID"])) {
	$channelID = $_REQUEST["channelID"];
} else {
	$channelID = 0;
}

echo $dbService->getNextOrderingForChannel($channelID);
?>