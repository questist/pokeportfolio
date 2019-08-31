<div class="menu-header"><ul class="dashboard-menu">
<li><a href="<?php echo site_url("dashboard/art"); ?>">Edit Art</a></li>
<li><a href="<?php echo site_url("dashboard/art3d"); ?>">Edit Art 3d</a></li>
<li><a href="<?php echo site_url("dashboard/artsb"); ?>">Edit Art Sketchbook</a></li>
<li><a href="<?php echo site_url("dashboard/photos"); ?>">Edit Photos</a></li>
<li><a href="<?php echo site_url("dashboard/featured"); ?>">Edit Featured</a></li>
<li><span class="logout-box"><a href="<?php echo site_url("dashboard/do_upload/" . $section);?>" id="upload">UPLOAD NEW IMAGE</a></span></li>
<li><span class="logout-box"><a href="<?php echo site_url("dashboard/emptyTrash/" . $section);?>" onclick="return confirm('Are You Sure You want to delete all images')" id="emptytrash">EMPTY THE TRASH</a></span></li>
<li><span class="logout-box"><a href="<?php echo site_url("admin_login/logout");?>">logout</a></span></li>
</ul>
</div>