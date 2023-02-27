<!DOCTYPE html>
<meta charset="utf-8">
<meta name="description" content="">
<link rel="stylesheet" href="http://fonts.googleapis.com/earlyaccess/notosanskr.css">
<link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
<link href="../css/index-head.css" rel="stylesheet">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" />
<!-- <link href="../css/needpopup.min.css" rel="stylesheet" > -->
<script src="http://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

<script type="text/javascript">
$(document).ready(function(){
  $("input[type=search]").keydown(function (key){

    if(key.keyCode ==13) {//키가 13이면 실행 (엔터=13)
        searchEnter();
    }
  });
 searchEnter=function(){
  //검색 찾는 로직 구현
    // alert($("input[type=search]").val());
document.searchform.submit();
};
});

</script>
<style>

    .icons{
      height:40px;
      padding-top:9px;
      margin-left:68px;
    }
</style>
<div class="head-menu">
  <?php
  error_reporting(0);



    if(!$_SESSION['userid']){
   ?>
   <span class="memlog"><a href="../login/login_form.php">로그인</a> </span>&nbsp;|&nbsp;<span class="memlog"><a href="../member/join.php">가입하기</a></span>
<?php
  }
  else {
?>
<span class="logined">
  <a href="../lib/newindex.php?see=seeuser&user=<?=$_SESSION['usernick']?>">
<button type="button" class="btn btn-danger btn-xs">
  <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
  &nbsp;<?=$_SESSION['userid'] ?></button>
</a>
</span>
<span class="memlog">&nbsp;님 환영합니다. | </span>
<span class="memlog"><a href="../login/logout.php">로그아웃</a> </span>&nbsp;|&nbsp;<span class="memlog"><a href="../login/recentpw_check_form.php">정보수정</a></span>
<?php } ?>
</div>
<form>
       &nbsp; <!-- float은 공간을 차지하지 않음(z축에 존재) 공간을 차지하는 공백 넣음-->
          <input type=checkbox name="menu_bt" id="menu_bt01" class="menubt01">
             <!--숨겨진 이동메뉴-->
              <div class="slide_box">
                <div class="box1">
                  <?php
                    if(!$_SESSION['userid'])
                    {
                  ?>
                  <a href="../login/login_form.php">
                  <?php
                  }
                  else{
                  ?>
                  <a href="../makedream/write_form3.php">
                    <?php
                    }
                     ?>
                     <div class="icons">
                  <img src="../img/write_icon2.png"  alt="글쓰기" title="당신의 꿈을 펼쳐보세요" width=74px; onmouseover='$(this).attr("src", "../img/write_icon.png")' onmouseout='$(this).attr("src","../img/write_icon2.png")' style="margin-right:40px; margin-top:3px;">
                    </a>
                    <?php
                    if(!$_SESSION['userid'])
                    {
                  ?>
                  <a href="../login/login_form.php">
                  <?php
                  }
                  else{
                  ?>
                  <a href="../lib/newindex.php?see=seeuser&user=<?=$_SESSION['usernick']?>">
                    <?php
                    }
                     ?>
                      <img src="../img/mylist_icon2.png"  alt="마이페이지" title="My List" width=80px; onmouseover='$(this).attr("src", "../img/mylist_icon.png")' onmouseout='$(this).attr("src","../img/mylist_icon2.png")' style="margin-top:5px;">
                    </a></div>

                </div>
                <!-- <div class="box2"></div> -->
                <!-- <div class="box3"></div> -->
                <div class="slide_text">

                 <ul  class="menu-ul"> Bucket List<div class="slide_line"></div>
                      <li class="menu-li">  <a href="../lib/newindex.php">ALL</a> </li>
                      <li class="menu-li">  <a href="../lib//newindex.php?category=travel">Travel</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=sport">Sport</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=food">Food</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=skill">Skill</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=culture">Culture</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=shopping">Shopping</a></li>
                      <li class="menu-li">  <a href="../lib/newindex.php?category=lifestyle">Life style</a></li>

                  </ul>

                  <ul  class="menu-ul"> Mission<div class="slide_line2"></div>
                      <li class="menu-li"> <a href="../lib/index-mission.php">All</a></li>
                       <li class="menu-li">  <a href="../lib/index-mission.php?table=mission&now=진행중미션">Ing</a> </li>
                       <li class="menu-li">  <a href="../lib/index-mission.php?table=mission&now=종료된미션">Ex</a></li>
                     </ul>

                    <ul class="menu-ul">Dream us<div class="slide_line3"></div>
                    <li class="menu-li">  <a href="../info/info.php#info3">About Dreamers</a></li>
                  </ul>

                    <ul class="menu-ul">Social Media<div class="slide_line4"></div>
                      <a href='https://www.instagram.com/Dream_and_us'><img src="../img/instagramno.png" width="32.5px"; style="margin-top:6px;" onmouseover='$(this).attr("src", "../img/instagram.png")' onmouseout='$(this).attr("src", "../img/instagramno.png")'/></a>&nbsp;
                      <a href='https://twitter.com/Dream_and_us'><img src="../img/twitterno.png" width="30px"; style="margin-top:6px;" onmouseover='$(this).attr("src", "../img/twitter.png")' onmouseout='$(this).attr("src", "../img/twitterno.png")'/></a>&nbsp;
                      <a href='http://blog.naver.com/langueihr'><img src="../img/naverblogno.png" width="30px"; style="margin-top:7px;" onmouseover='$(this).attr("src", "../img/naverblog.png")' onmouseout='$(this).attr("src", "../img/naverblogno.png")'/></a>

                   </ul>
                 </div>
              </div>
            </form>
          <label for="menu_bt01" class="bt_box">
          <img src = "../img/icon-menu.png" width=25px><div class="menu-hamburg"></div></label>
<form name="searchform" action="./newindex.php?mode=search" method="post">
          <input type=checkbox name="menu_bt" id="menu_bt02" class="menubt02">
             <div class="src-box"><label for="menu_bt02" class="search-icon" >
              <img src = "../img/icon-search.png" width= 25px ><div class="menu-search"></div> </label></div>
<!--
              <div class="bt_box">
              <div class="menu-join"><a href="index.html"><img src="join.png" width=70% height=30%/></a></div></div>


              <div class="bt_box">
              <div class="menu-login"><a href="index.html"><img src="login.png" width=90% height=30%/></a></div></div>
            -->
<!--검색창 옵션-->
          <input type="search" name="search" class="search-bar" value="검색"  onfocus="this.value=''"  onblur="if(this.value=='') this.value='검색'" onkeypress="javascript:if(event.keyCode==13) {search_onclick_submit}" autocomplete="off">


   </form>
   <ul class="mainmenu-ul"><li class="mainmenu-li">&nbsp; </li></ul>
