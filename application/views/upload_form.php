<html>
<head>
</head>
<body>

  <?php echo form_open_multipart('images/do_upload');?>
    <input type="file" name="userfile"  />
    <input type="number" name="cropval">
    <input type="submit" value="Upload">
  </form>
<p><?php echo anchor('images/show', 'See all uploaded images'); ?></p>
</body>
</html>
