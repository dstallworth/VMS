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
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" />
	
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
	<!--<script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
								
			
			$("#mytabs").tabs();
			
			$('#videoTable').dataTable();
			$('#videoTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			$('#articleTable').dataTable();
			$('#headlineTable').dataTable();
			
			//$("#visible").click(function() {$("#videos").show()});
			//$("#hide").click(function() {$("#videos").hide()});
			//$(function() {
				//$("#tabs").tabs();
			//});						
			
			
		});
						
	</script>
	
	
	

<link rel="stylesheet" type="text/css" href="nav.css" />

</head>
<body>

<br/><br/>
<div id="wrapper">
Channels --> <?php echo $dbService->getChannelByID($currentChannel)->getName();?>
<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<div id="mytabs">
<ul> 
  <li><a href="#videos">Videos</a></li> 
  <li><a href="#articles">Articles</a></li> 
  <li><a href="#headlines">Headlines</a></li>
</ul> 
<div id="videos">
<center><b>VIDEOS</b></center>	
	<table class="display" cellpadding="5" id="videoTable">
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
		</tbody>
	</table>
</div>
<div id="articles">
<center><b>ARTICLES</b></center>
	<table class="display" cellpadding="5" id="articleTable">
		<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Author</th>			
		</tr>
		</thead>
		<tbody>
	<?php
	$vidList = $dbService->getAllArticlesForChannel($currentChannel);
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($vidList as $vid) {?>
		<tr>
			<td><?php echo $vid->getID();?></td>
			<td><?php echo $vid->getTitle();?></td>
			<td><?php echo $vid->getPublished();?></td>			
			<td><?php echo $vid->getOrdering();?></td>
			<td><?php echo $vid->getCreated();?></td>
			<td><?php echo $vid->getCreatedBy();?></td>			
		</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>
<div id="headlines">
<center><b>HEADLINES</b></center>
	<table class="display" cellpadding="5" id="headlineTable">
		<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Author</th>					
		</tr>
		</thead>
		<tbody>
	<?php
	$vidList = $dbService->getAllHeadlinesForChannel($currentChannel);
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($vidList as $vid) {?>
		<tr>
			<td><?php echo $vid->getID();?></td>
			<td><?php echo $vid->getTitle();?></td>
			<td><?php echo $vid->getPublished();?></td>			
			<td><?php echo $vid->getOrdering();?></td>
			<td><?php echo $vid->getCreated();?></td>
			<td><?php echo $vid->getCreatedBy();?></td>			
		</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>
</div>

</div>
</body>
</html>
