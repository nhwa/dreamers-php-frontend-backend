<?php
// $uip=setcookie('userip','{$_SERVER[REMOTE_ADDR]}',time()+180);
error_reporting(0);
include "../lib/dbconn.php";

$table = "makedream";
$ripple = "reply";
$page=($_GET['page'])?$_GET['page']:1;
$search=$_POST['search'];
$mode = $_GET['mode'];
$category=$_GET['category'];
$user=$_GET['user']; //유저 검색용(마이페이지용)
$see=$_GET['see'];

$scale=20;			// 한 화면에 표시되는 글 수
$block=3;

    if ($mode=="search")
  {
    if(!$search)
    {
      echo("
        <script>
         window.alert('검색할 단어를 입력해 주세요!');
         location.href='./newindex.php';
        </script>
      ");
      exit;
    }
    $sql = "select * from $table where nick like '%$search%' or subject like '%$search%' or content like '%$search%' or category like '%$search%' order by num desc";
  }
  else if($mode=="hithithit"){
    if($category)
    {
      $sql="select * from $table where category='$category' order by hit desc";
    }
    else{
    $sql="select * from $table order by hit desc";
    }
  }
  else if($mode=="recom"){
    if($category)
    {
      $sql="select * from $table where category='$category' order by up desc";
    }
    else{
      $sql="select * from $table order by up desc";
    }
  }
  else if($see=="seeuser"){
    if($category)
    {
      $sql="select * from $table where nick='$user' and category='$category' order by num desc;";
    }
    else{
      $sql="select * from $table where nick='$user' order by num desc;";
    }
  }
  else
  {
    if($category)
    {
      $sql="select * from $table where category='$category' order by num desc;";
    }
    else{
    $sql = "select * from $table order by num desc";
    }
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

  // 표시할 페이지($page)에 따라 $start 계산
  $start = ($page - 1) * $scale;
  $number = $total_record - $start;
?>
  <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
  <html>
  <head>
    <title>글목록</title>
  <meta charset="utf-8">
  <meta http-equiv="Expires" content="0"/>
  <meta http-equiv="Pragma" content="no-cache"/>

<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link href="../css/index-content.css" rel="stylesheet">
<link href="./css/style-all.css" rel="stylesheet">

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<style>
body{
  overflow-x:hidden;
  overflow-y:scroll;
}
.modal {
z-index: 9999;
}
.modal-backdrop.in {
    filter: alpha(opacity = 80) !important;opacity: .8 !important;
    z-index: 2223;
}
</style>

<script>
	function check_input()
	{
		if (document.ripple_form.ripple_content.value=="")
		{
			alert("내용을 입력하세요!");
			document.ripple_form.ripple_content.focus();
			return;
		}
		else {
			document.ripple_form.submit();
		}
    }

    function del(href)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    };

</script>

<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel({interval: 3000});

    // Enable Carousel Indicators
    $(".item1").click(function(){
        $("#myCarousel").carousel(0);
    });
    $(".item2").click(function(){
        $("#myCarousel").carousel(1);
    });
    $(".item3").click(function(){
        $("#myCarousel").carousel(2);
    });

    // Enable Carousel Controls
    $(".left").click(function(){
        $("#myCarousel").carousel("prev");
    });
    $(".right").click(function(){
        $("#myCarousel").carousel("next");
    });
});
</script>

