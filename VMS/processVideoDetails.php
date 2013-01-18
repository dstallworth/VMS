<?php
require("Common.php");

$id = $_REQUEST["id"];
$title = $_REQUEST["title"];
$channel =  $_REQUEST["channel"];
$hits = $_REQUEST["hits"];
$videoDirectory = $_REQUEST["videoDirectory"];
if (isset($_REQUEST["published"])) {
	$published = $_REQUEST["published"];
} else {
	$published = "0";
}
$ordering = $_REQUEST["ordering"];
$startPublish = $_REQUEST["startPublish"];
$endPublish = $_REQUEST["endPublish"];
//$createdBy
//$created
//$modified
$hoverText = $_REQUEST["hoverText"];
$caption = $_REQUEST["caption"];
$filename = $_REQUEST["filename"];
$formatExtension = $_REQUEST["formatExtension"];
$relatedArticleID = $_REQUEST["relatedArticleID"];
$metaKey = $_REQUEST["metaKey"];
$metaDesc = $_REQUEST["metaDesc"];
$currentDateTime = date("Y-m-d H:i:s");

$video = $dbService->getSpecificVideo($id);
$oldOrdering = $video->getOrdering();

$video->setTitle($title);
$video->setChannelID($channel);
$video->setHits($hits);
$video->setVideoDirectory($videoDirectory);
$video->setPublished($published);
$video->setOrdering($ordering);
$video->setPublishUp($startPublish);
$video->setPublishDown($endPublish);
$video->setHoverText($hoverText);
$video->setCaption($caption);
$video->setFilename($filename);
$video->setRelatedArticle($relatedArticleID);
$video->setMetaKey($metaKey);
$video->setMetaDesc($metaDesc);
$video->setModified($currentDateTime);
$video->setFormatExtension($formatExtension);




if ($id == 0) {
	$dbService->adjustVideoOrderingForAdd($video->getChannelID(),$video->getOrdering());
	if ($video->store()) {
		echo "The video (".$video->getTitle().") has been added.";
	} else {
		$dbService->adjustVideoOrderingForRemove($video->getChannelID(),$video->getOrdering());
		echo "An Error Occurred while adding your video.";
	}
} else {
	if ($ordering != $oldOrdering) {
		//$oldVideo->delete(); //Update ordering of video [not oldVideo] to 0 instead of deleting
		$video->setOrdering(0);
		$video->update();
		$dbService->adjustVideoOrderingForRemove($video->getChannelID(),$oldOrdering);
		$dbService->adjustVideoOrderingForAdd($video->getChannelID(),$ordering);
		//Update ordering of video again to new ordering
		$video->setOrdering($ordering);		
		if ($video->update()) {
			echo "The video (".$video->getTitle().") has been updated.";
		} else {
			echo "An Error Occurred while updating your video.";
		}		
	} else {
		if ($video->update()) {
			echo "The video (".$video->getTitle().") has been updated.";
		} else {
			echo "An Error Occurred while updating your video.";
		}
	}
	
}

?>

<?php
$dbService->closeConnection();
?>