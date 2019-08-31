<div class="ui-widget ui-helper-clearfix">
<div class="container">
<ul id="gallery" class="gallery ui-helper-reset ui-helper-clearfix">
<?php for($i = 0; $i < sizeof($thumbs2d); $i++) {?>
<li id="<?php echo "art_".$i."_".$thumbs2d[$i]['id'];?>" class="ui-widget-content ui-corner-tr">
<img src="<?php echo $thumbs2d[$i]['thumb_src'];?>" alt="<?php echo $thumbs2d[$i]['title']; ?>" width="96" height="72" />
<a href="<?php echo $thumbs2d[$i]['orig_src']; ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
<a href="link/to/trash/script/when/we/have/js/off" title="Delete this image" class="ui-icon ui-icon-trash">Delete image</a>
</li>
<?php } ?>
</ul>
</div>
</div>
<p>Keep in mind thumbnails are 100px by 100px. The large images should be no larger than standard screen resolution</p>
<?php //ui-state-default on div was causing background-image to not display?>
<div id="trash" class="ui-widget-content dashboard-ui-state-default">
<h4 class="ui-widget-header"><span class="ui-icon ui-icon-trash">Trash</span> Trash</h4>
<?php if(sizeof($trash) != 0) { ?>
   <ul class='gallery ui-helper-reset'/>
<?php } ?>
<?php for($i = 0; $i < sizeof($trash); $i++) {?>
<li id="<?php echo "art_".$i."_".$trash[$i]['id'];?>" class="ui-widget-content ui-corner-tr">
<img src="<?php echo $trash[$i]['thumb_src'];?>" alt="<?php echo $trash[$i]['title']; ?>" width="96" height="72" />
<a href="<?php echo $trash[$i]['orig_src']; ?>" title="View larger image" class="ui-icon ui-icon-zoomin">View larger</a>
<a href='link/to/recycle/script/when/we/have/js/off' title='Recycle this image' class='ui-icon ui-icon-refresh'>Recycle image</a>
</li>
<?php } ?>
<?php if(sizeof($trash) != 0) { ?>
   </ul>
<?php } 
?>
</div>
</div>
</body>
</html>