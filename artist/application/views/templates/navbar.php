<img class="header-box" src="<?php echo base_url("images/logo.png");?>">
<div class="nav-box">
   <div class="menu" id="home"><span class="menu-hover"></span><a href="<?php echo site_url('home'); ?>" class="<?php if($page == 'home'):echo 'menu-bold';else:echo 'menu-span';endif;?>">Tomi</a></div>
   <div class="menu" id="art"><span class="menu-hover"></span><a href="<?php echo site_url('art'); ?>" class="<?php if($page == 'art'):echo 'menu-bold';else:echo 'menu-span';endif;?>">Art</a></div>
   <div class="menu" id="photos"><span class="menu-hover"></span><a href="<?php echo site_url('photos'); ?>" class="<?php if($page == 'photos'):echo 'menu-bold';else:echo 'menu-span';endif;?>">Photos</a></div>
   <div class="menu" id="resume"><span class="menu-hover"></span><a href="<?php echo site_url('resume'); ?>" class="<?php if($page == 'resume'):echo 'menu-bold';else:echo 'menu-span';endif;?>">Resume</a></div>
   <div class="menu" id="link"><span class="menu-hover"></span><a href="<?php echo site_url('link'); ?>" class="<?php if($page == 'link'):echo 'menu-bold';else:echo 'menu-span';endif;?>">Links</a></div>
</div>