<?php
session_start();
error_reporting(0);

include "../lib/joindbconn.php";
	if($_POST['nick'] != NULL){
	$nick_check = mq("select * from member where id='{$_POST['nick']}';");
	$nick_check = $nick_check->fetch_array();

	if($nick_check >= 1){
		echo "존재하는 닉네임입니다.";
	}
	 else {
		echo "사용가능한 닉네임입니다.";
	}
} ?>
