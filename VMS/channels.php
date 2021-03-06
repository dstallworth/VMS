<?php
require("Common.php");


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
	<script type="text/javascript" language="javascript" src="js/jquery.tablednd_0_5.js"></script>
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		$(".sub").hide();
		
		$("#subChannels").click(function() {
			alert("subChannels Clicked")
			$(".sub").toggle(200);			
			});
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
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">Channel Manager</td></tr>
	<tr>
		<td width="1" class="channelLabel">&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>
<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<center>
<div id="mytabs">
<div id="channels">
<center><b>Channels</b></center>
<div id="saveChannelOrdering">Drag table rows to change channel ordering</div>
	<table class="display" cellpadding="5" id="channelTable">
		<thead>
		<tr>
			<th>ID</th>	
			<th>Name</th>
			<th>Published</th>
			<th>Ordering</th>			
		</tr>
		</thead>
		<tbody>
	<?php
	$chanList = $dbService->getAllChannels();
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($chanList as $chan) {
			$subChannel = $dbService->getSubChannelsForChannel($chan->getID());
			$subCounter = 1;
			$subChanID = "";
			$subChanName = "";
			$subChanPublished = "";
			$subChanOrdering = "";
			foreach ($subChannel as $subChan) {
				$subChanID .= "<br/>&nbsp;";	//"<br/>".$subChan->getID();
				$subChanName .= "<br/>&nbsp;&nbsp;&nbsp;<a href=\"channelView.php?channelID=".$subChan->getID()."\">(".$subChan->getID().") ".$subChan->getName()."</a>";
				$subChanPublished .= $subChan->getPublishedCheckBoxHTML();
				$subChanOrdering .= "<br/>".$subChan->getOrdering();
			}
		?>
		<tr id="<?php echo $chan->getID();?>">
			<td align="center"><b><?php echo $chan->getID();?></b><?php echo $subChanID;?></td>
			<td><b><a href="channelView.php?channelID=<?php echo $chan->getID();?>"><?php echo $chan->getName();?></a></b><span id="subChannelFont"><?php echo $subChanName;?></span></td>
			<td align="center"><b><?php echo $chan->getPublishedCheckBoxHTML();?></b><?php echo $subChanPublished;?></td>			
			<td align="center"><b><?php echo $chan->getOrdering();?></b><span id="subChannelFont"><?php echo $subChanOrdering;?></span></td>
		</tr>
		<?php
		}
		?>
		</tbody>
	</table>

</div>
</div>

</center>

</div>
</body>
</html>
<?php
$dbService->closeConnection();
?>
