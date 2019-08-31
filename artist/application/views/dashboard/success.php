<html>
<head>
<title>Upload Form</title>
</head>
<body>

<h3>Your file was successfully uploaded!</h3>

<ul>

<?php
   foreach ($ulimgs as $value):?>
<li><?php echo "file: " . $value['string_field'];?>: <?php echo "thumb: " . $value['string_field_two'];?></li>
<?php endforeach; ?>
</ul>

<p><?php echo anchor('dashboard/do_upload/' . $section, 'Upload Another File!'); ?></p>
<p><?php echo anchor('dashboard/do_upload/' . $section . "/return",'Back to The Dashoard')?>

</body>
</html>
