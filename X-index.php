<!DOCTYPE html>
<html>

<meta charset="utf-8">
<meta name="description" content="">

<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link href="./css/style4.css" rel="stylesheet">
<link href="./css/needpopup.min.css" rel="stylesheet" >
  <head>

    <title>DreamUs, 당신의 꿈 그리고 우리</title>
  </head>

 <body style="overflow-x:hidden; overflow-y:auto;">
  <a href="#myAnchor" class="go-top">▲</a>

   <div id ="page-wrapper">
   <div class="wrapper" id="myAnchor" >


                <!-- 헤더 메뉴 -->
    <header id = "main-navi">
		    <?php   include "./lib/index-header.php";  ?>
        <div id = "logo">

           <a href="#"><img src = "./img/logoi.png" width=150px; height=auto; /></a>
         </div>
    </header>
    <!-- 헤더 메뉴 (로그인,검색 등 끝) -->
    <div class=clear>
    </div>




      <!-- 로고부분 -->

      <!-- 로고부분 끝 -->

      <div class=clear>
      </div>

<!-- 컨텐츠 게시판 부분 -->
            <div class="bk-list-nav">
              <?php include "./lib/index-content.php"; ?>
            </div>
<!-- 게시판 끝 -->
<div class=clear>
</div>



<!--
            <div id ="topmove">
            <div style ="position : fixed; bottom : 50px; right : 30px;">
            <a href="#topmove">
              <img src="topblack.png" onmouseover="this.src='topblue.png';" onmouseout="this.src='topblack.png';" width = "30px" height = "auto"></a>

</div>
</div>
              -->



    <div id="main-footer">
        <?php  include "./lib/index-footer.php"; ?>
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
