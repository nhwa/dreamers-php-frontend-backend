<?php
   session_start();
 error_reporting(0);

  $table="makedream";
  $num = $_GET['num'];  //parent임
  $userid=$_SESSION['userid'];
  $usernick=$_SESSION['usernick'];
  $ripple_num=$_GET['ripple'];
  $group_num=$num."_".$ripple_num;
  $ripple_content=$_POST['ripple_content'];
  $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
  $ip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장
  $ripple_group_num=$_GET['group']; //그룹넘버 받아오기
  // $riripple_content=$_POST['riripple_content'.$ripple_groupnum];
  // $ririple=$_POST['riripple_form_'.$ripple_groupnum]; //리리플 댓글 폼 이름
  $riripple_content=$_POST['eoeot'];


  if ($riripple_content&&$userid!="")
  {
    $ripple_group_num=$_GET['group']; //그룹넘버 받아오기
    $ripple_depth=1;
  }
else
  {
    $ripple_depth=0;
  }

  // echo ("<script>window.alert('$regist_day')</script>");

  // echo   $riripple_content;

  // $group_num=$num.'_'.

  // 리플 답글 기능
  // $group_num=$_POST['']
  // $depth=

?>
<meta charset="utf-8">
<?php
   if($userid=="") {
     echo("
	   <script>
	     window.alert('로그인 후 이용하세요.')
	     history.go(-1)
	   </script>
	 ");
	 exit;
   }
   include "../lib/dbconn.php";       // dconn.php 파일을 불러옴
// 쿼리
if ($riripple_content)
{
  $sql = "insert into reply (parent,group_num,depth,id,nick,content,regist_day,ip) values($num,'$ripple_group_num',$ripple_depth,'{$_SESSION['userid']}','{$_SESSION['usernick']}','$riripple_content','$regist_day','$ip')";
  mysql_query($sql, $connect);
  // echo "이거는 대댓글이다";
  // $sql="select * from reply where group_num='$ripple_group_num' and id='{$_SESSION['userid']}' and content='$riripple_content';";
  // $result=mysql_query($sql);
  // $row=mysql_fetch_array($result);
  //
  // $riripple_num=$row[num];
  // $riripple_nick=$row[nick];
  // $riripple_content=$row[content];
  // $riripple_date=$row[regist_day];
  ?>
<!--
  <div id="show_riripple">
  <div class="rrip_del"> -->
  <?php
  // if(($_SESSION['userid']=="admin") || ($_SESSION['userid']==$riripple_id))
  //       echo "<a href='../makedream/delete_ripple.php?table=$table&num=$item_num&ripple_num=$riripple_num'>
  //       <button type='button' id='delete_riripple_button' class='merong2'>삭제</button></a>";
  ?>
<!-- </div>
  <div class="riripple_content">
    <font color="#222" size="4"><b><?=$riripple_nick?></b></font> <font color="#e54063"><span class="glyphicon glyphicon-comment"></span></font>
  </div>
    <div class="rrip_content"><?=$riripple_content?></div>
  <div class="regiday"><?=$riripple_regist_day?></div>
</div> -->

<?php
}
else
{
  $sql = "insert into reply (parent,depth,id,nick,content,regist_day,ip) values($num,$ripple_depth,'{$_SESSION['userid']}','{$_SESSION['usernick']}','$ripple_content','$regist_day','$ip')";

     mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
     // echo "이거는 댓글이다";

  // 11.26 대댓글 추가 부분
     $sql="select * from reply where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
     $result=mysql_query($sql);
     $row=mysql_fetch_array($result);

  // $ripple_num=$row[num];
  // $parent_num=$row[parent];
  // $group_num=$ripplenum."_".$parent_num;
    $group_num=$row['parent']."_".$row['num'];
    $sql = "update reply set group_num = '$group_num' where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
        mysql_query($sql);

        $sql="select * from reply where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
        $result=mysql_query($sql);
        $row=mysql_fetch_array($result);

        $ripple_num=$row[num];
        $ripple_nick=$row[nick];
        $ripple_content=$row[content];
        $ripple_date=$row[regist_day];
      ?>
      <!-- <div class="rrip_title">

        <font color="#222" size="4"><b><?=$ripple_nick?></b></font> <font color="#e54063"><span class="glyphicon glyphicon-comment"></span></font>
        <div class="rip_del"> -->
        <?php
        // if(($_SESSION['userid']=="admin") || ($_SESSION['userid']==$ripple_id))
        //       echo "<a href='../makedream/delete_ripple.php?table=$table&num=$item_num&ripple_num=$ripple_num'>
        //       <button type='button' class='merong2'>삭제</button></a>";
        ?>
      <!-- </div>
      </div>
    <div class="rrip_content"><?=$ripple_content?></div>
    <div class="regiday"><?=$ripple_date?></div> -->
      <?php


  // 추가 끝
}

   // $sql = "insert into reply (parent,depth,id,nick,content,regist_day,ip) values($num,$ripple_depth,'{$_SESSION['userid']}','{$_SESSION['usernick']}','$ripple_content','$regist_day','$ip')";
   //
   // mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

// 11.26 대댓글 추가 부분
   // $sql="select * from reply where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
   // $result=mysql_query($sql);
   // $row=mysql_fetch_array($result);

// $ripple_num=$row[num];
// $parent_num=$row[parent];
// $group_num=$ripplenum."_".$parent_num;
  // $group_num=$row['parent']."_".$row['num'];
  // $sql = "update reply set group_num = '$group_num' where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
  //     mysql_query($sql);
// 추가 끝

// echo ("<script>
// window.alert('$row[parent]');
// </script>");
//
// echo $group_num;
// echo $sql;

mysql_close();                // DB 연결 끊기

  //
   // echo "
	 //   <script>
   //    history.go(-1)
	 //   </script>
	// ";
  //밑에꺼 스크립트 안에 있으면 주석처리 안되길래 밖에 빼놓은거임
  // 	    location.href = 'view.php?table=$table&num=$num';

  echo "
    <script>
     location.href = '../lib/newindex.php?table=$table&num=$num';
    </script>
 ";

 // include ("ripple.php?num=$item_num");

// mysql_close();                // DB 연결 끊기

 ?>
