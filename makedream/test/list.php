<?php
  extract($_POST);
  extract($_SERVER);

  include "db_connect.php";
  // mysql_select_db("");
  $query = "select * from board order by num desc";
  $result = mysql_query($query, $conn);

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
<table width=600 border=0 cellpadding=2 cellspacing=1 bgcolor=#336699>
  <tr bgcolor=#336699>
    <td align=center><font color=#f2ffff>Num</font>
    <td align=center><font color=#f2ffff>Title</font>
    <td align=center><font color=#f2ffff>Writer</font>
    <td align=center><font color=#f2ffff>Date</font>
    <td align=center><font color=#f2ffff>View</font>

<?php
  while($row = mysql_fetch_array($result)){
?>
<tr>
  <td bgcolor="#f2ffff" align=center><a href="read.php?num=<?=$row['num']?>">
    <?=$row['num']?></a>
  <td bgcolor="#f2ffff" align=center><a href="read.php?num=<?=$row['num']?>">
    <?=strip_tags($row['title'],'<b><i>');?></a>
  <td bgcolor="#f2ffff" align=center><a href="mailto:<?=$row['email']?>">
    <?=$row['name']?></a>
  <td bgcolor="#f2ffff" align=center><?=$row['date']?>
  <td bgcolor="#f2ffff" align=center><?=$row['view']?>
    <?php
      }
      mysql_close($conn);
    ?>
</table>
<p>
<a href=write.php>[Write]</a>
</center>
