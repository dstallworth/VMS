<?php
class Comment {

	var $id;
	var $status;
	var $ip;
	var $title;
	var $comment;
	var $submitDate;
	var $published;
	var $userid;
	var $categroy;
	var $channel;
	
	
	public function Comment(){
		//$this->dbService = new DBService();
		
	}
	
	
	public function getID() {
		return $this->id;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
		
	public function getStatus() {
		return $this->status;
	}

	public function setStatus($status) {
		$this->status = $status;
	}
	
	public function getIP() {
		return $this->ip;
	}
	
	public function setIP($ip) {
		$this->ip = $ip;
	}
	
	public function getUserid() {
		return $this->userid;
	}
	
	public function setUserid($userid) {
		$this->userid = $userid;
	}
	
	public function getTitle() {
		return $this->title;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}
	
	public function getComment() {
		return $this->comment;
	}
	
	public function setComment($comment) {
		$this->comment = $comment;
	}
	
	public function getSubmitDate() {
		return $this->submitDate;
	}
	
	public function setSubmitDate($date) {
		$this->submitDate = $date;
	}
	
	public function getSubmitDateText() {
		$thisDate = $this->getSubmitDate();
		list($year,$mon,$endString) = split("-",$thisDate);
		list($day,$timeString) = split(" ",$endString);
		
		return $mon."/".$day."/".$year;
	}
	
	public function getPublished() {
		return $this->published;
	}
	
	public function setPublished($published) {
		$this->published = $published;
	}
	
	public function getCategory() {
		return $this->category;
	}
	
	public function setCategory($category) {
		$this->category = $category;
	}	
	
	public function getChannel() {
		return $this->channel;
	}
	
	public function setChannel($channel) {
		$this->channel = $channel;
	}
	
	
	public function load($row) {
		$this->id = $row['id'];
		$this->userid = $row['userid'];
		$this->status = $row['status'];
		$this->submitDate = $row['submitDate'];
		$this->ip = $row['ip'];
		$this->published = $row['published'];
		$this->title = $row['title'];
		$this->comment = $row['comment'];
		$this->category = $row['category'];
		$this->channel = $row['channel'];
		
		
	}
	
	public function store() { 
		$fieldList = "(userid,submitDate,published,comment,title,category,channel,status,ip)";
		$valueList = "(".$this->userid.",'".$this->submitDate."',".$this->published.",'".$this->comment."','".$this->title."',".$this->category.",".$this->channel.",'".$this->status."','".$this->ip."')";
				
		$insertSQL = "INSERT INTO ".Constants::$commentsTable.$fieldList." VALUES ".$valueList;
		echo $insertSQL;
		if (!mysql_query($insertSQL)) {
			die("Error:".mysql_error());
		} 
	}

}
?>

