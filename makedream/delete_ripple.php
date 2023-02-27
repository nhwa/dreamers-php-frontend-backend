<?php
  session_start();
error_reporting(0);
      include "../lib/dbconn.php";

      $ripple_num=$_GET['ripple_num'];
      $num = $_GET['num'];
      $table="makedream";

      $sql = "delete from reply where num=$ripple_num";
      mysql_query($sql, $connect);
      mysql_close();

      echo "
	   <script>
   	    location.href = '../lib/newindex.php?table=$table&num=$num';
	   </script>
	  ";
    // history.go(-1)

// 	    location.href = '../lib/newindex.php?table=$table&num=$num';
?>
