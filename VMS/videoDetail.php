<?php

require("Common.php");

////$dbService = new DBService();
$util = new Utility();
$newVideo = 0;

if (isset($_REQUEST["newVideo"])) {
	$newVideo = $_REQUEST["newVideo"];
}

if (isset($_REQUEST["channelID"])) {
	$currentChannel = $_REQUEST["channelID"];
} else {
	$currentChannel = 0;
}

if (isset($_REQUEST["videoID"])) {
	$videoID = $_REQUEST["videoID"];
} else {
	$videoID = 1;
}

$vid = $dbService->getSpecificVideo($videoID);
$vidLocation = Constants::$videoBaseLocation.$vid->getVideoDirectory()."/".$vid->getFilename().".".$vid->getFormatExtension();
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
	
	<!--<script type="text/javascript" language="javascript" src="js/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.4.custom.min.js"></script>-->
	<!--<script type="text/javascript" language="javascript" src="js/jquery.idTabs.min.js"></script>-->
	<script type="text/javascript" language="javascript" src="js/dataTables-1.7/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" language="javascript" src="js/jquery.editable-select.js"></script>
	<script type="text/javascript" language="javascript" src="js/vms_jquery.js"></script>
	<script type="text/javascript">		
	$(function() {
		$("#sortable1, #sortable2").sortable({
			connectWith: '.connectedSortable'
		}).disableSelection();
		
		$('.editable-select').editableSelect(
	    {
	      bg_iframe: true,
	      
	      case_sensitive: false, // If set to true, the user has to type in an exact
	                             // match for the item to get highlighted
	      items_then_scroll: 10 // If there are more than 10 items, display a scrollbar
	    });
	    
	    if (<?php echo $newVideo;?>) {
	    	newVideo();
	    }
	    
	    $("#channel").change(function(){
	    	var value = $(this).val();
	    	$.post("getOrderingOptions.php",{channelID: value},
	    			function(data){
	    				$("#ordering").html(data);
	    				
	    	});
	    	
	    	$.post("getChannelName.php",{channelID: value},
	    			function(data2) {
	    				$(".channelTitle").html("&nbsp;&nbsp;<a href=\"channelView.php?channelID="+$("id",data2).text()+"\">"+$("name",data2).text()+"</a>");  				
	    	});
	    	
	    });
	    
	    $("#copyToBox").hide();
	    
	    $("#filename").change(function() {
	    	alert("Filename Changed");
	    	changeVideo();
	    });
	});
	
	function changeArticle(txt,artID) {
		//alert("Changing Article from "+document.videoDetailsForm.relatedArticle.value);
		document.videoDetailsForm.relatedArticle.value = txt;
		document.videoDetailsForm.relatedArticleID.value = artID;
		$('#dialog').dialog('close');
	}
	
	function showArticle(title,txt) {
		//alert("Showing Article with title: "+title+" \n"+" and text: "+txt);
		var closeWindow = "<br/><br/><a href=\"javascript: window.close();\">Close Window</a>";
		document.getElementById('dialog2').innerHTML = txt+closeWindow;
		$('#dialog2').title(title);
		$('#dialog2').dialog('open');
	}
	
	function saveDetails() {
		$.post("processVideoDetails.php",
				$("#videoDetailsForm").serialize(),
				function(data){
					checkUpdate(data);});		
	}
	
	function copyVideo() {
		var newChanID = document.getElementById("copychannel").value;
		hideCopyToBox();
		$.post("copyVideo.php",
				{videoID: "<?php echo $vid->getID();?>",newChannelID: newChanID},
				function(data){
					checkUpdate(data);
					});
	}
	
	function newVideo() {
		//alert("Starting New Video");
		
		$(':input','#videoDetailsForm')
		 .not(':button, :submit, :reset, :hidden')
		 .val('')
		 .removeAttr('checked')
		 .removeAttr('selected');
		
		$('.channelTitle').html('');
		$('#idText').html('0');
		$('#hitsText').html('0');
		$('#modifiedDate').html("<?php echo date("m/d/Y");?>");
		$('#created').html("<?php echo date("m/d/Y");?>");				
		$('#createdBy').html("USERNAME");
		for (var x=0;x<<?php echo $dbService->getNextOrderingForChannel(0);?>;x++) {
			$('#ordering').append("<option value="+x+">"+x+"</option>");
		}
		document.getElementById("id").value = "0";			
		
	}
	
	function changeVideo() {
		alert("Changing Video");
		
	  var videoDir = document.getElementById('videoDirectory').value;		
	  var videoName = document.getElementById('filename').value;
//alert("Video Directory = "+videoDir+"\nVideo Name = "+videoName);	  
	  var videoFile = "<?php echo Constants::$videoBaseLocation;?>"+videoDir+"/"+videoName+".flv";
//alert("Video File = "+videoFile);	  
	  so.addVariable('file',videoFile);
	  so.write('vidPreview');	  
	 // var player = document.getElementById('vidPreview');
	 // player.sendEvent('LOAD', videoFile);
	  //player.sendEvent("PLAY");
	  //player.addVariable("image",previewImage);
	  

	}
	
	function checkUpdate(data) {
		var htmlResult = "";
		htmlResult = data;
		/*if (data == 1) {
			htmlResult = "<h1>SUCCESS ("+data+")</h1>";
			document.getElementById('modifiedDate').innerHTML = "<?php echo date("m/d/Y");?>";
		} else {
			htmlResult = "<h1>FAILURE ("+data+")</h1>";
		}*/
		
		$('#messageBoxText').html(htmlResult);
		//$('#messageBox').fadeIn(500).delay(3000).fadeOut(1500);		
		////$('#messageBox').slideDown(500).delay(3000).slideUp(1500);
		$('#messageBox').show('fast');
		////$('#messageBox').animate({left: '0'},500).delay(3000).animate({left: '-200'},500);
		$('#messageBox').animate({top: '0'},500).delay(3000).animate({top: '-200'},500,"linear",function(){reloadPage();});
		//$('#messageBox').show('fast');
		
		
	}
	
	function reloadPage()  {
		//alert("reloading "+location.href);
		//var thisURL = location.href;
		//thisURLPart = thisURL.substring(thisURL.indexOf("videoID"),thisURL.length);
		//thisURLPart = thisURLPart.substring(0,thisURLPart.indexOf("=")+1);
		//newLocation = thisURL.substring(0,thisURL.indexOf("videoID"))+thisURLPart;
		//alert("need to load"+newLocation);
		location.reload(true);
	}
	
	function showCopyToBox() {
		//alert("Showing CopyToBox");
		$('#copyToBox').show();
		$('#copyToBox').animate({top: '0'},500);
	}
	
	function hideCopyToBox() {
		$('#copyToBox').animate({top: '-104'},500);
	}
		
			
	</script>
	<script type="text/javascript" language="javascript"  src="js/swfobject.js"></script>
	
	
	
	
