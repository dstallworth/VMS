<?php
require("Constants.php");
require("Database.php");
require("User.php");

class LoginService {

	//LOCAL DATABASE PARAMETERS
	/*
	private $dbhost = "localhost:3306";
	private $dbuser = "root"; 	
	private $dbpass = "mysql";	//"password";	
	private $dbname = "vms";	
	
	*/
	
	//PRODUCTION (GoDaddy) DATABASE PARAMETERS
	
	private $dbhost = "tvwebcityvms.db.3597151.hostedresource.com";	//	"mysqladmin2.secureserver.net";	//"p3smysql55.secureserver.net";   //"tvw0720007434489.db.3597151.hostedresource.com ";
	private $dbuser = "tvwebcityvms";
	private $dbpass = "Tvwebcity2007";
	private $dbname = "tvwebcityvms";
			
	private $conn = "";
	
	private static $instance;
	
	public function LoginService() {
	}
	
	public static function getInstance() {
		
		if(self::$instance == null) {
			//echo "Getting LoginService Instance. Instance = Null<br/>";
			self::$instance = new self();
		}
		return self::$instance;
	}

	
	public function connect() {
		$this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ("Error connecting to mysql");
		mysql_select_db($this->dbname,$this->conn);
	}
	
	public function connectToDB($thisHost, $thisUser, $thisPass, $thisName) {		
		$this->setDBHost($thisHost.":3306");
		$this->setDBUser($thisUser);
		$this->setDBPass($thisPass);
		$this->setDBName($thisName);
		$this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ("Error connecting to mysql");
		mysql_select_db($this->dbname,$this->conn);
	}
	
	public function closeConnection() {
		mysql_close($this->conn);
	}
	
	public function setDBHost($host) {
		$this->dbhost = $host;
	}
	
	public function getDBHost() {
		return $this->dbhost;
	}
	
	public function setDBUser($user) {
		$this->dbuser = $user;
	}
	
	public function getDBUser() {
		return $this->dbuser;
	}
	
	public function setDBPass($pass) {
		$this->dbpass = $pass;
	}
	
	public function getDBPass() {
		return $this->dbpass;
	}
	
	public function setDBName($name) {
		$this->dbname = $name;
	}
	
	public function getDBName() {
		return $this->dbname;
	}
		
	public function getDatabase($dbid) {
		$this->query  = "SELECT * from ".Constants::$databaseTable." WHERE id = ".$dbid;				
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$db = new Database();
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{		  
		  $db->load($cursor);			
		}
		return $db;
	}
	
	public function loginUser($username,$password) {
		$this->query  = "SELECT * from ".Constants::$userTable." WHERE username = '".$username."' AND password = '".base64_encode($password)."'";		
		$result = mysql_query($this->query);
		if(!$result){return false;}
		
		$user = new User();
		$userCount = 0;
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{		  
		  $user->load($cursor);	
		  $userCount++;	  		 
		}
		
		if ($userCount != 0) {
			//$this->closeConnection();
			return $user;
		}

		return false;
	}			
	
	
		
}
?>