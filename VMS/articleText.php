<?php

require("Common.php");

$articleText = "";
$articleTitle = "";

if (isset($_REQUEST["id"])) {
	$articleID = $_REQUEST["id"];
	$article = $dbService->getSpecificArticle($articleID);
	$articleText = $article->getMainText();
	$articleTitle = $article->getTitle();
} else {
	$articleID = 0;
	$articleText = "There was no article found with this ID";
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>VMS</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
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
<script type="text/javascript" language="javascript" src="js/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript" language="javascript" src="js/jquery.ipweditor-1.2.1.js"></script>
<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>

<script type="text/javascript">
//set all the tinyMCE configuration here and pass it to the editable
$().ready(function() {
	var ed = new tinymce.Editor('myipwe1', {
	theme: "advanced",
	theme_advanced_toolbar_location : "top",
	theme_advanced_toolbar_align : "left",
	content_css : "css/tinymce_content.css",
	height : "260"
	
	
	});
	
	$('.myipwe1').editable(
	{
	type: 'wysiwyg',
	editor: ed,
	onSubmit:function submitData(content){
	document.getElementById('newArticleText').value = content.current;
	saveText();	
	},
	submit:'save',
	cancel:'cancel'
	});
});

function saveText() {
	$.post("editArticleText.php",
			$("#articleEditForm").serialize());
}

</script>
	

</head>
<body>

<table cellspacing="0" width="100%">
<tr><td colspan="2" align="right"><a href="#" onclick="window.close();">Close Window</a></td></tr>
<tr><td colspan="2">&nbsp;</td></tr>
<tr bgcolor="#cccccc">
	<td valign="middle"><b><?php echo $articleTitle;?></b></td>
	<td align="right" valign="middle"><b>Click article text to edit</b>&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><div class="myipwe1" id="editable"><?php echo $articleText;?></div></td>
</tr>
</table>
<form name="articleEditForm" id="articleEditForm" action="">
<input type="hidden" name="articleID" value="<?php echo $articleID;?>"/>
<input type="hidden" name="newArticleText" id="newArticleText" value=""/>
</form>
</body>
</html>