</head>
<?php if ($newVideo) { ?>
<body onLoad="newVideo();">
<?php } else { ?>
<body>
<?php } ?>


<?php include("navigation.php"); ?>

<br/><br/>
<div id="messageBox">
	<div id="messageBoxText"></div>
</div>
<div id="copyToBox">
	<div id="copyToBoxClose"><a href="#" onclick="hideCopyToBox();">Close <b>X</b></a></div>
	<div id="copyToBoxText">
	<table cellspacing="8" cellpadding="8" width="100%">
		<tr>
			<td>Copy this video (<?php echo $vid->getTitle();?>) to the following channel:</td>
		</tr>
		<tr> 
			<td>
				<select name="copychannel" id="copychannel">
					<?php
			        
			        $chList = $dbService->getAllChannels();
			        foreach ($chList as $chan) {
			        	if ($chan->getID() == $vid->getChannelID()) {
			        		$chanSelected = "selected";
			        	} else {
			        		$chanSelected = "";
			        	}
			        ?>
			            <option value="<?php echo $chan->getID();?>" <?php echo $chanSelected;?>><?php echo $util->limitStringLength($chan->getName(),25);?></option>
			        <?php
			        }
			        ?>
				</select>&nbsp;<input type="button" name="copyButton" value="Copy" onclick="copyVideo();"/>
			</td>
		</tr>
		
	</table>
	</div>
