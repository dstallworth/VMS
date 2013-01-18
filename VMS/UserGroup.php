<?php
class UserGroup {

	var $id;
	var $name;
	
	public function UserGroup(){
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
	
	
	public function load($row) {
		$this->id = $row['id'];
		$this->name = $row['name'];	
		
	}
	
	public function store() {
		$fieldList = " (name)";
		$valueList = "('".$this->name."')";
				
		$insertSQL = "INSERT INTO ".Constants::$userGroupTable.$fieldList." VALUES ".$valueList;
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

