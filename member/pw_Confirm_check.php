<?php
// include "../lib/dbconn.php";
// 	if($_POST['email'] != NULL){
// 	$email_check = mq("select * from member where email='{$_POST['email']}';");
// 	$email_check = $email_check->fetch_array();
//
// 	if($email_check >= 1){
// 		echo "존재하는 이메일입니다.";
// 	} else {
// 		$okay = preg_match('/^[0-9a-zA-Z]([\-.\w]*[0-9a-zA-Z\-_+])*@([0-9a-zA-Z][\-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/', $_POST['email']);
// 		if ($okay) {
// 		    echo "사용가능한 이메일입니다.";
// 		} else {
// 		    echo "올바른 형식의 이메일이 아닙니다.";
// 		}
// 	}
// }

//error_repoting(0);

$pw=$_POST['pw'];
$pw1=$_POST['passwordconfirm'];

if($pw1==$pw)
{
	echo "비밀번호 일치";
}
else {
	echo "비밀번호 불일치 다시 입력!";
}
?>