</div>
<div id="wrapper">
<center>
<table width="98%" align="center" border="0">
	<tr class="pageTitle"><td colspan="3">Video Manager</td></tr>
	<tr>
		<td width="1" class="channelLabel">&nbsp;&nbsp;Channel: </td>
		<td width="1" nowrap class="channelTitle">&nbsp;&nbsp;<a href="channelView.php?channelID=<?php echo $currentChannel;?>"><?php echo $dbService->getChannelByID($currentChannel)->getName();?></a></td>
		<td width="*" align="right"><input type="button" onclick="newVideo();" id="newButton" value="New"/>&nbsp;<input type="button" id="copyButton" onclick="showCopyToBox();" value="Copy To"/>&nbsp;<input type="button" onclick="saveDetails();" id="saveButton" value="Save"/></td>
	</tr>
</table>
</center>
<!--<input type="button" id="visible" name="visible" value="Visible"/>
<input type="button" id="hide" name="hide" value="Hide"/>-->
<form name="videoDetailsForm" id="videoDetailsForm" action="">
<div id="vidDetails">

<table cellspacing="7" cellpadding="7" width="98%">
	<tr bgcolor="#cccccc"><td colspan="5" align="center" class="videoDetailsHeader"><b>Video Details</b></td></tr>
	<tr>
		<td class="videoDetailsLabel">Title: </td>
		<td colspan="4"><input type="text" name="title" id="title" size="70" value="<?php echo $vid->getTitle();?>"/></td>		
	</tr>
	<tr>				
		<td class="videoDetailsLabel">ID: </td>
		<td><div id="idText"><?php echo $vid->getID();?></div><input type="hidden" name="id" id="id" value="<?php echo $vid->getID();?>"/>
		</td>
		<td>&nbsp;</td>
		<td class="videoDetailsLabel">Hits: </td>
		<td><div id="hitsText"><?php echo $vid->getHits();?></div><input type="hidden" name="hits" value="<?php echo $vid->getHits();?>"/></td>
	</tr>
	<tr>
		<td class="videoDetailsLabel">Video Directory: </td>
		<td><!--<input type="text" name="videoDirectory" id="videoDirectory" size="35" value="<php echo $vid->getVideoDirectory();?>"/>-->
			<select name="videoDirectory" id="videoDirectory" class="editable-select">
				<?php		        
		        $directories = $dbService->getAllVideoDirectoriesAlphabetically();
		        ////$basedir = "../";
		        ////$directories = scandir($basedir);
		        foreach ($directories as $thisDir) {
		        	////if (is_dir($thisDir)) {		        	
			        	if ($thisDir == $vid->getVideoDirectory()) {
			        		$dirSelected = "selected";
			        	} else {
			        		$dirSelected = "";
			        	}
		        	
		        ?>
		            <option value="<?php echo $thisDir;?>" <?php echo $dirSelected;?>><?php echo $thisDir;?></option>
		        <?php
		        	////}
		        }
		        ?>
			</select>
		</td>
		<td>&nbsp;</td>
		<td class="videoDetailsLabel">Published: </td>
			<?php
			if ($vid->getPublished()) {
				$checked = "checked";
			} else {
				$checked = "";
			}
			?>
			<td><input type="checkbox" name="published" id="published" value="1" <?php echo $checked;?>/></td>
	</tr>
	<tr>
		<td class="videoDetailsLabel">Channel: </td>
		<td>
				<select name="channel" id="channel">
					<option value="0"></option>
					<?php
			        
			        $chList = $dbService->getAllChannels();
			        foreach ($chList as $chan) {
			        	if ($chan->getID() == $vid->getChannelID()) {
			        		$chanSelected = "selected";
			        	} else {
			        		$chanSelected = "";
			        	}
			        ?>
			            <option value="<?php echo $chan->getID();?>" <?php echo $chanSelected;?>><?php echo $util->limitStringLength($chan->getName(),25);?></option>
			        <?php
			        }
			        ?>
				</select>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="videoDetailsLabel">Ordering: </td>
		<td>
		<?php 
			$orderedVideos = $dbService->getAllVideosForChannel($currentChannel);
		?>			
			<select name="ordering" id="ordering">
				<?php
				foreach ($orderedVideos as $orderedVid) {
					$thisOrder = $orderedVid->getOrdering();
					if ($thisOrder == $vid->getOrdering()) {
						$selected = "selected";
					} else {
						$selected = "";
					}
				?>
					<option value="<?php echo $thisOrder;?>" <?php echo $selected;?>><?php echo $thisOrder." - ".$util->limitStringLength($orderedVid->getTitle(),30);?></option>
				<?php
				}?>
			</select>
		</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
	</tr>
	<tr>
		<td class="videoDetailsLabel">Start Publishing: </td>
		<td><input id="startPublish" name="startPublish" type="text" size="10"></td>
		<td>&nbsp;</td>
		<td class="videoDetailsLabel">End Publishing: </td>
		<td><input id="endPublish" name="endPublish" type="text" size="10"></td>
	</tr>
	
	
	<tr>
		<td class="videoDetailsLabel">Created By: </td>
		<td><div id="createdBy"><?php echo $dbService->getUserFullName($vid->getCreatedBy());?></div></td>
		<td>&nbsp;</td>
		<td class="videoDetailsLabel">Created: </td>
		<td><div id="created"><?php echo $util->formatDate($vid->getCreated());?></div></td>
	</tr>
	<tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td class="videoDetailsLabel">Modified: </td>
		<td><div id="modifiedDate"><?php echo $util->formatDate($vid->getModified());?></div></td>		
	</tr>	
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr>
		<td class="videoDetailsLabel" valign="top" nowrap>Hover Text: </td>
		<td colspan="4">
			<textarea cols="50" rows="5" name="hoverText" id="hoverText"><?php echo $vid->getHovertext();?></textarea>
	 	</td>
	</tr>
	<tr>
		<td class="videoDetailsLabel" valign="top" nowrap>Caption: </td>
		<td colspan="4">
			<textarea cols="50" rows="3" name="caption" id="caption"><?php echo $vid->getCaption();?></textarea>
	 	</td>
	</tr>
	<tr>
		<td class="videoDetailsLabel">Filename: </td>
		<td colspan="4">
			<input type="text" size="55" name="filename" id="filename" value="<?php echo $vid->getFilename();?>"/>						
		</td>
	</tr>
	<tr>	
		<td class="videoDetailsLabel">Video Format: </td>
		<td colspan="4">
			<select name="formatExtension" id="formatExtension">
				<?php
		        $extension = $vid->getFormatExtension();
		        $formats = $dbService->getAllVideoFormats();
		        foreach ($formats as $thisFormat) {
		        	$ext = $thisFormat->getFormatExtension();
		        	$desc = $thisFormat->getFormatDescription();
		        	if ($ext == $extension) {
		        		$formatSelected = "selected";
		        	} else {
		        		$formatSelected = "";
		        	}
		        ?>
		            <option value="<?php echo $ext;?>" <?php echo $formatSelected;?>><?php echo $desc." (.".$ext.")";?></option>
		        <?php
		        }
		        ?>
			</select>
		</td>
	</tr>
	
	<tr>
		<td class="videoDetailsLabel">Related Article: </td>
		<td colspan="4">
			<?php
				$articleID = $vid->getRelatedArticle();
				$articleTitle = $dbService->getSpecificArticle($articleID)->getTitle();
			?>
			<input type="text" size="50" name="relatedArticle" value="<?php echo $articleTitle." ($articleID)";?>"/>
			<input type="hidden" name="relatedArticleID" value="<?php echo $articleID;?>"/>
			<!--<a href="#" onclick="jQuery('#dialog').dialog('open'); return false">Select Article...</a>-->
			<input type="button" value="Select Article..." onclick="jQuery('#dialog').dialog('open'); return false"/>
		</td>
	</tr>
	<tr><td colspan="5">&nbsp;</td></tr>
	<tr><td colspan="5">&nbsp;</td></tr>		
