 $(function() {
	 var urlPath;
		//parse url path
		urlPath = document.location.href;
		var arrUrlSplit = urlPath.split("/");
		
		while(arrUrlSplit[arrUrlSplit.length-1] != "dashboard")
		{
			urlPath = arrUrlSplit.pop();
		}
		urlPath = arrUrlSplit.join("/");
		
// there's the gallery and the trash
var $gallery = $( "#gallery" ),
$trash = $( "#trash" );
var IDs = new Array();

//let the gallery be sortable as well
$gallery.sortable({
	placeholder: "ui-state-highlight ui-state-highlight-added",
	forcePlaceholderSize: true,
	start: function( event, ui ) {
		//every time a sort is restarted initialize ID array
		IDs = $gallery.sortable( "toArray" );
	},
	update: function( event, ui ) {	
		 AjaxSortImage(ui.item);
		 
	}

});

IDs = $gallery.sortable("toArray");
$gallery.disableSelection();
// let the gallery items be draggable
//$( "li", $gallery ).draggable({
//cancel: "a.ui-icon", // clicking an icon won't initiate dragging
//revert: "invalid", // when not dropped, the item will revert back to its initial position
//containment: "document",
//helper: "clone",
//cursor: "move"
//});
// let the trash be droppable, accepting the gallery items
$trash.droppable({
accept: "#gallery > li",
activeClass: "ui-state-highlight",
drop: function( event, ui ) {
deleteImage( ui.draggable );
}
});
// let the gallery be droppable as well, accepting items from the trash
//$gallery.droppable({
//accept: "#trash li",
//activeClass: "custom-state-active",
//drop: function( event, ui ) {
//recycleImage( ui.draggable );
//}
//});
// image deletion function
var recycle_icon = "<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>";
function deleteImage( $item ) {
AjaxMoveToTrash($item);
$item.fadeOut(function() {
var $list = $( "ul", $trash ).length ?
$( "ul", $trash ) :
$( "<ul class='gallery ui-helper-reset'/>" ).appendTo( $trash );
$item.find( "a.ui-icon-trash" ).remove();
$item.append( recycle_icon ).appendTo( $list ).fadeIn(function() {
//$item
//.animate({ width: "48px" })
//.find( "img" )
//.animate({ height: "36px" });
});
});
}
// image recycle function
var trash_icon = "<a href='link/to/trash/script/when/we/have/js/off' title='Delete this image' class='ui-icon ui-icon-trash'>Delete image</a>";
function recycleImage( $item ) {
if(!AjaxRecycleImage($item))
{
	return;
}
$item.fadeOut(function() {
$item
.find( "a.ui-icon-refresh" )
.remove()
.end()
.css( "width", "96px")
.append( trash_icon )
.find( "img" )
.css( "height", "72px" )
.end()
.appendTo( $gallery )
.fadeIn();
});

}
// image preview function, demonstrating the ui.dialog used as a modal window
function viewLargerImage( $link ) {
var src = $link.attr( "href" ),
title = $link.siblings( "img" ).attr( "alt" ),
$modal = $( "img[src$='" + src + "']" );
if ( $modal.length ) {
$modal.dialog( "open" );
} else {
var img = $( "<img alt='" + title + "' style='display: none; padding: 8px;' />" )
.attr( "src", src ).appendTo( "body" );
setTimeout(function() {
var width = img.attr("width") + 20;
img.dialog({
title: title,
width: width,
modal: true
});
}, 1 );
}
}
//ajax move item to trash bin
function AjaxMoveToTrash($item) {
	var movedID = $item.attr("id");
	 var tempIDs = $gallery.sortable( "toArray" );
	 var iTempID = 0;
	 var iID = -1;
	 var itemSQLID = -1;
	 var arrSplit;
	 //initialize SQL ID and page for passing
	 arrSplit = movedID.split("_");
	 itemSQLID = arrSplit[arrSplit.length-1];
	 
	 //loop through for new sortable positioning
	 for(i = 0; i < tempIDs.length; i++)
	 {
		 if(tempIDs[i] == movedID)
			 { iTempID = i;}
	 }
	 
	//alert("iID:" + iID + " iTempID:" + iTempID + " itemSQLID:" + itemSQLID);
	// alert(urlPath);
	$.ajax({
		type: 'POST',
		url: urlPath + '/submit',
		dataType: 'json',
		data: {
			sort: "trash",
			page: arrSplit[0],
			itemID: itemSQLID,
			floor: iTempID,
			count: IDs.length
		},
		success: function(data){
			if(data.success === false) {
				//alert("Error" + data.msg);
			}
			else {
				//alert("success" + data.msg);
			}
		},
		error: function(XMLHttpRequest,textStatus,errorThrown){
			alert("Error: Ajax trash item");
		}
	});
	
}
//ajax recycle image back to sortable
function AjaxRecycleImage($item){
	var trashedID = $item.attr("id");
	var arrSplit = trashedID.split("_");
	IDs = $gallery.sortable("toArray");
	if(arrSplit[0] == "photo" && IDs.length >= 24)
	{
		return false;
	}
	else if(arrSplit[0] != "photo" && IDs.length >= 8)
	{
		return false;
	}
	//alert("1: " + arrSplit[arrSplit.length-1] + " 2:" + arrSplit[0]);
	$.ajax({
		type: 'POST',
		url: urlPath + '/submit',
		dataType: 'json',
		data: {
			page: arrSplit[0],
			sort: "recycle",
			itemID: arrSplit[arrSplit.length-1],
			count: IDs.length
		},
		success: function(data){
			if(data.success === false) {
				//alert("Error" + data.msg);
			}
			else {
				//alert("success" + data.msg);
			}
		},
		error: function(XMLHttpRequest,textStatus,errorThrown){
			alert("error");
		}
	});
	return true;
}
//ajax sort image
function AjaxSortImage($item) {
	 var movedID = $item.attr("id");
	 var tempIDs = $gallery.sortable( "toArray" );
	 var iTempID;
	 var iID;
	 var itemSQLID = -1;
	 var arrSplit;
	 var bSort;
	 //initialize SQL ID and page for passing
	 arrSplit = movedID.split("_");
	 itemSQLID = arrSplit[arrSplit.length-1];
	 
	 //loop through for new sortable positioning
	 for(i = 0; i < tempIDs.length; i++)
	 {
		 if(tempIDs[i] == movedID)
			 { iTempID = i;}
		 else if(IDs[i] == movedID)
		 { iID = i;}
	 }
	 
	 //IDs = tempIDs;
	 //if the moved item was sorted down in the list
	 
	 bSort = iTempID < iID ? "down" : "up";
	 
	 //alert("iID:" + iID + " iTempID:" + iTempID + " itemSQLID:" + itemSQLID + " bsort:" + bSort + " page:" + arrSplit[0]);
	 
	 $.ajax({
		type: 'POST',
		url: urlPath + '/submit',
		dataType: 'json',
		data: {
			page: arrSplit[0],
			sort: bSort,
			itemID: itemSQLID,
			ceiling: (bSort == "down") ? iID : iTempID,
		 	floor: (bSort == "up") ? iID : iTempID
		},
		success: function(data){
			if(data.success === false) {
				//console.log("Error" + data.msg);
			}
			else {
				//console.log("success" + data.msg);
			}
		},
		error: function(XMLHttpRequest,textStatus,errorThrown){
			alert("error");
		}
	});

}

$("#upload").click(function() {
	
	
});


// resolve the icons behavior with event delegation
$( "ul.gallery > li" ).click(function( event ) {
var $item = $( this ),
$target = $( event.target );
if ( $target.is( "a.ui-icon-trash" ) ) {
deleteImage( $item );
} else if ( $target.is( "a.ui-icon-zoomin" ) ) {
viewLargerImage( $target );
} else if ( $target.is( "a.ui-icon-refresh" ) ) {
recycleImage( $item );
}
return false;
});
});