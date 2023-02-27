<?php
  session_start();
 ?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <title>글쓰기 페이지</title>

  <link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
  <link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
  <link href="../css/style3.css" rel="stylesheet">
  <link href="../css/needpopup.min.css" rel="stylesheet" >
    <link href="../css/make_form.css" rel="stylesheet" >

  <!-- include libraries(jQuery, bootstrap) -->
  <link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>
  <script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>

  <!-- include summernote css/js-->
  <link href="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">
  <script src="http://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.js"></script>

  <!-- include summernote css/js-->
<link href="../summernote/summernote.css" rel="stylesheet">
<script src="../summernote/summernote.js"></script>
<!-- summer note korean language pack -->
<script src="../summernote/lang/summernote-ko-KR.js">
$('#summernote').summernote();

$(document).ready(function() {
	$('#summernote').summernote({
		lang : 'ko-KR' //default : 'en-US'

  });
	});
</script>



<!--입력 함수-->
<!-- <script>
var edit = function() {
  $('.click2edit').summernote({focus: true});
};

var save = function() {
  var markup = $('.click2edit').summernote('code');
  $('.click2edit').summernote('destroy');
};
</script> -->


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
           <?php
           error_reporting(0);

             if(!$_SESSION['userid']){
            ?>
         로그인하세요.
           <?php
             }
             else {
           ?>
          <div class=clear></div>
<div class="toptoptop">
</div>
          <div class=clear></div>

           <!-- 컨텐츠 게시판 부분 -->
           <div class="bk-list-nav">
           <div class="container">
             <div class="makeyourdream">당신의 버킷리스트를 작성해보세요 :D</div>

             <div class="sub_summernote">
               <input type="text" class="subjecttext" name="subject" placeholder="제목을 입력하세요 :)" autocomplete="off" />
             </div>
    <div id="summernote"></div>
    <script>
    $('#summernote').summernote({
      options: {disableDragAndDrop: false},
      height: 500,                 // set editor height
      minHeight: null,             // set minimum height of editor
      maxHeight: null,             // set maximum height of editor
      focus: true,                  // set focus to editable area after initializing summernote
      placeholder: '내용을 입력하세요 :)'
        });
    </script>
    <!-- <form>
    <textarea id="summernote"></textarea>
    <button type="button" id="write">글쓰기</button>
</form> -->

  </div><!--container 끝-->
</div><!--bk-list-nave 끝-->
<!-- 게시판 끝 -->

<div class=clear>
</div>

<!-- footer시작 -->
<div id="main-footer">
    <?php  include "../lib/index-footer.php"; ?>
</div>

</div> <!--wrapper 끝-->
</div><!--page-wrapper 끝-->
</body>
</html>

<?php } ?>
