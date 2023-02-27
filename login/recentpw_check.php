<?php
include "../lib/dbconn.php";
  $id = $_POST['userid'];
  $pw = $_POST['pw'];

	$sql="select * from member where id='$id';";
  $result=mysql_query($sql,$connect);
  $row=mysql_fetch_array($result);
  $hash=$row['pw'];
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
	if(password_verify($pw,$hash)){
    echo("<script>
            location.href='./member_form_modify.php';
        </script>");

	}
  else {
    echo ("<script>
    window.alert('기존 비밀번호와 일치하지 않습니다 :◁')
    location.href='./recentpw_check_form.php';</script>");
	}

?>
