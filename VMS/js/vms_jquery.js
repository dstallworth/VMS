$(document).ready(function(){
						
	$("#mytabs").tabs();
	$("#detailtabs").tabs();
	
	$('#videoTable').dataTable({
		iDisplayLength: 25,
		aaSorting: [[4,"desc"]]
	});
	$('#videoTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#articleTable').dataTable({
		iDisplayLength: 25
	});
	$('#articleTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#headlineTable').dataTable({
		iDisplayLength: 25
	});
	$('#headlineTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );	
	
	$('#relatedVideosTable').dataTable({
		iDisplayLength: 10
	});
	$('#relatedVideosTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );										
	
	$('#channelTable').dataTable({
		iDisplayLength: 25,
		aoColumnDefs: [ {"sType": 'numeric', "aTargets":[3]} ],
		aaSorting: [[3,"asc"]],
		bAutoWidth: false,
		
	});
	$('#channelTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#videoTabTable').dataTable({
		iDisplayLength: 25,
		aaSorting: [[3,"asc"]]
	});
	$('#videoTabTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#articleTabTable').dataTable({
		iDisplayLength: 25
	});
	$('#articleTabTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#channelTabTable').dataTable({
		iDisplayLength: 25,
		bAutoWidth: false,
		
	});
	$('#channelTabTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#imageToggle').toggle(

        function(){ // you can add as much here as you'd like
			$('#publishImage').attr('src','images/checked.png');

        }, function() { // same here
			$('#publishImage').attr('src','images/unchecked.png');

     });
     
     $( "#startPublish" ).datepicker({ 
     				showOn: 'button',
     				buttonImage: 'images/date_picker.gif' 
     				});
     				
     $( "#endPublish" ).datepicker({ 
     				showOn: 'button',
     				buttonImage: 'images/date_picker.gif' 
     				});
     $("#dialog").dialog({
      bgiframe: true, autoOpen: false, width: 500, height: 500, modal: true
    });
    
    $("#dialog2").dialog({
      bgiframe: true, autoOpen: false, width: 500, height: 500, modal: false
    });
    
    $("#changePwdDialog").dialog({
      bgiframe: true, autoOpen: false, width: 330, height: 250, modal: true
    });
    
    $('#selectArticleTable').dataTable({
		iDisplayLength: 25
		
	});
	$('#selectArticleTable tr').hover( function() {
		if ( $(this).hasClass('row_selected') )
			$(this).removeClass('row_selected');
		else
			$(this).addClass('row_selected');
	} );
	
	$('#messageBox').hide();
		
	//$('#saveOrdering').html("&nbsp;");
	
	//$('#saveChannelOrdering').html("&nbsp;");
			
	/*$("#videoTabTable").tableDnD({
		 onDragClass: "myDragClass",		 
		 onDrop: function(table, row) {
	        var rows = table.tBodies[0].rows;
	        var debugStr = "Row dropped was "+row.id+". New order: ";
	        var serializeStr = "Serialized - "+$.tableDnD.serialize();
	        for (var i=0; i<rows.length; i++) {
	            debugStr += rows[i].id+" ";
	        }
	        
	        $('#saveOrdering').html("<a href=\"javascript:saveOrdering();\">Save Ordering</a>");
	        }
		
	});	
	
	$("#channelTable").tableDnD({
		 onDragClass: "myDragClass",		 
		 onDrop: function(table, row) {
	        var rows = table.tBodies[0].rows;
	        var debugStr = "Row dropped was "+row.id+". New order: ";
	        var serializeStr = "Serialized - "+$.tableDnD.serialize();
	        for (var i=0; i<rows.length; i++) {
	            debugStr += rows[i].id+" ";
	        }
	        
	        $('#saveChannelOrdering').html("<a href=\"javascript:saveChannelOrdering();\">Save Ordering</a>");
	        }
		
	});*/		
	
		     			     
	
});

function saveOrdering() {	
	$.post("processOrderingChange.php",
			$("#videoTabTable").tableDnDSerialize(),
			function(data){
				reloadPage();
				$('#saveOrdering').html("ORDERING SAVED");
				$('#saveOrdering').fadeOut(4500);});
}	

function saveChannelOrdering() {	
	$.post("processChannelOrderingChange.php",
			$("#channelTable").tableDnDSerialize(),
			function(data){
				alert(data);
				reloadPage();
				$('#saveChannelOrdering').html("ORDERING SAVED");
				$('#saveChannelOrdering').fadeOut(4500);});
}		

function checkPublish($elem) {
	var imgSrc = $elem.src;
	if (imgSrc.indexOf("unchecked") == -1) {
		$elem.src = "images/unchecked.png";
	} else {
		$elem.src = "images/checked.png";
	}
}

function reloadPage()  {
	location.reload(true);
}