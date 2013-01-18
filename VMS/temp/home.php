<?php
//session_start();
require("Common.php");

if (isset($_REQUEST["sport"])) {
	$sportID = $_REQUEST["sport"];
} else {
	$sportID = 0;
}

$sportList = $dbService->getSports();
function getSportName($sportList,$sport_id)
{
	foreach ($sportList as $thisSport)
	{
		if ($thisSport->getID() == $sport_id)
		{
			return $thisSport->getName();
		}
	}
	return "";
}

function getSportNameID($sportName)
{
	return str_replace(" ","_",strtolower($sportName));
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />

<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>SPAT - Sports Performance Analysis Tool</title>
	<link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.3/themes/base/jquery-ui.css" type="text/css" media="all" />
	<!--<link rel="stylesheet" href="http://static.jquery.com/ui/css/demo-docs-theme/ui.theme.css" type="text/css" media="all" />-->
	<link rel="stylesheet" href="custom-theme/jquery-ui-1.8.4.custom.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_page.css" type="text/css" media="all" />
	<link rel="stylesheet" href="js/dataTables-1.7/media/css/demo_table.css" type="text/css" media="all" />	
	<link rel="stylesheet" href="css/style.css" type="text/css" media="screen, projection"/>
	<link rel="stylesheet" href="css/superfish.css" type="text/css"  media="screen">

	<!-- REMOTE JQUERY <script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script> -->
	<!-- REMOTE JQUERY UI <script type="text/javascript" language="javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.4/jquery-ui.min.js"></script> -->
	<script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>
	<script type="text/javascript" src="js/jquery/jeditable.js" charset="utf-8"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script src="js/jQuery-File-Upload-jquery-ui/js/vendor/jquery.ui.widget.js"></script>
	<script src="js/jQuery-File-Upload-jquery-ui/js/jquery.iframe-transport.js"></script>
	<script src="js/jQuery-File-Upload-jquery-ui/js/jquery.fileupload.js"></script>
	<script src="js/jQuery-File-Upload-jquery-ui/js/jquery.fileupload-fp.js"></script>
	<script src="js/jQuery-File-Upload-jquery-ui/js/jquery.fileupload-ui.js"></script>	
	<script type="text/javascript" src="../assets/js/hoverIntent.js"></script>
	<script type="text/javascript" src="js/superfish.js"></script>
	
	
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function(){
						
		$('.targetDiv').hide();
		<?php 
		if ($sportID != 0)
		{?>
			$('#'+'<?php echo getSportNameID($dbService->getSportName($sportID));?>').show();
		<?php
		} else {
		?>
			$('#allSports').show();
		<?php
		}
		?>
			
		
		$('#athleteDetails').hide();
		$('#uploadAFile').hide();
		
		$('.editIcon').click ( function() { 
			$.post("details.php", {athID: $(this).attr('name')}, 
				function(data) {
				document.getElementById('athleteID').value = data.id;
				document.getElementById('athName').innerHTML = "<b>"+data.firstName+" "+data.lastName+"</b>";				
				document.getElementById('benchPress').value = data.bench;
				document.getElementById('squat').value = data.squat;
				document.getElementById('powerClean').value = data.clean;
				document.getElementById('big3').value = data.big3;
				document.getElementById('bodyWeight').value = data.weight;
				document.getElementById('verticalJump').value = data.vjJump;
				document.getElementById('dash20').value = data.yard20;
				document.getElementById('agility').value = data.proAgility;
				document.getElementById('dash40').value = data.yard40;
				document.getElementById('reach').value = data.vjReach;
			},"json");
		
			$('#athleteDetails').show();
			});
			
		$('.upload').click(
			function () { $('#uploadAFile').slideDown();}
			);
		

		$('.tableDataEdit').editable('update.php', {			
			placeholder : ' ',
			callback: function(){location.reload();}
		});
		
		$('.closeDetails').click ( function() {
			$('#athleteDetails').hide();
		});

		$('.closeImport').click ( function() {
			$('#uploadAFile').hide();
		});

		$('#cancelButton').click ( function() {
			$('#athleteDetails').hide();
		});

		
		
        $('.nav').click(function(){
              $('.targetDiv').hide();
             $('#'+$(this).attr('target')).show();
             //$('#graphLink').href = "graph.php?sport="+$('#'+$(this).attr('target'));
             $('#graphLink a').attr("href", "graph.php?sport="+$('#'+$(this).attr('target')));
        });
        
        $('#buttons tr').hover( function() {
        		if ( $(this).hasClass('buttons_hover') )
					$(this).removeClass('buttons_hover');
				else
					$(this).addClass('buttons_hover');
			} );
			
		$('#buttons tr').click( function() {
				$('#buttons tr').removeClass('buttons_active');
        		$(this).addClass('buttons_active');        		
			} );
        
			$("#mytabs").tabs();
			
			$('#allSportsTable').dataTable({
				"bSort": true,
				"bLengthChange": false,
				"iDisplayLength": 15
				
			});
			$('#allSportsTable tr').hover( function() {
				if ( $(this).hasClass('row_selected') )
					$(this).removeClass('row_selected');
				else
					$(this).addClass('row_selected');
			} );
			
			
			<?php
			foreach ($sportList as $tempSport)
			{
			?>
				$('#<?php echo getSportNameID($tempSport->getName())."Table";?>').dataTable({
					"bSort": true,
					"bLengthChange": false,
					"iDisplayLength": 15
					
				});
				$('#<?php echo getSportNameID($tempSport->getName())."Table";?> tr').hover( function() {
					if ( $(this).hasClass('row_selected') )
						$(this).removeClass('row_selected');
					else
						$(this).addClass('row_selected');
				} );
			<?php
			}
			?>

			$("#detailForm").submit(function(e){    
			       e.preventDefault();
			       $('#athleteDetails').hide();
				$.post("updateMeasurables.php", $("#detailForm").serialize(),
					   function(data) {
							alert(data);
							location.reload();
					   });				  
			});	

			
		});


				
	</script>
	
	
	<!--<link rel="stylesheet" type="text/css" href="nav.css" />-->
		



