<?php /* 클래스 파일 로드 */
include "Sendmail.php";

/* + host : smtp 호스트 주소
+ smtp_id : smtp 계정 아이디
+ smtp_pw : smtp 계정 비번
+ debug : 디버그표시기능 [1 : 활성 0 : 비활성]
+ charset : 문자 인코딩 + ctype : 메일 컨텐츠의 타입 */

 $config=array(
  'host'=>'ssl://smtp.naver.com',
  'smtp_id'=>'dreamandus@gmail.com',
  'smtp_pw'=>'#dreamers1205#',
  'debug'=>1,
  'charset'=>'utf-8',
  'ctype'=>'text/plain'
  );
  $sendmail = new Sendmail($config);

  /* + $to : 받는사람 메일주소 ( ex. $to="hong <hgd@example.com>" 으로도 가능)
  + $from : 보내는사람 이름
  + $subject : 메일 제목
  + $body : 메일 내용
  + $cc_mail : Cc 메일 있을경우 (옵션값으로 생략가능)
  + $bcc_mail : Bcc 메일이 있을경우 (옵션값으로 생략가능) */

  $to="hgd@example.com";
  $from="Master";
  $subject="메일 제목입니다.";
  $body="메일 내용입니다.";
  $cc_mail="cc@example.com";
  $bcc_mail="bcc@example.com";
  /* 메일 보내기 */
  $sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail)

  ?>
