<?
  extract($_POST);
  extract($_GET);
  extract($_SERVER);

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
<form action=delete.php?num=<?=$num?> method=POST>
<table width=600 border=0 cellpadding=2 cellspacing=1 bgcolor=#336699>
  <tr>
    <td height=20 align=center bgcolor=#336699><b>Check Password</b>
  <tr bgcolor=#f2ffff>
    <td align=center>Password:<input type=password name=password size=20>
    <input type=submit value=' OK '>
    <input type=button value=' Cancel ' onclick="history.back(1)">
  </tr>
</table>
</form>

</center>