</table>
</div>
<div id="vidDetailsTabs">
	<center><span class="videoDetailsHeader">Preview</span></center>
	<div id="vidPreview"></div>
	<br/> 
	<table cellspacing="15" cellpadding="8" width="95%">
		<tr class="videoDetailsHeader" bgcolor="#cccccc"><td align="center" colspan="2"><b>Meta Info</b></td></tr>
		<tr>
			<td class="videoDetailsLabel" valign="top" nowrap>Keywords: </td>
			<td>
				<textarea cols="45" rows="5" name="metaKey" id="metaKey"><?php echo $vid->getMetakey();?></textarea>
		 	</td>
		</tr>
		<tr><td >&nbsp;</td></tr>
		<tr>
			<td class="videoDetailsLabel" valign="top" nowrap>Description: </td>
			<td >
				<textarea cols="45" rows="5" name="metaDesc" id="metaDesc"><?php echo $vid->getMetadesc();?></textarea>
		 	</td>
		</tr>
	</table>						
</div>
</form>
</div>

<div id="dialog" title="Articles">	
	<table class="display" cellpadding="5" id="selectArticleTable">
		<thead>
		<tr>
			<th></th>
			<th>ID</th>
			<th>Title</th>
		</tr>
		</thead>
		<tbody>
	<?php
	$articleList = $dbService->getAllArticles();
	//$articleList = $dbService->getAllArticlesForChannel($currentChannel);
	//$vidList = $dbService->getAllChannels();
	//echo "SQL - ".$dbService->query;
      foreach ($articleList as $article) {
      	$newArticleText = str_replace("'","\'",$article->getTitle_js())." (".$article->getID().")";
      	?>
		<tr>
			<td align="center"><a href="#" onclick="window.open('articleText.php?id=<?php echo $article->getID();?>','articleWindow','height=400,width=500,modal=yes,alwaysRaised=yes'); return false"><img src="images/view_icon.gif" border="0" alt="View Article"/></a></td>
			<td align="center"><a href="javascript: changeArticle('<?php echo $newArticleText;?>','<?php echo $article->getID();?>');"><?php echo $article->getID();?></a></td>						
			<td><a href="javascript: changeArticle('<?php echo $newArticleText;?>','<?php echo $article->getID();?>');"><?php echo $article->getTitle();?></a></td>
		</tr>
		<?php
		}
		?>
		</tbody>
	</table>
</div>

<div id="dialog2" title="">
</div>


<script type='text/javascript'>
  var so = new SWFObject('player.swf','ply','470','320','9','#000000');
  so.addParam('allowfullscreen','true');
  so.addParam('allowscriptaccess','always');
  so.addParam('wmode','opaque');
  //so.addParam('flashvars','plugins=ova&config=http://longtailvideo.com/support/sites/all/modules/ova/content/jw5x/config/ad-servers/doubleclick/ova03.xml&file=path/to/video.mpr&duration=30&provider=video')
  so.addVariable('file','<?php echo $vidLocation;?>');
  
 so.write('vidPreview');
</script>

</body>
</html>
