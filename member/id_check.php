<?php
include "../lib/joindbconn.php";
	if($_POST['userid'] != NULL){
	$id_check = mq("select * from member where id='{$_POST['userid']}';");
	$id_check = $id_check->fetch_array();

// <script>
// 	$.post(
// 		"join.php",
// 		{$dat : $dat },
// 	)
// 		$.post(
// 		"join.php",
// 		{$dat1 : $dat1 },
// 	)
// </script>

	if($id_check >= 1){
echo "존재하는 아이디입니다.";
// 		$res= 'echo "존재하는 아이디입니다.";';
// echo '$res';

	} else {
		echo "사용가능한 아이디입니다.";
		// $res2= 'echo "콜입니다.";';
		// echo '$res2';
	}


} ?>
