<?php
// session_start();

// $db=new mysqli("localhost", "root", "", "dreamus");
//
// function mq($sql){
// global $db;
//
// return $db->query($sql);
// }

$connect=mysql_connect("localhost", "root", "") or die("cannot connect to SQL SERVER");
mysql_select_db("dreamus",$connect);
?>
