<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
<?php
//$phone=$phone1."-".$phone2."-".$phone3; //휴대폰번호 따로 받은것들 연결해서 넣기
//$email=$email1."@".$email2; //이메일주소 따로 받은것들 연결해서 넣기
//$registday=date("Y-m-d (H:i)"); //현재시간(년-월-일-시-분) 저장
//$ip=$REMOTE_ADDR; //방문자의 ip주소 저장

$id=$_POST['userid']; //아이디
$pw=$_POST['pw']; //비번
// $password=$pw;
// include "../login/password.php";

$hash=password_hash($pw,PASSWORD_DEFAULT);
$nick=$_POST['nick']; //닉네임
$name=$_POST['name']; //이름
$birth=$_POST['birth']; //생년월일
$sex=$_POST['sex']; //성별
$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']; //휴대폰번호 따로 받은 것들 연결
$email=$_POST['email']; //이메일
$address=$_POST['postnum']." ".$_POST['address1']." ".$_POST['address2'];
$registday=date("Y-m-d(H:i)");  //현재시간(년-월-일-시-분) 저장 p.316 참조
$ip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장

include "../lib/joindbconn.php"; //joindbconn.php 파일 불러오기
error_reporting(0);

// $sql="select * from member where id='$id';";
// $result=mq($sql);
// $exist_id=mysql_num_rows($result);


//    $sql="insert into member(id, pw, nick, name, birth, sex, phone, email, address, registday, ip) ";
//    $sql.="values('$id', '$pw', '$nick', '$name', '$birth', '$sex', '$phone', '$email', '$address', '$registday', '$ip');";
//    mysql_query($sql, $connect); //sql에 저장된 명령 실행
//
// if($exist_id)
// {
//     echo ("
//     <script>
//         window.alert('같은 아이디가 존재합니다.')
//         history.go(-1)
//     </script>
//     ");
//     exit;
// }
// else
// { //레코드 삽입 명령을 $sql에 입력
    $sql="insert into member(id, pw, nick, name, birth, sex, phone, email, address, registday, ip) ";
    $sql.="values('$id', '$hash', '$nick', '$name', '$birth', '$sex', '$phone', '$email', '$address', '$registday', '$ip')";
    mq($sql); //sql에 저장된 명령 실행
 // }

 $sql=mq("select * from member where id='$id';");
 //
 // if($sql)
 //   echo " 성공";
 // else
 //   echo " 실패";

mysql_close(); //데이터베이스 연결 종료

echo ("
<script>
location.href='../lib/newindex.php';
</script>
");

?>