</head>
<body>
<!-- ?php include("navigation.php"); -->


<div id="main_wrapper">
<div id="titleBar">&nbsp;&nbsp;<a href="home.php">Sports Performance Analysis Tool</a></div>
<div id="menu">
<!-- <table class="menuTable">
	<tr>
		<td class="upload">Import a File</td>
		<td class="reports">Reports</td>
	</tr>
</table>
-->

<ul class="sf-menu">
	<li>
		<a href="#">Show Sport Data</a>
		<ul>
			<li><a class="nav" target="allSports">All Sports</a></li>
			<?php
			foreach ($sportList as $aSport)
			{
			?>
			
			<li><a class="nav" target="<?php echo getSportNameID($aSport->getName());?>"><?php echo $aSport->getName();?></a></li>
			
			<?php
			}
			?>
			
		</ul>
	</li>		
	<li class="current">
		<a class="upload" href="#a">Import a File</a>	
		<ul>
			<li></li>
			
		</ul>	
	</li>
	<li>
		<a href="#">Reports</a>
		<ul>
			<li>
				<a href="#" nowrap>Send To Coaches</a>	
				<ul>
				<?php
				foreach ($sportList as $aSport)
				{
				?>
				
				<li><a href="report.php?sport=<?php echo $aSport->getID();?>"><?php echo $aSport->getName();?></a></li>
				
				<?php
				}
				?>
				</ul>			
			</li>
			<li>
				<a href="#" nowrap>Graphs</a>
				<ul>
					<li><div id="graphLink"><a href="graph.php?graph=graphBench">Bench Press</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graphSquat">Squat</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graphClean">Clean</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graphBig3">Big 3</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graphVerticalJump">Vertical Jump</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graphProAgility">Pro Agility</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graph20Yard">20-yard Dash</a></div></li>
					<li><div id="graphLink"><a href="graph.php?graph=graph40Yard">40-yard Dash</a></div></li>
				</ul>
			</li>			
		</ul>
	</li>
</ul>
</div>

<div id="uploadAFile">
<table>
<tr>
		<td align="right" class="closeImport"><b>CLOSE </b>&nbsp;<img src="images/closeImage.png" width="20" height="20"/></td>		
</tr>
<tr>
	
	<td align="center">
	    <form id="fileupload" action="load.php" method="post" enctype="multipart/form-data">
	        Import a data file to the server:&nbsp;&nbsp;<br/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="file" name="file" id="file"><br/>&nbsp;&nbsp;&nbsp;&nbsp;<br/>
			<input type="submit" name="submit" value="  Import...  "><br/>
	    </form>
   	</td>
</tr>
</table>
</div>

