<?php

require("Common.php");

//$dbService = new DBService();
$newArticle = 0;

if (isset($_REQUEST["newArticle"])) {
	$newArticle = $_REQUEST["newArticle"];
}

if (isset($_REQUEST["channelID"])) {
	$currentChannel = $_REQUEST["channelID"];
} else {
	$currentChannel = 1;
}

if (isset($_REQUEST["articleID"])) {
	$articleID = $_REQUEST["articleID"];
} else {
	$articleID = 1;
}

$article = $dbService->getSpecificArticle($articleID);
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
	<script type="text/javascript" language="javascript" src="js/tiny_mce/tiny_mce.js"></script>
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript">
	$(function() {
		$("#sortable1, #sortable2").sortable({
			connectWith: '.connectedSortable'
		}).disableSelection();
		
		if (<?php echo $newArticle;?>) {
	    	newArticle();
	    }
	});
	

	tinyMCE.init({
		mode : "exact",
		theme : "advanced",
		elements: "mainText",
		editor_selector : "mceEditor",
		editor_deselector : "mceNoEditor",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		content_css : "css/editor_content.css",
		plugins : "simplebrowser",
		plugin_simplebrowser_width : '800', //default
       	plugin_simplebrowser_height : '600', //default
       	plugin_simplebrowser_browselinkurl : 'tinymce/jscripts/tiny_mce/plugins/simplebrowser/browser.html?Connector=connectors/php/connector.php',
       	plugin_simplebrowser_browseimageurl : 'tinymce/jscripts/tiny_mce/plugins/simplebrowser/browser.html?Type=Image&Connector=connectors/php/connector.php',
       	plugin_simplebrowser_browseflashurl : 'tinymce/jscripts/tiny_mce/plugins/simplebrowser/browser.html?Type=Flash&Connector=connectors/php/connector.php'
		

	});
	
	function newArticle() {
		//alert("Starting New Article");
		
		$(':input','#articleDetailsForm')
		 .not(':button, :submit, :reset, :hidden')
		 .val('')
		 .removeAttr('checked')
		 .removeAttr('selected');
		
		tinyMCE.get('mainText').setContent("");
		
		$('.channelTitle').html('');
		$('#idText').html('0');		
		$('#hitsText').html('0');
		$('#modifiedDate').html("<?php echo date("m/d/Y");?>");
		$('#created').html("<?php echo date("m/d/Y");?>");				
		$('#createdBy').html("USERNAME");
		
		document.getElementById("id").value = "0";			
		
	}
	
	function saveDetails() {
		tinyMCE.triggerSave();
		//alert("submit data = "+$("#articleDetailsForm").serialize());
		$.post("processArticleDetails.php",
				$("#articleDetailsForm").serialize(),
				function(data){
					checkUpdate(data);});
	}

	function checkUpdate(data) {
		var htmlResult = "";
		htmlResult = data;
		
		$('#messageBoxText').html(htmlResult);
		//$('#messageBox').fadeIn(500).delay(3000).fadeOut(1500);		
		////$('#messageBox').slideDown(500).delay(3000).slideUp(1500);
		$('#messageBox').show('fast');
		////$('#messageBox').animate({left: '0'},500).delay(3000).animate({left: '-200'},500);
		$('#messageBox').animate({top: '0'},500).delay(3000).animate({top: '-200'},500);
		//$('#messageBox').show('fast');
	}
	
	</script>
	
	
	
	
</head>
<?php if ($newArticle) { ?>
<body onLoad="newArticle();">
<?php } else { ?>
<body>
<?php } ?>

<?php include("navigation.php"); ?>

<br/><br/>
<div id="messageBox">
	<div id="messageBoxText">TEST</div>
