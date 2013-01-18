<?php
//session_start();
require("Common.php");



/*if (!isset($_SESSION["username"])){
header("location:login.php");
} else {
	$username = $_SESSION["username"];
	$firstname = $_SESSION["firstname"];
	$databaseID = $_SESSION["databaseID"];
	$db = unserialize($_SESSION["database"]);
echo "DATABASE ID = ".$databaseID."<br/>";	
echo "DATABASE NAME = ".$db->getName()."<br/>";
	
echo "DATABASE: host = ".$db->getHost()."  user = ".$db->getUser()." pass = ".$db->getPwd()." name = ".$db->getName();
echo "<br/>";	
	$dbService->connectToDB($db->getHost(), $db->getUser(), $db->getPwd(), $db->getName());
}
*/


if (isset($_REQUEST["channelID"])) {
	$currentChannel = $_REQUEST["channelID"];
} else {
	$currentChannel = 1;
}

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>VMS</title>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css" type="text/css" media="all" />
	<!--<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />-->
	<link rel="stylesheet" href="custom-theme/jquery-ui-1.8.4.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection"/>

	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
	<!--<script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<!--<script type="text/javascript" language="javascript" src="js/jquery.dropdownPlain.js"></script>-->
	
	
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			
			
			$("#mytabs").tabs();
			
			$('#popularTable').dataTable({
				"bSort": false
				
			});
			$('#popularTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			$('#recentTable').dataTable({
				"bSort": false
				
			});
			
			$('#recentTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			
		});
						
	</script>
	
	
	<!--<link rel="stylesheet" type="text/css" href="nav.css" />-->
		



</head>
<body>
<?php include("navigation.php"); ?>

<br/><br/><br/><br/>
<div id="main_wrapper">

<div id="buttons">
	<div id="image"><a href="videos.php"><img src="images/manage_videos2.png" width="130" height="140" border="0"/></a></div>
	<div id="image"><a href="articles.php"><img src="images/manage_articles2.png" width="130" height="140" border="0"/></a></div>
	<!--<div id="image"><a href="headlines.php"><img src="images/manage_headlines2.png" width="130" height="140" border="0"/></a></div> -->	

	<div id="image"><a href="channels.php"><img src="images/manage_channels2.png" width="130" height="140" border="0"/></a></div>
	<div id="image"><a href="users.php"><img src="images/manage_users2.png" width="130" height="140" border="0"/></a></div>
	<div id="image"><a href="#"><img src="images/manage_communications2.png" width="130" height="140" border="0"/></a></div>

</div>

<div id="snapshot">
	<div id="mytabs">
		<ul> 
		  <li><a href="#popular">Most Popular</a></li> 
		  <li><a href="#recent">Most Recent</a></li>
		</ul>
	
		<div id="popular">
			Most Popular Videos
			<table class="display" border="1" cellpadding="5" id="popularTable">
				<thead>
				<tr>
					
					<th>ID</th>
					<th>Title</th>
					<th>Published</th>
					<th>Ordering</th>
					<th>Date Created</th>
					<th>Hits</th>
								
				</tr>
				</thead>
				<tbody>
			<?php
			$vidList = $dbService->getPopularVideosForChannel($currentChannel);
			//$vidList = $dbService->getAllChannels();
			//echo "SQL - ".$dbService->query;
		      foreach ($vidList as $vid) {?>
				<tr>
					<td><?php echo $vid->getID();?></td>
					<td><a href="videoDetail.php?channelID=<?php echo $vid->getChannelID();?>&videoID=<?php echo $vid->getID();?>"><?php echo $vid->getTitle();?></a></td>
					<td align="center"><?php echo $vid->getPublishedCheckBoxHTML();?></td>			
					<td><?php echo $vid->getOrdering();?></td>
					<td><?php echo $util->formatDate($vid->getCreated());?></td>
					<td><?php echo $vid->getHits();?></td>			
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
		
		<div id="recent">
			Most Recently Added Videos
			<table class="display" border="1" cellpadding="5" id="recentTable">				
				<thead>
				<tr>
					<th>ID</th>
					<th>Title</th>
					<th>Published</th>
					<th>Ordering</th>
					<th>Date Created</th>
					<th>Hits</th>			
				</tr>
				</thead>
				<tbody>
			<?php
			$vidList = $dbService->getLatestVideos();
			//$vidList = $dbService->getAllChannels();
			//echo "SQL - ".$dbService->query;
		      foreach ($vidList as $vid) {?>
				<tr>
					<td><?php echo $vid->getID();?></td>
					<td><a href="videoDetail.php?channelID=<?php echo $vid->getChannelID();?>&videoID=<?php echo $vid->getID();?>"><?php echo $vid->getTitle();?></a></td>
					<td align="center"><?php echo $vid->getPublishedCheckBoxHTML();?></td>			
					<td><?php echo $vid->getOrdering();?></td>
					<td><?php echo $util->formatDate($vid->getCreated());?></td>
					<td><?php echo $vid->getHits();?></td>			
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
	</div>
</div>

</div>
</body>
</html>
<?php
$dbService->closeConnection();
?>
