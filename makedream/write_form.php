<?php
	session_start();
	include "../lib/dbconn.php";

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
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요1");
          document.board_form.subject.focus();
          return;
      }

      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
			location.href='insert.php?mode=11';
   }
</script>
</head>

<body>
<div id="wrap">
  <div id="header">
    <?php include "../lib/top_login2.php"; ?>
  </div>  <!-- end of header -->

  <div id="menu">
	<?php include "../lib/top_menu2.php"; ?>
  </div>  <!-- end of menu -->

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
		<form  name="board_form" method="post" action="insert.php?mode=modify&num=<?php=$num?>&page=<?php=$page?>&table=<?php=$table?>" enctype="multipart/form-data">
<?php
	}
	else
	{
?>
		<form  name="board_form" method="post" action="insert.php?table=<?php=$table?>" enctype="multipart/form-data">
<?php
	}
?>
		<div id="write_form">
			<div class="write_line"></div>
			<div id="write_row1"><div class="col1"> 별명 </div><div class="col2"><?php=$usernick?></div>
<?php
	if( $userid && ($mode != "modify"))
	{
?>
				<div class="col3"><input type="checkbox" name="html_ok" value="y"> HTML 쓰기</div>
<?php
	}
?>
			</div>
			<div class="write_line"></div>
			<div id="write_row2"><div class="col1"> 제목   </div>
			                     <div class="col2"><input type="text" name="subject" value="<?php=$item_subject?>" ></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row3"><div class="col1"> 내용   </div>
			                     <div class="col2"><textarea rows="15" cols="79" name="content"><?php=$item_content?></textarea></div>
			</div>
			<div class="write_line"></div>
			<div id="write_row4"><div class="col1"> 이미지파일1   </div>
			                     <div class="col2"><input type="file" name="upfile[]" multiple></div>
			</div>
			<div class="clear"></div>
<?php 	if ($mode=="modify" && $item_file_0)
	{
?>
			<div class="delete_ok"><?php=$item_file_0?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="0"> 삭제</div>
			<div class="clear"></div>
<?php
	}
?>


			</div>
<?php 	if ($mode=="modify" && $item_file_1)
	{
?>
			<div class="delete_ok"><?php=$item_file_1?> 파일이 등록되어 있습니다. <input type="checkbox" name="del_file[]" value="1"> 삭제</div>
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
?>
			<div class="write_line"></div>

			<div class="clear"></div>
		</div>

		<div id="write_button"><a href="#"><img src="../img/ok.png" onclick="check_input()"></a>&nbsp;
								<a href="list.php?table=<?php=$table?>&page=<?php=$page?>"><img src="../img/list.png"></a>
		</div>
		</form>

	</div> <!-- end of col2 -->
  </div> <!-- end of content -->
</div> <!-- end of wrap -->

</body>
</html>
