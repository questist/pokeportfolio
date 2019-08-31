<html>
<head>
<title>Upload Form</title>
</head>
<body>

<?php echo $error;?>

<?php echo form_open_multipart('dashboard/do_upload/'. $section);?>
<?php 
echo form_label('Upload Large Image here','orig_img');
?>
<input type="file" name="lrgimg" size="20" />
<br>
<?php 
echo form_label('Upload Thumbnail Image here','orig_img');
?>
<input type="file" name="smallimg" size="20" />
<?php 
echo "<br />";
echo form_hidden("section", $section );
echo "<br />";
echo form_label('What is the title of the Image','title_label');
echo form_error('title');
$data = array(
      'name'        => 'title',
      'id'          => 'title',
      'maxlength'   => '100',
      'size'        => '50',
      'style'       => 'width:30em',
);
echo "<br />";
echo form_input($data);
?>
<br /><br />

<input type="submit" value="upload" />

</form>

</body>
</html>