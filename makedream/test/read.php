<?
  extract($_GET);
  extract($_POST);
  extract($_SERVER);

  include "db_connect.php";
  // mysql_select_db("");
  $query = "select * from board where num=$num";
  $result = mysql_query($query, $conn);

  $row=mysql_fetch_array($result);
?>
<style>
  td,input{
    font-size:9pt;
  }
  A:link{font-size:9pt;
          color:black;
          text-decoration: none;}
  A:visited{font-size:9pt;
          color:black;
          text-decoration: none;}
  A:hover{font-size:9pt;
          color:black;
          text-decoration: underline;}
</style>
<center>
<table width=600 bgcolor=#336699>
  <tr>
    <td height=20 align=center bgcolor=#336699 colspan=4><font color=white>
      <?=$row['title']?></font></td>
  </tr>
  <tr>
    <td bgcolor=#f2ffff width=50>Writer</td>
    <td bgcolor=white width=250><?=$row['name']?></td>
    <td bgcolor=#f2ffff width=50>Email</td>
    <td bgcolor=white width=250><?=$row['email']?></td>
  </tr>
  <tr>
    <td bgcolor=#f2ffff width=50>Date</td>
    <td bgcolor=white width=250><?=$row['date']?></td>
    <td bgcolor=#f2ffff width=50>View</td>
    <td bgcolor=white width=250><?=$row['view']?></td>
  </tr>
  <tr bgcolor=white colspan=4>
    <td><pre><?=$row['content']?></pre></td>
  </tr>
  <!-- 기타 메뉴 -->
  <tr>
    <td colspan=4 bgcolor=white>
      <table width=100%>
        <tr>
          <td width=200 height=20>
            <a href=list.php>[List]</a>
            <a href=write.php>[Write]</a>
            <a href=edit.php?num=<?=$num?>>[Edit]</a>
            <a href=predelete.php?num=<?=$num?>>[Delete]</a>
          <td align=right>
            <?
              $result_1 = mysql_query("select num from board where num > $num limit 1", $conn);
              $next_num = mysql_fetch_array($result_1);

              if(empty($next_num['num'])){
                echo "
                  [Next]
                ";
              }else{
                echo "
                  <a href=read.php?num=$next_num[num]>[Next] </a>
                ";
              }
            ?>
            <?
              $result_2 = mysql_query("select num from board where num < $num
                                      order by num desc limit 1", $conn);
              $previous_num = mysql_fetch_array($result_2);

              if(empty($previous_num['num'])){
                echo "
                  [Previous]
                ";
              }else{
                echo "
                  <a href=read.php? num=$previous_num[num]> [Previous]</a>
                ";
              }
            ?>
      </table>
    </td>
  </tr>
  <?
    mysql_query("update board set view = view + 1 where num=$num");
    mysql_close($conn);
  ?>
</table>
</center>
