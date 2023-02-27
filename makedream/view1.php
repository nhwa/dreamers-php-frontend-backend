<?php
	session_start();

error_reporting(0);
// $_COOKIE['userip'];

	include "../lib/dbconn.php";

	$table="makedream";
$num = $_GET['num'];

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
  $row = mysql_fetch_array($result);


	// echo ("<script> window.alert('{$_cookie['userip']}');</script>");
	// echo ("<script> window.alert('$num');</script>");
	// echo ("<script> window.alert('{$_SESSION['usersip']}');</script>");


	$item_num = $row[num];
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
	// $is_html      = $row[is_html];

	// if ($is_html!="y")
	// {
	// 	$item_content = str_replace(" ", "&nbsp;", $item_content);
	// 	$item_content = str_replace("\n", "<br>", $item_content);
	// }

// 갯수 세자
	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
	// $fields=mysql_num_fields($result);
	// $row = mysql_fetch_row($result);
	$file_count=0;
	while($row=mysql_fetch_row($result))
	{
		for($i=7; $i<10; $i++)
		{
			if($row[$i]!="")
			{
				$file_count+=1;
			}
		}
	}
	 // echo $file_count;

	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i])
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			if ($image_width[$i] > 550)
				$image_width[$i] = 550;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

// 생성된 쿠키가 없고, 글쓴이와 세션 아이디가 일치하지 않으면 조회수 증가
// 둘 중 하나라도 만족하지 않으면 증가하지 않음!!
	if(($num!=$_COOKIE['hit_makedream' .$num])&&($_SESSION['userid']!=$row[id])) {
		$new_hit=$item_hit +1;
	  $sql = "update makedream set hit=$new_hit where num=$num;";
	  mysql_query($sql, $connect);
	  setcookie("hit_makedream" .$num, $num, time()*60*60*24, "/");
	}

?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<!-- <link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all"> -->
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
<style>
.modal-title{
  font-family: 'Noto Sans KR', sans-serif;
}

.modal-content {
    position: relative;
		background - color: #fff;
		- webkit - background - clip: padding - box;
		background - clip: padding - box;
		border: 1 px solid #999;
		border:1px solid rgba(0,0,0,.2);
		border-radius:6px;
		outline:0;
		-webkit-box-shadow:0 3px 9px rgba(0,0,0,.5);
		box-shadow:0 3px 9px rgba(0,0,0,.5);
		padding: 15px;
	}
	.col-sm-8{
		padding-top: 15px;
		/*padding-bottom: 15px;*/
	}
	.col-sm-4{
		padding-top: 15px;
	}
</style>
<script>
// var motherWindow=dialogArguments;
// //부모창을 리로드 시킬때
// motherWindow.location.reload();
// //부모창의 URL을 이동시킬때
// motherWindow.location="html페이지 주소";
// opener.parent.location.reload();
// window.close();
// window.opener.parent.location.reload();
// callbacks: {
// 			afterClose: function() {
// 						 window.location.reload();
// 					 }
// parent.location.reload();
			 }
</script>
<!-- 슬라이드111 -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-1.12.2.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script> -->
<!--슬라이드-->
	<!-- <link href="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet" />
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="http://netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script> -->
<!--	-->
<!-- <style>
#content {
		top: 100px;
		background-color: #f00;
	}
</style> -->
</head>

<body style="overflow-x:hidden; overflow-y:auto;">
	<!-- header -->
	<div class="modal-header">
	    <!-- 닫기(x) 버튼 -->
	  <button type="button" class="close" data-dismiss="modal">×</button>
	  <!-- header title -->
	  <h4 class="modal-title"><?=$item_subject ?></h4>
	</div>

	<div id="modal-body">
				<div id="view_content">
			<div id="view_title1"><?= $item_subject ?></div>
			<div id="view_title2"><?= $item_nick ?> | 조회 : <?= $item_hit ?> | <?= $item_date ?> </div>
				<div class="row">

				  <div class="col-sm-8">
						<!-- style="background-color:lavenderblush;"-->
						<?php
							for ($i=0; $i<3; $i++)
							{
								if ($image_copied[$i])
								{
									$img_name = $image_copied[$i];
									$img_name = "../makedream/data/".$img_name;
									$img_width = $image_width[$i];
									echo "<img src='$img_name' width='$img_width'>"."<br><br>";
								}
							}
									?>
						</div>
				  <div class="col-sm-4" style="background-color:lavender;">
						<div class="usernugu">
							유저는 누구냐
						</div>
						<div class="sharashara">

						</div>

					</div>
				</div>


			<?= $item_content ?>
		</div>

		<div id="ripple">