</div>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">Article Manager</td></tr>
	<tr>
		<td width="1" class="channelLabel">&nbsp;&nbsp;Channel: </td>
		<td width="1" nowrap class="channelTitle">&nbsp;&nbsp;<a href="channelView.php?channelID=<?php echo $currentChannel;?>"><?php echo $dbService->getChannelByID($currentChannel)->getName();?></td>
		<td width="*" align="right"><input type="button" onclick="newArticle();" id="newButton" value="New"/>&nbsp;<input type="button" onclick="saveDetails();" id="saveButton" value="Save"/></td>
		<td>&nbsp;</td>
	</tr>
</table>
</center>
<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="articleDetailsForm" id="articleDetailsForm" action="">
<div id="articleDetails">

<table width="100%" align="center" cellspacing="12" cellpadding="12">

	<tr bgcolor="#cccccc"><td colspan="5" align="center" class="videoDetailsHeader"><b>Article Details</b></td></tr>
	
	<tr>
		<td class="detailTabLabel">Title: </td>
		<td><input type="text" name="title" size="45" value="<?php echo $article->getTitle();?>"/></td>
		<td>&nbsp;</td>
		<td class="detailTabLabel">ID: </td>
		<td><div id="idText"><?php echo $article->getID();?></div><input type="hidden" name="id" id="id" value="<?php echo $article->getID();?>"/></td>
	</tr>
	<tr>
		<td class="detailTabLabel">Channel: </td>
		<td>
				<select name="channel">
					<?php
			        
			        $chList = $dbService->getAllChannels();
			        foreach ($chList as $chan) {
			        	if ($chan->getID() == $article->getChannelID()) {
			        		$chanSelected = "selected";
			        	} else {
			        		$chanSelected = "";
			        	}
			        ?>
			            <option value="<?php echo $chan->getID();?>" <?php echo $chanSelected;?>><?php echo $chan->getName();?></option>
			        <?php
			        }
			        ?>
				</select>
		</td>
		<td>&nbsp;</td>
		<td class="detailTabLabel">Published: </td>
			<?php
			if ($article->getPublished()) {
				$checked = "checked";
			} else {
				$checked = "";
			}
			?>
			<td><input type="checkbox" name="published" <?php echo $checked;?>/></td>
	</tr>	
	<tr><td colspan="5">&nbsp;</td></tr>
	
	<tr>
		<td class="detailTabLabel">Start Publishing: </td>
		<td><input id="startPublish" name="startPublish" type="text" size="10"></td>
		<td>&nbsp;</td>
		<td class="detailTabLabel">End Publishing: </td>
		<td><input id="endPublish" name="endPublish" type="text" size="10"></td>
	</tr>
	<tr>		
		<td colspan="3" align="left" nowrap>
		<table width="100%">
		<tr>
			<td width="1" align="right"><span class="detailTabLabel">Created: </span></td>
			<td align="left">&nbsp;&nbsp;<div id="created" style="display:inline;"><?php echo $util->formatDate($article->getCreated());?></div><input type="hidden" name="created" id="created" value="<?php echo $util->formatDate($article->getCreated());?>"/></td>
			<td align="right"><span class="detailTabLabel">Created By: </span><td>
			<td align="left"><input type="text" id="createdBy" name="createdBy" value="<?php echo $article->getCreatedBy();?>"/></td>
		</td>
		</table>
		</td>
		<td><span class="detailTabLabel">Modified:</span></td>
		<td><div id="modifiedDate" style="display:inline;"><?php echo $util->formatDate($article->getModified());?></div><input type="hidden" name="modified" id="modified" value="<?php echo $util->formatDate($article->getModified());?>"/></td>
		
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
		<td class="detailTabLabel" valign="top" nowrap>Caption: </td>
		<td colspan="4">
			<textarea class="mceNoEditor" cols="80" rows="5" name="caption"><?php echo $article->getCaption();?></textarea>
	 	</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
		<td class="detailTabLabel" valign="top">Main Text: </td>
		<td colspan="4">
			<textarea class="mceEditor" cols="80" rows="20" id="mainText" name="mainText"><?php echo $article->getMaintext();?></textarea>
		</td>
	</tr>
</table>

</div>
</form>
</div>

</body>
</html>
