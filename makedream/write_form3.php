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
		$item_file[0] = $row[file_name_0];
		$item_file[1] = $row[file_name_1];
		$item_file[2] = $row[file_name_2];

		$copied_file[0] = $row[file_copied_0];
		$copied_file[1] = $row[file_copied_1];
		$copied_file[2] = $row[file_copied_2];

		if($item_file[2])
		{
			$file_count=3;
		}
		else if($item_file[1])
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
		if ($copied_file[$i])
		{
			$imageinfo = GetImageSize("./data/".$copied_file[$i]);
			$image_width[$i] = $imageinfo[0];
			$image_height[$i] = $imageinfo[1];
			$image_type[$i]  = $imageinfo[2];

			// echo "width1 : $image_width[$i]<br>height1 :$image_height[$i]";

			// if ($image_width[$i] > 460)
			// 	$image_width[$i] = 460;

			// if($image_height[$i]>412.5)
			$image_width[$i]=100;
			$image_height[$i]=80;
			// $image_width[$i]=$image_height[$i]*$imageinfo[0]/$imageinfo[1];
      //
			// if($image_width[$i] < 568){
			// 	$image_width[$i]=568;
			// }
			// echo "width : $image_width[$i]<br>height :$image_height[$i]";

		}
	}

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta charset="utf-8">
<title>Dreamers, 당신의 꿈 그리고 우리</title>
    <link rel="icon" href="../lib/favicon_img/favicon.ico" type="image/ico">
<link href="../css/write_form1.css" rel="stylesheet" type="text/css" media="all">
<!-- <link href="../css/common1.css" rel="stylesheet" type="text/css" media="all">
<link href="../css/board4.css" rel="stylesheet" type="text/css" media="all"> -->
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<link href="../css/needpopup.min.css" rel="stylesheet" >
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>

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

<script>
function return_check(){
	location.href='../lib/newindex.php';
}
</script>

	<style type="text/css">
    input[type=file] {
        display: none !important;
    }
    .my_button {
        display: inline-block;
        width: 160px;
        text-align: center;
        padding: 10px;
        background-color:#A8A8A8;
        color: #fff;
				font-size:19px;
        text-decoration: none;
        border-radius: 5px;
    }
    .imgs_wrap {
        border: 2px solid #A8A8A8;
				margin-right: 93px;
				margin-top: 15px;
        margin-bottom: 15px;
        padding-top: 10px;
        padding-bottom: 10px;

    }
    .imgs_wrap img {
        max-width: 150px;
        margin-left: 10px;
        margin-right: 10px;
    }
	</style>

    <script type="text/javascript" src="./js/jquery-3.1.0.min.js" charset="utf-8"></script>
    <script type="text/javascript">
		function modify_submit(){

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

									 alert("수정되었습니다 :D");
									document.board_form.submit();
				}



        // 이미지 정보들을 담을 배열
        var sel_files = [];
        $(document).ready(function() {

            $("#input_imgs").on("change", handleImgFileSelect);
        });

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

        function handleImgFileSelect(e) {

            // 이미지 정보들을 초기화
            sel_files = [];
            $(".imgs_wrap").empty();

            var files = e.target.files;
            var filesArr = Array.prototype.slice.call(files);

            var index = 0;
            filesArr.forEach(function(f) {
                if(!f.type.match("image.*")) {
                    alert("확장자는 이미지 확장자만 가능합니다.");
                    return;
                }

                sel_files.push(f);

                var reader = new FileReader();
                reader.onload = function(e) {
                    var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
                    $(".imgs_wrap").append(html);
                    index++;

                }
                reader.readAsDataURL(f);

            });
        }

        function deleteImageAction(index) {
            console.log("index : "+index);
            console.log("sel length : "+sel_files.length);

            sel_files.splice(index, 1);

            var img_id = "#img_id_"+index;
            $(img_id).remove();
        }

        function fileUploadAction() {
            console.log("fileUploadAction");
            $("#input_imgs").trigger('click');
        }

				//submit 거셔야돼

        function submitAction() {
            console.log("업로드 파일 갯수 : "+sel_files.length);
            var data = new FormData();

            for(var i=0, len=sel_files.length; i<len; i++) {
                var name = "image_"+i;
                data.append(name, sel_files[i]);
            }
            data.append("image_count", sel_files.length);

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


           if(sel_files.length < 1) {
               alert("1개이상의 파일을 선택해주세요.");
               return;
           }

						if(sel_files.length > 3) {
               alert("3개이하의 파일을 선택해주세요.");
               return;
           }
						document.board_form.submit();
        }

    </script>
