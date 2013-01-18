<?php echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
require("Common.php");
header("Content-type: text/xml");
$xmlString = "";
$result = $dbService->getAllVideos();
$resultCount = 1;
//$xmlString .= "<?xml version=\"1.0\" encoding=\"UTF-8\">\n";
$xmlString .= "<videos>\n";
//while($rs = mysql_fetch_array($result, MYSQL_ASSOC))
foreach($result as $content)
{
	//$content = new Content();
	//$content->load($rs);
	$xmlString .= "<video>\n";	
	$xmlString .= $content->getIDXML();
	$xmlString .= $content->getTitleXML();
	$xmlString .= $content->getVideoDirectoryXML();
	$xmlString .= $content->getCaptionXML();
	$xmlString .= $content->getFilenameXML();
	$xmlString .= "<channelName>".$dbService->getChannelByID($content->getChannelID())->getName()."</channelName>";
	$xmlString .= "</video>\n";
}

$xmlString .= "</videos>\n";
$xmlString = ltrim($xmlString);
print "";
flush();
print $xmlString;
?>
