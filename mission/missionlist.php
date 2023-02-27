<?php
	session_start();
	// $uip=setcookie('userip','{$_SERVER[REMOTE_ADDR]}',time()+180);
error_reporting(0);
	$table = "mission";
	$ripple = "reply";
	$page=($_GET['page'])?$_GET['page']:1;
	$now=$_GET['now'];

	// echo ("<script> window.alert('$uip');</script>"); //이거 조회수때문에 테스트 했던거임
?>

<!DOCTYPE html>
<html>

<meta charset="utf-8">
<meta name="description" content="">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> -->
<!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->

<link href="../css/style-all.css" rel="stylesheet">
<link href="../css/missionlist.css" rel="stylesheet">
<!-- <link href="../css/common.css" rel="stylesheet" type="text/css" media="all"> -->
<!-- <link href="../css/board4.css" rel="stylesheet" type="text/css" media="all"> -->

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<title>Dreamers, 당신의 꿈 그리고 우리</title>
    <link rel="icon" href="../lib/favicon_img/favicon.ico" type="image/ico">
<style>
body{
  overflow-x:hidden;
  overflow-y:scroll;
}
</style>
</head>
<?php
	include "../lib/dbconn.php";
	$scale=5;			// 한 화면에 표시되는 글 수
	$block=3;


if($now=="진행중미션")
{
	$sql="select * from $table where ingorex=1 order by num desc";
}
else if($now=="종료된미션")
{
	$sql="select * from $table where ingorex=0 order by num desc";
}
else{
		$sql = "select * from $table order by num desc";
}

	$result = mysql_query($sql, $connect);
	$total_record = mysql_num_rows($result); // 전체 글 수

	$pageNum = ceil($total_record/$scale);//총페이지
	$blockNum = ceil($pageNum/$block);
	$nowBlock = ceil($page/$block);

	// 전체 페이지 수($total_page) 계산
	if ($total_record % $scale == 0)
		$total_page = floor($total_record/$scale);
	else
		$total_page = floor($total_record/$scale) + 1;

		$s_page = ($nowBlock * $block) - ($block - 1);

		if ($s_page <=1){ // 페이지번호($page)가 0 일 때
	    $s_page = 1;
	  }              // 페이지 번호를 1로 초기화
	  $e_page = $nowBlock*$block;

	  if($pageNum <= $e_page){
	    $e_page = $pageNum;
	  }

	// if (!$page)                 // 페이지번호($page)가 0 일 때
	// 	$page = 1;              // 페이지 번호를 1로 초기화

	// 표시할 페이지($page)에 따라 $start 계산
	$start = ($page - 1) * $scale;
	$number = $total_record - $start;
?>

 <body style="overflow-x:hidden; overflow-y:auto;">
   <div class=clear></div>
  <!-- <a href="#myAnchor" class="go-top">▲</a> -->

<!-- 컨텐츠 게시판 부분 -->
  <div class="mission_container">
		<div class="mission_title"> <!--게시판 제목부분-->
			<div class="mission_name">Mission</div>
			<div class="mission_side">It's time to challenge!</div>
		</div>
		<div class="mission_show">