<?php
	    $sql = "select * from reply where parent='$item_num'";
	    $ripple_result = mysql_query($sql);

		while ($row_ripple = mysql_fetch_array($ripple_result))
		{
			$ripple_num = $row_ripple[num];
			$ripple_id = $row_ripple[id];
			$ripple_nick = $row_ripple[nick];
			$ripple_content = str_replace("\n", "<br>", $row_ripple[content]);
			$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
			$ripple_date = $row_ripple[regist_day];
?>
			<div id="ripple_writer_title">
			<ul>
			<li id="writer_title1"><?=$ripple_nick?></li>
			<li id="writer_title2"><?=$ripple_date?></li>
			<li id="writer_title3">
		      <?php
					if(($_SESSION['userid']=="admin") || ($_SESSION['userid']==$ripple_id))
			          echo "<a href='delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>[삭제]</a>";
			  ?>
			</li>
			</ul>
			</div>
			<div id="ripple_content"><?=$ripple_content?></div>
			<div class="hor_line_ripple"></div>
<?php
		}
?>
			<form  name="ripple_form" method="post" action="insert_ripple.php?table=<?=$table?>&num=<?=$item_num?>">
			<div id="ripple_box">
				<div id="ripple_box1"><img src="../img/title_comment.gif"></div>
				<div id="ripple_box2">
					<!-- <input type=text name=rep> -->
					<textarea rows="5" cols="65" name="ripple_content"></textarea>

				</div>
				<div id="ripple_box3"><a href="#"><button type="button" onclick="check_input()">작성</button></a></div>
			</div>
			</form>
	</div>


		<!-- <div id="view_button">
				<a href="../lib/index-content1.php?table=<?=$table?>&page=<?=$page?>">리스트</a>&nbsp;
		</div> -->
<div id="write">
<?php
	if($_SESSION['userid'] && ($_SESSION['userid']==$item_id))
	{
?>
				<a href="write_form2.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정하기</a>&nbsp;
				<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제하기</a>&nbsp;
<?php
	}
?>
<?php
	if($_SESSION['userid'])
	{
?>
				<a href="write_form2.php?table=<?=$table?>">
				<!-- <img src="../img/write.png"> -->
				글쓰기</a>
<?php
	}
?>
		</div>
		<div class="clear"></div>

	</div> <!-- end of col2 -->

    <!-- <div id="main-footer"> -->
        <?php
				  // include "../lib/index-footer.php";
					 ?>
    <!-- </div> -->
    </div>

    <!--top-move 탑으로 스크롤!-->

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script>
        /*Add class when scroll down*/
        $(window).scroll(function(event){
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $(".go-top").addClass("show");
            } else {
                $(".go-top").removeClass("show");
            }
        });
        /*Animation anchor*/
        $('a').click(function(){
            $('html, body').animate({
                scrollTop: $( $(this).attr('href') ).offset().top
            }, 1000);
        });
        </script>


    <!--popup(이미지 누르면 팝업)-->

    	<script src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
		<script src="script/needpopup.min.js"></script>
		<script>
			needPopup.config.custom = {
				'removerPlace': 'outside',
				'closeOnOutside': false,
				onShow: function() {
					console.log('needPopup is shown');
				},
				onHide: function() {
					console.log('needPopup is hidden');
				}
			};
			needPopup.init();
		</script>
  </body>
</html>
