<?php

include("../lib/dbconn.php");

$sql="select * from pushpush;";
$result=mysql_query($sql);

$row=mysql_fetch_array($result);

$table=$row[table_name];
$id = $row[id];

echo ("<script> document.write()</script>")

?>
