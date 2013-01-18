<?php
require("Common.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>VMS</title>
<link rel="stylesheet" type="text/css" href="js/dataTables-1.6/media/css/demo_page.css" />
<link rel="stylesheet" type="text/css" href="js/dataTables-1.6/media/css/demo_table.css" />

	<!--<script type="text/javascript" language="javascript" src="js/dataTables-1.6/media/js/jquery.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.6/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
		
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			startMenu();
		} );
		
		function startMenu() {
			$('#startMenu').css({ opacity: 0.0});
			$('#bar2').toggle( 
				function() {
					$('#startMenu').stop().animate({height: '300', opacity: 1.0 });
			},	function() {
					$('#startMenu').stop().animate({height: '0', opacity: 0.0 });
			});
			
			$('#app1').mouseover(
				function() {
					$(this).css({opacity: 0.8});
				})	  .mouseout(function() {
					$(this).css({opacity: 1.0});
				});
				
			$('#app2').mouseover(
				function() {
					$(this).css({opacity: 0.8});
				})	  .mouseout(function() {
					$(this).css({opacity: 1.0});
				});
				
			$('#app3').mouseover(
				function() {
					$(this).css({opacity: 0.8});
				})	  .mouseout(function() {
					$(this).css({opacity: 1.0});
				});
		}
	</script>

<link rel="stylesheet" type="text/css" href="css/vms.css" />

</head>
<body>

<div id="wrapper">
	<div id="startBar">
		<div id="startMenu">
		 <div id="app1">Hello World!</div>
		 <div id="app2"></div>
		 <div id="app3"></div>
		</div>
		
		<div id="bar1">
		Bar 1
		</div>
		
		<div id="bar2">
		Bar 2
		</div>
		
		<div id="bar3">
		Bar 3
		</div>
	</div>
	
</div>

</body>
</html>
