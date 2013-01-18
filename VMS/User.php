<?php
class User {

	var $id;
	var $username;
	var $password;
	var $firstName;
	var $lastName;
	var $email;
	var $userType;
	var $registerDate;
	var $lastVisitDate;
	var $databaseID;
	var $insertSQL;
	var $updateSQL;
	
	
	public function User(){
		//$this->dbService = new DBService();
		
	}
	
	
	public function getID() {
		return $this->id;
	}
	
	public function setID($id) {
		$this->id = $id;
	}
		
	public function getUsername() {
		return $this->username;
	}

	public function setUsername($username) {
		$this->username = $username;
	}
	
	public function getPassword() {
		return $this->password;
	}
	
	public function setPassword($password) {
		$this->password = $password;
	}
	
	public function getFirstName() {
		return $this->firstName;
	}
	
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}
	
	public function getLastName() {
		return $this->lastName;
	}
	
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}
	
	public function getFullName() {
		return $this->firstName." ".$this->lastName;
	}
	
	public function getEmail() {
		return $this->email;
	}
	
	public function setEmail($email) {
		$this->email = $email;
	}
	
	public function getUserType() {
		return $this->userType;
	}
	
	public function setUserType($userType) {
		$this->userType = $userType;
	}
	
	public function getRegisterDate() {
		return $this->registerDate;
	}
	
	public function setRegisterDate($registerDate) {
		$this->registerDate = $registerDate;
	}
	
	public function getLastVisitDate() {
		return $this->lastVisitDate;
	}
	
	public function setLastVisitDate($lastVisitDate) {
		$this->lastVisitDate = $lastVisitDate;
	}		
	
	public function getDatabaseID() {
		return $this->databaseID;
	}
	
	public function setDatabaseID($dbID) {
		$this->databaseID = $dbID;
	}
	
	public function load($row) {
		$this->id = $row['id'];
		$this->username = $row['username'];
		$this->password = $row['password'];
		$this->firstName = $row['firstname'];
		$this->lastName = $row['lastname'];
		$this->email = $row['email'];
		$this->userType = $row['usertype'];
		$this->registerDate = $row['registerDate'];
		$this->lastVisitDate = $row['lastvisitDate'];		
		$this->databaseID = $row['databaseID'];
		
	}
	
	public function store() {
		$fieldList = " (username,password,firstname,lastname,email,usertype,registerDate,lastVisitDate,databaseID)";
		$valueList = "('".$this->username."','".$this->password."','".$this->firstName."','".$this->lastName."','".$this->email."',".$this->userType.",'".$this->registerDate."','".$this->lastVisitDate."','".$this->databaseID."')";
				
		$this->insertSQL = "INSERT INTO ".Constants::$userTable.$fieldList." VALUES ".$valueList;
		if (!mysql_query($this->insertSQL)) {
			die("Error:".mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function update() {
		$fieldList = " (username,password,firstname,lastname,email,usertype,registerDate,lastVisitDate,daftabaseID)";
		
				
		$updateSQL = "UPDATE ".Constants::$userTable." set ";
		$updateSQL .= " username = '".$this->username."',";
		$updateSQL .= " password = '".$this->password."',";
		$updateSQL .= " firstname = '".$this->firstName."',";
		$updateSQL .= " lastname = '".$this->lastName."',";
		$updateSQL .= " email = '".$this->email."',";
		$updateSQL .= " usertype = ".$this->userType.",";
		$updateSQL .= " registerDate = '".$this->registerDate."',";
		$updateSQL .= " lastvisitDate = '".$this->lastVisitDate."',";
		$updateSQL .= " databaseID = ".$this->databaseID." ";
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

