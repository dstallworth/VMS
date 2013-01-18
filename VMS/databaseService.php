<?php
//require("Constants.php");

class DBService {

	static $contentTable = "content";
	static $videoTable = "videos";
	static $articleTable = "articles";
	static $channelTable = "channels";
	static $categoryTable = "categories";
	static $commentsTable = "comments";
	static $userTable = "users";
	static $userTypeTable = "usertypes";
	static $userGroupTable = "user_group";
	static $videoFormatTable = "video_format";
	static $databaseTable = "database";
	static $channelVideoTable = "channel_video";
	
	static $published = "1";
	static $videoCategory = "1";
	static $articleCategory = "2";
	static $headlineCategory = "3";
	
	static $channelNameField = "name";
	
	static $articleTitleField = "title";
	static $articleTextField = "fulltext";
	static $relatedArticleField = "parentid";
	
	static $videoNameField = "title";
	static $videoFullNameField = "title_alias";
	static $videoCaptionField = "introtext";
	
	static $imageLocation = "http://localhost/iMariah/images/";
	static $videoBaseLocation = "http://tvwebcity.com/vids/";
	//LOCAL DATABASE PARAMETERS
	
	////private $dbhost = "localhost:3306";
	////private $dbuser = "root"; 	
	////private $dbpass = "mysql";	//"password";	
	////private $dbname = "vms";	
	
	//PRODUCTION (GoDaddy) DATABASE PARAMETERS
	/*
	private $dbhost = "p3smysql55.secureserver.net";	//	"mysqladmin2.secureserver.net";	//"p3smysql55.secureserver.net";   //"tvw0720007434489.db.3597151.hostedresource.com ";
	private $dbuser = "tvw0720007434489";
	private $dbpass = "vEcretr9";
	private $dbname = "tvw0720007434489";
		
	*/
	
	private $dbhost = "68.178.137.28";	//	"mysqladmin2.secureserver.net";	//"p3smysql55.secureserver.net";   //"tvw0720007434489.db.3597151.hostedresource.com ";
	private $dbuser = "VMSystem";
	private $dbpass = "Inert!a82";
	private $dbname = "VMSystem";
	
	
	private $conn = "";
	
	private $publishedClause = " AND state = 1";
	private $publishedClause2 = " WHERE state = 1";
	private $publishedClause3 = " AND published = 1";
	private $publishedClause4 = " WHERE published = 1";
	private $videoWhereClause = " ";
	private $videoOrderingClause = " order by ordering ASC, created DESC, hits DESC";
	private $videoOrderingLatestClause = " order by created DESC, hits DESC, ordering ASC";
	private $videoOrderingPopularClause = " order by hits DESC, created DESC, ordering ASC";
	private $articleOrderingClause = " order by created DESC, ordering ASC";
	private $relatedClause = " AND keywords like ";
	private $resultLimitString = "";
	
	public $resultLimit;
	public $query;
	public $insert = "INSERTING";
	private static $counter=0;
	
	private static $instance;
	
	/*private function DBService() {
		self::$counter++;	
		echo "CREATING DBService (".self::$counter.")<br/>";	
		$this->videoWhereClause = " Where catid in (SELECT id FROM ".$categoryTable." where category_type = 1)";
	}
	*/
	
	public function DBService() {
		$this->videoWhereClause = " Where catid in (SELECT id FROM ".$categoryTable." where category_type = 1)";
	}
	
	public static function getInstance() {
		echo "Getting DBService Instance<br/>";
		
		if(!self::$instance instanceof DBService) {
			echo "Getting Instance. Instance = Null<br/>";
			self::$instance = new DBService();
			
		}
		
		return self::$instance;
	}
	
	public static function getSessionInstance() {
		echo "Getting DBService Session Instance<br/>";
		
		if(!isset($_SESSION["instance"])) {
			echo "Getting Instance. Instance = Null<br/>";
			self::$instance = new DBService();
			$_SESSION["instance"] = serialize(self::$instance);
		}else {
			echo "Instance in session: ".unserialize($_SESSION["instance"])->getConn();
		}
		
		//return self::$instance;
		return unserialize($_SESSION["instance"]);
	}
	
	

