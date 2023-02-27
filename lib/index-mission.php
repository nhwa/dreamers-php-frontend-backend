<?php
  session_start();
  error_reporting(0);



  // $userip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장

// $ips = $_SERVER[REMOTE_ADDR];
//   $uip=setcookie('userip',$ips,time()+180,'/');
//         $_SESSION['usersip']=$_SERVER['REMOTE_ADDR'];
//
// echo ("<script> window.alert('$uip');</script>");
// echo ("<script> window.alert('{$_SESSION['usersip']}');</script>");
$mode=$_GET['mode'];
$category=$_GET['category'];
$page=($_GET['page'])?$_GET['page']:1;
$now=$_GET['now'];
 ?>

<!DOCTYPE html>
<html>

<meta charset="utf-8">
<meta name="description" content="">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">

<link href="../css/style-all.css" rel="stylesheet">

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" /> -->
<!-- <link href="../css/needpopup.min.css" rel="stylesheet" > -->

<!--top-move 탑으로 스크롤!-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script>
    /*Add class when scroll down*/
    $(window).scroll(function(event){
        var scroll = $(window).scrollTop();
        if (scroll > 30) {
            $(".go-top").addClass("show");
        } else {
            $(".go-top").removeClass("show");
        }
    });


        $(window).scroll(function(event){
            var scroll = $(window).scrollTop();
            if (scroll >= 50) {
                $(".write-top").addClass("show");
            } else {
                $(".write-top").removeClass("show");
            }
        });
    /*Animation anchor*/
    $('a').click(function(){
        $('html, body').animate({
            scrollTop: $( $(this).attr('href') ).offset().top
        }, 1000);
    });
    </script>

      <head>
            <style>
            body{
              overflow-x: hidden;

              background-image: url(../img/bg9.jpeg);
              background-size:cover;
            }
            /*.overw{
              position:relative;
              top : 300px;
              width:100px;
              height:auto;
              margin:0px 50px 0px 50px;
              z-index:9999;
            }*/

            .getout{
              /*background-color:#f00;*/
              position:relative;
              margin:8% 20% 0% 20%;
              padding:2%;
              background-color:rgba(255,255,255,0.8);
              max-height:1200px;
              min-width:890px;
              border-radius: 7px;
            }
            #page-wrapper {
            /*position:absolute;*/
            width:100%;

            /*background-color:#f00;*/
            }
            footer{
              opacity:0.95;

            }

            </style>
    <title>Dreamers, 당신의 꿈 그리고 우리</title>
    <script>
    $(document).ready(function(){
        // Activate Carousel
        $("#myCarousel").carousel({interval: 3000});

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
    </script>
          <link rel="icon" href="favicon_img/favicon.ico" type="image/ico">
  </head>

 <body>
   <div class=clear></div>
  <!-- <a href="#myAnchor" class="go-top show"><span class="	glyphicon glyphicon-chevron-up" style="font-size:32px; color:white; margin-top:6px"></span></a> -->

    <span class="glyphicon glyphicon-edit" style="font-size:32px; color:white; margin-top:6px"></span></a>

   <div id ="page-wrapper">


   <div class=clear></div>
                <!-- 헤더 메뉴 -->
    <header id = "main-navi">
		    <?php   include "./index-head.php";  ?>
        <div id = "logo">

           <a href="./newindex.php"><img src = "../img/logoi.png" width=150px; height=auto; /></a>
         </div>
    </header>
    <!-- 헤더 메뉴 (로그인,검색 등 끝) -->

     <!--배너끝-->
     <!-- <video  autoplay="autoplay" loop="loop"class="video_size">
       <source src="../img/banner1.mp4"   type="video/mp4">
     </video> -->
     <!-- <div class= "category"> -->

       <!--배너-->
<!-- <span><a href="../lib/newindex.php?category=<?=$category?>&mode=<?=$mode?> " class="category_icon"><img src="../img/category_icon/1.all.png" class="overw" title="all" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=travel&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/2.travel.png" class="overw" title="Travel" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=sport&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/3.sport.png" class="overw" title="Sport" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=food&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/4.food.png" class="overw" title="Food" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=skill&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/5.skill.png" class="overw" title="Skill" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=culture&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/6.culture.png" class="overw" title="Culture" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=shopping&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/7.shopping.png" class="overw" title="Shopping" alt="카테고리아이콘"></a>&nbsp;&nbsp;
<a href="../lib/newindex.php?category=lifestyle&mode=<?=$mode?>" class="category_icon"><img src="../img/category_icon/8.life_style.png" class="overw" title="Lifestyle" alt="카테고리아이콘"></a></span>
     </div>
<div class=clear></div>
     <div class="sort111">
       <span class="recent"><a href="../lib/newindex.php?category=<?=$category?>">최신순</a></span>
       <span class="hithithit"><a href="../lib/newindex.php?mode=hithithit&category=<?=$category?>">조회순</a></span>
       <span class="recom"><a href="../lib/newindex.php?mode=recom&category=<?=$category?>">추천순</a></span>
</div> -->
       <!-- <span class="popular"><a href="#">인기순</a></span> -->

      <!-- 로고부분 -->

      <!-- 로고부분 끝 -->

      <div class=clear>
      </div>

<!-- 컨텐츠 게시판 부분 -->
<!-- 수정중 12.03-->
            <div class="getout">
              <?php include "../mission/missionlist.php"; ?>
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



    </div>
    <!-- <div id="main-footer">
        <?php
          // include "../lib/index-footer.php";
           ?>
    </div> -->




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
  </body>
</html>
