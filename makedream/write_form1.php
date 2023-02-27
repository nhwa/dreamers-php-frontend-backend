<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<title>이거슨 글을 쓰는 곳이여</title>
<link href="../css/common.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/write_from.css" rel="stylesheet" type="text/css" media="all">

</head>

<body>

	<div class="clear"></div>

<div id ="pageWrap">
	<div id="header">
		<?php
		include "../lib/index-head.php";
		 ?>
	</div>
	<!--헤더 끝-->


	<!-- 중앙 글작성 부분 시작 -->
	<div id = "main">
		<?php
		include "write_form.php";
		 ?>
		<!-- 좌측 메뉴 선택자 -->
		<div class="menu">

			<div class="file">
			</div>
			<div class="category">
			</div>
			<div class="tag">
			</div>
		 </div> <!-- 좌측 메뉴선택자 끝 -->

		<div class="menu1"> <!-- 우측 내용 작성 -->
			<div class="title">
				<!-- 제목 -->
			</div>
			<div class="content">
				<!-- 내용 -->
			</div>
			<div class="submit">
			</div>
		</div>
	</div>

</div>

<div id="footer">
	<?php
	include "../lib/index-footer.php";
	?>
</div>

</body>
</html>