	public function getConn() {
		return $this->conn;
	}
	public function connect() {
		//if (!isset($_SESSION["dbConnection"])) {
			//echo "NO EXISTING CONNECTION";
			$this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ("Error connecting to mysql");
			//$_SESSION["dbConnection"] = serialize($this->conn);	
			//echo "NEW CONNECTION = ".$this->conn;
		//} else {
			//$this->conn = unserialize($_SESSION["dbConnection"]);
			//echo "CONNECTION EXISTS (".$this->conn.")";
		//}
		//echo "DB CONNECTION = ".$this->conn;
		mysql_select_db($this->dbname,$this->conn);
		
	}
	
	public function connectToDB($thisHost, $thisUser, $thisPass, $thisName) {		
		$this->setDBHost($thisHost);
		$this->setDBUser($thisUser);
		$this->setDBPass($thisPass);
		$this->setDBName($thisName);
		$this->conn = mysql_connect($this->dbhost, $this->dbuser, $this->dbpass) or die ("Error connecting to mysql");
//echo "<br/>CONNECTED TO DB ".$this->conn;
		//$_SESSION["dbConnection"] = serialize($this->conn);		
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
echo "<br/>Connection = ".$this->conn;

		$this->query  = "SELECT * from ".$databaseTable." WHERE id = ".$dbid;				
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$db = new Database();
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{		  
		  $db->load($cursor);			
		}
		return $db;
	}
	
	private function buildSearchOrderingClause($sText) {
		return " order by locate('".$sText."',metadesc)";		
	}
	
	private function buildRelatedClause($wordList) {
		
		if ($wordList == "") return " (metakey like '%TVWebCity%') order by created desc";
		
		$returnString = "";
		$strArray = explode(",",$wordList);
		$strCount = 0;
		for ($i=0;$i<count($strArray);$i++) {
			$strCount++;
			if ($i == 0) {
				$returnString .= " (metakey like '%".$strArray[$i]."%')";
			} else {
				$returnString .= " OR (metakey like '%".$strArray[$i]."%')";
			}
		}
		
		
		
		return $returnString." order by created desc";
	}
	
	private function getResultLimitString() {
		if (isset($this->resultLimit) && ($this->resultLimit != "")) {
			return " LIMIT ".$this->resultLimit;
		} else {
			return "";
		}
	}
	
	private function getContentList($result) {
		$contentList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$content = new Content();
			$content->load($cursor);			
			$contentList[] = $content; 
		}
		
