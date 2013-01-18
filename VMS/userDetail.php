<?php
require("Common.php");

if (isset($_REQUEST["userID"])) {
	$selectedUser = $_REQUEST["userID"];
} else {
	$selectedUser = 1;
}

$user = $dbService->getUserByID($selectedUser);


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
	$(function() {
		$("#changePwdDialog").hide();	
	});
	
	function saveDetails() {
		$.post("processUserDetails.php",
				$("#userDetailsForm").serialize(),
				function(data){
					checkUpdate(data);});
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
	
	function openChangePwdDialog() {
		$('#changePwdDialog').title("Change Password");
		$('#changePwdDialog').dialog('open');
	}
	
	function changePwd() {
		var currentPwd = $("#currentPassword").val();
		var newPwd = $("#newPassword").val();
		var confirmNewPwd = $("#confirmNewPassword").val();
		
		if (currentPwd != "<?php echo $user->getPassword();?>") {
			alert("The current password you entered is incorrect");
			return false;
		}
		
		if (confirmNewPwd != newPwd) {
			alert("The password and confirmation password do not match." );
			return false;
		}
		
		$("#password").val(newPwd);
		$("#changePassword").val(true);
		$('#changePwdDialog').dialog('close');
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
		<td width="1" nowrap class="detailTitle">&nbsp;&nbsp;<?php echo $user->getUsername();?></td>
		<td width="*" align="right"><input type="button" onclick="newUser();" id="newButton" value="New"/>&nbsp;<input type="button" onclick="saveDetails();" id="saveButton" value="Save"/>&nbsp;<input type="button" id="cancelButton" onclick="cancel();" value="Cancel"/></td>
	</tr>
</table>

<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="userDetailsForm" id="userDetailsForm" action="">
<input type="hidden" id="changePassword" name="changePassword" value="false"/>
<table width="96%" align="center" cellspacing="10" cellpadding="10">

	<tr bgcolor="#cccccc"><td align="center" class="channelHeader"><b>User Details</b></td></tr>
	
	
	<tr>
		<td align="center">
		<table cellspacing="10" cellpadding="10">
			<tr>
				<td class="detailLabel" width="1" nowrap>ID: </td>
				<td width="1"><?php echo $user->getID();?><input type="hidden" name="id" value="<?php echo $user->getID();?>"/></td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>User Type: </td>
				<td>
				<?php 
					$usertypes = $dbService->getAllUserTypes();
				?>
					<select name="usertype">
						<?php
						foreach ($usertypes as $type) {
							if ($type->getID() == $user->getUserType()) {
								$selected = "selected";
							} else {
								$selected = "";
							}
						?>
					<option value="<?php echo $type->getID();?>" <?php echo $selected;?>><?php echo $type->getName();?></option>
						<?php
						}?>
					</select>
				</td>						
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>First Name: </td>
				<td width="1"><input type="text" name="firstname" size="30" value="<?php echo $user->getFirstName();?>"/></td>					
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>Username: </td>
				<td width="1"><input type="text" name="username" size="30" value="<?php echo $user->getUsername();?>"/></td>
				
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>Last Name: </td>
				<td width="1"><input type="text" name="lastname" size="30" value="<?php echo $user->getLastName();?>"/></td>
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>Password: </td>
				<td width="1" nowrap>
					<input type="password" id="password" name="password" size="20" value="<?php echo $user->getPassword();?>" readonly/>
					<input type="button" name="submitButton" value="Change Pwd..." onclick="jQuery('#changePwdDialog').dialog('open'); return false;"/>
				</td>						
			</tr>
			<tr>
				<td class="detailLabel" width="1" nowrap>Email: </td>
				<td width="1"><input type="text" name="email" size="30" value="<?php echo $user->getEmail();?>"/></td>									
				<td width="15">&nbsp;</td>
				<td class="detailLabel" width="1" nowrap>User Since: </td>
				<td width="1"><?php echo $util->formatDate($user->getRegisterDate());?><input type="hidden" name="registerDate" value="<?php echo $user->getRegisterDate();?>"/></td>
				
			</tr>
			
			
		</table>
		</td>
	</tr>
	
</table>
</form>

</center>

<div id="changePwdDialog" title="Change Password">
<table cellspacing="12" cellpadding="12">
	<tr>
		<td colspan="2">&nbsp;&nbsp;</td>
	</tr>
	<tr>
		<td>Current Password: </td>
		<td><input type="password" id="currentPassword" name="currentPassword"/></td>
	</tr>
	<tr>
		<td>New Password: </td>
		<td><input type="password" id="newPassword" name="newPassword"/></td>
	</tr>
	<tr>
		<td>Confirm New Password: </td>
		<td><input type="password" id="confirmNewPassword" name="confirmNewPassword"/></td>
	</tr>
	<tr><td colspan="2">&nbsp;</td></tr>
	<tr><td colspan="2" align="center"><input type="button" name="submitButton" value="Submit" onclick="changePwd();"/></td></tr>
</table>
</div>

</div>
</body>
</html>
