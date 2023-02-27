<?php
// include "../lib/dbconn.php";

$pw=$_POST['pw'];
// $pw_check = $_POST['passwordconfirm'];

if(preg_match('/^[0-9a-zA-Z]([\-.\w]*[0-9a-zA-z\-_+]){4,16}$/', $pw))
// if(preg_match('/[0-9]/',$pw) && preg_match('/[a-zA-Z]/',$pw) && preg_match('/[^0-9a-zA-Z]/',$pw)&&(strlen($pw)>=4))
{
 echo "유효한 비밀번호입니다.";
}
else{
echo "5~16자 이상의 영문, 숫자 조합";
}

// 	if($pw_check != NULL){
// 	// $pw_check = mq("select * from member where email='{$_POST['email']}';");
// 	// $email_check = $email_check->fetch_array();
//
//
//
// 	if($pw_check == $pw){
// 		echo "비밀번호가 일치합니다.";
// 	} else {
// 		$okay = preg_match('/^[0-9a-zA-Z]([\-.\w]*[0-9a-zA-Z\-_+])*@([0-9a-zA-Z][\-\w]*[0-9a-zA-Z]\.)+[a-zA-Z]{2,9}$/', $_POST['email']);
// 		if ($okay) {
// 		    echo "사용가능한 이메일입니다.";
// 		} else {
// 		    echo "올바른 형식의 이메일이 아닙니다.";
// 		}
// 	}
// }
?>