		return $contentList;
	}
	
	private function getChannelList($result) {
		$channelList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$channel = new Channel();
			$channel->load($cursor);
			$channelList[] = $channel; 
		}
		
		return $channelList;
	}
	
	private function getCommentList($result) {
		$commentList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$comment = new Comment();
			$comment->load($cursor);
			$commentList[] = $comment; 
		}
		
		return $commentList;
	}
	
	private function getFormatList($result) {
		$formatList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$format = new VideoFormat();
			$format->load($cursor);
			$formatList[] = $format; 
		}
		
		return $formatList;
	}
	
	private function getUserList($result) {
		$userList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$user = new User();
			$user->load($cursor);
			$userList[] = $user; 
		}
		
		return $userList;
	}
	
	private function getUserTypeList($result) {
		$userTypeList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$usertype = new UserType();
			$usertype->load($cursor);
			$userTypeList[] = $usertype; 
		}
		
		return $userTypeList;
	}
	
	public function getAllContent() {
		$this->query  = "SELECT * FROM ".$contentTable.$this->publishedClause2." order by created,title";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllVideos() {
		$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos')".$this->publishedClause;
//echo "QUERY: ".$this->query;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllUsers() {
		$this->query  = "SELECT * from ".$userTable;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getUserList($result);
	}
	
	public function getAllUserTypes() {
		$this->query  = "SELECT * from ".$userTypeTable." order by permission_level desc";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getUserTypeList($result);
	}
	
	public function getAllRelatedVideos($videoID) {
		$quickQuery = "SELECT metakey from ".$contentTable." Where id = ".$videoID;
		$quickResult = mysql_query($quickQuery);
		if(!$quickResult){die(mysql_error());}
		$quickRow = mysql_fetch_array($quickResult, MYSQL_ASSOC);
		$keywords = $quickRow["metakey"];
		$relatedClause = $this->buildRelatedClause($keywords);
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos')".$this->publishedClause." AND ".$relatedClause.$this->getResultLimitString();
		$this->query  = "SELECT distinct * from ".$contentTable." Where catid in (".$this->getCategoryIDList("Videos").")".$this->publishedClause." AND ".$relatedClause.$this->getResultLimitString();
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	
	private function getCategoryIDForChannel($categoryName,$channelID) {
		$this->query  = "SELECT `id` FROM ".$categoryTable." where `title` like '%".$categoryName."%' AND `channel` = ".$channelID;			
		$thisID = 0;	
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$thisID =  $cursor['id'];
		if ($thisID == null) $thisID = 0;
		return $thisID;
		
	}
	
	private function getCategoryIDList($categoryName) {
		$this->query  = "SELECT `id` FROM ".$categoryTable." where `title` like '%".$categoryName."%'";			
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$idList = "";
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			if (strlen($idList) == 0){
				$idList =  $cursor['id'];				
			} else {
				$idList =  $idList.",".$cursor['id'];
			}
		}
		return $idList;
		
	}
	
	
	public function getAllArticles() {
		$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles')";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllVideosForChannel($channelID) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		//$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingClause.$this->getResultLimitString();
		$this->query  = "SELECT * from ".$contentTable.$this->videoWhereClause." AND channelid = ".$channelID.$this->videoOrderingClause.$this->getResultLimitString();		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllPublishedVideosForChannel($channelID) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		//$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingClause.$this->getResultLimitString();
		$this->query  = "SELECT * from ".$contentTable.$this->videoWhereClause." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingClause.$this->getResultLimitString();
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getLatestVideos() {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM jos_categories where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") ".$this->publishedClause.$this->videoOrderingLatestClause.$this->getResultLimitString();
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getLatestVideosForChannel($channelID) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingLatestClause.$this->getResultLimitString();
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getPopularVideosForChannel($channelID) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingPopularClause.$this->getResultLimitString();
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getLeadVideoForChannel($channelID) {
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause." order by ordering limit 1";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$video = new Content();
		$video->load($cursor);
		return $video;
	}
	
	public function getLeadVideoForSearch($searchText) {
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (metadesc like '%".$searchText."%' OR title like '%".$searchText."%' )".$this->publishedClause.$this->buildSearchOrderingClause($searchText);
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$video = new Content();
		$video->load($cursor);
		return $video;
		
		return $result;
	}
	
	public function getSpecificVideo($videoID) {
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where id = ".$videoID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$video = new Content();
		$video->load($cursor);
		return $video;
	}
	
	public function getListOfVideos($videoList) {		
		
		$catName = "Videos";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title like '%Headlines%') AND sectionid = 2 ".$this->publishedClause." order by ordering ASC";
		$this->query  = "SELECT * from ".$contentTable." Where id in (".$videoList.")";				
		//$this->query  = "SELECT * from ".$contentTable." Where id in (265,665,641)";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getSpecificArticle($articleID) {		
		 
		$queryString = "SELECT * from ".$contentTable." Where id = ".$articleID;
		//echo "QUERY: ".$queryString;
		$this->query  = $queryString;
		
		$article = new Content();
		
		if ($articleID != null) {
			$result = mysql_query($this->query);
			if(!$result){die(mysql_error());}
			$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
			$article->load($cursor);
		}
		
		return $article;
	}		
	
	
	public function getAllArticlesForChannel($channelID) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "Articles";
		if ($channelID == 0){
			$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID).$this->publishedClause.$this->articleOrderingClause;	
		} else {
			$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		}
		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}		
		
		return $this->getContentList($result);
	}
	
	public function getAllContentForSearch($searchText) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (title like '%".$searchText."%' OR introtext like '%".$searchText."%' OR `` like '%".$searchText."%')".$this->publishedClause.$this->videoOrderingClause;
		$this->query  = "SELECT * from ".$contentTable." Where (title like '%".$searchText."%' OR introtext like '%".$searchText."%' OR maintext like '%".$searchText."%'OR metadesc like '%".$searchText."%')".$this->publishedClause.$this->buildSearchOrderingClause($searchText);
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllArticlesForSearch($searchText) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "Articles";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (title like '%".$searchText."%' OR introtext like '%".$searchText."%' OR maintext like '%".$searchText."%')".$this->publishedClause.$this->videoOrderingClause;
		$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (metadesc like '%".$searchText."%')".$this->publishedClause.$this->buildSearchOrderingClause($searchText);		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllVideosForCategory($category) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "Videos";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (title like '%".$searchText."%' OR introtext like '%".$searchText."%' OR maintext like '%".$searchText."%')".$this->publishedClause.$this->videoOrderingClause;
		$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (metakey like '%".$category."%')".$this->publishedClause;			//.$this->buildSearchOrderingClause($category)
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllVideosForSearch($searchText) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "Videos";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (title like '%".$searchText."%' OR introtext like '%".$searchText."%' OR maintext like '%".$searchText."%')".$this->publishedClause.$this->videoOrderingClause;
		$this->query  = "SELECT * from ".$contentTable." Where catid in (".$this->getCategoryIDList($catName).") AND (metadesc like '%".$searchText."%')".$this->publishedClause.$this->buildSearchOrderingClause($searchText);
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getPopularVideosForSearch($searchText) {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDList($catName)." AND (metadesc like '%".$searchText."%')".$this->publishedClause.$this->buildSearchOrderingClause($searchText).$this->videoOrderingPopularClause;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllPopularVideos() {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Videos' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;
		$catName = "Videos";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDList($catName).$this->publishedClause.$this->videoOrderingPopularClause;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getChannelByID($channelID) {
		$this->query  = "SELECT * from ".$channelTable." Where id = ".$channelID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$returnChannel = new Channel();
		$returnChannel->load($cursor);
		
		return $returnChannel;
	}
	
	public function getChannelByName($channelName) {
		$this->query  = "SELECT * from ".$channelTable." Where name = ".$channelName;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$returnChannel = new Channel();
		$returnChannel->load($cursor);
		
		return $returnChannel;
	}
	
	public function getChannelName($channelID) {
		$this->query  = "SELECT * from ".$channelTable." Where id = ".$channelID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$chanName =  $cursor['title'];
		
		return $chanName;
	}
	
	public function getChannelID($channelName) {
		$this->query  = "SELECT * from ".$channelTable." Where title = '".$channelName."'";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$chanID =  $cursor['id'];
		
		return $chanID;
	}
	
	public function getLeadChannel() {
		$this->query  = "SELECT * from ".$channelTable." Where ordering = 1";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$leadChannel =  $cursor['id'];
		
		return $leadChannel;
	}
	
	public function getSubChannelsForChannel($channelID) {
		$this->query  = "SELECT * from ".$channelTable." Where parentid = ".$channelID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getChannelList($result);				
	}
	
	public function getCategory($categoryID) {
		$this->query  = "SELECT * from ".$categoryTable." Where id = ".$categoryID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$catName =  $cursor['title'];
		
		return $catName;
	}
	
	public function getAllHeadlines() {
		$catName = "Headlines";
		$channelID = "2";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title like '%Headlines%') AND sectionid = 2 ".$this->publishedClause." order by ordering ASC";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = 2 ".$this->publishedClause." order by ordering ASC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getAllHeadlinesForChannel($channelID) {
		$catName = "Headlines";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title like '%Headlines%' AND sectionid = ".$channelID.") AND sectionid =  ".$channelID.$this->publishedClause." order by ordering ASC";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid =  ".$channelID.$this->publishedClause." order by ordering ASC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getContentList($result);
	}
	
	public function getNumberOfHeadlinesForChannel($channelID) {
		$catName = "Headlines";
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title like '%Headlines%' AND sectionid = ".$channelID.") AND sectionid =  ".$channelID.$this->publishedClause." order by ordering ASC";
		$this->query  = "SELECT count(*) as count from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid =  ".$channelID.$this->publishedClause;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$cursor = mysql_fetch_array($result, MYSQL_ASSOC);
		$num =  $cursor['count'];
		return $num;
	}
	
	
	public function updateHits($contentID) {
		$this->query  = "UPDATE ".$contentTable." set hits = hits+1 Where id = ".$contentID;
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
	}
	
	public function getAboutUsText() {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "About Us";
		$channelID = "2";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;			
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $result;
	}
	
	public function getTermsOfServiceText() {
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title = 'Articles' AND section = ".$channelID.") AND sectionid = ".$channelID.$this->publishedClause.$this->articleOrderingClause;
		$catName = "Terms of Service";
		$channelID = "2";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause.$this->videoOrderingClause;			
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $result;
	}
	
	public function getChannelImage($channelID) {
		$this->query  = "SELECT * from ".$channelTable." Where id = ".$channelID.$this->publishedClause3;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		  $chan = new Channel();
		  $chan->load($cursor);
		  $image = $chan->getImage();
		}
		return $image;
	}
	
	public function getChannelHeaderImage($channelID) {
		$this->query  = "SELECT * from ".$channelTable." Where id = ".$channelID.$this->publishedClause3;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		  $chan = new Channel();
		  $chan->load($cursor);
		  $chanName = $chan->getName();
		  $chanName = str_replace(" ","",$chanName);
		  $chanName = strtolower($chanName)."_header.png";
		}
		return $chanName;
	}
	
	public function getAllChannels() {
		$this->query  = "SELECT * from ".$channelTable." order by ordering ASC";	
		$result = mysql_query($this->query);	
		if(!$result){die(mysql_error());}
		
		return $this->getChannelList($result);
	}
	
	public function getAllPublishedChannels() {
		$this->query  = "SELECT * from ".$channelTable.$this->publishedClause4." order by ordering ASC";	
		$result = mysql_query($this->query);	
		if(!$result){die(mysql_error());}
		
		return $this->getChannelList($result);
	}
	
	public function getAllTopLevelChannels() {
		$this->query  = "SELECT * from ".$channelTable.$this->publishedClause4." AND parentid = 0 order by ordering ASC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
	
		return $this->getChannelList($result);
	}
	
	public function getNumberOfChannels() {
		$this->query  = "SELECT * from ".$channelTable.$this->publishedClause4;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$chanCount = 0;
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{
			$chanCount = $chanCount + 1;
		}
		return $chanCount;
	}
	
	public function getCommentsForVideo($videoID) {
		$this->query  = "SELECT * from ".$commentsTable.$this->publishedClause4." AND videoID = ".$videoID." order by submitDate DESC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getCommentList($result);
	}
	
	public function getCommentsForChannel($channel) {
		$this->query  = "SELECT * from ".$commentsTable.$this->publishedClause4." AND channel = ".$channel." order by submitDate DESC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getCommentList($result);
	}
	
	public function getAllComments() {
		$this->query  = "SELECT * from ".$commentsTable.$this->publishedClause4." order by submitDate DESC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getCommentList($result);
	}
	
	public function getSpecificUser($userid) {
		$this->query  = "SELECT * from ".$userTable." WHERE id = ".$userid;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$user = new User();
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{		  
		  $user->load($cursor);			
		}
		return $user;
	}
	
	public function getUsername($userid) {
		return $this->getSpecificUser($userid)->getUsername();
	}
	
	public function getUserFullName($userid) {
		return $this->getSpecificUser($userid)->getFullName();
	}
	
	public function getUserIDByUsername($username) {
		$this->query  = "SELECT * from ".$userTable." WHERE username = '".$username."'";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		  $user = new User();
		  $user->load($cursor);
		  $userid = $user->getID();
		  
		}
		return $userid;
	}
	
	public function getUserByID($userid) {
		$this->query  = "SELECT * from ".$userTable." WHERE id = '".$userid."'";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		$user = null;
		while($cursor = mysql_fetch_array($result, MYSQL_ASSOC))
		{
		  $user = new User();
		  $user->load($cursor);
		}
		return $user;
	}
	
	public function loginUser($username,$password) {
		$this->query  = "SELECT * from ".$userTable." WHERE username = '".$username."' AND password = '".base64_encode($password)."'";		
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
	
	public function getVideoCategories() {
		$catName = "Categories";
		$channelID = $this->getChannelID("Video Categories");
		//$this->query  = "SELECT * from ".$contentTable." Where catid in (SELECT id FROM ".$categoryTable." where title like '%Headlines%') AND sectionid = 2 ".$this->publishedClause." order by ordering ASC";
		$this->query  = "SELECT * from ".$contentTable." Where catid = ".$this->getCategoryIDForChannel($catName,$channelID)." AND channelid = ".$channelID.$this->publishedClause." order by ordering ASC";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $result;
	}
	
	public function adjustVideoOrderingForAdd($channelID, $newIndex) {
		$this->query = "Update ".$contentTable. " set ordering = ordering+1 where channelID = ".$channelID." AND ordering >= ".$newIndex. " AND catid in (SELECT id FROM ".$categoryTable." where title = 'Videos')";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $result;	
	}
	
	//public function adjustVideoOrderingForUpdate($channelID, $oldIndex, $newIndex) {
	//	$this->query = "Update ".$contentTable. "set ordering = ordering+1 where channelID = ".$channelID." AND ordering >= ".$newIndex. " AND ordering < ".$oldIndex." AND catid in (SELECT id FROM ".$categoryTable." where title = 'Videos')";	
	//}
	
	public function adjustVideoOrderingForRemove($channelID, $oldIndex) {
		$this->query = "Update ".$contentTable. " set ordering = ordering-1 where channelID = ".$channelID." AND ordering > ".$oldIndex. " AND catid in (SELECT id FROM ".$categoryTable." where title = 'Videos')";
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}

		return $result;		
	}
	
	public function getNextOrderingForChannel($chanID) {
		if ($chanID == 0) {
			$this->query = "Select max(ordering) as ordering from ".$contentTable;
		} else {
			$this->query = "Select max(ordering) as ordering from ".$contentTable." Where channelID = ".$chanID;
		}
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return ((int)($row['ordering']))+1;
	}
	
	public function getMaxChannelOrdering($channelID) {
		
		$thisQuery = "Select max(ordering) as ordering from ".$channelTable;
		$thisChannel = $this->getChannelByID($channelID);
		$thisWhereClause = " where parentid = ".$thisChannel->getParentID();
		$this->query = $thisQuery.$thisWhereClause;
		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$row = mysql_fetch_array($result, MYSQL_ASSOC);
		return ((int)($row['ordering']));
	}
	
	
	public function getAllVideoFormats() {
		$this->query  = "SELECT * from ".$videoFormatTable;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		return $this->getFormatList($result);
	}
	
	public function getAllVideoDirectories() {
		$this->query  = "SELECT distinct video_directory from ".$contentTable.$this->videoWhereClause;		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$formatList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$formatList[] = $cursor['video_directory']; 
		}
		
		return $formatList;
	}
	
	public function getAllVideoDirectoriesAlphabetically() {
		$this->query  = "SELECT distinct video_directory from ".$contentTable.$this->videoWhereClause." order by video_directory";		
		$result = mysql_query($this->query);
		if(!$result){die(mysql_error());}
		
		$formatList = array();
		while ($cursor = mysql_fetch_array($result, MYSQL_ASSOC)) {
			$formatList[] = $cursor['video_directory']; 
		}
		
		return $formatList;
	}
	
	public function register($first, $last, $email,$age,$userType) {
		$sql = "Insert into users (firstname, lastname, email, age, userType) values ('".$first."','".$last."','".$email."','".$age."',4)";
		$result = mysql_query($sql);
		if(!$result){die(mysql_error());}
	}
	
	public function lockContent($contentID) {
		$updateSQL = "update ".$contentTable." set locked = 1 where id = ".$contentID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function unlockContent($contentID) {
		$updateSQL = "update ".$contentTable." set locked = 0 where id = ".$contentID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function setOrdering($contentID, $order) {
		$updateSQL = "update ".$contentTable." set ordering = ".$order." where id = ".$contentID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function addNewUser ($thisUser) {
		return $thisUser->store();
	}
	
	public function addNewChannel($thisChannel) {
		return $thisChannel->store();
	}
	
	
	public function addNewVideo($thisVideo) {
		$thisVideo->setOrdering($this->getNextOrderingForChannel($thisVideo->getChannelID()));
		return $thisVideo->store();
	}
	
	
	public function addNewArticle($thisArticle) {
		return $thisArticle->store();
	}
	
	public function addNewHeadline($thisHeadline) {
		return $thisHeadline->store();
	}
	
	
	public function addVideoToChannel($thisVideoID, $thisChannelID) {
		$updateSQL = "update ".$contentTable." set channelID = ".$thisChannelID." where id = ".$thisVideoID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function addArticleToChannel($thisArticleID, $thisChannelID) {
		$updateSQL = "update ".$contentTable." set channelID = ".$thisChannelID." where id = ".$thisArticleID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function addHeadlineToChannel($thisHeadlineID, $thisChannelID) {
		$updateSQL = "update ".$contentTable." set channelID = ".$thisChannelID." where id = ".$thisHeadlineID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function addSubChannelToChannel($thisSubChannelID, $thisChannelID) {
		$updateSQL = "update ".$channelTable." set parentid = ".$thisChannelID." where id = ".$thisSubChannelID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
	public function addArticleToVideo($thisArticleID, $thisVideoID) {
		$updateSQL = "update ".$contentTable." set related_aticle = ".$thisArticleID." where id = ".$thisVideoID;
		
		$result = mysql_query($updateSQL);
		if(!$result){
			die(mysql_error());
			return false;
		} else {
			return true;
		}
	}
	
		
}
?>