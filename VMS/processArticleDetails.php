<?php
require("Common.php");

$id = $_REQUEST["id"];
$title = $_REQUEST["title"];
$channel =  $_REQUEST["channel"];

if (isset($_REQUEST["published"])) {
	$published = "1";
} else {
	$published = "0";
}


//$ordering = $_REQUEST["ordering"];
$startPublish = $_REQUEST["startPublish"];
$endPublish = $_REQUEST["endPublish"];
//$createdBy
//$created
//$modified

$caption = $_REQUEST["caption"];
$mainText = $_REQUEST["mainText"];


$currentDateTime = date("Y-m-d H:i:s");

$article = $dbService->getSpecificArticle($id);
$article->setTitle($title);
$article->setChannelID($channel);
$article->setPublished($published);
$article->setPublishUp($startPublish);
$article->setPublishDown($endPublish);
$article->setCaption($caption);
$article->setMaintext($mainText);
$article->setModified($currentDateTime);
$article->setCategoryID(80);

if ($id == 0) {
	if ($article->store()) {
		echo "The article (".$article->getTitle().") has been added.";
	} else {
		echo "An Error Occurred while adding your article.";
	}
} else {
	if ($article->update()) {
		echo "The article (".$article->getTitle().") has been updated.";
	} else {
		echo "An Error Occurred while updating your article.";
	}
	
}

?>
<?php
$dbService->closeConnection();
?>