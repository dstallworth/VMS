<?php
require("Common.php");

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
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	function saveDetails() {
		alert("SAVING DETAILS");
		$.post("processChannelDetails.php",
				$("#channelDetailsForm").serialize(),
				function(data){
					checkUpdate(data);});
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
	
	</script>
	
</head>
<body>

<?php include("navigation.php"); ?>
<div id="messageBox">
	<div id="messageBoxText"></div>
</div>
<br/><br/>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">Channel Manager</td></tr>
	<tr>
		<td width="1" class="channelLabel">&nbsp;&nbsp;</td>
		<td width="1" nowrap class="channelTitle">&nbsp;&nbsp;</td>
		<td width="*" align="right"><input type="button" onclick="saveDetails();" id="saveButton" value="Save"/>&nbsp;<input type="button" id="cancelButton" onclick="cancel();" value="Cancel"/></td>
	</tr>
</table>

<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="channelDetailsForm" id="channelDetailsForm" action="">
<input type="hidden" id="id" name="id" value="0"/>
<table width="96%" align="center" cellspacing="4" cellpadding="4">

	<tr bgcolor="#cccccc"><td align="center" class="channelHeader"><b>New Channel Details</b></td></tr>
	
	<tr>
		<td align="center">
		<table cellspacing="10" cellpadding="10">
			<tr>
				<td class="channelLabel" width="1">Name: </td>
				<td width="1"><input type="text" name="name" size="45"/></td>
				<td width="15">&nbsp;</td>
				<td width="15">&nbsp;</td>
				<td width="15">&nbsp;</td>								
			</tr>
			<tr>
				<td class="channelLabel" width="1">Description: </td>
				<td width="1"><input type="text" name="description" size="45"/></td>					
				<td width="15">&nbsp;</td>
				<td class="channelLabel" width="1">Published: </td>
					
				<td><input type="checkbox" name="published" /></td>
				
			</tr>
			<tr>
				<td class="channelLabel" width="1" nowrap>Parent Channel: </td>
				<td width="1">
						<select name="parentID">
							<option value="0"></option>
							<?php
					        
					        $chList = $dbService->getAllChannels();
					        $channelCount = 0;
					        foreach ($chList as $thisChan) {
					        	
					        ?>
					            <option value="<?php echo $thisChan->getID();?>"><?php echo $thisChan->getName();?></option>
					        <?php
					         $channelCount++;
					        }
					        ?>
						</select>
				</td>
				<td width="15">&nbsp;</td>
				<td class="channelLabel" width="1">Ordering: </td>
				<td>
					<select name="ordering">
						<option value="<?php echo $channelCount+1;?>"><?php echo $channelCount+1;?></option>
						<?php
						for ($i=1;$i<=$channelCount;$i++) {							
						?>
							<option value="<?php echo $i;?>"><?php echo $i;?></option>
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

</div>
</body>
</html>
<?php
$dbService->closeConnection();
?>