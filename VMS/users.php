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
	function newUser() {
		
		window.location = "newUser.php";			
		
	}
	</script>
</head>
<body>

<?php include("navigation.php"); ?>

<br/><br/>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0" cellpadding="5">
	<tr class="pageTitle"><td colspan="3">User Manager</td></tr>
	<tr>
		<td width="1" class="channelLabel">&nbsp;&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>	
<td colspan="3" align="right"><input type="button" id="newButton" onclick="newUser();" value="New User"/></a></td>
</tr>
</table>
</center>

<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<center>
<div id="mytabs">
<div id="users">

<center><b>USERS</b></center>

	<table class="display" cellpadding="5" id="videoTable">
		<thead>
		<tr>
			<th>Username</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Email</th>
			<th>Register Date</th>
			<th>User Type</th>					
		</tr>
		</thead>
		<tbody>
	<?php
	$userList = $dbService->getAllUsers();
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($userList as $user) {?>
		<tr>
			<td align="center"><a href="userDetail.php?userID=<?php echo $user->getID();?>"><?php echo $user->getUsername();?></td>
			<td align="center"><?php echo $user->getFirstName();?></a></td>
			<td align="center"><?php echo $user->getLastName();?></a></td>
			<td align="center"><?php echo $user->getEmail();?></td>			
			<td align="center"><?php echo $user->getRegisterDate();?></td>
			<td align="center"><?php echo $user->getUserType();?></a></td>	
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

