<?php
$connect=mysql_connect("localhost","dreamers","1234");
mysql_select_db("dreamus",$connect);


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



$idch = $_POST['id'];


$sql = "SELECT * FROM ex WHERE id='$idch';";
$result = mysqli_query($connect,$sql);
$count = mysqli_num_rows($result);

if($idch == ""){
    ?>
<div>아이디를 입력하세요.</div>
<?php
}else{

    if($count == 0){
    ?>
    <div style="color:green" class="use">
    사용가능한 아이디입니다.
    <input type="hidden" value="1" name="use"/>
    </div>
    <?php
    }else{
    ?>
    <div style="color:red" class="use">
    아이디가 존재합니다.
    <input type="hidden" value="0" name="use"/>
    </div>
    <?php
    }
}
    ?>
