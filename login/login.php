<?php
    session_start();
    error_reporting(0);
?>
<meta charset="utf-8">
<?php
include "../lib/dbconn.php";

//이전화면에서 **이 입력되지 않았으면 "**를 입력하세요" 메시지 출력
//if(!$userid)
//{
//    echo("
//        <script>
//            window.alert('아이디를 입력하세요.')
//            history.go(-1)
//        </script>
//    ");
//}
//
//if(!$pw)
//{
//    echo ("
//    <script>
//        window.alert('비밀번호를 입력하세요.')
//        history.go(-1)
//    </script>
//    ");
//}

$id=$_POST['userid']; //아이디
$pw=$_POST['pw'];
// $password=$pw;
// // $hash=password_hash($pw, PASSWORD_DEFAULT);
// echo("<script>window.alert($password) </script>");

$sql="select * from member where id='$id';";
$result=mysql_query($sql,$connect);
$num_match=mysql_num_rows($result);
// $sql=$sql->fetch_array();

// echo ("
//     <script>
//         window.alert('$num_match');
//     </script>
// ");

// echo $num_match;
if(!$num_match)
{
    echo ("
        <script>
            window.alert('등록되지않은 아이디입니다.');
            location.href='./login_form.php';
        </script>
    ");
}
else
{
    $row=mysql_fetch_array($result);
    $hash=$row['pw'];

    if (password_verify($pw,$hash))
    { // 비밀번호가 일치하는지 비교합니다.
      $userid=$row[id];
      $username=$row[name];
      $usernick=$row[nick];
      $useremail=$row[email];

      $_SESSION['userid']=$userid;
      $_SESSION['username']=$username;
      $_SESSION['usernick']=$usernick;
      $_SESSION['useremail']=$useremail;

      // if($_SESSION['userid']=="Dreamer")
      // {
      //   $_SESSION['userid']="ADMIN";
      // }

      // echo $_SESSION['userid'];
      // echo $_SESSION['username'];
      // echo $_SESSION['usernick'];
      echo ("
          <script>
            window.alert('Welcome to Dreamus :D');
              location.href='../lib/newindex.php';
          </script>
      ");
      exit;

    }
    else
    {
        echo ("
            <script>
                window.alert('비밀번호가 일치하지않습니다.');
             location.href='./login_form.php';
            </script>
        ");
    }
}

?>
