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
[출처] PHP- Reboot : 6th signup 아이디 중복확인 Part.1|작성자 NoDe

