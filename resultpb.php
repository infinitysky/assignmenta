<!DOCTYPE HTML PUBLIC
"-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html401/loose.dtd">
<html>
<head>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
  <title>Result Page</title>
</head>
<body>
<?php
	require_once('db.php');
	if(!mysql_connect(DB_HOST, DB_USER, DB_PW)){
	echo "Can't connect to database";
	}
	else{
	$dbcon = mysql_connect(DB_HOST, DB_USER, DB_PW);
	mysql_select_db('winestore', $dbcon);
	}
	
?>

	
</body>
</html>