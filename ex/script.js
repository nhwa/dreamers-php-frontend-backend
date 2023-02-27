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
[출처] PHP- Reboot : 6th signup 아이디 중복확인 Part.1|작성자 NoDe

