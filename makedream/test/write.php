<style>
td,input {
  font-size:9;
}
</style>
<!-- 글 입력을 받는 화면 -->
<form action=insert.php method=POST>
<table width=600 cellpadding=2 cellspacing=1 bgcolor="#336699">
  <tr>
    <td><font color="white">Write</font>
  <tr>
    <td bgcolor="#f2ffff">
      <table>
        <tr>
          <td>Name
          <td><input type=text name=name size=20 maxlength=20>
        <tr>
          <td>Email
          <td><input type=text name=email size=30 maxlength=30>
        <tr>
          <td>Password
          <td><input type=password name=password size=20 maxlength=20>
        <tr>
          <td>Title
          <td><input type=text name=title size=70 maxlength=40>
        <tr>
          <td>Content
          <td><textarea name=content cols=70 rows=15></textarea>
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