</head>
<body>

  <?php
     for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)
     {
        mysql_data_seek($result, $i);     // 포인터 이동
        $row = mysql_fetch_array($result); // 하나의 레코드 가져오기

      $item_num = $row[num]; //게시물번호
      $item_id  = $row[id]; //작성자아이디
      // $item_name = $row[name]; //작성자이름
      $item_nick = $row[nick]; //작성자 닉네임
      $item_category = $row[category]; //게시글의 카테고리
      $item_hit = $row[hit]; //게시글의 조회수
      $item_date = $row[regist_day]; //게시글의 게시 날짜
      $item_date = substr($item_date, 0, 17); //게시글의게시날짜를 불러오기
      $item_subject = str_replace(" ", "&nbsp;", $row[subject]); //게시글의게시제목을 html 적용한걸로불러오기
      $item_up = $row[up];
      $item_content = $row[content];

      $image_copied[0] = $row[file_copied_0];
      $img_name = $image_copied[0];
			$img_name = "../makedream/data/".$img_name;

      $sql = "select * from $ripple where parent=$item_num";
      $result2 = mysql_query($sql, $connect);
      $num_ripple = mysql_num_rows($result2);
  ?>

<div class="pics">
  <!-- <div  class="btn btn-default" id="popbutton">   -->
    <!--모달 팝업 추가 -->
    <!-- <div class="modal fade">
      <div class="modal-dialog">
        <div class="modal-content">-->

        <!-- 잠깐 죽여버림 -->
        <!-- <a href="../makedream/view2.php?num=<?=$item_num ?>&page=<?=$page ?>" data-remote="../makedream/view2.php?num=<?=$item_num ?>&page=<?=$page ?>" data-toggle="modal" data-target="#myModal<?=$item_num ?>" data-needpopup-show="#small-popup" display="hidden" class="cbcb"> -->

<a href="../makedream/view4.php?num=<?=$item_num ?>&page=<?=$page ?>" data-remote="../makedream/view4.php?num=<?=$item_num ?>&page=<?=$page ?>" data-toggle="modal" data-target="#myModal<?=$item_num ?>" data-needpopup-show="#small-popup" display="hidden" class="cbcb">
 <div class="picnav">
    <div class="ih-item square effect6 bottom_to_top">

        <!-- <a href="#" data-needpopup-show="#small-popup"> -->
          <div class="img"><img src=<?=$img_name ?>  border="0"/>
            <div class="info">
              <h3><?=$item_category ?></h3>
              <p><?=$item_subject ?></p>
              <h6><?=$item_nick ?>님</h6>
              <h6>조회 <?=$item_hit ?>&nbsp;&nbsp;&nbsp;추천 <?=$item_up ?></h6>
            </div>
          </div>
        <!-- </a> -->

    </a>

                    <!--  팝업 내부 -->
                    <!-- <div class="modal fade"> -->
                        <div id="myModal<?=$item_num ?>" class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

            <div id='small-popup' class="needpopup">
				<!-- <a href="#" data-needpopup-show="#big-popup"></a>
        <div class="popup-screenimg">
          <img src="../img/1.png" width=100% height=auto; />
          <p>해시태그 부분</p>
      </div>
      <div class="popup-screenabout">
        <p> SCREEN ABOUT</p>
        <p> User profile</p>
        <p> About bucketlist
      </div>
      <div class="popup-screenuser">
        <p>  SCREEN USER</p>
        <p></p>
      </div>
      <div class="popup-screencomment">
        <p>  SCREEN COMMENT</p>
      </div><!--popup-screencomment끝 -->
    </div><!--small-popup 끝-->

    </div>  <!--ih-item square effect6 bottom_to_top 끝-->
  </div> <!--pic nav 끝-->
</div>
</div>
</div>
</div><!--pics 끝-->
<!-- </div>  -->

  <?php
     	   $number--;
     }
     ?>
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
           <a href='../lib/newindex.php?page=<?=$s_page-1?>' aria-label="Previous">
             <span aria-hidden="true">&laquo;</span>
           </a>
           <?php
    	}
  for ($p=$s_page; $p<=$e_page; $p++) {

      if ($page == $p)
  		{
  			echo "<li class='active'><a href='../lib/newindex.php?table=$table&page=$p'>$p</a></li>";
  		}
  		else
  		{
  		echo "<li><a href='../lib/newindex.php?table=$table&page=$p'>$p</a></li>";
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
  <a href='../lib/newindex.php?page=<?=$e_page+1?>' aria-label="Next">
    <span aria-hidden="true">&raquo;</span>
  </a>
  <?php
  }
  ?>
</li>
</ul>
</nav>
</body>
</html>
