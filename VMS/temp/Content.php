<?php


class Content {

	var $id;
	var $title;
	var $title_alias;
	var $introtext;
	var $fulltext;
	var $state;
	var $sectionid;
	var $mask;
	var $catid;
	var $created;
	var $created_by;
	var $created_by_alias;
	var $modified;
	var $modified_by;
	var $checked_out;
	var $checked_out_time;
	var $publish_up;
	var $publish_down;
	var $images;
	var $urls;
	var $attribs;
	var $version;
	var $parentid;
	var $ordering;
	var $metakey;
	var $metadesc;
	var $access;
	var $hits;
	var $articleXMLString;
	var $dbService;
	
	
	public function Content(){
		$dbService = new DBService();
		
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
		$this->setTitle(str_replace("'","&#39;",$this->title));
		return htmlentities($this->title);
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getTitleAliasXML() {
		return "<titleAlias>".$this->title_alias."</titleAlias>";
	}
	
	public function getTitleAlias() {
		return $this->title_alias;
	}
	
	public function getTitleAlias_js() {
		//return str_replace("'","",$this->title_alias);
		return htmlentities($this->title_alias);
	}
	
	public function setTitleAlias($titleAlias) {
		$this->title_alias = $titleAlias;
	}
	
	public function getIntrotextXML() {
		return "<introText>".$this->introtext."</introText>";
	}
	
	public function getIntrotext() {
		return $this->introtext;
	}
	
	public function getIntrotext_js() {
		//return str_replace("'","",$this->introtext);
		return htmlentities($this->introtext);
	}
	
	public function setIntrotext($introtext) {
		$this->introtext = $introtext;
	}
	
	public function getFulltextXML() {
		return "<fullText>".$this->fulltext."</fullText>";
	}
	
	public function getThumbnailXML() {
		return "<thumbnail>".strtolower($this->fulltext)."</thumbnail>";
	}
	
	public function getFulltext() {
		return $this->fulltext;
	}
	
	public function getFulltext_js() {
		//return str_replace("'","",$this->fulltext);
		return htmlentities($this->fulltext);
	}
	
	
	public function setFulltext($fulltext) {
		$this->fulltext = $fulltext;
	}
	
	public function getChannelIDXML() {
		return "<channelID>".$this->sectionid."</channelID>";
	}
	
	public function getChannelID() {
		return $this->sectionid;
	}
	
	public function setChannelID($channelID) {
		$this->sectionid = $channelID;
	}
	
	public function getChannelNameXML() {
		return "<channelName>".$dbService->getChannel($this->getChannelID())."</channelName>";
	}
	
	public function getChannelName() {
		return $dbService->getChannel($this->getChannelID());
	}
	
	public function getCategoryIDXML() {
		return "<categoryID>".$this->catid."</categoryID>";
	}
	
	public function getCategoryID() {
		return $this->catid;
	}
	
	public function setCategoryID($catid) {
		$this->catid = $catid;
	}
	
	public function getCategoryXML() {
		return "<category>".$dbService->getCategory($this->getCategoryID())."</category>";
	}
	
	public function getCategory() {
		return $dbService->getCategory($this->getCategoryID());
	}
		
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
	
	public function getRelatedArticle($articleID) {
		
		$dbs = new DBService();
		$articleXMLString = $dbs->getArticle($articleID)->getArticleXML();
		
		return $articleXMLString;
	}
	
	public function getCreatedByAliasXML() {
		return "<createdByAlias>".$this->created_by_alias."</createdByAlias>";		
	}
	
	public function getArticleXML() {
		return "<createdByAlias>".$dbService->getSpecificArticle($this->created_by_alias)->getXML()."</createdByAlias>";		
	}
	
	public function getCreatedByAlias() {
		return $this->created_by_alias;
	}
	
	public function setCreatedByAlias($createdByAlias) {
		$this->created_by_alias = $createdByAlias;
	}
	
	
	
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
	
	public function getImagesXML() {
		return "<images>".$this->images."</images>";
	}
	
	public function getImages() {
		return $this->images;
	}
	
	public function setImages($images) {
		$this->images = $images;
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
	
	public function getAttributesXML() {
		return "<attributes>".$this->attribs."</attributes>";
	}
	
	public function getAttributes() {
		return $this->attribs;
	}
	
	public function setAttributes($attribs) {
		$this->attribs = $attribs;
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
	
	public function getSectionIDXML() {
		return "<sectionID>".$this->sectionid."</sectionID>";
	}
	
	public function getSectionID() {
		return $this->sectionid;
	}
	
	public function setSectionID($secID) {
		$this->sectionid = $secID;
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
	
	public function getRelated() {
		$attributes = $this->getAttributes();
		$startIndex = strpos($attributes,"keyref");
		$endIndex = strpos($attributes,"docbook_type");
		$indexDiff =$endIndex-($startIndex+7);
		
		$related = substr($attributes,$startIndex+7,$indexDiff);
		
		return $related;
	}
	
	public function getToolTip() {
		$searchArray = array("'","&#39;");
		$replaceArray = array("","");
		$hoverText = "";
		$vidText = str_replace($searchArray,$replaceArray,$this->getIntrotext());
		
		$hoverText = $hoverText."<table background=d4d4d4>";
		//$hoverText = $hoverText."<tr style=\"background: url('images/cosmoHoverBg.png') no-repeat center;\"><td>".$vidText."</td></tr>";
		$hoverText = $hoverText."<tr><td>".$vidText."</td></tr>";
		$hoverText = $hoverText."</table>";
		
		return $hoverText;
	}
	
	

	public function load($row) {
		$this->id = $row['id'];
		$this->title = $row['title'];
		$this->title_alias = $row['title_alias'];
		$this->introtext = 	$row['introtext'];	//str_replace('"','\"',$row['introtext']);
		$this->fulltext = $row['fulltext'];//str_replace('"','\"',$row['fulltext']);
		$this->state = $row['state'];
		$this->sectionid = $row['sectionid'];
		$this->mask = $row['mask'];
		$this->catid = $row['catid'];
		$this->created = $row['created'];
		$this->created_by = $row['created_by'];
		$this->created_by_alias = $row['created_by_alias'];
		$this->modified = $row['modified'];
		$this->modified_by = $row['modified_by'];
		$this->checked_out = $row['checked_out'];
		$this->checked_out_time = $row['checked_out_time'];
		$this->publish_up = $row['publish_up'];
		$this->publish_down = $row['publish_down'];
		$this->images = $row['images'];
		$this->urls = $row['urls'];
		$this->attribs = $row['attribs'];
		$this->version = $row['version'];
		$this->parentid = $row['parentid'];
		$this->ordering = $row['ordering'];
		$this->metakey = $row['metakey'];
		$this->metadesc = $row['metadesc'];
		$this->access = $row['access'];
		$this->hits = $row['hits'];
	
	}
	
	
	public function getXML() {
		$xmlString = "";
		$xmlString .= $this->getIDXML();
		$xmlString .= $this->getTitleXML();
		$xmlString .= $this->getTitleAliasXML();
		$xmlString .= $this->getIntrotextXML();
		$xmlString .= $this->getFulltextXML();
		$xmlString .= $this->getThumbnailXML();
		$xmlString .= $this->getStateXML();
		$xmlString .= $this->getSectionIDXML();
		$xmlString .= $this->getCategoryIDXML();
		$xmlString .= $this->getCreatedXML();
		$xmlString .= $this->getCreatedByXML();
		$xmlString .= $this->getCreatedByAliasXML();
		$xmlString .= $this->getModifiedXML();
		$xmlString .= $this->getModifiedByXML();
		$xmlString .= $this->getCheckedOutXML();
		$xmlString .= $this->getCheckedOutTimeXML();
		$xmlString .= $this->getPublishUpXML();
		$xmlString .= $this->getPublishDownXML();
		$xmlString .= $this->getImagesXML();
		$xmlString .= $this->getURLsXML();
		//$xmlString .= $this->getAttributesXML();
		$xmlString .= $this->getVersionXML();
		$xmlString .= $this->getParentIDXML();
		$xmlString .= $this->getOrderingXML();
		$xmlString .= $this->getMetakeyXML();
		$xmlString .= $this->getMetadescXML();
		$xmlString .= $this->getAccessXML();
		$xmlString .= $this->getHitsXML();
		
		return $xmlString;
	
	}
	
	public function getExtendedXML() {
		$xmlString = "";
		$xmlString .= $this->getIDXML();
		$xmlString .= $this->getTitleXML();
		$xmlString .= $this->getTitleAliasXML();
		$xmlString .= $this->getIntrotextXML();
		$xmlString .= $this->getFulltextXML();
		$xmlString .= $this->getThumbnailXML();
		$xmlString .= $this->getStateXML();
		$xmlString .= $this->getSectionIDXML();
		$xmlString .= $this->getCategoryIDXML();
		$xmlString .= $this->getCreatedXML();
		$xmlString .= $this->getCreatedByXML();
		$xmlString .= $this->getArticleXML();
		$xmlString .= $this->getModifiedXML();
		$xmlString .= $this->getModifiedByXML();
		$xmlString .= $this->getCheckedOutXML();
		$xmlString .= $this->getCheckedOutTimeXML();
		$xmlString .= $this->getPublishUpXML();
		$xmlString .= $this->getPublishDownXML();
		
		$xmlString .= $this->getImagesXML();
		$xmlString .= $this->getURLsXML();
		//$xmlString .= $this->getAttributesXML();
		$xmlString .= $this->getVersionXML();
		$xmlString .= $this->getParentIDXML();
		$xmlString .= $this->getOrderingXML();
		$xmlString .= $this->getMetakeyXML();
		$xmlString .= $this->getMetadescXML();
		$xmlString .= $this->getAccessXML();
		$xmlString .= $this->getHitsXML();
		
		return $xmlString;
	
	}
	
	
	public function getHeadlinesXML() {
		$xmlString = "";
		$xmlString .= "<headline url=\"".$this->getTitleAlias()."\">";
		$xmlString .= $this->getIntrotext();
		$xmlString .= "</headline>";
		
		
		return $xmlString;
	}
	
	public function getTermsXML() {
		$xmlString = "";
		$xmlString .= "<text>";
		$xmlString .= $this->getFulltext();
		$xmlString .= "</text>";
		
		
		return $xmlString;
	}
	
	public function getAboutUsXML() {
		$xmlString = "";
		$xmlString .= "<text>";
		$xmlString .= $this->getFulltext();
		$xmlString .= "</text>";
		
		
		return $xmlString;
	}
	
	private function parseDate($dateValue) {			
		$dateTimeStr = explode(" ",$dateValue);
		$dateStr = $dateTimeStr[0];
		$thisDate = explode("-",$dateStr);
		$month = $thisDate[1];
		$day = $thisDate[2];
		$year = $thisDate[0];
		
		$returnDate = mktime(0,0,0,$month,$day,$year);
		
		return $returnDate;
		
		
	}
	
	private function daysSince($dateValue) {			
		$dateTimeStr = explode(" ",$dateValue);
		$dateStr = $dateTimeStr[0];
		$thisDate = explode("-",$dateStr);
		$month = $thisDate[1];
		$day = $thisDate[2];
		$year = $thisDate[0];
		
		
		$theDateValue = date("U",mktime(0,0,0,$month,$day,$year));
		$nowDate = date("U",mktime(0,0,0,date("m"),date("d"),date("Y")));
		$secondsSince = $nowDate - $theDateValue;
		$daysSince = (int) ($secondsSince / 86400);
		
		return $daysSince;
		
		
	}
	 
	private function date_diff($d1, $d2){
	/* compares two timestamps and returns array with differencies (year, month, day, hour, minute, second)
	*/
	  //check higher timestamp and switch if neccessary
	  if ($d1 < $d2){
	    $temp = $d2;
	    $d2 = $d1;
	    $d1 = $temp;
	  }
	  else {
	    $temp = $d1; //temp can be used for day count if required
	  }
	  $d1 = date_parse(date("Y-m-d",$d1));
	  $d2 = date_parse(date("Y-m-d",$d2));
	  //seconds
	  if ($d1['second'] >= $d2['second']){
	    $diff['second'] = $d1['second'] - $d2['second'];
	  }
	  else {
	    $d1['minute']--;
	    $diff['second'] = 60-$d2['second']+$d1['second'];
	  }
	  //minutes
	  if ($d1['minute'] >= $d2['minute']){
	    $diff['minute'] = $d1['minute'] - $d2['minute'];
	  }
	  else {
	    $d1['hour']--;
	    $diff['minute'] = 60-$d2['minute']+$d1['minute'];
	  }
	  //hours
	  if ($d1['hour'] >= $d2['hour']){
	    $diff['hour'] = $d1['hour'] - $d2['hour'];
	  }
	  else {
	    $d1['day']--;
	    $diff['hour'] = 24-$d2['hour']+$d1['hour'];
	  }
	  //days
	  if ($d1['day'] >= $d2['day']){
	    $diff['day'] = $d1['day'] - $d2['day'];
	  }
	  else {
	    $d1['month']--;
	    $diff['day'] = date("t",$temp)-$d2['day']+$d1['day'];
	  }
	  //months
	  if ($d1['month'] >= $d2['month']){
	    $diff['month'] = $d1['month'] - $d2['month'];
	  }
	  else {
	    $d1['year']--;
	    $diff['month'] = 12-$d2['month']+$d1['month'];
	  }
	  //years
	  $diff['year'] = $d1['year'] - $d2['year'];
	  return $diff;    
	}
	
	private function getCurrentDate() {
		return mktime(0,0,0,date("m"),date("d"),date("Y"));
	}
	
	public function howLongAgo($dateValue) {
		//$difference = date_diff($this->parseDate($dateValue),$this->getCurrentDate());
		$dateTimeStr = explode(" ",$dateValue);
		$dateStr = $dateTimeStr[0];
		//$difference = $this->date_diff($dateStr,date("Y-m-d"));
		
		
		
		return $this->daysSince($dateValue);
	}

	public function daysSinceAdded() {
		return $this->howLongAgo($this->getModified());
	}
	
	public function getKeywordsAsAltTag() {
		//$keyWordArray = array();
		//$keyWordArray = explode(",",$this->getMetakey());
		$kWordAlt = str_replace(", ","-",$this->getMetakey());
		$kWordAlt = str_replace(",","-",$kWordAlt);
		
		return $kWordAlt;
	}
}
?>