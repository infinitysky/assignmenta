<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta http-equiv="content-type" content="text/html;charset=utf-8" />
<title>Search Page</title>
</head>

<body bgcolor = "white">
<form action = "resultpb.php" method = "GET">


<?php
require_once('db.php');
mysql_connect(DB_HOST, DB_USER, DB_PW);
$dbcon = mysql_connect(DB_HOST, DB_USER, DB_PW);

if(!$dbcon)
{
//echo 'Could not connect to mysql on ' . DB_HOST . "\n";
//exit;
die('Can not accesse '.mysqlerror());
}
echo 'Connected to mysql on ' . DB_HOST . "\n";
mysql_select_db("winestore", $dbcon);


$query = "select region_name from region ";
$result = mysql_query($query, $dbcon);
?>





<br />
<br />
<br />
<span>Please Enter wine name:</span>
<input type = "text" name = "winename" id = "winename" value = "All"/>
<br />
<br />
<br />
<br />
<span>Enter winery name:</span>
<input type = "text" name = "wineryname" id = "wineryname" />
<br />
<br />
<input type = "submit" name = "submit" id = "submit" value = "Search" />

</form>
</body>
</html>