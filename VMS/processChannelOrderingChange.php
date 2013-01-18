<?php
require("Common.php");

echo "NEW ORDERING<br/>";
echo "============<br/>";
$orderList = $_REQUEST["channelTable"];

for($x=1;$x<sizeof($orderList)-1;$x++) {	
	$channel = $dbService->getChannelByID($orderList[$x]);
	echo $x." - [".$channel->getID()."]".$channel->getTitle()."(".$channel->getOrdering().")<br/>";
	$channel->setOrdering($x);
	$channel->update();
}


?>

<?php
$dbService->closeConnection();
?>