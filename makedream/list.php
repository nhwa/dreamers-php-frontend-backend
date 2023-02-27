<?php
	session_start();
	// $uip=setcookie('userip','{$_SERVER[REMOTE_ADDR]}',time()+180);
error_reporting(0);
	$table = "makedream";
	$ripple = "reply";
	$page=$_GET['page'];

	// echo ("<script> window.alert('$uip');</script>"); //이거 조회수때문에 테스트 했던거임
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all"> <!--책꺼용-->
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">  <!--책꺼용-->

<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<!-- <link href="./css/style3.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="../css/needpopup.min.css" rel="stylesheet" >
<title>DreamUs, 당신의 꿈 그리고 우리</title>
</head>
<?php
	include "../lib/dbconn.php";
	$scale=20;			// 한 화면에 표시되는 글 수

    if ($mode=="search")
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}
		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
	}

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;
	$number = $total_record - $start;
?>

 <body style="overflow-x:hidden; overflow-y:auto;">
   <div class=clear></div>
  <a href="#myAnchor" class="go-top">▲</a>

   <div id ="page-wrapper">
   <div class="wrapper" id="myAnchor" >

   <div class=clear></div>
                <!-- 헤더 메뉴 -->
    <header id = "main-navi">
		    <?php   include "../lib/index-head.php";  ?>
        <div id = "logo">

           <a href="../index/newindex.php"><img src = "../img/logoi.png" width=150px; height=auto; /></a>
         </div>
    </header>
    <!-- 헤더 메뉴 (로그인,검색 등 끝) -->
     <div class=clear></div>



      <!-- 로고부분 -->

      <!-- 로고부분 끝 -->

      <div class=clear>
      </div>

<!-- 컨텐츠 게시판 부분 -->
            <div class="bk-list-nav">
  <div id="content">
	<div id="col1">
		<div id="left_menu">
<?php
			include "../lib/left_menu.php";
?>
		</div>
	</div>

	<div id="col2">
		<div id="title">
			<img src="../img/title_free.gif">
		</div>

		<form  name="board_form" method="post" action="list.php?&mode=search">
		<div id="list_search">
			<div id="list_search1">▷ 총 <?php echo $total_record ?> 개의 게시물이 있습니다.  </div>
			<div id="list_search2"><img src="../img/select_search.gif"></div>
			<div id="list_search3">
				<select name="find">
                    <option value='subject'>제목</option>
                    <option value='content'>내용</option>
                    <option value='nick'>닉네임</option>
				</select></div>
			<div id="list_search4"><input type="text" name="search"></div>
			<div id="list_search5"><input type="image" src="../img/list_search_button.gif"></div>
		</div>
		</form>
		<div class="clear"></div>

		<div id="list_top_title">
			<ul>
				<li id="list_title1"><img src="../img/list_title1.gif"></li>
				<li id="list_title2"><img src="../img/list_title2.gif"></li>
				<li id="list_title3"><img src="../img/list_title3.gif"></li>
				<li id="list_title4"><img src="../img/list_title4.gif"></li>
				<li id="list_title5"><img src="../img/list_title5.gif"></li>
			</ul>
		</div>

		<div id="list_content">
<?php
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
      mysql_data_seek($result, $i);     // 포인터 이동
      $row = mysql_fetch_array($result); // 하나의 레코드 가져오기

	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	  $sql = "select * from $ripple where parent=$item_num";
	  $result2 = mysql_query($sql, $connect);
	  $num_ripple = mysql_num_rows($result2);

?>
			<div id="list_item">
				<div id="list_item1"><?= $number ?></div>
				<div id="list_item2"><a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&mode=<?=$mode?>"><?= $item_subject ?></a>
<?php
		if ($num_ripple)
				echo " [$num_ripple]";
?>
				</div>
				<div id="list_item3"><?=$item_nick ?></div>
				<div id="list_item4"><?=$item_date ?></div>
				<div id="list_item5"><?=$item_hit ?></div>
			</div>
<?php
   	   $number--;
   }
?>
			<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp;
<?php
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{
			echo "<a href='list.php?table=$table&page=$i'> $i </a>";
		}
   }
?>
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div id="button">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
<?php
	if($_SESSION['userid'])
	{
?>
		<a href="write_form2.php?mode=111"> 글쓰기 </a>
<?php
	}
?>
				</div>
			</div> <!-- end of page_button -->
        </div> <!-- end of list bk-list-nav -->
		<div class="clear"></div>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
