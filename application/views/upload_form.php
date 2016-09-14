<html>
<head>
</head>
<body>

  <?php echo form_open_multipart('images/do_upload');?>
    <input type="file" name="userfile"  />
    <input type="submit" value="Upload">
  </form>
  <?php echo "Hello User#".$userno;?>
</body>
</html>
