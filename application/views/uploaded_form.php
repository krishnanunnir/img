<html>
<head>
<title>Upload Form</title>
  <script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.min.js"></script>
  <script src="<?php echo base_url(); ?>js/jquery.Jcrop.min.js"></script>
  <link rel="stylesheet" href="<?php echo base_url(); ?>css/jquery.Jcrop.css" type="text/css" />
  <style>
  #photo1{
        width: 100%;
    height: 100%;
    object-fit: cover;
    overflow: hidden;
    left:300px;
}

  }
  </style>
<script type="text/javascript">

jQuery(function($){

  $('#photo').Jcrop({
    onChange:   showCoords,
    onSelect:   showCoords
  });

});

// Simple event handler, called from onChange and onSelect
// event handlers to show an alert, as per the Jcrop 
// invocation above

function showCoords(c)
{
  //$('#cords').html('<p>x='+ c.x +' y='+ c.y +' x2='+ c.x2 +' y2='+ c.y2+'</p>'+'<p>w='+c.w +' h='+ c.h+'</p>');
  $("#xc").val(c.x);
  $("#yc").val(c.y);
  $("#h").val(c.h);
  $("#w").val(c.w);

};

</script>
  </head>
<body>
  <h3>Your file was successfully uploaded!</h3>
  <ul>
    <?php foreach ($upload_data as $item => $value):?>
      <li><?php echo $item;?>: <?php echo $value;?></li>
    <?php endforeach; ?>
  </ul>
  <img src="<?php echo base_url().$namef;?>" id="photo"><br>
  <div id="cords">
    <form method="post" action="hope">
      X:<input type="number" id="xc" name="xc">
      Y:<input type="number" id="yc" name="yc">
      W:<input type="number" id="h" name="h">
      H:<input type="number" id="w" name="w">
      <input type="submit" value="Crop">
    </form>
  </div>
  <a href="<?php echo base_url().$namef?>" download="<?php echo $namef;?>">Download</a><?php echo "(file size reduced by ".((floor($im_size*100))/100)."%)"?>
  <p><?php echo anchor('images/index', 'Upload Another File!'); ?></p>
  <p><?php echo anchor('images/show', 'See all uploaded images'); ?></p>
</body>
</html>
