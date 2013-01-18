<?php

class Content {

	var $id;
	var $title;
	var $video_directory;
	var $caption;
	var $hovertext;
	var $maintext;
	var $filename;
	var $formatExtension;
	var $state;
	var $channelid;	
	var $catid;
	var $created;
	var $created_by;
	var $related_article;
	var $modified;
	var $modified_by;
	var $checked_out;
	var $checked_out_time;
	var $publish_up;
	var $publish_down;
	var $thumbnail;
	var $urls;
	var $version;
	var $parentid;
	var $ordering;
	var $metakey;
	var $metadesc;
	var $access;
	var $hits;
	var $locked;
	var $articleXMLString;
	
	
	public function Content(){
	
	}
	
	public function getIDXML() {
		return "<id>".$this->id."</id>";
	}
	
	public function getID() {
		return $this->id;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
	
	public function getTitleXML() {
		return "<title>".$this->title."</title>";
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function getTitle_js() {
		//return str_replace("'","",$this->title);
		return htmlentities($this->title);
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getVideoDirectoryXML() {
		return "<videoDirectory>".$this->video_directory."</videoDirectory>";
	}
	
	public function getVideoDirectory() {
		return $this->video_directory;
	}
	
	public function getVideoDirectory_js() {
		//return str_replace("'","",$this->video_directory);
		return htmlentities($this->video_directory);
	}
	
	public function setVideoDirectory($videoDirectory) {
		$this->video_directory = $videoDirectory;
	}
	
	public function getCaptionXML() {
		return "<caption>".$this->caption."</caption>";
	}
	
	public function getCaption() {
		return $this->caption;
	}
	
	public function getCaption_js() {
		//return str_replace("'","",$this->caption);
		return htmlentities($this->caption);
	}
	
	public function setCaption($caption) {
		$this->caption = $caption;
	}
	
	public function getHovertextXML() {
		return "<hoverText>".$this->hovertext."</hoverText>";
	}
	
	public function getHovertext() {
		return $this->hovertext;
	}
	
	public function getHovertext_js() {
		//return str_replace("'","",$this->hovertext);
		return htmlentities($this->hovertext);
	}
	
	
	public function setHovertext($hovertext) {
		$this->hovertext = $hovertext;
	}	
		
		
	public function getMaintextXML() {
		return "<mainText>".$this->fulltext."</mainText>";
	}
	
	public function getMaintext() {
		return $this->maintext;
	}
	
	public function getMaintext_js() {
		//return str_replace("'","",$this->maintext);
		return htmlentities($this->maintext);
	}
	
	
	public function setMaintext($maintext) {
		$this->maintext = $maintext;
	}

	public function getFilenameXML() {
		return "<filename>".$this->filename."</filename>";
	}
	
	public function getFilename() {
		return $this->filename;
	}
	
	public function getFilename_js() {		
		return htmlentities($this->filename);
	}	
	
	public function setFilename($filename) {
		$this->filename = $filename;
	}
	
	public function getFormatExtension() {
		return $this->formatExtension;
	}
	
	public function getFormatExtensionXML() {
		return "<formatExtension>".$this->formatExtension."</formatExtension>";
	}
	
	public function setFormatExtension($extension) {
		$this->formatExtension = $extension;
	}

	public function getChannelIDXML() {
		return "<channelID>".$this->channelid."</channelID>";
	}
	
	public function getChannelID() {
		return $this->channelid;
	}
	
	public function setChannelID($channelID) {
		$this->channelid = $channelID;
	}
	
	/*public function getChannelNameXML() {
		$dbService = new DBService();
		return "<channelName>".$dbService->getChannelByID($this->getChannelID())->getName()."</channelName>";
	}*/
	
	/*public function getChannelName() {
		$dbService = new DBService();
		return $dbService->getChannelByID($this->getChannelID())->getName();
	}*/
	
	
	public function getCategoryIDXML() {
		return "<categoryID>".$this->catid."</categoryID>";
	}
	
	public function getCategoryID() {
		return $this->catid;
	}
	
	public function setCategoryID($catid) {
		$this->catid = $catid;
	}
	
	/*public function getCategoryXML() {
		return "<category>".$dbService->getCategory($this->getCategoryID())."</category>";
	}*/
	
	/*public function getCategory() {
		return $dbService->getCategory($this->getCategoryID());
	}*/
		
	public function getCreatedXML() {
		return "<created>".$this->created."</created>";
	}
	
	public function getCreated() {
		return $this->created;
	}
	
	public function setCreated($creationDate) {
		$this->created = $creationDate;
	}
	
	public function getCreatedByXML() {
		return "<createdBy>".$this->created_by."</createdBy>";
	}
	
	public function getCreatedBy() {
		return $this->created_by;
	}
	
	public function setCreatedBy($createdBy) {
		$this->created_by = $createdBy;
	}
	
	/*public function getCreatedByName() {
		return $dbService->getSpecificUser($this->getCreatedBy())->getFullName();
	}*/
		
	public function getCreatedByAliasXML() {
		return "<relatedArticle>".$this->related_article."</relatedArticle>";		
	}
	
	/*public function getArticleXML() {
		return "<relatedArticle>".$dbService->getSpecificArticle($this->related_article)->getXML()."</relatedArticle>";		
	}*/
	
	public function getRelatedArticle() {
		return $this->related_article;
	}
	
	public function setRelatedArticle($relatedArticle) {
		$this->related_article = $relatedArticle;
	}
	
	/*public function getRelatedArticleTitle() {
		$dbService = new DBService();
		return $dbService->getSpecificArticle($this->getRelatedArticle())->getTitle();
	}*/
	
	/*public function getRelatedArticleText() {
		$dbService = new DBService();
		return $dbService->getSpecificArticle($this->getRelatedArticle())->getMaintext();
	}*/
	
	
	public function getModifiedXML() {
		return "<modified>".$this->modified."</modified>";
	}
	
	public function getModified() {
		return $this->modified;
	}
	
	public function setModified($modifiedDate) {
		$this->modified = $modifiedDate;
	}
	
	public function getModifiedByXML() {
		return "<modifiedBy>".$this->modified."</modifiedBy>";
	}
	
	public function getModifiedBy() {
		return $this->modified_by;
	}
	
	public function setModifiedBy($modifiedBy) {
		$this->modified_by = $modifiedBy;
	}
	
	public function getCheckedOutXML() {
		return "<checkedOut>".$this->checked_out."</checkedOut>";
	}
	
	public function getCheckedOut() {
		return $this->checked_out;
	}
	
	public function setCheckedOut($checkedOut) {
		$this->checked_out = $checkedOut;
	}
	
	public function getCheckedOutTimeXML() {
		return "<checkedOutTime>".$this->checked_out_time."</checkedOutTime>";
	}
	
	public function getCheckedOutTime() {
		return $this->checked_out_time;
	}
	
	public function setCheckedOutTime($checkedOutTime) {
		$this->checked_out_time = $checkedOutTime;
	}
	
	public function getPublishUpXML() {
		return "<publishUp>".$this->publish_up."</publishUp>";
	}
	
	public function getPublishUp() {
		return $this->publish_up;
	}
	
	public function setPublishUp($publishUp) {
		$this->publish_up = $publishUp;
	}
	
	public function getPublishDownXML() {
		return "<publishDown>".$this->publish_down."</publishDown>";
	}
	
	public function getPublishDown() {
		return $this->publish_down;
	}
	
	public function setPublishDown($publishDown) {
		$this->publish_down = $publishDown;
	}
	
	public function getThumbnailXML() {
		return "<thumbnail>".$this->thumbnail."</thumbnail>";
	}
	
	public function getThumbnail() {
		return $this->thumbnail;
	}
	
	public function setThumbnail($thumbnail) {
		$this->thumbnail = $thumbnail;
	}
	
	public function getURLsXML(){
		return "<urls>".$this->urls."</urls>";
	}
	
	public function getURLs(){
		return $this->urls;
	}
	
	public function setURLs($urls) {
		$this->urls = $urls;
	}
			
	public function getVersionXML() {
		return "<version>".$this->version."</version>";
	}
	
	public function getVersion() {
		return $this->version;
	}
	
	public function setVersion($version) {
		$this->version = $version;
	}
	
	public function getParentIDXML() {
		return "<parentID>".$this->parentid."</parentID>";
	}
	
	public function getParentID() {
		return $this->parentid;
	}
	
	public function setParentID($parentid) {
		$this->parentid = $parentid;
	}
	
	public function getOrderingXML()
	{
		return "<ordering>".$this->ordering."</ordering>";
	}
	
	public function getOrdering()
	{
		return $this->ordering;
	}
	
	public function setOrdering($value)
	{
		$this->ordering = $value;
	}
	
	public function getMetakeyXML() {
		return "<metakey>".$this->metakey."</metakey>";
	}
	
	public function getMetakey() {
		return $this->metakey;
	}
	
	public function setMetakey($metakey) {
		$this->metakey = $metakey;
	}
	
	public function getMetadescXML() {
		return "<metadesc>".$this->metadesc."</metadesc>";
	}
	
	public function getMetadesc() {
		return $this->metadesc;
	}
	
	public function setMetadesc($metadesc) {
		$this->metadesc = $metadesc;
	}
	
	public function getAccessXML() {
		return "<access>".$this->access."</access>";
	}
	
	public function getAccess() {
		return $this->access;
	}
	
	public function setAccess($access) {
		$this->access = $access;
	}
	
	public function getHitsXML() {
		return "<hits>".$this->hits."</hits>";
	}
	
	public function getHits() {
		return $this->hits;
	}
	
	public function setHits($hits) {
		$this->hits = $hits;
	}
	
	public function getStateXML() {
		return "<state>".$this->state."</state>";
	}
	
	public function getState() {
		return $this->state;
	}
	
	public function setState($state) {
		$this->state = $state;
	}
	
	public function getPublishedXML() {
		return $this->getStateXML();
	}
	
	public function getPublished() {
		return $this->getState();
	}
	
	public function setPublished($state) {
		$this->setState($state);
	}
	
	public function getPublishedCheckBoxHTML() {
		$returnHTML = "";
		if ($this->getState()) {
			$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/checked.png\" width=\"20\" height=\"20\" onclick=\"javascript:checkPublish(this);\"> </div>";	
		} else {
			$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/unchecked.png\" width=\"20\" height=\"20\"/> </div>";	
		}
		//$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/checked.png\" width=\"20\" height=\"20\" onclick=\"javascript:checkPublish(this);\"> </div>";
		return $returnHTML;
	}
	
	public function getLocked() {
		return $this->locked;
	}
	
	public function isLocked() {
		return $this->locked;
	}
	
	public function setLocked($lock) {
		$this->locked = $lock;
	}
	
	
	public function getToolTip() {
		$searchArray = array("'","&#39;");
		$replaceArray = array("","");
		$hoverText = "";
		$vidText = str_replace($searchArray,$replaceArray,$this->getHovertext());
		
		$hoverText = $hoverText."<table background=d4d4d4>";
		//$hoverText = $hoverText."<tr style=\"background: url('images/cosmoHoverBg.png') no-repeat center;\"><td>".$vidText."</td></tr>";
		$hoverText = $hoverText."<tr><td>".$vidText."</td></tr>";
		$hoverText = $hoverText."</table>";
		
		return $hoverText;
	}
	
	

	public function load($row) {
		$this->id = $row['id'];
		$this->title = $row['title'];
		$this->video_directory = $row['video_directory'];
		$this->caption = 	$row['caption'];	//str_replace('"','\"',$row['introtext']);
		$this->hovertext = $row['hovertext'];
		$this->maintext = $row['maintext'];//str_replace('"','\"',$row['maintext']);
		$this->filename = $row['filename'];
		$this->state = $row['state'];
		$this->channelid = $row['channelid'];
		$this->catid = $row['catid'];
		$this->created = $row['created'];
		$this->created_by = $row['created_by'];
		$this->related_article = $row['related_article'];
		$this->modified = $row['modified'];
		$this->modified_by = $row['modified_by'];
		$this->checked_out = $row['checked_out'];
		$this->checked_out_time = $row['checked_out_time'];
		$this->publish_up = $row['publish_up'];
		$this->publish_down = $row['publish_down'];
		$this->thumbnail = $row['thumbnail'];
		$this->urls = $row['urls'];		
		$this->version = $row['version'];
		$this->parentid = $row['parentid'];
		$this->ordering = $row['ordering'];
		$this->metakey = $row['metakey'];
		$this->metadesc = $row['metadesc'];
		$this->access = $row['access'];
		$this->hits = $row['hits'];
		$this->formatExtension = $row['format_extension'];
	
	}
	
	
	public function getXML() {
		$xmlString = "";
		$xmlString .= $this->getIDXML();
		$xmlString .= $this->getTitleXML();
		$xmlString .= $this->getVideoDirectoryXML();
		$xmlString .= $this->getCaptionXML();
		$xmlString .= $this->getHovertextXML();
		$xmlString .= $this->getMaintextXML();	
		$xmlString .= $this->getFilenameXML();	
		$xmlString .= $this->getStateXML();
		$xmlString .= $this->getChannelIDXML();
		$xmlString .= $this->getCategoryIDXML();
		$xmlString .= $this->getCreatedXML();
		$xmlString .= $this->getCreatedByXML();
		$xmlString .= $this->getRelatedArticleXML();
		$xmlString .= $this->getModifiedXML();
		$xmlString .= $this->getModifiedByXML();
		$xmlString .= $this->getCheckedOutXML();
		$xmlString .= $this->getCheckedOutTimeXML();
		$xmlString .= $this->getPublishUpXML();
		$xmlString .= $this->getPublishDownXML();
		$xmlString .= $this->getThumbnailXML();
		$xmlString .= $this->getURLsXML();
		$xmlString .= $this->getVersionXML();
		$xmlString .= $this->getParentIDXML();
		$xmlString .= $this->getOrderingXML();
		$xmlString .= $this->getMetakeyXML();
		$xmlString .= $this->getMetadescXML();
		$xmlString .= $this->getAccessXML();
		$xmlString .= $this->getHitsXML();
		$xmlString .= $this->getFormatExtensionXML();
		
		return $xmlString;
	
	}
	
	public function getExtendedXML() {
		$xmlString = "";
		$xmlString .= $this->getIDXML();
		$xmlString .= $this->getTitleXML();
		$xmlString .= $this->getVideoDirectoryXML();
		$xmlString .= $this->getCaptionXML();
		$xmlString .= $this->getHovertextXML();
		$xmlString .= $this->getMaintextXML();	
		$xmlString .= $this->getFilenameXML();	
		$xmlString .= $this->getStateXML();
		$xmlString .= $this->getChannelIDXML();
		$xmlString .= $this->getCategoryIDXML();
		$xmlString .= $this->getCreatedXML();
		$xmlString .= $this->getCreatedByXML();
		$xmlString .= $this->getRelatedArticleXML();
		$xmlString .= $this->getModifiedXML();
		$xmlString .= $this->getModifiedByXML();
		$xmlString .= $this->getCheckedOutXML();
		$xmlString .= $this->getCheckedOutTimeXML();
		$xmlString .= $this->getPublishUpXML();
		$xmlString .= $this->getPublishDownXML();
		$xmlString .= $this->getThumbnailXML();
		$xmlString .= $this->getURLsXML();
		$xmlString .= $this->getVersionXML();
		$xmlString .= $this->getParentIDXML();
		$xmlString .= $this->getOrderingXML();
		$xmlString .= $this->getMetakeyXML();
		$xmlString .= $this->getMetadescXML();
		$xmlString .= $this->getAccessXML();
		$xmlString .= $this->getHitsXML();
		$xmlString .= $this->getFormatExtensionXML();
		
		
		return $xmlString;
	
	}
	
	public function store() {
		$util = new Utility();
		
		$insertSQL = "insert into ".Constants::$contentTable;
		$insertSQL .= " (id,title,video_directory,caption,hovertext,maintext,filename,state,channelid,catid,created,created_by,related_article,modified,modified_by,checked_out," .
				"checked_out_time,publish_up,publish_down,thumbnail,urls,version,parentid,ordering,metakey,metadesc,access,format_extension)";
		$insertSQL .= " values (";
		$insertSQL .= "null ,";
		$insertSQL .= "'".$util->dbFormat($this->getTitle())."',";
		$insertSQL .= "'".$this->getVideoDirectory()."',"; //
		$insertSQL .= "'".$util->dbFormat($this->getCaption())."',"; ///caption
		$insertSQL .= "'".$util->dbFormat($this->getHovertext())."',"; //hovertext
		$insertSQL .= "'".$util->dbFormat($this->getMaintext())."',";	//maintext
		$insertSQL .= "'".$util->dbFormat($this->getFilename())."',"; //filename		
		$insertSQL .= $this->checkEmpty($this->getState()).",";	//state
		$insertSQL .= $this->checkEmpty($this->getChannelID()).","; //channelid
		$insertSQL .= $this->checkEmpty($this->getCategoryID()).",";	//catid
		$insertSQL .= "'".$this->checkEmptyDateTime($this->getCreated())."',";	//created	
		$insertSQL .= $this->checkEmpty($this->getCreatedBy()).",";	//created_by
		$insertSQL .= $this->checkEmpty($this->getRelatedArticle()).",";	//related_article
		$insertSQL .= "'".$this->checkEmptyDateTime($this->getModified())."',";	//modified
		$insertSQL .= $this->checkEmpty($this->getModifiedBy()).","; //modified_by
		$insertSQL .= $this->checkEmpty($this->getCheckedOut()).",";  //checked_out
		$insertSQL .= "'".$this->checkEmptyDateTime($this->getCheckedOutTime())."',";  //checked_out)time
		$insertSQL .= "'".$this->checkEmptyDateTime($this->getPublishUp())."',";  // publish_up
		$insertSQL .= "'".$this->checkEmptyDateTime($this->getPublishDown())."',";  // publish_down
		$insertSQL .= "'".$this->getThumbnail()."',";	//thumbnail
		$insertSQL .= "'".$this->getURLs()."',";		//urls
		$insertSQL .= $this->checkEmpty($this->getVersion()).",";  // version
		$insertSQL .= $this->checkEmpty($this->getParentID()).","; //parentid
		$insertSQL .= $this->checkEmpty($this->getOrdering()).","; // ordering
		$insertSQL .= "'".$util->dbFormat($this->getMetakey())."',"; // metakey
		$insertSQL .= "'".$util->dbFormat($this->getMetadesc())."',";  //metadesc
		$insertSQL .= $this->checkEmpty($this->getAccess()).", "; //access
		$insertSQL .= "'".$this->getFormatExtension()."'";
									
		$insertSQL .= ")";
//echo "SQL - ".$insertSQL;		
		$result = mysql_query($insertSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function update() {
		$util = new Utility();
		
		$updateSQL = "update ".Constants::$contentTable." set ";
		$updateSQL .= " title = '".$util->dbFormat($this->getTitle())."',";
		$updateSQL .= " video_directory = '".$this->getVideoDirectory()."',"; //
		$updateSQL .= " caption = '".$util->dbFormat($this->getCaption())."',"; ///caption
		$updateSQL .= " hovertext = '".$util->dbFormat($this->getHovertext())."',"; //hovertext
		$updateSQL .= " maintext = '".$util->dbFormat($this->getMaintext())."',";	//maintext
		$updateSQL .= " filename = '".$util->dbFormat($this->getFilename())."',"; //filename		
		$updateSQL .= " state = ".$this->checkEmpty($this->getState()).",";	//state
		$updateSQL .= " channelid = ".$this->checkEmpty($this->getChannelID()).","; //channelid
		$updateSQL .= " catid = ".$this->checkEmpty($this->getCategoryID()).",";	//catid
		$updateSQL .= " created = '".$this->checkEmptyDateTime($this->getCreated())."',";	//created	
		$updateSQL .= " created_by = ".$this->checkEmpty($this->getCreatedBy()).",";	//created_by
		$updateSQL .= " related_article = ".$this->checkEmpty($this->getRelatedArticle()).",";	//related_article
		$updateSQL .= " modified = '".$this->getModified()."',";	//modified
		$updateSQL .= " modified_by = ".$this->checkEmpty($this->getModifiedBy()).","; //modified_by
		$updateSQL .= " checked_out = ".$this->checkEmpty($this->getCheckedOut()).",";  //checked_out
		$updateSQL .= " checked_out_time = '".$this->checkEmptyDateTime($this->getCheckedOutTime())."',";  //checked_out)time
		$updateSQL .= " publish_up = '".$this->checkEmptyDateTime($this->getPublishUp())."',";  // publish_up
		$updateSQL .= " publish_down = '".$this->checkEmptyDateTime($this->getPublishDown())."',";  // publish_down
		$updateSQL .= " thumbnail = '".$this->getThumbnail()."',";	//thumbnail
		$updateSQL .= " urls = '".$this->getURLs()."',";		//urls
		$updateSQL .= " version = ".$this->checkEmpty($this->getVersion()).",";  // version
		$updateSQL .= " parentid = ".$this->checkEmpty($this->getParentID()).","; //parentid
		$updateSQL .= " ordering = ".$this->checkEmpty($this->getOrdering()).","; // ordering
		$updateSQL .= " metakey = '".$util->dbFormat($this->getMetakey())."',"; // metakey
		$updateSQL .= " metadesc = '".$util->dbFormat($this->getMetadesc())."',";  //metadesc
		$updateSQL .= " access = ".$this->checkEmpty($this->getAccess()).", "; //access
		$updateSQL .= " format_extension = '".$this->getFormatExtension()."' ";
		$updateSQL .= " where id = ".$this->getID();
		
		//echo "SQL - ".$updateSQL;		
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function delete() {
		$deleteSQL = "delete from  ".Constants::$contentTable." where id = ".$this->getID();
echo "DELETE SQL = ".$deleteSQL;		
		$result = mysql_query($deleteSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function getHeadlinesXML() {
		$xmlString = "";
		$xmlString .= "<headline url=\"".$this->getRelatedArticle()."\">";
		$xmlString .= $this->getCaption();
		$xmlString .= "</headline>";
		
		
		return $xmlString;
	}
	
	public function getTermsXML() {
		$xmlString = "";
		$xmlString .= "<text>";
		$xmlString .= $this->getMaintext();
		$xmlString .= "</text>";
		
		
		return $xmlString;
	}
	
	public function getAboutUsXML() {
		$xmlString = "";
		$xmlString .= "<text>";
		$xmlString .= $this->getMaintext();
		$xmlString .= "</text>";
		
		
		return $xmlString;
	}
	
	private function checkEmpty($value) {
		if (($value == "") || ($value == null)) {
			return 0;
		} else {
			return $value;
		}
	}
	
	private function checkEmptyDateTime($value) {
		if (($value == "") || ($value == null)) {
			return "0000-00-00 00:00:00";
		} else {
			return $value;
		}
	}
	

}
?>

