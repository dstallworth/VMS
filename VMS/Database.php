<?php

class Database {
	
	var $id;
	var $host;
	var $user;
	var $pwd;
	var $name;
	var $organization;
	
	public function Database() {
		
	}
	
	public function getID() {
		return $this->id;
	} 
	
	public function setID($thisID) {
		$this->id = $thisID;
	}
	
	public function getHost() {
		return $this->host;
	} 
	
	public function setHost($thisHost) {
		$this->host = $thisHost;
	}
	
	public function getUser() {
		return $this->user;
	} 
	
	public function setUser($thisUser) {
		$this->user = $thisUser;
	}
	
	public function getPwd() {
		return $this->pwd;
	} 
	
	public function setPwd($thisPwd) {
		$this->pwd = $thisPwd;
	}
	
	public function getName() {
		return $this->name;
	} 
	
	public function setName($thisName) {
		$this->name = $thisName;
	}
	
	public function getOrganization() {
		return $this->organization;
	} 
	
	public function setOrganization($thisOrg) {
		$this->organization = $thisOrg;
	}
	
	public function load($row) {
		$this->id = $row['id'];
		$this->host = $row['host'];
		$this->user = $row['user'];
		$this->pwd = $row['password'];
		$this->name = $row['name'];		
		$this->organization = $row['organization'];
		
	}
	
	public function store() {
		$fieldList = " (host,user,password,name,organization)";
		$valueList = "('".$this->host."','".$this->user."','".$this->password."','".$this->name."','".$this->organization."')";
				
		$this->insertSQL = "INSERT INTO ".Constants::$databaseTable.$fieldList." VALUES ".$valueList;
		if (!mysql_query($this->insertSQL)) {
			die("Error:".mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function update() {
		$fieldList = " (host,user,password,name,organization)";
		
				
		$updateSQL = "UPDATE ".Constants::$databaseTable." set ";
		$updateSQL .= " host = '".$this->host."',";
		$updateSQL .= " user = '".$this->user."',";
		$updateSQL .= " password = '".$this->pwd."',";
		$updateSQL .= " name = '".$this->name."'";
		$updateSQL .= " organization = '".$this->organization."'";
		$updateSQL .= " where id = ".$this->getID();
	
		if (!mysql_query($updateSQL)) {
			die("Error:".mysql_error());
			return false;
		} else {
			return true;
		}
	}
}

?>
