<?php
include "../db.php";
	if($_POST['userpw'] != NULL){
	$pw_check = mq("select * from member where pw='{$_POST['userpw']}'");
	
	$pw_check = $pw_check->fetch_array();

	if($pw_check >= 1){
		echo "존재하는 아이디입니다.";
	} else {
		echo "콜";
	}
} ?>
