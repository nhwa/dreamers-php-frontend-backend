<?php
	session_start();
	$uip=setcookie('userip','{$_SERVER[REMOTE_ADDR]}',time()+180);


	include "../lib/dbconn.php";

$mode=$_GET['mode'];

	if ($mode=="modify")
	{
		$sql = "select * from $table where num=$num";
		$result = mysql_query($sql, $connect);
		$row = mysql_fetch_array($result);

		$item_subject     = $row[subject];
		$item_content     = $row[content];
		$item_file_0 = $row[file_name_0];
		$item_file_1 = $row[file_name_1];
		$item_file_2 = $row[file_name_2];

		$copied_file_0 = $row[file_copied_0];
		$copied_file_1 = $row[file_copied_1];
		$copied_file_2 = $row[file_copied_2];
	}


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<title>이거슨 글을 쓰는 곳이여</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<!-- <link href="./css/style3.css" rel="stylesheet"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="../css/needpopup.min.css" rel="stylesheet" >


<script>
  function check_input()
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
      document.board_form.submit();
   }


</script>
</head>


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
		<div class="clear"></div>

		<div id="write_form_title">
			<img src="../img/write_form_title.gif">
		</div>
		<div class="clear"></div>
<?php
	if($mode=="modify")
	{
?>
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?php echo $num; ?>&page=<?php echo $page; ?>&table=<?php echo $table; ?>" enctype="multipart/form-data">
<?php
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?php echo $table; ?>" enctype="multipart/form-data">
<?php
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 닉네임 </div><div class="col2"><?php echo $_SESSION['usernick']; ?></div>
<?php
	if( $userid && ($mode != "modify"))
	{
?>
				<!-- <div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div> -->
<?php
	}
?>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 카테고리   </div>
													 <div class="col2">
														 <select name="sel_cate" class="sel_cate">
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
													 </div>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="subject" value="<?php echo "$item_subject"; ?>" placeholder="제목" autocomplete="off"></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content" placeholder="내용을 입력하세요." autocomplete="off"><?php echo "$item_content"; ?></textarea></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row4"><div class="col1"> 이미지 업로드(3개까지)   </div>
			                     <div class="col2"><input type="file" name="upfile[]" multiple></div>
			</div>
			<div class="clear"></div>
<?php 	if ($mode=="modify" && $item_file_0)
	{
?>
			<div class="delete_ok"><?php echo $item_file_0; ?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?php
	}
?>


			</div>
<?php 	if ($mode=="modify" && $item_file_1)
	{
?>
			<div class="delete_ok"><?php echo $item_file_1; ?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
			<div class="clear"></div>
<?php
	}
?>
			<div class="write_line"></div>
			<div class="clear">

			</div>
<?php 	if ($mode=="modify" && $item_file_2)
	{
?>
			<div class="delete_ok"><?php=$item_file_2?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="2"> 삭제</div>
			<div class="clear"></div>
<?php
	}
	// 확인용
	// echo ("<script> window.alert($mode) </script>");
		// echo ("<script> window.alert(document.board_form.content.value) </script>");
?>
			<div class="write_line"></div>

			<div class="clear"></div>
		</div>

		<div id="write_button"><a href="#">
			<button type="button" value="작성하기" onclick="check_input()">작성하기</button></a>&nbsp;
								<a href="list.php?table=<?php echo $table; ?>&page=<?php echo $page; ?>"><img src="../img/list.png"></a>
		</div>
		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
	<div class=clear>
	</div>
	<div id="main-footer">
			<?php  include "../lib/index-footer.php"; ?>
	</div>
	</div>
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
<!--
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
	</script> -->


</div> <!-- end of wrap -->

</body>
</html>
