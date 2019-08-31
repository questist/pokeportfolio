
<div class="content-box rounded-corners">
<div class="gallery-box centered">
   <?php for($i = 0;$i < sizeof($thumbsphotos); $i++) {
      if(($i % 4) == 0) { ?> 
         <ul class="gallery-row">
      <?php } ?>
      <li><a href="<?php echo $thumbsphotos[$i]['orig_src']; ?>" title="<?php echo $thumbsphotos[$i]['title']; ?>">
      <img class="gallery-thumb"  src="<?php echo $thumbsphotos[$i]['thumb_src'];?>"></a>
      </li>
      <?php if($i % 4 == 3) { ?> 
         </ul>
      <?php } ?>
   <?php } ?>
</div>
</div>
<div class="hidden" id="noteHeight"><?php $numRows = ceil(sizeof($thumbsphotos)/4); echo ($numRows * 130) + ($numRows* 2 * 15) + 100 . "px";?></div>
