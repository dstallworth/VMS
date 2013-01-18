<?php
////////////////////////////////////////////////////////////////////////////////////////
// Class: Channel
// Purpose: Connect to a database, MySQL version
///////////////////////////////////////////////////////////////////////////////////////
//require_once 'SystemComponent.php';
//require_once 'databaseService.php';
require_once "Constants.php";

class Channel {

	var $id;
	var $title;
	var $name;
	var $image;
	var $scope;
	var $image_position;
	var $description;
	var $published;
	var $checked_out;
	var $checked_out_time;
	var $ordering;
	var $access;
	var $count;
	var $parentid;
	
	
	public function Channel(){
		//$this->dbService = new DBService();
		
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
		return str_replace("'","\'",$this->title);
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getNameXML() {
		return "<name>".$this->name."</name>";
	}
	
	public function getName() {
		return $this->name;
	}	
	
	public function setName($name) {
		$this->name = $name;
	}
	
	public function getImageXML() {
		return "<image>".$this->image."</image>";
	}
	
	public function getImage() {
		return $this->image;
	}
	
	public function setImage($image) {
		$this->image = $image;
	}
		
	public function getDescriptionXML() {
		return "<description>".$this->description."</description>";
	}
	
	public function getDescription() {
		return $this->description;
	}
	
	public function setDescription($description) {
		$this->description = $description;
	}
	
	public function getPublishedXML() {
		return "<published>".$this->published."</published>";
	}
	
	public function getPublished() {
		return $this->published;
	}
	
	public function setPublished($published) {
		$this->published = $published;
	}	
	
	public function getPublishedCheckBoxHTML() {
		$returnHTML = "";
		if ($this->getPublished()) {
			$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/checked.png\" width=\"16\" height=\"16\" onclick=\"javascript:checkPublish(this);\"> </div>";	
		} else {
			$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/unchecked.png\" width=\"16\" height=\"16\"/> </div>";	
		}
		$returnHTML = "<div id=\"imageToggle\"> <img id=\"publishImage\" src=\"images/checked.png\" width=\"16\" height=\"16\" onclick=\"javascript:checkPublish(this);\"> </div>";
		return $returnHTML;
	}	
	
	public function getOrderingXML() {
		return "<ordering>".$this->ordering."</ordering>";
	}
	
	public function getOrdering() {
		return $this->ordering;
	}
	
	public function setOrdering($ordering) {
		$this->ordering = $ordering;
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
		
	public function getCountXML() {
		return "<count>".$this->count."</count>";
	}
	
	public function getCount() {
		return $this->count;
	}
	
	public function setCount($count) {
		$this->count = $count;
	}
	
	public function getParamsXML() {
		return "<params>".$this->params."</params>";
	}
	
	public function getParams() {
		return $this->params;
	}
	
	public function setParams($params) {
		$this->params = $params;
	}
	
	public function getParentIDXML() {
		return "<parentid>".$this->parentid."</parentid>";
	}
	
	public function getParentid() {
		return $this->parentid;
	}
	
	public function setParentid($parentid) {
		$this->parentid = $parentid;
	}
			
			
	public function load($row) {
		$this->id = $row['id'];
		$this->title = $row['title'];
		$this->name = $row['name'];
		$this->image = $row['image'];
		$this->description = $row['description'];
		$this->published = $row['published'];
		$this->checked_out = $row['checked_out'];
		$this->checked_out_time = $row['checked_out_time'];
		$this->ordering = $row['ordering'];
		$this->access = $row['access'];
		//$this->count = $row['count'];
		$this->parentid = $row['parentid'];	
	}
	
	public function getXML() {
		$xmlString = "";
		$xmlString .= "<channel>";
		$xmlString .= $this->getIDXML();
		$xmlString .= $this->getTitleXML();
		$xmlString .= $this->getNameXML();
		$xmlString .= $this->getImageXML();
		$xmlString .= $this->getDescriptionXML();
		$xmlString .= $this->getPublishedXML();
		$xmlString .= $this->getCheckedOutXML();
		$xmlString .= $this->getCheckedOutTimeXML();
		$xmlString .= $this->getOrderingXML();
		$xmlString .= $this->getAccessXML();
		//$xmlString .= $this->getCountXML();
		$xmlString .= $this->getParentIDXML();
		$xmlString .= "</channel>";
		return $xmlString;
	
	}
	
	public function getMenuItem() {
		$menuString = "";
		$menuString .= "<menu label=\"".$this->getName()."\" data=\"".$this->getID()."\" />";
		
		return $menuString;
	}
	
	public function store() {
		$util = new Utility();
		
		$insertSQL = "insert into ".Constants::$channelTable;
		$insertSQL .= " (id,title,name,image,description,published,checked_out,checked_out_time,ordering,access,count,parentid)";
		$insertSQL .= " values (";
		$insertSQL .= $this->getID().",";
		$insertSQL .= "'".$util->dbFormat($this->getTitle())."',";
		$insertSQL .= "'".$util->dbFormat($this->getName())."',";
		$insertSQL .= "'".$util->dbFormat($this->getImage())."',";
		$insertSQL .= "'".$util->dbFormat($this->getDescription())."',";		
		$insertSQL .= $this->checkEmpty($this->getPublished()).",";
		$insertSQL .= $this->checkEmpty($this->getCheckedOut()).",";
		$insertSQL .= "'".$util->dbFormat($this->getCheckedOutTime())."',";
		$insertSQL .= $this->getOrdering().",";
		$insertSQL .= $this->checkEmpty($this->getAccess()).",";
		$insertSQL .= $this->checkEmpty($this->getCount()).",";
		$insertSQL .= $this->getParentid();
		$insertSQL .= ")";
				
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
		
		$updateSQL = "update ".Constants::$channelTable." set ";		
		$updateSQL .= " title = '".$util->dbFormat($this->getTitle())."',";
		$updateSQL .= " name = '".$util->dbFormat($this->getName())."',";
		$updateSQL .= " image = '".$util->dbFormat($this->getImage())."',";
		$updateSQL .= " description = '".$util->dbFormat($this->getDescription())."',";		
		$updateSQL .= " published = ".$this->getPublished().",";
		$updateSQL .= " checked_out = ".$this->checkEmpty($this->getCheckedOut()).",";
		$updateSQL .= " checked_out_time = '".$util->dbFormat($this->getCheckedOutTime())."',";
		$updateSQL .= " ordering = ".$this->getOrdering().",";
		$updateSQL .= " access = ".$this->checkEmpty($this->getAccess()).",";
		$updateSQL .= " count = ".$this->checkEmpty($this->getCount()).",";
		$updateSQL .= " parentid = ".$this->getParentid();
		$updateSQL .= " where id = ".$this->getID();
		
//echo "UPDATE SQL = ".$updateSQL;	
//echo " UPDATING (".$this->getID().") ".$this->getTitle()." Ordering to ".$this->getOrdering()."\n";	
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function delete() {
		$deleteSQL = "delete from  ".Constants::$channelTable." where id = ".$this->getID();
		$result = mysql_query($deleteSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	private function checkEmpty($value) {
		if (($value == "") || ($value == null)) {
			return 0;
		} else {
			return $value;
		}
	}
}
?>