<!-- <div id="buttons">
	<table width="100%">
		<tr><td valign="middle"><a class="nav" target="allSports"><img src="images/fhs_logo_small.gif" width="40" height="40" border="0"/>All Sports</a></td></tr>

		<?php
		//foreach ($sportList as $aSport)
		//{
		?>
		
		<tr><td valign="middle"><a class="nav" target="<?php //echo getSportNameID($aSport->getName());?>"><img src="images/fhs_logo_small.gif" width="40" height="40" border="0"/><?php //echo $aSport->getName();?></a></td></tr>
		
		<?php
		//}
		?>

		
	</table>

</div>
 -->

<div id="snapshot">
	
	
		<!-- All Sports -->
		<div id="allSports" class="targetDiv">
			<br/><div class="tableTitle">ALL SPORTS</div>
			<table class="display" border="1" cellpadding="5" id="allSportsTable">
				<thead>
				<tr>		
					<th>&nbsp;</th>					
					<th>Last Name</th>
					<th>First Name</th>
					<th>Sport 1</th>
					<th>Sport 2</th>
					<th>Bench</th>
					<th>Squat</th>
					<th>Clean</th>
					<th>Big 3</th>
					<th>VJ Reach</th>
					<th>VJ Jump</th>
					<th>20yd Dash</th>
					<th>40yd Dash</th>
					<th>Agility</th>
					<th>Weight</th>
					<th>Class</th>								
				</tr>
				</thead>
				<tbody>
			<?php
			$sportID = 0;
			$athleteList = $dbService->getAthletesBySport($sportID);
			//$vidList = $dbService->getAllChannels();
			//echo "SQL - ".$dbService->query;			
		      foreach ($athleteList as $athlete) {
		      	$measurables = $dbService->getMeasurablesByAthleteID($athlete->getID());
		      	$athID = $athlete->getID();?>
				<tr>					
					<td class="tableData"><div class ="editIcon" name="<?php echo $athlete->getID();?>"><img src="images/editImage.png" width="20" height="20"/></div></td>
					<td class="tableData"><?php echo $athlete->getLastName();?></td>
					<td class="tableData"><?php echo $athlete->getFirstName();?></td>
					<td class="tableData"><?php echo getSportName($sportList,$athlete->getSport1());?></td>			
					<td class="tableData"><?php echo getSportName($sportList,$athlete->getSport2());?></td>					
					<td class="tableDataEdit" id="<?php echo $sportID."-Bench-".$athID;?>"><?php echo $measurables->getBench();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Squat-".$athID;?>"><?php echo $measurables->getSquat();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Clean-".$athID;?>"><?php echo $measurables->getClean();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Big3-".$athID;?>"><?php echo $measurables->getBig3();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-VerticalJump_Reach-".$athID;?>"><?php echo $measurables->getVJReach();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-VerticalJump_Jump-".$athID;?>"><?php echo $measurables->getVJJump();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-20Yard-".$athID;?>"><?php echo $measurables->get20Yard();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-40Yard-".$athID;?>"><?php echo $measurables->get40Yard();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-ProAgility-".$athID;?>"><?php echo $measurables->getProAgility();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Weight-".$athID;?>"><?php echo $measurables->getWeight();?></td>
					<td class="tableData"><?php echo $athlete->getGRClass();?></td>
				</tr>
				<?php
				}
				?>
				</tbody>
			</table>
		</div>
		
	<?php
	foreach ($sportList as $tableSport)
	{
		
	?>
		
		<!-- <?php echo $tableSport->getName();?> -->
		<div id="<?php echo getSportNameID($tableSport->getName());?>" class="targetDiv">
			<br/><div class="tableTitle">
			<?php 
			$sportID = $tableSport->getID();
			echo strtoupper(getSportName($sportList,$sportID));
			?>
			</div>
			<table class="display" border="1" cellpadding="5" id="<?php echo getSportNameID($tableSport->getName())."Table";?>">
				<thead>
				<tr>	
					<th>&nbsp;</th>				
					<th>Last Name</th>
					<th>First Name</th>
					<th>Sport 1</th>
					<th>Sport 2</th>
					<th>Bench</th>
					<th>Squat</th>
					<th>Clean</th>
					<th>Big 3</th>
					<th>VJ Reach</th>
					<th>VJ Jump</th>
					<th>20yd Dash</th>
					<th>40yd Dash</th>
					<th>Agility</th>
					<th>Weight</th>
					<th>Class</th>									
				</tr>
				</thead>
				<tbody>
			<?php			
			$athleteList = $dbService->getAthletesBySport($sportID);
			//$vidList = $dbService->getAllChannels();
			//echo "SQL - ".$dbService->query;			
		      foreach ($athleteList as $athlete) {
		      	if (($athlete->getSport1() == $sportID) || ($athlete->getSport2() == $sportID))
		      	{
		      		$measurables = $dbService->getMeasurablesByAthleteID($athlete->getID());
		      		$athID = $athlete->getID();?>
				<tr>	
					<td class="tableData"><div class ="editIcon" name="<?php echo $athlete->getID();?>"><img src="images/editImage.png" width="20" height="20"/></div></td>				
					<td class="tableData"><?php echo $athlete->getLastName();?></td>
					<td class="tableData"><?php echo $athlete->getFirstName();?></td>
					<td class="tableData"><?php echo getSportName($sportList,$athlete->getSport1());?></td>			
					<td class="tableData"><?php echo getSportName($sportList,$athlete->getSport2());?></td>					
					<td class="tableDataEdit" id="<?php echo $sportID."-Bench-".$athID;?>"><?php echo $measurables->getBench();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Squat-".$athID;?>"><?php echo $measurables->getSquat();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Clean-".$athID;?>"><?php echo $measurables->getClean();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Big3-".$athID;?>"><?php echo $measurables->getBig3();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-VerticalJump_Reach-".$athID;?>"><?php echo $measurables->getVJReach();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-VerticalJump_Jump-".$athID;?>"><?php echo $measurables->getVJJump();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-20Yard-".$athID;?>"><?php echo $measurables->get20Yard();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-40Yard-".$athID;?>"><?php echo $measurables->get40Yard();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-ProAgility-".$athID;?>"><?php echo $measurables->getProAgility();?></td>
					<td class="tableDataEdit" id="<?php echo $sportID."-Weight-".$athID;?>"><?php echo $measurables->getWeight();?></td>
					<td class="tableData"><?php echo $athlete->getGRClass();?></td>
				</tr>
				<?php
				}
		      }
				?>
				</tbody>
			</table>
		</div>
				
	<?php
	}
	?>		
	
