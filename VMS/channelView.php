<?php
require("Common.php");

if (isset($_REQUEST["channelID"])) {
	$currentChannel = $_REQUEST["channelID"];
} else {
	$currentChannel = 1;
}

$chan = $dbService->getChannelByID($currentChannel);


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
	<script type="text/javascript" language="javascript" src="js/jquery.tablednd_0_5.js"></script>
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	function saveDetails() {
		$.post("processChannelDetails.php",
				$("#channelDetailsForm").serialize(),
				function(data){
					checkUpdate(data);});
	}		
	
	
	function newChannel() {
		
		window.location = "newChannel.php";			
		
	}
	
	function cancel() {
		
		window.location = "channels.php";			
		
	}
	
	
	function checkUpdate(data) {
		var htmlResult = "";
		htmlResult = data;
		
		$('#messageBoxText').html(htmlResult);
		$('#messageBox').show('fast');
		$('#messageBox').animate({top: '0'},500).delay(3000).animate({top: '-200'},500);
		
	}
	
	$("#videoTabTable").tableDnD({
		 onDragClass: "myDragClass",		 
		 onDrop: function(table, row) {
	        var rows = table.tBodies[0].rows;
	        var debugStr = "Row dropped was "+row.id+". New order: ";
	        var serializeStr = "Serialized - "+$.tableDnD.serialize();
	        for (var i=0; i<rows.length; i++) {
	            debugStr += rows[i].id+" ";
	        }
	        //alert(debugStr);
	        //alert(serializeStr);
	        $('#saveOrdering').html("<a href=\"javascript:saveOrdering();\">Save Ordering</a>");
	        }
		
	});	
	
	$("#channelTable").tableDnD({
		 onDragClass: "myDragClass",		 
		 onDrop: function(table, row) {
	        var rows = table.tBodies[0].rows;
	        var debugStr = "Row dropped was "+row.id+". New order: ";
	        var serializeStr = "Serialized - "+$.tableDnD.serialize();
	        for (var i=0; i<rows.length; i++) {
	            debugStr += rows[i].id+" ";
	        }
	        //alert(debugStr);
	        //alert(serializeStr);
	        $('#saveChannelOrdering').html("<a href=\"javascript:saveChannelOrdering();\">Save Ordering</a>");
	        }
		
	});		
	
	</script>
	
</head>
<body>

<?php include("navigation.php"); ?>

<br/><br/>
<div id="messageBox">
	<div id="messageBoxText"></div>
</div>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">Channel Manager</td></tr>
	<tr>
		<td width="1" class="detailLabel">&nbsp;&nbsp;Channel: </td>
		<td width="1" nowrap class="detailTitle">&nbsp;&nbsp;<?php echo $chan->getName();?></td>
		<td width="*" align="right"><input type="button" onclick="newChannel();" id="newButton" value="New"/>&nbsp;<input type="button" onclick="saveDetails();" id="saveButton" value="Save"/>&nbsp;<input type="button" id="cancelButton" onclick="cancel();" value="Cancel"/></td>
	</tr>
</table>

<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="channelDetailsForm" id="channelDetailsForm" action="">
<table width="96%" align="center" cellspacing="4" cellpadding="4">

	<tr bgcolor="#cccccc"><td align="center" class="channelHeader"><b>Channel Details</b></td></tr>
	
	
	<tr>
		<td align="center">
		<table cellspacing="10" cellpadding="10">
			<tr>
				<td class="detailLabel" width="1">Name: </td>
				<td width="1"><input type="text" name="name" size="45" value="<?php echo $chan->getName();?>"/></td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1">ID: </td>
				<td width="1"><?php echo $chan->getID();?><input type="hidden" name="id" value="<?php echo $chan->getID();?>"/></td>						
			</tr>
			<tr>
				<td class="detailLabel" width="1">Description: </td>
				<td width="1"><input type="text" name="description" size="45" value="<?php echo $chan->getDescription();?>"/></td>					
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1">Published: </td>
					<?php
					if ($chan->getPublished()) {
						$checked = "checked";
					} else {
						$checked = "";
					}
					?>
				<td><input type="checkbox" name="published" <?php echo $checked;?>/></td>
				
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>Parent Channel: </td>
				<td width="1">
						<select name="parentID">
							<option value="0"></option>
							<?php
					        
					        $chList = $dbService->getAllChannels();
					        foreach ($chList as $thisChan) {
					        	if ($thisChan->getID() == $chan->getParentID()) {
					        		$chanSelected = "selected";
					        	} else {
					        		$chanSelected = "";
					        	}
					        ?>
					            <option value="<?php echo $thisChan->getID();?>" <?php echo $chanSelected;?>><?php echo $thisChan->getName();?></option>
					        <?php
					        }
					        ?>
						</select>
				</td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1">Ordering: </td>
				<td>
				<?php 
					$maxOrdering = $dbService->getMaxChannelOrdering($currentChannel);
				?>
					<select name="ordering">
						<?php
						for ($i=1;$i<=$maxOrdering+1;$i++) {
							if ($i == $chan->getOrdering()) {
								$selected = "selected";
							} else {
								$selected = "";
							}
						?>
							<option value="<?php echo $i;?>" <?php echo $selected;?>><?php echo $i;?></option>
						<?php
						}?>
					</select>
				</td>
				
			</tr>	
			
		</table>
		</td>
	</tr>
	
</table>
</form>

</center>

<div id="mytabs">
<ul> 
  <li><a href="#videos">Videos</a></li> 
  <li><a href="#articles">Articles</a></li> 
</ul> 
<div id="videos">
<div id="saveOrdering">Drag table rows to change ordering</div>
<center><b>VIDEOS</b></center>	
	<table class="display" cellpadding="5" id="videoTabTable">
		<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
			<th>Ordering</th>
			<th>Date Created</th>
			<th>Related Article</th>
			<th>Hits</th>			
		</tr>
		</thead>
		<tbody>
	<?php
	$vidList = $dbService->getAllVideosForChannel($currentChannel);	
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($vidList as $vid) {?>
		<tr id="<?php echo $vid->getID();?>">
			<td align="center"><?php echo $vid->getID();?></td>
			<td><a href="videoDetail.php?channelID=<?php echo $vid->getChannelID();?>&videoID=<?php echo $vid->getID();?>"><?php echo $vid->getTitle();?></a></td>
			<td align="center"><?php echo $vid->getPublishedCheckBoxHTML();?></td>			
			<td align="center"><?php echo $vid->getOrdering();?></td>
			<td align="center"><?php echo $util->formatDate($vid->getCreated());?></td>
			<td align="center"><a href="articleDetail.php?articleID=<?php echo $vid->getRelatedArticle();?>"><?php echo $dbService->getSpecificArticle($vid->getRelatedArticle())->getTitle();?></a></td>
			<td align="center"><?php echo $vid->getHits();?></td>			
		</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>
<div id="articles">
<center><b>ARTICLES</b></center>
	<table class="display" cellpadding="5" id="articleTabTable">
		<thead>
		<tr>
			<th>ID</th>
			<th>Title</th>
			<th>Published</th>
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
			<td align="center"><?php echo $vid->getID();?></td>
			<td><a href="#"><?php echo $vid->getTitle();?></a></td>
			<td align="center"><?php echo $vid->getPublishedCheckBoxHTML();?></td>			
			<td align="center"><?php echo $util->formatDate($vid->getCreated());?></td>
			<td align="center"><?php echo $vid->getCreatedBy();?></td>			
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
<?php
$dbService->closeConnection();
?>