<?php
$connect=mysql_connect("localhost","dreamers","1234");
mysql_select_db("dreamus",$connect);
?>

<script>
$(document).ready(function(){

    $('#id').blur(function(){

            $.ajax({ // ajax실행부분
                type: "post",
                url : "../user/checkid.php",
                data : {
                    id : $('#id').val()
                },
                success : function s(a){ $('#idch').html(a); },
                error : function error(){ alert('시스템 문제발생');}
            });
    });

});

function blank_up(){
    var du = document.userinput;

    if(!du.name.value){
        alert("이름을 입력하시오");
        du.name.focus();
        return false;
    }

    if(!du.id.value){
        alert("아이디를 입력하시오");
        du.id.focus();
        return false;
    }
    // 부분 추가
    if(du.use.value == '0'){
        alert("아이디 중복을 확인해주세요.");
        du.id.focus();
        return false;
    }  // 여기까지

    if(!du.nickname.value){
        alert("닉네임를 입력하시오");
        du.nickname.focus();
        return false;
    }

    if(!du.pw.value){
        alert("패스워드를 입력하시오");
        du.pw.focus();
        return false;
    }

    if(du.pw.value != du.pwch.value){
        alert("패스워드를 정확하게 입력해주세요.");
        du.pwch.focus();
        return false;
    }

    if(!du.con.checked){
        alert("약관에 동의 해주시기 바랍니다.");
        du.con.focus();
        return false;
    }

}
</script>



회원가입
<form action="signupDo.php" method="post" name="userinput">
    <table>
    <tr>
        <td>이름</td> <td><input type="text" name="name" id="name"/></td>
    </tr>

    <tr>
        <td>아이디</td>
        <td>
            <div><input type="text" name="id" id="id"/></div>
            <div id="idch">아이디를 입력하세요.
                <input type="hidden" value="0" name="use"/>
            </div>
        </td>
    </tr>

    <tr>
        <td>닉네임</td> <td><input type="text" name="nickname" id="nickname" /></td>
    </tr>

    <tr>
        <td>비밀번호</td> <td><input type="password" name="pw" id="pw"/></td>
    </tr>

    <tr>
        <td>비밀번호확인</td> <td><input type="password" name="pwch" id="pwch" onkeyup="check_pw(this.value)"/></td>
    </tr>

    <tr>
        <td></td><td><div id="check">비밀번호를 확인하세요.</div></td>
    </tr>

    <tr>
        <td colspan="2"><input type="checkbox" name="con" /> 약관에 동의 하시겠습니까?</td>
    </tr>

    <tr>
        <td colspan="2"><input type="submit" value="회원가입" onclick="return blank_up()" /></td>
    </tr>

    </table>
</form>

<?php
mysql_close();
?>
