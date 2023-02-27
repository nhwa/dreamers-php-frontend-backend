<?php
	session_start();

error_reporting(0);


	include "../lib/dbconn.php";
 $userid=$_SESSION['userid'];
	$table="mission";
 $num = $_GET['num'];
 $page=$_GET['page'];
 $now=$_GET['now'];

  // $mode = $_GET['mode'];

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);
  $row = mysql_fetch_array($result);

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
	$item_date= str_replace("(", "", $item_date);
	$item_date= str_replace(")", "", $item_date);
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	$item_content = $row[content];
	$item_content = str_replace(" ", "&nbsp;", $item_content);
	$item_content = str_replace("\r\n", "<br>", $item_content);


// 파일 갯수 세자
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

						// if ($image_width[$i] > 460)
						// 	$image_width[$i] = 460;

						// if($image_height[$i]>412.5)
						$image_height[$i]=412;
						$image_width[$i]=568;
					}
					// else
					// {
					// 	$image_width[$i] = "";
					// 	$image_height[$i] = "";
					// 	$image_type[$i]  = "";
					// }

	}

// 생성된 쿠키가 없고, 글쓴이와 세션 아이디가 일치하지 않으면 조회수 증가
// 둘 중 하나라도 만족하지 않으면 증가하지 않음!!
	if($num!=$_COOKIE['hit_mission' .$num]) {
		$new_hit=$item_hit +1;
	  $sql = "update $table set hit=$new_hit where num=$num;";
	  mysql_query($sql, $connect);
	  setcookie("hit_mission" .$num, $num, time()*60*60*24, "/");
	}
	else if($_SESSION['userid']!=$row[id])
{
		  setcookie("hit_mission" .$num, $num, time()*60*60*24, "/");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">

<!-- 수정 끝 쿠키 새로고침임 -->
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<script>
    function del(href)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }

		function update_push(gbn, no){
		var url="../makedream/push.php?table=<?=$table?>&num=<?=$item_num?>";
		$.get(url, {gbn:gbn, no:no}, function(args){
		$("#up_push<?=$item_num?>").html(args);
		}
		);
		}


</script>
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
</script>
<style>
* {
	margin:0 auto;
	padding:0 auto;
}
body {
	background-image:url(../img/bg9.jpeg);
	background-size:cover;
	margin:20px;



}
.view_content {

}
/*img {
	display:block;
  width:500px;
  height:auto;
  position:relative;
  left:50%;
  margin-left:-250px;
}*/
.read_all {
	display:block;
  width:550px;
  height:auto;
  position:relative;
	/*top : 20px;*/
  left:50%;
	margin:20px 0px 30px -250px;
	/*background-color:#fff;*/
	padding : 10px 25px 0px 25px;

}
.read_opa{
	position:absolute;
	display:block;
	width:100%;
	height:100%;
	margin-left:-25px;
	background-color:#fff;
z-index:-100;
		opacity:0.7;
		border-radius: 7px;

}
.idmatch {
	display:block;
	width:500px;
	left:50%;
	margin-left:+137px;

  height:auto;
  position:relative;

	}
	.ripple {
		display:block;
	  width:500px;
	  height:auto;
	  position:relative;
	  left:50%;
	  margin-left:-250px;
	}
	.form-control {
		display:block;
	  width:500px;
	  height:auto;
	  position:relative;
	  left:50%;
	  margin-left:-250px;
	}
  .undersub{
		margin : 20px 0px 0px 0px;
	}
	.undersub_rest{
		float:right;
	}
	.read_content{
		margin-bottom:20px;
	}
</style>
    <link rel="icon" href="../lib/favicon_img/favicon.ico" type="image/ico">
	</head>


<body>
	<!-- header -->

	<div class="read_all">
		<div class="read_opa">
		</div>
	<div class="modal-header">
	    <!-- 닫기(x) 버튼 -->
			<a href="../lib/index-mission.php?page=<?=$page?>&now=<?=$now?>">
	  <button type="button" class="close" data-dismiss="modal">×</button>
	</a>
	  <!-- header title -->
	  <h4 class="modal-title"><?=$item_subject ?></h4>
	</div>

	<div id="modal-body">
				<div id="view_content">
					<div class="undersub">
						<span class="undersub_nick">
							<button type="button" class="btn btn-danger btn-xs">
								<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								&nbsp;<?= $item_nick ?></button>
						</span>
						<span class="undersub_nick_rest">
							's Bucketlist
						</span>
						<span class="undersub_rest">
							<span class="glyphicon glyphicon-check" aria-hidden="true"></span>
							 <?= $item_hit ?>&nbsp;&nbsp;&nbsp;
								<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
							 <?= $item_date ?>
						</span>
					</div>
			<hr>
				  <div class="col-sm-81">
						<!-- style="background-color:lavenderblush;"-->
						<?php
						$img_name = $image_copied[0];
						$img_name = "../mission/data/".$img_name;
						?>
						<div id="myCarousel<?=$item_num?>" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
					    <!-- <ol class="carousel-indicators">
								<?php
									if($file_count!=1) //사진이 한개만 있으면 리스트 모양 ● 이거 안생기게 하는거
									{
								 ?>
					      <li data-target="#myCarousel<?=$item_num?>" data-slide-to="0" class="active"></li>
								<?php
									}
							 ?>
								<?php
								if($file_count>1)
								{
									for($i=1; $i<$file_count; $i++)
									{
									?>
      					<li data-target="#myCarousel<?=$item_num?>" data-slide-to="<?=$i ?>"></li>
								<?php
									}
								}
								 ?>
