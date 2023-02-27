=\<?php
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
// echo ("<script>window.alert('$category')</script>");
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
          <link rel="icon" href="favicon_img/favicon.ico" type="image/ico">

            <style>
            body{
              overflow-x: hidden;
            }
            /*.overw{
              position:relative;
              top : 300px;
              width:100px;
              height:auto;
              margin:0px 50px 0px 50px;
              z-index:9999;
            }*/
            .overw{
            position:relative;
            display:inline-block;
            /*width: 76px;
            height: 70px;*/
            }
            .overp {
              display:inline-block;
              background-color: rgba(0,0,0,0.3);
              /*width: 76px;
              height: 70px;*/
            }
            </style>
    <title>Dreamers, 당신의 꿈 그리고 우리</title>
  </head>

 <body>
   <div class=clear></div>
  <a href="#myAnchor" class="go-top show" title="맨위로">
    <span class="	glyphicon glyphicon-chevron-up" style="font-size:32px; color:white; margin-top:6px">
    </span></a>

<?php
if(!$_SESSION['userid'])
  {
    ?>
    <a href="../login/login_form.php" class="write-top show">
    <?php
  }
  else{
?>
  <a href="../makedream/write_form3.php" class="write-top show" title="글쓰기">
<?php
}
?>
    <span class="glyphicon glyphicon-edit" style="font-size:32px; color:white; margin-top:6px">
    </span>
          </a>

   <div id ="page-wrapper">
   <div class="wrapper" id="myAnchor" >

   <div class=clear></div>
                <!-- 헤더 메뉴 -->
    <header id = "main-navi">
		    <?php
        include "./index-head.php";
         ?>
        <div id = "logo">

           <a href="./newindex.php"><img src = "../img/logoi.png" width=150px; height=auto; /></a>
         </div>
    </header>
    <!-- 헤더 메뉴 (로그인,검색 등 끝) -->

     <!--배너끝-->
     <video  autoplay="autoplay" loop="loop"class="video_size">
       <source src="../img/real_banner.mp4"   type="video/mp4">
     </video>
     <div class= "category">
     <!--배너-->
     <span>
       <a href="../lib/newindex.php?category=&mode=<?=$mode?>" class="category_icon" >
         <?php if($category=="")
         {?>
       <div class="overp">
     <?php } else{ ?>
       <div class="overw">
     <?php } ?>
       <img src="../img/category_icon/cate_icon_1_all.png" class="overw" title="all" alt="카테고리아이콘" >
    </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=travel&mode=<?=$mode?>" class="category_icon" onclick="toggle_object(1); return false;">
     <?php if($category=="travel")
     {?>
       <div class="overp">
     <?php } else{ ?>
        <div class="overw">
     <?php } ?>
      <img src="../img/category_icon/cate_icon_2_travel.png" class="overw" title="Travel" alt="카테고리아이콘">
      </div></a>&nbsp;&nbsp;
      <a href="../lib/newindex.php?category=sport&mode=<?=$mode?>" class="category_icon">
       <?php if($category=="sport")
       {?>
         <div class="overp">
       <?php } else{ ?>
         <div class="overw">
         <?php } ?>
         <img src="../img/category_icon/cate_icon_3_sport.png" class="overw" title="Sport" alt="카테고리아이콘">
       </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=food&mode=<?=$mode?>" class="category_icon">
       <?php if($category=="food")
       {?>
         <div class="overp">
       <?php } else{ ?>
         <div class="overw">
         <?php } ?>
         <img src="../img/category_icon/cate_icon_4_food.png" class="overw" title="Food" alt="카테고리아이콘">
     </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=skill&mode=<?=$mode?>" class="category_icon">
     <?php if($category=="skill"){?>
       <div class="overp">
         <?php } else{ ?>
           <div class="overw">
           <?php } ?>
             <img src="../img/category_icon/cate_icon_5_skill.png" class="overw" title="Skill" alt="카테고리아이콘">
       </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=culture&mode=<?=$mode?>" class="category_icon">
       <?php if($category=="culture"){?>
         <div class="overp">
       <?php } else{ ?>
         <div class="overw">
         <?php } ?>
         <img src="../img/category_icon/cate_icon_6_culture.png" class="overw" title="Culture" alt="카테고리아이콘">
       </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=shopping&mode=<?=$mode?>" class="category_icon">
       <?php if($category=="shopping"){?>
         <div class="overp">
       <?php } else{ ?>
         <div class="overw">
         <?php } ?>
         <img src="../img/category_icon/cate_icon_7_shopping.png" class="overw" title="Shopping" alt="카테고리아이콘">
       </div></a>&nbsp;&nbsp;
     <a href="../lib/newindex.php?category=lifestyle&mode=<?=$mode?>" class="category_icon">
       <?php if($category=="lifestyle"){?>
         <div class="overp">
     <?php } else{ ?>
       <div class="overw">
       <?php } ?>
       <img src="../img/category_icon/cate_icon_8_life_style.png" class="overw" title="Lifestyle" alt="카테고리아이콘">
     </div></a></span>
          </div>
     <div class=clear></div>
          <div class="sort111">
              <a href="../lib/newindex.php?mode=&category=<?=$category?>">
                <?php if($mode==""){?>
                <div class="recent" style="color:#e54064;">
         <?php } else{ ?>
         <div class="recent">
         <?php } ?>LIBRARY</div></a>

            <a href="../lib/newindex.php?mode=hithithit&category=<?=$category?>">
              <?php if($mode=="hithithit"){?>
              <div class="hithithit" style="color:#e54064;">
       <?php } else{ ?>
         <div class="hithithit">
         <?php } ?>HIT</div></a>

            <a href="../lib/newindex.php?mode=recom&category=<?=$category?>">
              <?php if($mode=="recom"){?>
              <div class="recom" style="color:#e54064;">
       <?php } else{ ?>
         <div class="recom">
         <?php } ?>BEST</div></a>
       </div>
     </div>
       <!-- <span class="popular"><a href="#">인기순</a></span> -->

      <!-- 로고부분 -->

      <!-- 로고부분 끝 -->

      <div class=clear>
      </div>

<!-- 컨텐츠 게시판 부분 -->
            <div class="bk-list-nav">
              <?php include "../lib/index-content1.php"; ?>
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
              <!-- <footer> -->
                <?php include "../lib/index-footer.php"; ?>
              <!-- </footer> -->

    </div>
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
