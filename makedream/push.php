<?php
 session_start();

 error_reporting(0);

 include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

// $table="pushpush"; //추천인 확인하는 테이블 이거 안쓰고 직접 입력하였스므니다
?>
<meta charset="utf-8">
<?php
// 로그인 안한애들 돌려보내기
	if(!$_SESSION['userid']) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

  $table=$_GET['table']; //테이블 이름받아오기
  $page=$_GET['page']; //페이지 번호 받아오기 나중에 화면 돌아가기 위해서
  $item_num=$_GET['num']; //게시물 번호 받아오기
  $push_id=$_SESSION['userid']; //추천한 사람 아이디 받아오기 (로그인 한 사람만 가능)
  $ip=$_SERVER['REMOT_ADDR'];

//선택한 게시판의 게시물번호를 검색해서 불러오기
  $sql="select * from pushpush where table_name='$table' and item_num=$item_num and id ='$push_id';";
  $result=mysql_query($sql, $connect);
  $row=mysql_num_rows($result);

  $id=$row[id];


  if(!$row){
    $sql="insert into pushpush (table_name, item_num, id, ip) values ('$table', '$item_num', '$push_id', '$ip');";
    mysql_query($sql);
    $sql="select * from makedream where num=$item_num";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $row_up=$row[up];
    $new_up=$row_up+1;
    $sql="update makedream set up=$new_up where num=$item_num;";
    mysql_query($sql);

    $sql="select * from $table where num=$item_num;";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $up=$row[up];

    echo $up;
  }
  else{
    $sql="select * from $table where num=$item_num;";
    $result=mysql_query($sql);
    $row=mysql_fetch_array($result);
    $up=$row[up];

      echo "$up<br>이미 추천하셨어요 :D";

    mysql_close();
    // echo ("
    // <script>
    // window.alert('추천되었습니다 :D')
    // location.href='../lib/newindex.php?table=$table_name&page=$page&num=$item_num';
    // </script>
    // ");
  }
