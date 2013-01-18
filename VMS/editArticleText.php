<?php
require("Common.php");

$articleID = $_REQUEST["articleID"];
$articleText = $_REQUEST["newArticleText"];

$article = $dbService->getSpecificArticle($articleID);
$article->setMainText($articleText);

$article->update();
/*if ($article->update()) {
	echo "SUCCESS";
} else {
	echo "FAILURE";
}*/

?>