<?php
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
   {
    mysql_data_seek($result, $i);     // 포인터 이동
    $row = mysql_fetch_array($result); // 하나의 레코드 가져오기

		$item_num  = $row[num];
		$today=date("Y-m-d");
		$item_deadline=$row[deadline];
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
		// $ingorex=$row[ingorex];
		if($today>$item_deadline)
		{
			$sql="update $table set ingorex=0 where num=$item_num";
			mysql_query($sql);
		}

		mysql_data_seek($result, $i);     // 포인터 이동
    $row = mysql_fetch_array($result); // 하나의 레코드 가져오기

		$item_num  = $row[num];
		$item_category = $row[category];
		$item_id = $row[id];
		// $item_name    = $row[name];
		$item_nick = $row[nick];
		$item_hit = $row[hit];
		$item_date = $row[regist_day];
		$item_deadline=$row[deadline];
	  $item_date = substr($item_date, 0, 10);
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
		$ingorex=$row[ingorex];

		if($ingorex==0)
		{
			$ingorex="종료된미션";
		}
		else{
			$ingorex="진행중미션";
		}

	  $sql = "select * from $ripple where parent=$item_num";
	  $result2 = mysql_query($sql, $connect);
	  $num_ripple = mysql_num_rows($result2);
?>
		<div class="mission_content"> <!--게시판 내용-->
			<span class="mission_num">
				<?=$number?>
			</span>
			<a href="../lib/index-mission.php?table=<?=$table?>&now=<?=$ingorex?>" title="<?=$ingorex?> 보기" alt="미션보기">
			<span class="mission_ingorex">
					<?=$ingorex?>
				</a>
			</span>
			<!-- <a href="../mission/mission_view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>" data-remote="../mission/mission_view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>" data-toggle="modal" data-target="#myModal<?=$item_num ?>" data-needpopup-show="#small-popup" display="hidden"> -->
			<a href="../mission/mission_view.php?num=<?=$item_num?>&now=<?=$ingorex?>&page=<?=$page?>">
			<span class="mission_category">
				<?=$item_category?>
			</span>
			<!-- 12.03 수정중  -->
			<!-- <div class="mission_sub"> -->
			<span class="mission_subject">
					<?=$item_subject?>
					</span>
					</a>
					<!-- </div> -->



			<span class="mission_date">
				<?=$item_date?> ~ <?=$item_deadline?>
			</span>

		</div> <!--end of mission_content-->
	<?php
	$number--;
		}
	 ?>
	 <!-- <div id="myModal<?=$item_num ?>" class="modal fade">
	 <div class="modal-dialog">
	 <div class="modal-content">
		 <div id='small-popup' class="needpopup">
</div>
	 </div>
	 </div>
	 </div> -->


 </div> <!--end of mission_show-->

 <div class="mission_write">
 <?php
 	if($_SESSION['userid']=="Dreamer")
 	{
 ?>
 		<a href="../mission/mission_write_form.php?table=mission"> 미션글작성 </a>
 <?php
 	}
 ?>
</div> <!--end of mission_write-->

 <nav aria-label="Page navigation">
	 <ul class="pagination">
		 <li>
			 <?php
			 if($s_page==1)
			 {
				 ?>
				 				 <span aria-hidden="true">&laquo;</span>
			<?php
			 }
			 else
			 {
			 ?>
			 <a href='../lib/index-mission.php?table=<?=$table?>&page=<?=$s_page-1?>' aria-label="Previous">
				 <span aria-hidden="true">&laquo;</span>
			 </a>
			 <?php
	}
for ($p=$s_page; $p<=$e_page; $p++) {

	if ($page == $p)
 {
	 echo "<li class='active'><a href='../lib/index-mission.php?table=$table&page=$p'>$p</a></li>";
 }
 else
 {
 echo "<li><a href='../lib/index-mission.php?table=$table&page=$p'>$p</a></li>";
 }
}
?>
<li>
	<?php
	if($e_page==$total_page)
	{
	 ?>
	 <span aria-hidden="true">&raquo;</span>
<?php
}
else{
?>
<a href='../lib/index-mission.php?table=<?=$table?>&page=<?=$e_page+1?>' aria-label="Next">
<span aria-hidden="true">&raquo;</span>
</a>
<?php
}
?>
</li>
</ul>
</nav>

			<!-- <div page="page_bottom">
				<div page="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; -->
<?php
   // 게시판 목록 하단에 페이지 링크 번호 출력
   // for ($i=1; $i<=$total_page; $i++)
   // {
		// if ($page == $i)     // 현재 페이지 번호 링크 안함
		// {
		// 	echo "<b> $i </b>";
		// }
		// else
		// {
		// 	echo "<a href='missionlist.php?table=$table&page=$i'> $i </a>";
		// }
   // }
?>
			<!-- &nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div class="mission_write"> -->
<?php
	// if($_SESSION['userid']==admin)
	// {
?>
		<!-- <a href="mission_write_form.php?"> 글쓰기 </a> -->
<?php
	// }
?>
				<!-- </div> -->
			<!-- </div> -->
			<!-- end of page_bottom -->
		<div class="clear"></div>



  </div> <!-- end of mission_content -->

</body>
</html>
