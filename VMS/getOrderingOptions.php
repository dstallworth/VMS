<?php
require("Common.php");

if (isset($_REQUEST["channelID"])) {
	$channelID = $_REQUEST["channelID"];
} else {
	$channelID = 0;
}

$orderingMax =  $dbService->getNextOrderingForChannel($channelID);
$returnOptions = "";

for ($x=1;$x<=$orderingMax;$x++) {
	$returnOptions .="<option value=\"".$x."\">".$x."</option>";	
}

echo $returnOptions;
?>