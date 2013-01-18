<?php
require("Common.php");

//$dbService = new DBService();

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
	<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
	
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<!--<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			$('#videoTable').dataTable();
			$('#articleTable').dataTable();
			$('#headlineTable').dataTable();
			
			$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.subnav
			$("ul.topnav li a") .mouseover(function() { //When trigger is clicked...
				//Following events are applied to the subnav itself (moving subnav up and down)
				$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click
				$(this).parent().hover(function() {
				}, function(){	
					$(this).parent().find("ul.subnav").slideUp('medium'); //When the mouse hovers out of the subnav, move it back up
				});
				//Following events are applied to the trigger (Hover events for the trigger)
				}).hover(function() { 
					$(this).addClass("subhover"); //On hover over, add class "subhover"
				}, function(){	//On Hover Out
					$(this).removeClass("subhover"); //On hover out, remove class "subhover"
			});
			
									
			
			
		});
						
	</script>
	<script type="text/javascript">
	$(function() {
		$("#tabs").tabs();
	});
	</script>
	
	<script type="text/javascript" src="js/jquery.idTabs.min.js"></script>

<link rel="stylesheet" type="text/css" href="nav.css" />

</head>
<body>
<div id="nav">
<ul class="topnav">
    <li><a href="#">Home</a></li>
    <li>
        <a href="#">Channels</a>
        <ul class="subnav">
        <?php
        
        $chList = $dbService->getAllChannels();
        foreach ($chList as $chan) {?>
            <li><a href="nav.php?channelID=<?php echo $chan->getID();?>"><?php echo $chan->getName();?></a></li>
        <?php
        }
        ?>
            
        </ul>
    </li>
    
    <li><a href="#">Videos</a></li>
    <li><a href="#">Articles</a></li>
    <li><a href="#">Headlines</a></li>
    <li><a href="#">Users</a></li>
</ul>
</div>
<br/><br/>
Channels --> <?php echo $dbService->getChannelByID($currentChannel)->getName();?><div id="tabs">
<ul> 
  <li><a href="#videos">Videos</a></li> 
  <li><a href="#articles">Articles</a></li> 
  <li><a href="#headlines">Headlines</a></li>
</ul> 
<div id="videos">
	<table class="datatable" border="1" cellpadding="5" id="videoTable">
		<tr bgcolor="#CCCCCC">
			<td colspan="6"><b>Videos</b></td>			
		</tr>
		<tr bgcolor="#CCCCCC">
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Hits</th>			
		</tr>
	<?php
	$vidList = $dbService->getAllVideosForChannel($currentChannel);
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($vidList as $vid) {?>
		<tr>
			<td><?php echo $vid->getID();?></td>
			<td><?php echo $vid->getTitle();?></td>
			<td><?php echo $vid->getPublished();?></td>			
			<td><?php echo $vid->getOrdering();?></td>
			<td><?php echo $vid->getCreated();?></td>
			<td><?php echo $vid->getHits();?></td>			
		</tr>
		<?php
		}
		?>
	</table>
</div> 
<div id="articles">
	<table class="datatable" border="1" cellpadding="5" id="articleTable">
		<tr bgcolor="#CCCCCC">
			<td colspan="6"><b>Articles</b></td>			
		</tr>
		<tr bgcolor="#CCCCCC">
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Author</th>			
		</tr>
	<?php
	$articleList = $dbService->getAllArticlesForChannel($currentChannel);	
      foreach ($articleList as $article) {?>
		<tr>
			<td><?php echo $article->getID();?></td>
			<td><?php echo $article->getTitle();?></td>
			<td><?php echo $article->getPublished();?></td>			
			<td><?php echo $article->getOrdering();?></td>
			<td><?php echo $article->getCreated();?></td>
			<td><?php echo $article->getCreatedBy();?></td>			
		</tr>
		<?php
		}
		?>
	</table>
</div>
<div id="headlines">
	<table class="datatable" border="1" cellpadding="5" id="headlineTable">
		<tr bgcolor="#CCCCCC">
			<td colspan="6"><b>Headlines</b></td>			
		</tr>
		<tr bgcolor="#CCCCCC">
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Author</th>			
		</tr>
	<?php
	$headlineList = $dbService->getAllHeadlinesForChannel($currentChannel);
      foreach ($headlineList as $headline) {?>
		<tr>
			<td><?php echo $headline->getID();?></td>
			<td><?php echo $headline->getTitle();?></td>
			<td><?php echo $headline->getPublished();?></td>			
			<td><?php echo $headline->getOrdering();?></td>
			<td><?php echo $headline->getCreated();?></td>
			<td><?php echo $headline->getCreatedBy();?></td>			
		</tr>
		<?php
		}
		?>
	</table>
</div>
</div>
</body>
</html>
