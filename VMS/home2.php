<?php
require("Common.php");

//$dbService = new DBService();

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
	<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" />
	
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
	<script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script>
	<!--<script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
			
			$("ul.topnav").hide();
			$("ul.subnav").parent().append("<span></span>"); //Only shows drop down trigger when js is enabled - Adds empty span tag after ul.subnav
			$("ul.mainnav li a") .click(function() {
				//$(this).toggleClass("channel");
				$(this).addClass("mainnav_hover");
				$("ul.topnav").slideToggle();
			});
			
			//$("ul.topnav") .mouseout(function() {
			//	$("ul.mainnav li a").removeClass("mainnav_hover");
			//	$(this).slideToggle();
			//});
			
			
			
			$("ul.topnav li a") .mouseover(function() { //When trigger is clicked...
				//Following events are applied to the subnav itself (moving subnav up and down)
				$(this).parent().find("ul.subnav").slideDown('fast').show(); //Drop down the subnav on click
				$(this).parent().hover(function() {
				}, function(){	
					$(this).parent().find("ul.subnav").slideUp('medium'); //When the mouse hovers out of the subnav, move it back up
					$("ul.mainnav li a").removeClass("mainnav_hover");
					$("ul.topnav li").slideUp();
				});
				//Following events are applied to the trigger (Hover events for the trigger)
				}).hover(function() { 
					$(this).addClass("subhover"); //On hover over, add class "subhover"
				}, function(){	//On Hover Out
					$(this).removeClass("subhover"); //On hover out, remove class "subhover"
			});
			
			$("#mytabs").tabs();
			
			$('#videoTable').dataTable();
			$('#videoTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			$('#articleTable').dataTable();
			$('#articleTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			$('#headlineTable').dataTable();
			$('#headlineTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			
		});
						
	</script>
	
	
	

<link rel="stylesheet" type="text/css" href="nav.css" />

</head>
<body>
<div id="nav">
<ul class="mainnav">
    <li><a href="#">Home</a></li>
    <li><a href="#">Channels</a></li>    
    <li><a href="#">Videos</a></li>
    <li><a href="#">Articles</a></li>
    <li><a href="#">Headlines</a></li>
    <li><a href="#">Users</a></li>
</ul>

<ul class="topnav">
    <li><a href="#">Add a Channel</a></li>
    <li>
        <a href="#">Manage Channels</a>
        <ul class="subnav">
        <?php
        
        $chList = $dbService->getAllChannels();
        foreach ($chList as $chan) {?>
            <li><a href="nav2.php?channelID=<?php echo $chan->getID();?>"><?php echo $chan->getName();?></a></li>
        <?php
        }
        ?>
            
        </ul>
    </li>  
    
</ul>

</div>
<br/><br/><br/><br/>
<div id="wrapper">

<table>
<tr>
	<td>Manage Videos</td>
	<td>Manage Articles</td>
	<td>Manage Headlines</td>	
</tr>
<tr>
	<td>Manage Channels</td>
	<td>Manage Users</td>
	<td>Manage Communications</td>
</tr>
</table>

</div>
</body>
</html>
