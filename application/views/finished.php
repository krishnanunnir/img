<html>
<head>
</head>
<body>
<?php
foreach($records as $r){
 echo "<br>".$r->user;
 echo "<br><img src=".$r->url.">";
}
?>
</body>
</html>