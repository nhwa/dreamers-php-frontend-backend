<?php
	session_start();

error_reporting(0);


	include "../lib/dbconn.php";
$userid=$_SESSION['userid'];
	$table="makedream";
$num = $_GET['num'];
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

			if ($image_width[$i] > 460)
				$image_width[$i] = 460;

			if($image_height[$i]>412.5)
			$image_height[$i]=412.5;
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
	if($num!=$_COOKIE['hit_makedream' .$num]) {
		$new_hit=$item_hit +1;
	  $sql = "update makedream set hit=$new_hit where num=$num;";
	  mysql_query($sql, $connect);
	  setcookie("hit_makedream" .$num, $num, time()*60*60*24, "/");
	}
	else if($_SESSION['userid']!=$row[id])
{
		  setcookie("hit_makedream" .$num, $num, time()*60*60*24, "/");
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">

<!-- 수정 끝 쿠키 새로고침임 -->
<meta http-equiv="Expires" content="0"/>
<meta http-equiv="Pragma" content="no-cache"/>


<script>
    function del(href)
    {
        if(confirm("한번 삭제한 자료는 복구할 방법이 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }



</script>
<style>


.redbox{background-color:#f00;
	display:block;
	position:relative;
width:100px; height:100px;}

/*.half_space {

border:1px solid #fff;
}*/
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
	/*.col-sm-8{
		padding-top: 15px;
	}
	.col-sm-4{
		padding-top: 15px;
	}*/
	.read_content{
		/*float: left;*/
		padding: 0px 7px 25px 7px ;
		overflow-x:hidden;
		word-break:break-all;
	}
	.col-sm-41{
		padding-bottom: 10px;
	}
	#carousel{
		float: left !important;
	}
	.undersub{
		padding-top: 10px;
	}
	.undersub_rest{
		float: right;
	}
.undersub_nick{
	padding-left: 15px;
}
.undersub_nick_rest{
position:relative;
top : .5px;
}
.undersub_rest{
	position:relative;
	top : .5px;
}
.btn-danger{
	display:inline-block;
	background-color: #e54064;
	border-color: #e54064;
}

.btn-info {
		color: #fff;
		background-color: #29a1d8;
		border-color: #29a1d8;
		border-radius: 7px;
}

.glyphicon-time{
	margin-right: 1.5px;
}
.form-group{
	margin-top: 10px;
}
.write_button{
	float: right;
	margin: 6px 0px 6px 0px;
}
.label-danger{
	background-color: #e54064;
	position:relative;
}
.label-default{
	/*background-color: #e54064;*/
	position:relative;
	background-color:#f00;
 font-size:10px;
display:inline;
 width:500px !important;
 height:50px !important;
}
.merong {
position:relative;
display:inline-block;
top:1px;
width:auto;
height:22.2px;
/*background-color:#f00;*/
border-radius:3px;
font-size:12px;
padding: 3.5px 5px 0px 5px;
border: .5px solid #ccc;
}
.merong2 {
position:relative;
display:inline-block;
top:1.5px;
float:right;
margin-right:5px;
width:auto;
height:21px;
/*background-color:#f00;*/
border-radius:3px;
font-size:12px;
padding: 3.5px 5px 0px 5px;
border: .5px solid #ccc;
}
.merong3 {
position:relative;
display:inline-block;
top:1.5px;
margin:7px 5px 12px 0px;
width:auto;
height:21px;
background-color:#fff;
border-radius:3px;
font-size:11px;
color:#1061a1;
padding: 3.5px 5px 3.5px 5px;
border: .5px solid #1061a1;
}
.idmatch{
	/*height: 50px;*/
	float: right;
}
.ripple_content{
	/*border-bottom: .5px solid #f2f2f2;*/
	/*margin: 7px 0px 7px 0px;*/
	/*background-color: rgba(0,0,0,.01);*/
	margin: 3px 6px 6px 5px;
}
.rip_del {
	float:right;
	margin-right:7px;
}
.rrip_del{
	float:right;
	margin-right:-18px;
}

hr {
	margin-top: 10px;
	margin-bottom: 15px;
}
.ripple_show{
	border-bottom: .5px solid #f2f2f2;
	margin: 5px 0px;
}
.form-control{
	border: 1px solid #eee !important;
}
textarea:focus {
border:1px solid #eee !important;
box-shadow:inset 0 1px 1px rgba(0,0,0,.075),0 0 8px rgba(238,238,238,.6) !important;
}
.riripple{
	padding-left:7px;
}
.riripple_form{
	margin-bottom: 10px;
}
.riripple_wrap {
	margin:3px 0px 3px 0px;
	padding : 7px 25px 7px 25px;

	background-color:#f9f9f9;
	border-radius: 7px;

 }
 .riripple_left{
	 display: inline-block;
	 top:0px;
	 width:25px;
	 height:auto;
	 background-color: #f00;
 }
 .riripple_content{
	 display: inline-block;
	 word-break:break-all;

 }
 .rrip_content {
	 color:#525252;
	 word-break:break-all;
	 padding:5px 7px 0px 7px;

 }
 .regiday {
	 color:#aaa;
	 font-size:11.4px;
	 padding-left:7px;
	 margin-top:5px;
 }
 .rrip_title {
	 padding-left:5px;
 }
 .img_size{
	 overflow: hidden;

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
</script>
<script>
$(document).ready(function(){
    // Activate Carousel
    $("#myCarousel").carousel({interval: 3000});
//이부분 총 사진 갯수에 따라 달라지는 초로 계산해야된다 왜냐하면 저건 총 시간(초) 이기때문이다
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

// ajax 추천기능
function update_push(gbn, no){
var url="../makedream/push.php?table=<?=$table?>&num=<?=$item_num?>";
$.get(url, {gbn:gbn, no:no}, function(args){
$("#up_push<?=$item_num?>").html(args);
}
);
}

// 모달 띄울 때 ajax로 댓글을 미리 출력해놓기
$(document).ready(function(){
var url="../makedream/ripple.php?num=<?=$item_num?>";
$.get(url, function(args){
$(".ajax_ripple<?=$item_num?>").html(args);
});
});


</script>
<script>
function check_input(index)
{
var index;
var loginedid="<?=$userid?>";
var url="../makedream/ripple.php?table=<?=$table?>&num=<?=$item_num?>";

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
						document.ripple_form<?=$item_num?>.submit;
						var url="../makedream/ripple.php?num=<?=$item_num?>";

						$.get(url, {index:index}, function(args){
						$("#ajax_ripple").html(args);
						}
						);
				  	// document.ripple_form<?=$item_num?>.target = 'selfWin';
				    // window.name = 'selfWin';
						// // return false;
            //
						// document.ripple_form<?=$item_num?>.submit();
						// alert('댓글이 입력되었습니다 :)');
            //
						// reload();
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

//
function post(index)
{
	var index;
  var comment = document.getElementById("comment").value;
  var id = "$_SESSION['userid']";
  if(comment && id)
  {
    $.ajax
    ({
      type: 'post',
      url: '../makedream/insert_ripple1.php?&table=<?=$table?>&num=<?=$item_num?>',
      data:
      {
         user_comm:comment,
	     	 user_id:id
      },
      success: function (response)
      {
	    document.getElementById("all_comments").innerHTML=response+document.getElementById("all_comments").innerHTML;
	    document.getElementById("comment").value="";
        document.getElementById("username").value="";

      }
    });
  }

  return false;
}
</script>
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
						$img_name = "../makedream/data/".$img_name;
						?>
						<div class="img_size">
						<div id="myCarousel" class="carousel slide" data-ride="carousel">
							<!-- Indicators -->
					    <ol class="carousel-indicators">
								<?php
									if($file_count!=1) //사진이 한개만 있으면 리스트 모양 ● 이거 안생기게 하는거
									{
								 ?>
					      <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
								<?php
									}
							 ?>
								<?php
								if($file_count>1)
								{
									for($i=1; $i<$file_count; $i++)
									{
									?>
      					<li data-target="#myCarousel" data-slide-to="<?=$i ?>"></li>
								<?php
									}
								}
								 ?>
</ol>
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
										 $img_name = "../makedream/data/".$img_name;
										 ?>
										 <div class="item">
							         <img src="<?=$img_name ?>" alt="사진" width="<?=$image_width[$i]?>" height="<?=$image_height[$i]?>">
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
									<a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
										<span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
										<span class="sr-only">Previous</span>
									</a>
									<a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
										<span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
										<span class="sr-only">Next</span>
									</a>
									<?php
								}
									?>
								</div>
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
							<button type="button" class="btn btn-info" onclick="update_push('up','<?=$row['$item_num']?>')">
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
					<a href="../makedream/write_form3.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">
					<button type="button" class="btn btn-default">수정</button></a>&nbsp;
					<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">
					<button type="button" class="btn btn-default">삭제</button></a>
					<?php
						}
					?>
				</div>
				<br><br>
				<?php
			 		}
			  ?>

<!-- 리플 출력-->
<div id="ripple">
		<div class="ripple">
			<h4><span class="label label-danger">comment</span></h4>
			<form name="ripple_form<?=$item_num?>" method="post" action="" onsubmit="return post(<?=$item_num?>);">
				<div class="form-group">
					<!-- <input type=text name=rep> -->
					<textarea  class="form-control" rows="5" id="comment" name="ripple_content" style="resize: none;" placeholder="댓글을 입력하세요 :)"></textarea>
					<!-- <div class="write_button"><button  type="button" id="insert_ripple_btn" class="btn btn-info btn-sm" onclick="check_input(<?=$item_num?>)"><b>댓글달기</b></button></div> -->
					<div class="write_button"><button  type="submit" id="insert_ripple_btn" class="btn btn-info btn-sm"><b>댓글달기</b></button></div>
				</div>
			</div>
			</form>
			<br>

			<div class="ajax_ripple<?=$item_num?>">
			</div>

				</div>
			</div>
		</div>


<div id="write">
<?php
	if($_SESSION['userid'] && ($_SESSION['userid']==$item_id))
	{
?>
				<a href="../makedream/write_form3.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정하기</a>&nbsp;
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

    <!-- <div id="main-footer"> -->

    <!-- </div> -->
	</div> <!-- view content-->
</div> <!-- modal body -->


  </body>
</html>