<?php
		if($mode=="modify"){
?>

<script type="text/javascript">
		// 이미지 정보들을 담을 배열
		var sel_files = [];
		$(document).ready(function() {

				$("#select_category").val("<?=$item_category?>");

				$("#input_imgs").on("change", handleImgFileSelect);
		});

		function fileUploadAction() {
				console.log("fileUploadAction");
				$("#input_imgs").trigger('click');
		}

		function handleImgFileSelect(e) {

				// 이미지 정보들을 초기화
				sel_files = [];
				$(".imgs_wrap").empty();

				var files = e.target.files;
				var filesArr = Array.prototype.slice.call(files);

				var index = 0;
				filesArr.forEach(function(f) {
						if(!f.type.match("image.*")) {
								alert("확장자는 이미지 확장자만 가능합니다.");
								return;
						}

						sel_files.push(f);

						var reader = new FileReader();
						reader.onload = function(e) {
								var html = "<a href=\"javascript:void(0);\" onclick=\"deleteImageAction("+index+")\" id=\"img_id_"+index+"\"><img src=\"" + e.target.result + "\" data-file='"+f.name+"' class='selProductFile' title='Click to remove'></a>";
								$(".imgs_wrap").append(html);
								index++;

						}
						reader.readAsDataURL(f);

				});
		}

		function deleteImageAction(index) {
				console.log("index : "+index);
				console.log("sel length : "+sel_files.length);

				sel_files.splice(index, 1);

				var img_id = "#img_id_"+index;
				$(img_id).remove();
		}

		function fileUploadAction() {
				console.log("fileUploadAction");
				$("#input_imgs").trigger('click');
		}

		//submit 거셔야돼

		function submitAction() {
				console.log("업로드 파일 갯수 : "+sel_files.length);
				var data = new FormData();

				for(var i=0, len=sel_files.length; i<len; i++) {
						var name = "image_"+i;
						data.append(name, sel_files[i]);
				}
				data.append("image_count", sel_files.length);

				if(sel_files.length < 1) {
						alert("1개이상의 파일을 선택해주세요.");
						return;
				}

				if(sel_files.length > 3) {
						alert("3개이하의 파일을 선택해주세요.");
						return;
				}
				document.board_form.submit();
		}

</script>
<?php } ?>



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
			<td class="tdsize"><textarea rows="24" cols="88" name="content" placeholder="내용을 입력하세요." autocomplete="off" class="content_write"><?php echo "$item_content"; ?></textarea></td></tr>
<?php
	if($mode!="modify")
	{
?>
		<tr>
			<td class="tdsize">
				<!-- button tag 추가 -->
				<!-- 이미지 업로드 최대3장 -->
				<!-- <input type="text" id="fileName" class="file_input_textbox" readonly="readonly"/><div class="file_input_div">
				<input type="button" value="파일찾기" class="file_input_button" />
				<input type="file" id="file" class="file_input_hidden" onchange="fileNameInput()" name="upfile[]" multiple/></div>-->
				    <div>
				        <div class="input_wrap">
				            <a href="javascript:" onclick="fileUploadAction();" class="my_button">파일 업로드</a>
				            <input type="file" id="input_imgs" name="upfile[]" multiple/>
				        </div>
				    </div>
				    <div>
				        <div class="imgs_wrap">
				            <img id="img" />
				        </div>
				    </div>
						<li style="color:#EAEAEA; margin-top:-7px; font-size:13px;">1개이상 3개이하의 파일만 첨부가 가능합니다.</li>
						<li style="color:#EAEAEA; margin-top: 1px; font-size:13px;">(50MB이하 / PNG,JPG,GIF 형식만 첨부가능)</li>
						<!-- <li style="color:#EAEAEA; margin-top: 1px; font-size:13px;">글 작성 후 사진 수정이 불가능하니 신중하게 선택해주세요 :)</li><br> -->

<!--<a href="javascript:" class="my_button" onclick="submitAction();">업로드</a> -->

			</td></tr>
<?php } ?>
</table>

<!-- <div id="write_button"><a href="#"> -->

<?php
// $row=mysql_num_rows($result);
// echo "<script>window.alert('$image_num')</script>";
//
// if ($mode=="modify" && $item_file[0])
// {
// 	$img_name = $copied_file[0];
// 	$img_name = "../makedream/data/".$img_name;
?>
<!-- <div class="delete_pics">

<div class="delete_ok">

<input type="checkbox" name="del_file[]" id="del_check0" value="0">
<label for="del_check0"><img src="<?=$img_name?>" class="show_saved_pics" width="100px" height="80px"></label></div> -->
<?php
// }
// if ($mode=="modify" && $item_file[1])
// {
// 	$img_name = $copied_file[1];
// 	$img_name = "../makedream/data/".$img_name;
?>
	<!-- <div class="delete_ok">

		<input type="checkbox" name="del_file[]" id="del_check1" value="1">
	<label for="del_check1"><img src="<?=$img_name?>" class="show_saved_pics" width="100px" height="80px"></label></div> -->
<?php
// }
// if ($mode=="modify" && $item_file[2])
// {
// 	$img_name = $copied_file[2];
// 	$img_name = "../makedream/data/".$img_name;
?>
	<!-- <div class="delete_ok">

		<input type="checkbox" name="del_file[]" id="del_check2" value="2">
	<label for="del_check2"><img src="<?=$img_name?>" class="show_saved_pics" width="100px" height="80px"></label></div> -->
<?php
// }
// 확인용
// echo ("<script> window.alert($mode) </script>");
// echo ("<script> window.alert(document.board_form.content.value) </script>");
?>
<!-- </div> -->

<?php
if($mode=="modify")
{
?>
<button type="button" value="수정하기" class="write" onclick="modify_submit()">수정하기</button>
<?php } else{ ?>
<button type="button" value="작성하기" class="write" onclick="submitAction();">작성하기</button>
						<!-- <a href="list.php?table=<?php=$table ?>&page=<?=$page ?>">리스트</a> -->
<?php } ?>

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
