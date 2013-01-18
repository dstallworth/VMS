<?php
class UserType {

	var $id;
	var $name;
	var $permissionLevel;	
	
	public function UserType(){
		//$this->dbService = new DBService();
		
	}
	
	
	public function getID() {
		return $this->id;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
		
	public function getName() {
		return $this->name;
	}

	public function setName($name) {
		$this->name = $name;
	}
	
	public function getPermissionLevel() {
		return $this->permissionLevel;
	}
	
	public function setPermissionLevel($permissionLevel) {
		$this->permissionLevel = $permissionLevel;
	}
	
	
	
	public function load($row) {
		$this->id = $row['id'];
		$this->name = $row['name'];
		$this->permissionLevel = $row['permission_level'];			
		
	}
	
	public function store() {
		$fieldList = " (name,permission_level)";
		$valueList = "('".$this->name."',".$this->permission_level."')";
				
		$insertSQL = "INSERT INTO ".Constants::$userTypeTable.$fieldList." VALUES ".$valueList;
		if (!mysql_query($insertSQL)) {
			die("Error:".mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function update() {
		
		$updateSQL = "UPDATE ".Constants::$userTypeTable." set ";
		$updateSQL .= " name = '".$this->name."',";
		$updateSQL .= " permission_level = '".$this->permissionLevel;
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

