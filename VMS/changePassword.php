<?php
require("Common.php");

if (isset($_SESSION["userID"])) {
	$selectedUser = $_SESSION["userID"];
	$user = $dbService->getUserByID($selectedUser);
} else {
	header("location:login.php");
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
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>	
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	$(function() {
		$("#changePwdDialog").hide();	
	});
	
	function saveDetails() {
		$.post("processPasswordChange.php",
				$("#passwordChangeForm").serialize(),
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
		
		if (currentPwd != "<?php echo (base64_decode($user->getPassword()));?>") {
			alert("The current password you entered is incorrect");
			return false;
		}
		
		if (confirmNewPwd != newPwd) {
			alert("The password and confirmation password do not match." );
			return false;
		}
		
		$.post("processPasswordChange.php",
			$("#passwordChangeForm").serialize(),
			function(data){
				checkUpdate(data);});
		
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
	<tr class="pageTitle"><td colspan="3">Change Password</td></tr>
	<tr>
		<td width="1" class="detailLabel">&nbsp;&nbsp;User: </td>
		<td width="1" nowrap class="detailTitle">&nbsp;&nbsp;<?php echo $user->getUsername();?></td>
		<td width="*" align="right">&nbsp;</td>
	</tr>
</table>

</center>

<div id="changePassword">
<form id="passwordChangeForm" name="passwordChangeForm" action="">
<input type="hidden" id="userid" name="userid" value="<?php echo $user->getID();?>"/>
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
</form>
</div>

</div>
</body>
</html>
