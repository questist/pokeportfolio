
   <div class="content-box rounded-corners">
      <div class="gallery-box gallery-box-hover centered">
   <div class="gallery-sidebar" style="margin-top: 11px">
      <img src="<?php echo base_url("images/2dartsidebar.png"); ?>" />
   </div>
   <?php for($i = 0;$i < sizeof($thumbs2d); $i++) {
      if(($i % 4) == 0) { ?> 
         <ul class="gallery-row">
      <?php } ?>
      <li><a href="<?php echo $thumbs2d[$i]['orig_src']; ?>" title="<?php echo $thumbs2d[$i]['title']; ?>">
      <img class="gallery-thumb"  src="<?php echo $thumbs2d[$i]['thumb_src'];?>"></a>
      </li>
      <?php if($i % 4 == 3) { ?> 
         </ul>
      <?php } ?>
   <?php } ?>
</div>
<div class="gallery-box gallery-box-hover centered">
   <div class="gallery-sidebar" style="margin-top: 11px">
      <img src="<?php echo base_url("images/3dartsidebar.png"); ?>" />
   </div>
   <?php for($i = 0; $i < sizeof($thumbs3d); $i++) {
      if(($i % 4) == 0) { ?> 
         <ul class="gallery-row">
      <?php } ?>
      <li><a href="<?php echo $thumbs3d[$i]['orig_src']; ?>" title="<?php echo $thumbs3d[$i]['title']; ?>">
      <img class="gallery-thumb"  src="<?php echo $thumbs3d[$i]['thumb_src'];?>"></a>
      </li>
      <?php if($i % 4 == 3) { ?> 
         </ul>
      <?php } ?>
   <?php } ?>
</div>

<div class="gallery-box gallery-box-hover centered">
   <div class="gallery-sidebar" style="margin-top: 11px">
      <img src="<?php echo base_url("images/sketchbooksidebar.png"); ?>" />
   </div>
   <?php for($i = 0; $i < sizeof($thumbssb); $i++) {
      if(($i % 4) == 0) { ?> 
         <ul class="gallery-row">
      <?php } ?>
      <li><a href="<?php echo $thumbssb[$i]['orig_src']; ?>" title="<?php echo $thumbssb[$i]['title']; ?>">
      <img class="gallery-thumb"  src="<?php echo $thumbssb[$i]['thumb_src'];?>"></a>
      </li>
      <?php if($i % 4 == 3) { ?> 
         </ul>
      <?php } ?>
   <?php } ?>
</div>

<div class="hidden" id="noteHeight"><?php $numRows = ceil(sizeof($thumbs2d)/4) + ceil(sizeof($thumbs3d)/4) + ceil(sizeof($thumbssb)/4); echo ($numRows * 130) + ($numRows* 2 * 15) + 100 . "px";?></div>
   
   </div>