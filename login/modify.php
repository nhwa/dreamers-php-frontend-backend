<?php
session_start();
?>
<meta charset="utf-8">
<?php
error_reporting(0);
//$id=$_SESSION['userid']; //세션에 남아있는 아이디
$pw=$_POST['pw']; //비번
$hash=password_hash($pw,PASSWORD_DEFAULT);
$nick=$_POST['nick']; //닉네임
$name=$_POST['name']; //이름
$birth=$_POST['birth']; //생년월일
$sex=$_POST['sex']; //성별
$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']; //휴대폰번호 따로 받은 것들 연결
$email=$_POST['email']; //이메일
$address=$_POST['postnum']." ".$_POST['address1']." ".$_POST['address2'];
//$registday=date("Y-m-d(H:i)");  //현재시간(년-월-일-시-분) 저장 p.316 참조
//$ip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장

//echo $_SESSION['userid'];
//echo("<script>
//        window.alert("{$_SESSION['userid']}");
//    </script>
//");

include "../lib/joindbconn.php"; //dbconn.php 파일 불러오기
error_reporting(0);

// $sql="select * from member where id='{$_SESSION['userid']}';";
// $result=mq($sql);
// $row=mysql_fetch_array($result);


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
    $sql="update member set pw='{$hash}', nick='{$nick}', name='{$name}', birth='{$birth}',sex='{$sex}', phone='{$phone}', email='{$email}', address='{$address}' where id='{$_SESSION['userid']}'";
    mq($sql); //sql에 저장된 명령 실행

//mysql_close();

echo("<script>
        window.alert('회원 정보가 수정되었습니다 :▷');
        location.href='../lib/newindex.php';
    </script>
");
?>
