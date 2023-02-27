<?php
// $uip=setcookie('userip','{$_SERVER[REMOTE_ADDR]}',time()+180);
error_reporting(0);
  include "../lib/dbconn.php";

	$table = "makedream";
	$ripple = "reply";
	$page=$_GET['page'];
  $search=$_POST['search'];
  $mode = $_GET['mode'];

  $scale=20;			// 한 화면에 표시되는 글 수
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

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#popbutton").click(function(){
        $('div.modal').modal({remote : '../ex/whatsthat.php'});
    })
});
</script>
<style>
.modal-picnav {
  display: inline;
  position : relative;
  width : 20%;
  height :15%;
  min-width: 400px;
  background-color: #49B8D6;
  margin: 3% auto;
  /*float: left;*/

  .ih-item img {
    width: 100%;
    height: 100%;
    overflow:hidden;
  }
}
</style>
</head>
<body>

  <?php
     for ($i=0; $i<2; $i++)
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
<!-- <button class="btn btn-default" id="popbutton">모달출력버튼</button><br/> -->
<!-- <div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content"> -->

<!-- 시작부분 -->

<div class="pics">
  <!-- <div  class="btn btn-default" id="popbutton"> -->
      <!--모달 팝업 추가 -->
        <!-- <div class="modal-content"> -->
 <div class="modal-picnav" id="popbutton">
    <div class="ih-item square effect6 bottom_to_top">
      <a href="#">
        <a href="#" data-needpopup-show="#small-popup">
          <div class="img"><img src=<?=$img_name ?>
            <div class="info">
              <h3><?=$item_category ?></h3>
              <p><?=$item_subject ?></p>
              <h6><?=$item_nick ?>님</h6>
              <h6>조회 <?=$item_hit ?>&nbsp;&nbsp;&nbsp;추천 <?=$item_up ?></h6>
            </div>
          </div>
        </a>
      </a>
                    <!--  팝업 내부 -->
                    <div class="modal fade">
                      <div class="modal-dialog">
                        <div class="modal-content">
            <div id='small-popup' class="needpopup">
			    </div><!--small-popup 끝-->
        </div>
      </div>
    </div>
    <?php
           $number--;
       }
    ?>
    </div>  <!--ih-item square effect6 bottom_to_top 끝-->
  </div> <!--pic nav 끝-->
</div>
</div>
</div> <!--pics 끝-->



        <!-- remote ajax call이 되는영역  끝-->


    </div>
  </div>
</div>
</body>
</html>


출처: http://hellogk.tistory.com/37 [IT Code Storage]
