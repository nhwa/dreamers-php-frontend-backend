
<meta charset="utf-8">
<meta http-equiv="content-type" content="text/html" charset="utf-8"/>
<style>
body { display:none;}
</style>
          <!-- <link rel="icon" href="favicon_img/favicon.ico" type="image/ico"> -->
<body>
</body>
<?php
error_reporting(0);
include "../lib/dbconn.php";

$id=$_POST['userid'];//아이디
$name=$_POST['name']; //이름
$phone=$_POST['phone1']."-".$_POST['phone2']."-".$_POST['phone3']; //휴대폰번호 따로 받은 것들 연결
//
// echo("<script>window.alert('$id') </script>");
// echo("<script>window.alert('$name') </script>");
// echo("<script>window.alert('$phone') </script>");

$sql="select * from member where id='$id';";
$result=mysql_query($sql,$connect);
$row=mysql_fetch_array($result);

//
// echo("<script>window.alert('$row[id]') </script>");
// echo("<script>window.alert('$row[name]') </script>");
// echo("<script>window.alert('$row[phone]') </script>");

if($row['id']==$id)
{
  if($row['name']==$name)
  {
    if($row['phone']==$phone)
    {
      function genRandom($length = 5) {
          $char = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
          $char .= 'abcdefghijklmnopqrstuvwxyz';
          $char .= '0123456789';
          $result = '';
          for($i = 0; $i <= $length; $i++) {
              $result .= $char[mt_rand(0, strlen($char))];
          }
          return($result);
      }

      $pw=genRandom();

      $hash=password_hash($pw,PASSWORD_DEFAULT);
      $sql="update member set pw='{$hash}' where id='$id';";
      mysql_query($sql,$connect);

      include '../mail/sendmail.php';
      // /* + host : smtp 호스트 주소
      // + smtp_id : smtp 계정 아이디
      // + smtp_pw : smtp 계정 비번
      // + debug : 디버그표시기능 [1 : 활성 0 : 비활성]
      // + charset : 문자 인코딩 + ctype : 메일 컨텐츠의 타입 */
      //
      //  $config=array(
      //   'host'=>'ssl://smtp.naver.com',
      //   'smtp_id'=>'dreamandus@naver.com',
      //   'smtp_pw'=>'#dreamers1205#',
      //   'debug'=>1,
      //   'charset'=>'utf-8',
      //   'ctype'=>'text/plain'
      //   );
        $sendmail = new Sendmail();
      //
        /* + $to : 받는사람 메일주소 ( ex. $to="hong <hgd@example.com>" 으로도 가능)
        + $from : 보내는사람 이름
        + $subject : 메일 제목
        + $body : 메일 내용
        + $cc_mail : Cc 메일 있을경우 (옵션값으로 생략가능)
        + $bcc_mail : Bcc 메일이 있을경우 (옵션값으로 생략가능) */

        $to=$row['email'];
        $from="Dreamers";
        $subject = "[Dreamus]{$row[id]}님의 임시비밀번호가 발급되었습니다.";
        $body="{$row[id]}님의 비밀번호는 {$pw} 입니다.";

        //이메일
        $email=explode("@",$to); //메일주소를 @로 나눈다
        $email_front=$email[0]; //메일주소의 앞(메일 아이디)
        $email_back=$email[1]; //메일주소 뒤
        // $email_front_num=strlen($email_front2);
        $email_front1=substr($email_front,0,3); //메일 아이디의 앞 세글자(노출할 부분)
        $email_front2=substr($email_front,3); //메일 아이디의 앞 세글자이후 부분(*로 대체할 부분)
        $email_front2_num=strlen($email_front2); //메일 아이디의 앞 세글자 제외한 아이디의 갯수
        $munza="";
        for($i=0; $i<$email_front2_num; $i++)
        {
          $munza.="*";
        }
        $email_front2=str_replace($email_front2,$munza,$email_front2);
        // $cc_mail="cc@example.com";
        // $bcc_mail="bcc@example.com";
        //이메일끝//

        /* 메일 보내기 */
        $sendmail->send_mail($to, $from, $subject, $body);

        echo ("
            <script>
            window.alert('{$email_front1}{$email_front2}@{$email_back}(으)로 임시비밀번호를 보냈습니다 :D');
            location.href='./login_form.php';
            </script>

        ");
        exit;


    }
    else
    {
      echo ("
          <script>
              window.alert('회원정보가 일치하지 않습니다.');
              location.href='./findpass_form.php';
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
            location.href='./findpass_form.php';
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
              location.href='./findpass_form.php';
          </script>
      ");
      exit;
}
?>