</ol> -->
					     <!-- Wrapper for slides -->
					     <div class="carousel-inner" role="listbox">

					       <div class="item active">
					         <img src="<?=$img_name ?>" alt="사진" width="<?=$image_width[0]?>" height="<?=$image_height[0]?>">
					       </div>
								 <?php

								 echo $count;
								 if($file_count>1)
								 {
									 for($i=1; $i<$file_count; $i++)
									 {
										 $img_name = $image_copied[$i];
										 $img_name = "../mission/data/".$img_name;
										 ?>
										 <div class="item">
							         <img src="<?=$img_name ?>" alt="사진" width="<?=$img_width[$i]?>" height="<?=$img_height[$i]?>">
							       </div>
									 <?php
									 	}
								 	}
								  ?>

									<!-- Left and right controls -->
									<?php
									if($file_count>1)
									{
									?>
									<!-- 수정중 -->
									<!-- <a class="left carousel-control" href="#myCarousel<?=$item_num?>" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel<?=$item_num?>" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a> -->
									<?php
								}
									?>
								</div>
												</div>
														</div>
												<hr>
				  <div class="col-sm-41">
						 <!-- style="background-color:lavender;" -->
						<div class="read_content">
							<?=$item_content ?>
						</div>
						<!-- 추천기능 -->
						<div class="pushpush" align="center" id="pushpush">
							<button type="button" class="btn btn-info" onclick="update_push('up','<?=$row[$item_num]?>')">
							<span class="glyphicon glyphicon-heart" aria-hidden="true"></span><b> HOPE</b><br><span id="up_push<?=$item_num?>"><?=$item_up ?></span>
							</button>
						</div>
					</div>
					<hr>
				<?php
					if($item_id==$_SESSION['userid'])
					{
				?>
				<div class="idmatch">
					<?php
						if($_SESSION['userid'] && ($_SESSION['userid']==$item_id))
						{
					?>
					<a href="../mission/mission_write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
					<button type="button" class="btn btn-default">수정</button></a>&nbsp;
					<a href="javascript:del('../mission/mission_delete.php?table=<?=$table?>&num=<?=$num?>')">
					<button type="button" class="btn btn-default">삭제</button></a>
					<?php
						}
					?>
				</div>
				<br><br>
				<?php
			 		}
			  ?>


		<!-- </div> -->
		<div class="clear"></div>

    <!-- <div id="main-footer"> -->

    <!-- </div> -->
	</div> <!-- view content-->
</div> <!-- modal body -->

<script>
function check_input(index)
{
var index;
var loginedid="<?=$userid?>";

if(loginedid!="")
	{
				if(index =='<?=$item_num?>' )
				{
					if (document.ripple_form<?=$item_num?>.ripple_content.value=="")
					{
						alert("댓글 내용을 입력하세요 :)");
						document.ripple_form<?=$item_num?>.ripple_content.focus();
						return;
					}
					else
					{
				  	document.ripple_form<?=$item_num?>.target = 'selfWin';
				    window.name = 'selfWin';
						// return false;

						document.ripple_form<?=$item_num?>.submit();
						alert('댓글이 입력되었습니다 :)');

						reload();
						}
					}
			}
			else
			{
					alert('로그인 후 이용하세요 :(');
			}
		}
</script>

<script>
function riri_check(num)
{
	var num;
	// var foo = document.getElementById('comment4');
	formname='riripple_form'+num;
	// alert(foo);
	var loginedids="<?=$userid?>";

	if(loginedids!="")
		{
if(document.forms[formname].eoeot.value=="")
{
				alert("내용을 입력하세요 :D");
				document.forms[formname].eoeot.focus();
}
else {
				document.forms[formname].submit();
				alert('댓글이 입력되었습니다 :D');
}
}
else
{
		alert('로그인 후 이용하세요 :(');
}
}
</script>
</div>
  </body>
</html>
