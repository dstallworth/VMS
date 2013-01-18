<?php
require("Common.php");
?>

<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>XML Grid Example</title>
<link rel="stylesheet" type="text/css" href="js/dataTables-1.6/media/css/demo_page.css" />
<link rel="stylesheet" type="text/css" href="js/dataTables-1.6/media/css/demo_table.css" />

	<script type="text/javascript" language="javascript" src="js/dataTables-1.6/media/js/jquery.js"></script>
	<script type="text/javascript" language="javascript" src="js/dataTables-1.6/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" charset="utf-8">
		$(document).ready(function() {
			$('#content').dataTable();
		} );
	</script>

<!--<link rel="stylesheet" type="text/css" href="css/vms.css" />-->

</head>
<body>
<h1>Content Data</h1>
<table cellpadding="0" cellspacing="0" border="0" class="display" id="content">
	<thead>
		<tr>
			<th class="header">ID</th>
			<th class="header">Title</th>
			<th class="header">Directory</th>
			<th class="header">Caption</th>
			<th class="header">Filename</th>
			<th class="header">Channel</th>
		</tr>
	</thead>
	<tbody>
		<?php
			$contentList = $dbService->getAllContent();
			foreach($contentList as $content) {
		?>
			<tr>
				<td class="data"><?php echo $content->getID();?></td>
				<td class="data"><?php echo $content->getTitle();?></td>
				<td class="data"><?php echo $content->getVideoDirectory();?></td>
				<td class="data"><?php echo $content->getCaption();?></td>
				<td class="data"><?php echo $content->getFilename();?></td>
				<td class="data"><?php echo $content->getChannelName();?></td>
			</tr>
		<?php	}
		?> 
	</tbody>
</table>

</body>
</html>