</div>

</div>

<div id="athleteDetails">
<form id="detailForm" method="post">
<input type="hidden" name="athleteID" id="athleteID"/>
<table border="0">
	<tr>
		<td align="right" class="closeDetails"><img src="images/closeImage.png" width="20" height="20"/></td>		
	</tr>
	<tr>
		<td align="left" class="detailsName"><div id="athName">Firstname Lastname</div></td>		
	</tr>
	<tr>
		<td>
		<table class="detailData">
			<tr>
				<td class="tableDataDetail" nowrap>Bench Press</td><td><input name="benchPress" id="benchPress"/></td>
				<td class="tableDataDetail" nowrap>Squat</td><td><input name="squat" id="squat"/></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr><td colspan="4">&nbsp;</td></tr>
			
			<tr>
				<td class="tableDataDetail" nowrap>Power Clean</td><td><input name="powerClean" id="powerClean"/></td>
				<td class="tableDataDetail" nowrap>Big 3</td><td><input name="big3" id="big3"/></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr><td colspan="4">&nbsp;</td></tr>
			
			<tr>
				<td class="tableDataDetail" nowrap>Body Weight</td><td><input name="bodyWeight" id="bodyWeight"/></td>			
				<td class="tableDataDetail" nowrap>Vert. Jump</td><td><input name="verticalJump" id="verticalJump"/></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr><td colspan="4">&nbsp;</td></tr>
			
			<tr>	
				<td class="tableDataDetail" nowrap>20 yd. Dash</td><td><input name="dash20" id="dash20"/></td>
				<td class="tableDataDetail" nowrap>Agility</td><td><input name="agility" id="agility"/></td>
				<td colspan="2">&nbsp;</td>
			</tr>
			
			<tr><td colspan="4">&nbsp;</td></tr>
			
			<tr>
				<td class="tableDataDetail" nowrap>40 yd. Dash</td><td><input name="dash40" id="dash40"/></td>
				<td class="tableDataDetail" nowrap>Reach</td><td><input name="reach" id="reach"/></td>
				<td colspan="2">&nbsp;</td>			
			</tr>			
		</table>
		</td>
	</tr>
	<tr>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td align="center"><input id="applyChanges" type="Submit" value="Apply Changes"/>&nbsp;&nbsp;<input id="cancelButton" type="button" value="Cancel"/></td>
	</tr>
</table>
</form>
</div>
</body>
</html>
<?php
$dbService->closeConnection();
?>
