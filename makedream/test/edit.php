<?
  extract($_POST);
  extract($_SERVER);
?>
<style>
td,input {
  font-size:9;
}
</style>
<!-- Edit -->
<form action=update.php?num=<?=$_GET['num']?> method=POST>
<table width=600 cellpadding=2 cellspacing=1 bgcolor="#336699">
  <?

    include "db_connect.php";
    $query = "select * from board where num=$_GET[num]";
    $result = mysql_query($query, $conn);

    $data = mysql_fetch_array($result);
  ?>
  <tr>
    <td><font color="white">Edit</font>
  <tr>
    <td bgcolor="#f2ffff">
      <table>
        <tr>
          <td>Name
          <td><input type=text name=name size=20 value="<?=$data['name']?>" maxlength=20>
        <tr>
          <td>Email
          <td><input type=text name=email size=30 value="<?=$data['email']?>" maxlength=30>
        <tr>
          <td>Password
          <td><input type=password name=password size=20 maxlength=20>
        <tr>
          <td>Title
          <td><input type=text name=title size=70 value="<?=$data['title']?>" maxlength=40>
        <tr>
          <td>Content
          <td><textarea name=content cols=70 onclick="this.select()"
            onfocus="this.select" value="<?=$data['content']?>" rows=15></textarea>
        <tr>
          <td>
          <td cospan=2 align=right height=30><input type=submit value=Write>&nbsp;
          <input type=reset value=reset>&nbsp;
          <input type=button value=back onclick="history.back(1)">

      </table>
    </td>
  </tr>
</table>
</form>
