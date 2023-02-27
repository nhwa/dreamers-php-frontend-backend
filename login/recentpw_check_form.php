<?php
session_start();
error_reporting(0);
 ?>
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
 <html>
 <head>
          <link rel="icon" href="../lib/favicon_img/favicon.ico" type="image/ico">
 	<title>Dreamers 당신의 꿈, 그리고 우리</title>
 <meta charset="utf-8">
    <link href="../css/login4.css" rel="stylesheet">
 </head>

  <body style="overflow-x:hidden; overflow-y:auto;">

    <section>

         <div id="login">

          <form name="member_form" action="./recentpw_check.php" method="post">
             <a href="../lib/newindex.php"><img src = "../img/logoi.png" class="loginlogo"/></a>
         <input type="text" name="userid" class="inpt" required="required" maxlength="20" placeholder="아이디" autocomplete="off" value="<?php echo $_SESSION['userid']; ?>" readonly>
           <input type="password" name="pw" class="inpt" required="required" maxlength="30" placeholder="비밀번호" autocomplete="off" />
                      <div class="submit-wrap">
                      <input type="submit" value="비밀번호 확인" class="submit">
                      </div>
                </form>
  </div>
    </section>
    </div>
    </div>

 </body>
</html>
