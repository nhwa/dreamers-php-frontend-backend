<?php
  //* extract �Լ��� Ű���� ����ȭ ��Ű�� ���̴�.
  extract($_POST);
  extract($_SERVER);

  include "db_connect.php";
  $query = "insert into board (name, email, password, title,
            content, date, ip, view) values('$name',
            '$email', '$password', '$title',
            '$content',now(), '$_SERVER[REMOTE_ADDR]',
            '0')";

  $result = mysql_query($query, $conn);

  mysql_close($conn);
  echo ("<meta http-equiv='refresh' content='1; url=list.php'>");
?>
