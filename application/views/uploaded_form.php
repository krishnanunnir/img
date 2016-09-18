<html>
<head>
<title>Upload Form</title>
</head>
<body>
  <h3>Your file was successfully uploaded!</h3>
  <ul>
    <?php foreach ($upload_data as $item => $value):?>
      <li><?php echo $item;?>: <?php echo $value;?></li>
    <?php endforeach; ?>
  </ul>
  <img src="<?php echo base_url().$namef;?>"><br>
  <a href="<?php echo base_url().$namef?>" download="<?php echo $namef;?>">Download</a><?php echo "(file size reduced by ".((floor($im_size*100))/100)."%)"?>
  <p><?php echo anchor('images/index', 'Upload Another File!'); ?></p>
  <p><?php echo anchor('images/show', 'See all uploaded images'); ?></p>
</body>
</html>
