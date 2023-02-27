<?php
session_start();
error_reporting(0);
 ?>

<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
          <link rel="icon" href="favicon_img/favicon.ico" type="image/ico">
<style>
body { display:none;}
</style>
<body>
</body>
<?php
// error_reporting(0);
include "../lib/dbconn.php";
$name=$_POST['name']; //이름
$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']; //휴대폰번호 따로 받은 것들 연결
$email=$_POST['email'];//email
//
// echo("<script>window.alert('$id') </script>");
// echo("<script>window.alert('$name') </script>");
// echo("<script>window.alert('$phone') </script>");

$sql="select * from member where email='$email';";
$result=mysql_query($sql,$connect);
$row=mysql_fetch_array($result);

//
// echo("<script>window.alert('$row[id]') </script>");
// echo("<script>window.alert('$row[name]') </script>");
// echo("<script>window.alert('$row[phone]') </script>");

if($row['name']==$name)
{
  if($row['phone']==$phone)
  {
    if($row['email']==$email)
    {
      $userid=$row[id];

      echo ("<script>
              window.alert('회원님의 아이디는 $userid 입니다 :D');
              location.href='./login_form.php';
          </script>
          ");
    }
    else
    {
      echo ("
          <script>
              window.alert('회원정보가 일치하지 않습니다.');
              location.href='./findid_form.php';
          </script>
      ");
      exit;
    }
  }
  else
  {
    echo ("
        <script>
            window.alert('회원정보가 일치하지 않습니다.');
            location.href='./findid_form.php';
        </script>
    ");
    exit;
  }
}

else
{
      echo ("
          <script>
              window.alert('회원정보가 일치하지 않습니다.');
              location.href='./findid_form.php';
          </script>
      ");
      exit;
}
?>
