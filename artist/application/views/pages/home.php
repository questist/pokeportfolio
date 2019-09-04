

<div class="content-box rounded-corners">

<div class="slideshow-box">
<div class="blueberry">
<ul class="slides">
<?php for($i = 0; $i < count($featured); $i++) {?>
<li><img id="feat_img_<?php echo $i; ?>"  src="<?php echo $featured[$i]['orig_src'];?>" /></li>
<?php } ?></ul><ul class="pager">
<?php $i=0;foreach($featured as $k => $thumb_item) {?>
<li><span class="overlay"></span><a id="thumb_link_<?php echo $i++; ?>" href="<?php echo $thumb_item['orig_src'] ?>"><img style="border: 0px" src="<?php echo $thumb_item['thumb_src'];?>" id="thumb-<?php echo $thumb_item['id']; ?>" /></a></li>
<?php } ?>
</ul>
</div>
</div>
<div style="clear:left;padding-top:20px" class="paragraph">
<p style="position: relative;top: 12px;margin-left: auto;margin-right: auto">Here you will find my various creative works including my artwork of different types<br /> photography

and links to colleagues. I hope you have a great stay
and <br />please leave me a message with any inquiries <br />or 

interest in my work.    <br> <a href="mailto:me@artist.com">me@artist.com</a> </p></div>
</div>
