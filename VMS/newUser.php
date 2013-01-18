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
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>	
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	function saveDetails() {
		
			var pwd = $("#password").val();
			var confirmPwd = $("#confirmPassword").val(); 
			if (pwd == confirmPwd) {
				$.post("processUserDetails.php",
					$("#userDetailsForm").serialize(),
					function(data){
						checkUpdate(data);});
			} else {
				alert("The password and confirmation password do not match." );
			}	
		
			
		
	}		
	
	
	function newUser() {
		
		window.location = "newUser.php";			
		
	}
	
	function cancel() {
		
		window.location = "users.php";			
		
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

<br/><br/>
<div id="messageBox">
	<div id="messageBoxText"></div>
</div>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">User Manager</td></tr>
	<tr>
		<td width="1" class="detailLabel">&nbsp;&nbsp;User: </td>
		<td width="1" nowrap class="detailTitle">&nbsp;&nbsp;New User</td>
		<td width="*" align="right"><input type="button" onclick="newUser();" id="newButton" value="New"/>&nbsp;<input type="button" onclick="saveDetails();" id="saveButton" value="Save"/>&nbsp;<input type="button" id="cancelButton" onclick="cancel();" value="Cancel"/></td>
	</tr>
</table>

<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="userDetailsForm" id="userDetailsForm" action="">
<input type="hidden" name="changePassword" value="true"/>
<table width="96%" align="center" cellspacing="10" cellpadding="10">

	<tr bgcolor="#cccccc"><td align="center" class="channelHeader"><b>User Details</b></td></tr>
	
	
	<tr>
		<td align="center">
		<table cellspacing="10" cellpadding="10">
			<tr>
				<td class="detailLabel" width="1" nowrap>ID: </td>
				<td width="1"><input type="hidden" name="id" value="0"/></td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>User Type: </td>
				<td>
				<?php 
					$usertypes = $dbService->getAllUserTypes();
				?>
					<select name="usertype">
						<?php
						foreach ($usertypes as $type) {							
						?>
					<option value="<?php echo $type->getID();?>"><?php echo $type->getName();?></option>
						<?php
						}?>
					</select>
				</td>						
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>First Name: </td>
				<td width="1"><input type="text" name="firstname" size="30"/></td>					
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>Username: </td>
				<td width="1"><input type="text" name="username" size="30"/></td>
				
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>Last Name: </td>
				<td width="1"><input type="text" name="lastname" size="30"/></td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>Password: </td>
				<td width="1"><input type="password" id="password" name="password" size="30"/></td>						
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>Email: </td>
				<td width="1"><input type="text" name="email" size="30"/></td>									
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>Confirm Password: </td>
				<td width="1"><input type="password" id="confirmPassword" name="confirmPassword" size="30"/></td>	
				
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