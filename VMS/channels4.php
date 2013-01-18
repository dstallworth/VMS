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
	<!-- XX<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css" type="text/css" media="all" /> -->
	<!-- <link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />-->
	<!-- XX  <link rel="stylesheet" href="custom-theme/jquery-ui-1.8.4.custom.css" type="text/css" media="all" /> -->
	<!-- XX <link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" /> -->
	<!-- XX <link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" /> -->
	<link rel="stylesheet" href="css/jquery.treeTable.css" type="text/css" media="screen, projection"/>
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection"/>
	
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<!-- <script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script> -->
	<!-- <script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script> -->
	<!-- <script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script> -->
	
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.treeTable.js"></script>
	<script type="text/javascript" language="javascript">
	$(document).ready(function(){
		
		$("#tree").treeTable();
		
	});
	</script>
</head>
<body>


<center><b>Channels</b></center>
	<table id="tree">
  <tr id="node-1">
    <td>Parent</td>
  </tr>
  <tr id="node-2" class="child-of-node-1">
    <td>Child</td>
  </tr>
  <tr id="node-3" class="child-of-node-2">
    <td>Child</td>
  </tr>
</table>

	

</body>
</html>

