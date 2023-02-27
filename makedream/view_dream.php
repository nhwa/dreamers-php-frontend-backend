<?php
error_reporting(0);
  include "../lib/dbconn.php";

	$table = "makedream";
	$ripple = "reply";
	// $page=$_GET['page'];
  $item_num = $_GET['item_num'];
	$page=$_GET['page'];
  $sql = "select * from $table where num=$item_num";
	$result = mysql_query($sql, $connect);
  $row = mysql_fetch_array($result);

  $item_id = $row[id];
	// $item_name = $row[name];
  $item_nick = $row[nick];
	$item_hit = $row[hit];
	$item_up = $row[up];

	$image_name[0]   = $row[file_name_0];
	$image_name[1]   = $row[file_name_1];
	$image_name[2]   = $row[file_name_2];
	$image_copied[0] = $row[file_copied_0];
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

  $item_date = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];


  	for ($i=0; $i<3; $i++)
  	{
  		if ($image_copied[$i])
  		{
  			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
  			$image_width[$i] = $imageinfo[0];
  			$image_height[$i] = $imageinfo[1];
  			$image_type[$i]  = $imageinfo[2];

  			if ($image_width[$i] > 785)
  				$image_width[$i] = 785;
  		}
  		else
  		{
  			$image_width[$i] = "";
  			$image_height[$i] = "";
  			$image_type[$i]  = "";
  		}
  	}

  	if($num!=$_COOKIE['hit_makedream' .$num]) {
  		$new_hit=$item_hit +1;
  	  $sql = "update makedream set hit=$new_hit where num=$num;";
  	  mysql_query($sql, $connect);
  	  setcookie("hit_makedream" .$num, $num, time()*60*60*24, "/");
  	}
  ?>

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
      }
  </script>

<!--  팝업 내부 -->
<!-- <div id='small-popup' class="needpopup"> -->

<a href="#" data-needpopup-show="#big-popup"></a>

        <div class="popup-screenimg">
        <div class="img">
<div id="myCarousel" class="carousel slide" data-ride="carousel">
	<!--페이지-->
<div class="">
  <a href="../../jhe/jqm_ex05_modal.php" data rel="dialog">누르면 글 나옴</a>
</div>
	<ol class="carousel-indicators">
		<li data-target="#myCarousel" data-slide-to="0" class="active"></li>
		<li data-target="#myCarousel" data-slide-to="1"></li>
		<li data-target="#myCarousel" data-slide-to="2"></li>
	</ol>
	<!--페이지-->

	<div class="carousel-inner">
		<!--슬라이드1-->
		<div class="item active">
			<img src="../img/2.png" style="width:100%" alt="First slide">
			<div class="container">
			</div>
		</div>
		<!--슬라이드1-->

		<!--슬라이드2-->
		<div class="item">
			<img src="../img/3.png" style="width:100%" data-src="" alt="Second slide">
			<div class="container">
			</div>
		</div>
		<!--슬라이드2-->

		<!--슬라이드3-->
		<div class="item">
			<img src="../img/4.png" style="width:100%" data-src="" alt="Third slide">
			<div class="container">
			</div>
		</div>
		<!--슬라이드3-->
	</div>
	<!--이전, 다음 버튼-->
	<a class="left carousel-control" href="#myCarousel" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
	<a class="right carousel-control" href="#myCarousel" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
</div></div>
<!--
        <div class="hashtag">
            <p>#노이슈바슈타인 #독일 #디즈니성 #퓌센</p></div>
-->
            </div>
      <div class="popup-screenabout">
        <p> SCREEN ABOUT</p>
        <p> User profile</p>
          <p> About bucketlist</p>
      </div>
      <div class="popup-screenuser">
        <p>  SCREEN USER</p>
        <p></p>
      </div>
      <div class="popup-screencomment">
        <p>  SCREEN COMMENT</p>
      </div>

  <!-- <a href="#" data-needpopup-show="#big-popup"></a>
  <div class="popup-screenimg">
    <img src="../img/1.png" width=100% height=auto; />
      <p>으앙 부분</p>
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
  </div> -->
  <!--popup-screencomment끝-->
<!-- </div><!--small-popup 끝-->
