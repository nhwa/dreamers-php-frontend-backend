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
  <!-- <link href="./css/style3.css" rel="stylesheet"> -->
  <link href="./css/needpopup.min.css" rel="stylesheet" >
  <!-- bootstrap + jquery -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
  <script src="https://code.jquery.com/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

  <!-- include summernote css/js-->
<link href="./summernote/summernote.css" rel="stylesheet">
<script src="./summernote/summernote.js"></script>
<!-- summer note korean language pack -->
<script src="./summernote/lang/summernote-ko-KR.js"></script>
<script type="text/javascript">
  $(function() {
    $('.summernote').summernote({
      height: 300,          // 기본 높이값
      minHeight: null,      // 최소 높이값(null은 제한 없음)
      maxHeight: null,      // 최대 높이값(null은 제한 없음)
      focus: true,          // 페이지가 열릴때 포커스를 지정함
      lang: 'ko-KR'         // 한국어 지정(기본값은 en-US)
    });
  });
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
     		    <?php   include "./lib/index-head.php";  ?>
             <div id = "logo">

                <a href="./newindex.php"><img src = "./img/logoi.png" width=150px; height=auto; /></a>
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

           <!-- 컨텐츠 게시판 부분 -->
  <div class="container">
    <h3 class="page-header">당신의 버킷리스트를 만들어보세요.</h3>
    <form class="form-horizontal">
      <div class="form-group">
        <!-- <label for="subject" class="col-sm-2 control-label">제　　목</label> -->
        <div class="col-sm-10">
          <input type="text" name="subject" class="sub_summernote" placeholder="제목을 입력하세요">
</div>
      </div>
      <div class="form-group">
        <!-- <label for="content" class="col-sm-2 control-label">내용입력</label> -->
        <div class="col-sm-10">
          <textarea name="content" id="content" class="summernote" placeholder="내용입력"></textarea>
        </div>
      </div>
      <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
          <button type="submit" class="btn btn-default">Save</button>
        </div>
      </div>
    </form>
  </div>
<!-- 게시판 끝 -->

<div class=clear>
</div>

<!-- footer시작 -->
<div id="main-footer">
    <?php  include "./lib/index-footer.php"; ?>
</div>

</div> <!--wrapper 끝-->
</div><!--page-wrapper 끝-->
</body>
</html>

<?php } ?>
