<?
  //* extract 함수는 키값을 변수화 시키는 것이다.
  extract($_POST);
  extract($_SERVER);

  if(empty($password)){
    echo "
      <script>
        alert('Empty Password');
        history.back(1);
      </script>
    ";
    exit;
  }

  include "db_connect.php";
  $query = "select password from board where num=$_GET[num]";
  $result = mysql_query($query, $conn);

  $row = mysql_fetch_array($result);

  if($password == $row['password']){  //같으면 지워라
    $query_1 = "delete from board where num=$_GET[num]";
    $result_1 = mysql_query($query_1,$conn);

  }else{
    echo "
      <script>
      alert('Wrong Password');
      history.go(-2);
      </script>
    ";
  }
  mysql_close($conn);
?>
<meta http-equiv='refresh' content='1; url=list.php'>
<font size=2>Deleted.</font>
