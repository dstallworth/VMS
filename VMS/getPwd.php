<?php

//require("Common.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>VMS Login</title>
<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css" type="text/css" media="all" />
	<!--<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />-->
	<link rel="stylesheet" href="custom-theme/jquery-ui-1.8.4.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection"/>
		
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
	
	<!--<script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>-->
	<!--<script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.editable-select.js"></script>
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript">
	
	function login() {
		//alert("loginForm.serialize = "+$("#loginForm").serialize());
		$.post("findPwd.php",
				$("#loginForm").serialize(),
				function(data){
					loginResult(data);});		
	}
	
	function loginResult(data) {
		//alert("LOGIN RESULT (data = "+data+")");	
		
			$('#loginMessage').html(data);
		
	}	
		
	
	</script>
</head>
<body onLoad="document.loginForm.username.focus();">
<div id="page-wrap">
<div id="logo">
	<img src="images/TVWC_text_logo.png"/>
	<div id="logo2">
		<img src="images/videowing.png"/>		
	</div>
	
</div>
<center>
<form name="loginForm" id="loginForm" action="" onSubmit="login();return false;">
<br/><br/>
<table cellpadding="10" cellspacing="10" border="0">
	<tr>
		<td align="center" colspan="2"><h1>LOGIN</h1></td>
	</tr>
	<tr>
		<td>Username: </td>
		<td><input type="text" name="username" size="20"></td>
	</tr>
	<tr>
		<td>Password: </td>
		<td><input type="password" name="password" size="20"></td>
	</tr>
	<tr><td>&nbsp;</td></tr>
	<tr>
		<td align="center" colspan="2"><input type="submit" id="submit" value="Login"/></td>
	</tr>
</table>
<table cellpadding="10" cellspacing="10" border="0">
	<tr>
		<td align="center"><div id="loginMessage"></div></td>
	</tr>
</table>
</form>
</center>
</div>
</body>
</html>
