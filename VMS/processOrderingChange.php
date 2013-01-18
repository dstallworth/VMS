<?php
require("Common.php");

echo "NEW ORDERING<br/>";
echo "============<br/>";
$orderList = $_REQUEST["videoTabTable"];

for($x=1;$x<sizeof($orderList)-1;$x++) {	
	$video = $dbService->getSpecificVideo($orderList[$x]);
	echo $x." - [".$video->getID()."]".$video->getTitle()."(".$video->getOrdering().")<br/>";
	$video->setOrdering($x);
	$video->update();
}


?>

<?php
$dbService->closeConnection();
?>