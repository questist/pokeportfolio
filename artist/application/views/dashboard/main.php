<div class="container">
<ul id="sortable-art">
<?php for($i = 0; $i < sizeof($thumbs2d); $i++) {?>
<li id="<?php echo "art_".$i;?>"><img class="gallery-thumb"  src="<?php echo $thumbs2d[$i]['thumb_src'];?>">
      </li>
<?php } ?>
</ul>
</div>
<div class="container">
<ul id="sortable-3d">
<?php for($i = 0; $i < sizeof($thumbs3d); $i++) {?>
<li id="<?php echo "art3d_".$i;?>"><img class="gallery-thumb"  src="<?php echo $thumbs3d[$i]['thumb_src'];?>">
      </li>
<?php } ?>
</ul>
</div>
 <script>
$(function() {
$( "#sortable-art" ).sortable();
$( "#sortable-art" ).disableSelection();

$( "#sortable-art" ).sortable({
	stop: function( event, ui ) {
		var ids = $( "#sortable-art" ).sortable( "toArray" );
		alert(ids);
		}
	});
});

</script>
</body>
</html>