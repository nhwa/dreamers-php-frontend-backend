<?
  //DB connect
  $conn = mysql_connect("localhost","php","0000");
  //DB를 선택한다.
  mysql_select_db("user_php");
  //한글에 대한 처리를 한다.
  mysql_query("set names euckr");

?>
