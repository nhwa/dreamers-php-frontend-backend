<?php
	session_start();

error_reporting(0);
	include "../lib/dbconn.php";

$table=$_GET['table'];
$mode=$_GET['mode']; //수정을 받기 위해서 한다.
$num=$_GET['num'];
$page=$_GET['page'];

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);

		$item_category = $row[category];
		$item_subject  = $row[subject];
		$item_content  = $row[content];
		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];

		if($item_file_2)
		{
			$file_count=3;
		}

		else if($item_file_1)
		{
			$file_count=2;
		}

		else
		{
			$file_count=1;
		}
	}

	for ($i=0; $i<3; $i++)
	{
		if ($copied_file_0[$i])
		{
			$imageinfo = GetImageSize("./data/".$copied_file_0[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			// echo "width1 : $image_width[$i]<br>height1 :$image_height[$i]";

			// if ($image_width[$i] > 460)
			// 	$image_width[$i] = 460;

			// if($image_height[$i]>412.5)
			$image_height[$i]=412;
			$image_width[$i]=$image_height[$i]*$imageinfo[0]/$imageinfo[1];

			if($image_width[$i] < 568){
				$image_width[$i]=568;
			}
			// echo "width : $image_width[$i]<br>height :$image_height[$i]";

		}

	}



?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<title>이거슨 글을 쓰는 곳이여</title>
<link href="../css/write_form1.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="../css/common1.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all"> -->
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="../css/needpopup.min.css" rel="stylesheet" >
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

<style>
.select {border:1px solid #d7d7d7; padding:3px; display:inline-block; *display:inline; zoom:1; background:#fff; height:16px;}
.select i {position:relative; display:block; overflow:hidden; height:17px;}
.select select {font-family:"NerisLight"; position:absolute; width:103%; top:-2px; left:-2px; right:-2px}
input[type=checkbox]{
	display: inline-block;
}

textarea { opacity:0.7;}
input[type=text] {
	opacity:0.7;
}
select{
	opacity:0.7;
}

</style>
<?php
// if(!$mode==modify)
// {
?>

<script>
function fileNameInput(){
// $('input[type=file]').get(0).files.length;
 var fName = $('#file').val().split("\\");
 // var fileCount = $('#file').get(0).files.length;
 // window.alert($('#file').get(0).files.length);
 if($('#file').get(0).files.length == 1){
    $('#fileName').val($(fName)[2]);

	}
 else{
	 $('#fileName').val('파일 '+$('#file').get(0).files.length +'개');
 }
}
</script>
<?php
// }
// else
// {
?>

<script>

$(function() {
	$("#select_category").val("<?=$item_category?>");

	var file_count=<?=$file_count?>;
	if(file_count ==3)
	{
	$("#fileName").val('파일 3개');
}
	else if(file_count ==2){
	$("#fileName").val('파일 2개');
}
else
{
	$("#fileName").val('<?=$item_file_0?>');
}

});

</script>
<?php
// }
?>

<script>
function return_check(){
	location.href='../lib/newindex.php';
}
</script>

<script>
  function check_input(index)
	{
		if(index=="2")
   {
     // 카테고리 선택 안된거 선택하게 추가
		 if(document.board_form.sel_cate.value=="cate")
		 {
			 alert("카테고리를 선택해주세요!");
			 document.board_form.sel_cate.focus();
			 return;
		 }

      if (document.board_form.subject.value == "")
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }

      if (document.board_form.content.value == "")
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }

			if($('#file').get(0).files.length < 1)
			{
				alert("1개 이상의 파일을 첨부하세요!");
				document.board_form.content.focus();
				return;
			}

			if($('#file').get(0).files.length > 3)
			{
				alert("3개 이하의 파일을 첨부하세요!");
				document.board_form.content.focus();
				return;
			}

      document.board_form.submit();
   }
	 if(index=="1")
	 {

		if(document.board_form.sel_cate.value=="cate")
		{
			alert("카테고리를 선택해주세요!");
			document.board_form.sel_cate.focus();
			return;
		}

			if (document.board_form.subject.value == "")
			{
					alert("제목을 입력하세요!");
					document.board_form.subject.focus();
					return;
			}

			if (document.board_form.content.value == "")
			{
					alert("내용을 입력하세요!");
					document.board_form.content.focus();
					return;
			}
					if($('#file').get(0).files.length > 3)
					{
						alert("3개 이하의 파일을 첨부하세요!");
						document.board_form.content.focus();
						return;
					}

			document.board_form.submit();
	 }

 }


</script>
<style>
	body {
		background-image: url(../img/bg4.jpg);
		/*background-size:100%;*/
		background-size: cover;
		/*background-position:right;*/
		/*background-*/
		height:100%;

	}
</style>
</head>

 <body style="overflow-x:hidden; overflow-y:auto;">

	 <!-- <img src = "../img/bg.jpeg" /> -->


   <div class=clear></div>
  <!-- <a href="#myAnchor" class="go-top">▲</a> -->

   <div id ="page-wrapper">
   <div class="wrapper" id="myAnchor" >

   <div class=clear></div>
                <!-- 헤더 메뉴 -->
    <header id = "main-navi">
		    <?php   include "../lib/index-head.php";  ?>
        <div id = "logo">

           <a href="../lib/newindex.php"><img src = "../img/logoi.png" width=150px; height=auto; /></a>
         </div>
    </header>
    <!-- 헤더 메뉴 (로그인,검색 등 끝) -->
     <div class=clear></div>

	<div id="content">
		<?php
			if($mode=="modify")
			{
		?>
				<form  name="board_form" method="post" action="./insert.php?mode=modify&num=<?=$num ?>&table=<?=$table ?>" enctype="multipart/form-data">
		<?php
			}
			else
			{
		?>
				<form  name="board_form" method="post" action="./insert.php?table=<?=$table ?>" enctype="multipart/form-data">
		<?php
			}
		?>
					<table border="0" width="730">
					<tr>
						<!-- <td class="tdsize">닉네임</td> -->
						<td class="tdsize"><button type="button" class="btn btn-danger btn-xs">
							<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
							&nbsp;<?= $_SESSION['usernick'] ?></button> </td></tr>
		<?php
			if( $userid && ($mode != "modify"))
			{
		?>
						<!-- <div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div> -->
		<?php
	}
		?>
		<tr>
			<!-- <td class="tdsize">카테고리</td> -->
			<td class="tdsize"> <select name="sel_cate" class="sel_cate" id="select_category"> <!-- onchange 써야하는디!!-->
			 <!-- <optgroup label="카테고리" selected> -->
			 <option value="cate" selected disabled>카테고리</option>
			 <option value="travel">Travel</option>
			 <option value="sport">Sport</option>
			 <option value="food">Food</option>
			 <option value="skill">Skill</option>
			 <option value="culture">Culture</option>
			 <option value="shopping">Shopping</option>
			 <option value="lifestyle">Life Style</option>
			 <!-- </optgroup> -->
		 </select>
		<!-- <tr><td class="tdsize">제목</td> -->&nbsp;&nbsp;
		<input type="text" class="subject" name="subject" value="<?php echo "$item_subject"; ?>" placeholder="제목" autocomplete="off" size="73px"></td></tr>
<tr><td>
	<!-- <div class="line1"><div class="line2"> -->
</td></tr>
		<tr>
			<!-- <td class="tdsize">내용</td> -->
			<td class="tdsize"><textarea rows="27" cols="88" name="content" placeholder="내용을 입력하세요." autocomplete="off" class="content_write"><?php echo "$item_content"; ?></textarea></td></tr>

		<tr>
			<td class="tdsize">
				<!-- button tag 추가 -->
				<!-- 이미지 업로드 최대3장 -->
				<input type="text" id="fileName" class="file_input_textbox" readonly="readonly"/>
				<div class="file_input_div">
				<input type="button" value="파일찾기" class="file_input_button" />
				<input type="file" id="file" class="file_input_hidden" onchange="fileNameInput()" name="upfile[]" multiple />
			</div>
		</td>
	</tr>

		<?php 	if ($mode=="modify" && $item_file_0)
			{
		?>
					<div class="delete_pics">
					<div class="delete_ok">
							<img src="
							<?=
							?>
							" class="show_saved_pics" width="100px" height="80px">
						<input type="checkbox" name="del_file[]" value="0"> 삭제</div>
		<?php
			}
	if ($mode=="modify" && $item_file_1)
			{
		?>
					<div class="delete_ok"><?php echo $item_file_1; ?><input type="checkbox" name="del_file[]" value="1"> 삭제</div>
		<?php
			}
		?>
					<div class="write_line"></div>
		<?php 	if ($mode=="modify" && $item_file_2)
			{
		?>
					<div class="delete_ok"><?php=$item_file_2?><input type="checkbox" name="del_file[]" value="2"> 삭제</div>
				</div>
		<?php
			}
			// 확인용
			// echo ("<script> window.alert($mode) </script>");
			// 	echo ("<script> window.alert(document.board_form.content.value) </script>");
		?></table>
				<!-- <div id="write_button"><a href="#"> -->
<li style="color:#EAEAEA; margin-top:-7px; font-size:13px;">1개이상 3개이하의 파일만 첨부가 가능합니다.</li>
<li style="color:#EAEAEA; margin-top: 1px; font-size:13px;">(50MB이하 / PNG,JPG,GIF 형식만 첨부가능)</li>
					<button type="button" value="작성하기" class="write" <?php if($mode=="modify" && (($item_file_0)||($item_file_1)||($item_file_2))){ $index="1"; } else { $index="2"; } ?>
					onclick="check_input(<?=$index?>)">작성하기</button></a>
										<!-- <a href="list.php?table=<?php=$table ?>&page=<?=$page ?>">리스트</a> -->

			<?php
			if($mode=="modify")
			{
				?>
			<input type="button" value="돌아가기" class=reset onclick="return_check()" />
		<?php
	}
	else {?>
					<input type="reset" value="취소하기" class="reset"/>
				<?php } ?>
				<!-- </div> -->

				</form>


		  </div> <!-- end of content -->
			<div class=clear>
			</div>

		</div> <!--wrapper-->
		</div> <!-- page wrapper-->


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

		</body>
		</html>
