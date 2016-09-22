<html>
<head>
<title>Upload Form</title>
<?php $base=base_url()?>
  <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>css/imgareaselect-default.css" />
  <script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.min.js"></script>
  <script type="text/javascript" src="<?php echo base_url(); ?>scripts/jquery.imgareaselect.pack.js"></script>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script>
$(document).ready(function () {
    $('<div><img src="ferret.jpg" style="position: relative;" /><div>')
        .css({
            float: 'left',
            position: 'relative',
            overflow: 'hidden',
            width: '100px',
            height: '100px'
        })
        .insertAfter($('#ferret'));

    $('#ferret').imgAreaSelect({ aspectRatio: '1:1', onSelectChange: preview });
});
</script>
</head>
<body>
  <h3>Your file was successfully uploaded!</h3>
  <ul>
    <?php foreach ($upload_data as $item => $value):?>
      <li><?php echo $item;?>: <?php echo $value;?></li>
    <?php endforeach; ?>
  </ul>
  <img src="<?php echo base_url().$namef;?>"><br>
  <a href="<?php echo base_url().$namef?>" download="<?php echo $namef;?>" id="photo">Download</a><?php echo "(file size reduced by ".((floor($im_size*100))/100)."%)"?>
  <p><?php echo anchor('images/index', 'Upload Another File!'); ?></p>
  <p><?php echo anchor('images/show', 'See all uploaded images'); ?></p>
</body>
</html>
