<!DOCTYPE html>
<html>
<head>
<title><?php echo $title?></title>
<meta charset="utf-8"/>
<meta content="text/html;charset=utf-8" http-equiv="Content-Type">
<!-- Style sheets -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('CSS/blueberry.css'); ?>" />
<link rel="stylesheet" type="text/css" href="<?php echo base_url('CSS/main_stylesheet.css'); ?>" />
<script src="<?php echo base_url("js/jquery__p.js"); ?>"></script>
<script src="<?php echo base_url("js/jquery.blueberry.js"); ?>"></script>
<script type="text/javascript">
$(document).ready(function(){
		  var ref = document.referrer;
		  var loaded = 0;
		  var check = ref.search("<?php echo base_url(); ?>");
		  //var loc = window.location.href;
		  //var loccheck = loc.search("<?php echo base_url(); ?>");
		  
		  if(check == -1 )
		  {
		     loaded = 1;
		  }
		
		$(".menu").mouseover(function(){
			if(loaded == 1) {
			   $(this).find("span.menu-hover").stop().fadeTo(800,.9,function(){});
			}
			else if(loaded == 0)  {
				//$(this).find("span.menu-hover").css("opacity",.9);
				loaded = 1;
			}
		}).mouseout(function(){
			$(this).find("span.menu-hover").stop().fadeTo(400,0,function(){});
		});
		
		if($("hidden").html() != '') {
			$("div.content-box").css('height', $("#noteHeight").html());
		}

		$(".menu").click(function(){
			window.location = $(this).find("a").attr("href");
		});
		<?php if($page == "resume") { ?>
		$("div.content-box").css('height', '1160px');
		<?php } ?>
		<?php if($page == "home") { ?>

		    	$(".thumb-link").click(function(){
		    		var href = $(this).attr("href");
		    		$(".featured-item").fadeOut("fast", function() {
		    			$(this).attr("src",href).fadeIn('slow', function(){});
		    		});
		    		
		    		return false;
		    	});
		<?php }?>
});
<?php if($page == "home") { ?>
$(window).load(function() {
	   $('.blueberry').blueberry( {pager: false});
});
<?php } ?>
</script>

<?php if($page == "art" || $page == "photos") { ?>
<script src="<?php echo base_url("js/jquery.lightbox-0.5.js"); ?>"></script>
<script src="<?php echo base_url("js/jquery.lightbox-0.5-admin.js"); ?>"></script>
<link rel="stylesheet" type="text/css" href="<?php echo base_url('CSS/jquery.lightbox-0.5.css'); ?>" media="screen" />

	<script type="text/javascript">
    $(function() {
        $(".gallery-row a").lightBox();
    });
    </script>
<?php } ?>

</head>
<body id="viewport">
