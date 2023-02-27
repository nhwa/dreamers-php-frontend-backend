<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
	<meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://fonts.googleapis.com/css?family=Quicksand|Ubuntu" rel="stylesheet">
    <!-- <link href="../css/index-all.css" rel="stylesheet"> -->
    <link href="../css/join3.css" rel="stylesheet">
    <!-- <link href="css/needpopup.min.css" rel="stylesheet"> -->
    <link rel="icon" href="../lib/favicon_img/favicon.ico" type="image/ico">

    <script type="text/javascript" src="../script/jquery-3.2.1.js"></script> <!--나도모르는데 스크립트 쓸 때 필요한거-->
    <script type="text/javascript" src="../script/joincheck.js"></script><!--아이디랑 이메일 중복체크하는 거-->
<script>
      // <!-- 아이디 중복 확인 부분-->
      $(document).ready(function(e) {
      	$(".check").on("keyup", function(){ //check라는 클래스에 입력을 감지
      		var self = $(this);
      		var userid;

      		if(self.attr("id") === "userid"){
      			userid = self.val();
      		}

      		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
      			"id_check.php",
      			{ userid : userid },
      			function(data){
      				if(data!='0'){ //만약 data값이 전송되면
                if (data == '존재하는 아이디입니다.')
                {
                  self.parent().parent().find("div[id=id_check]").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
        					self.parent().parent().find("div[id=id_check]").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
        					self.parent().parent().find("div[id=id_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=id_check]").css("margin-bottom", "7px"); //마진 줘라
                }

                else if (data == '사용가능한 아이디입니다.')
                {
                  self.parent().parent().find("div[id=id_check]").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
        					self.parent().parent().find("div[id=id_check]").css("color", "#0CAA0C",); //div 태그를 찾아 css효과로 녹색을 설정합니다
        					self.parent().parent().find("div[id=id_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=id_check]").css("margin-bottom", "7px"); //마진 줘라
                }
              }
      			}
      		);
      	});
      });


// 닉네임 중복 확인 부분

      $(document).ready(function(e) {
      	$(".check2").on("keyup", function(){ //check2라는 클래스에 입력을 감지
      		var self = $(this);
      		var nick;

      		if(self.attr("id") === "nick"){
      			nick = self.val();
      		}

      		$.post( //post방식으로 nick_check.php에 입력한 nick값을 넘깁니다
      			"nick_check.php",
      			{ nick : nick },
            function(data1){
              if(data1!='0'){ //만약 data1값이 전송되면
                if (data1 == '존재하는 닉네임입니다.')
                {
                  self.parent().parent().find("div[id=nick_check]").html(data1); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                  self.parent().parent().find("div[id=nick_check]").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
                  self.parent().parent().find("div[id=nick_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=nick_check]").css("margin-bottom", "7px"); //마진 줘라
                }

                else if (data1 == '사용가능한 닉네임입니다.')
                {
                  self.parent().parent().find("div[id=nick_check]").html(data1); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                  self.parent().parent().find("div[id=nick_check]").css("color", "#0CAA0C",); //div 태그를 찾아 css효과로 녹색을 설정합니다
                  self.parent().parent().find("div[id=nick_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=nick_check]").css("margin-bottom", "7px"); //마진 줘라
                }
              }
            }

      		);
      	});
      });

 // 이메일 중복 확인 부분
      $(document).ready(function(e) {
      	$(".check1").on("keyup", function(){ //check1라는 클래스에 입력을 감지
      		var self = $(this);
      		var email;

      		if(self.attr("id") === "email"){
      			email = self.val();
      		}

      		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
      			"email_check.php",
      			{ email : email },
            function(data2){
              if(data2!='0'){ //만약 data2값이 전송되면
                if ((data2 == '존재하는 이메일입니다.')||(data2 == '올바른 형식의 이메일이 아닙니다.'))
                {
                  self.parent().parent().find("div[id=email_check]").html(data2); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                  self.parent().parent().find("div[id=email_check]").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
                  self.parent().parent().find("div[id=email_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=email_check]").css("margin-bottom", "7px"); //마진 줘라
                }

                else if (data2 == '사용가능한 이메일입니다.')
                {
                  self.parent().parent().find("div[id=email_check]").html(data2); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                  self.parent().parent().find("div[id=email_check]").css("color", "#0CAA0C",); //div 태그를 찾아 css효과로 녹색을 설정합니다
                  self.parent().parent().find("div[id=email_check]").css("font-size", "12px"); //하나씩만해라
                  self.parent().parent().find("div[id=email_check]").css("margin-bottom", "7px"); //마진 줘라
                }
              }
            }

      		);
      	});
      });


        // 비밀번호 유효성 확인 부분
             $(document).ready(function(e) {
             	$(".check3").on("keyup", function(){ //check3라는 클래스에 입력을 감지
             		var self = $(this);
             		var pw;

             		if(self.attr("id") === "pw"){
             			pw = self.val();
             		}

             		$.post( //post방식으로 pw_check.php에 입력한 pw값을 넘깁니다
             			"pw_check.php",
             			{ pw : pw },

                   function(data3){
                     if(data3!='0'){ //만약 data3값이 전송되면
                       if (data3 == '5~16자 이상의 영문, 숫자 조합')
                       {
                         self.parent().parent().find("div[id=pw_check]").html(data3); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                         self.parent().parent().find("div[id=pw_check]").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
                         self.parent().parent().find("div[id=pw_check]").css("font-size", "12px"); //하나씩만해라
                         self.parent().parent().find("div[id=pw_check]").css("margin-bottom", "7px"); //마진 줘라
                       }

                       else if (data3 == '유효한 비밀번호입니다.')
                       {
                         self.parent().parent().find("div[id=pw_check]").html(data3); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                         self.parent().parent().find("div[id=pw_check]").css("color", "#0CAA0C",); //div 태그를 찾아 css효과로 녹색을 설정합니다
                         self.parent().parent().find("div[id=pw_check]").css("font-size", "12px"); //하나씩만해라
                         self.parent().parent().find("div[id=pw_check]").css("margin-bottom", "7px"); //마진 줘라
                       }
                     }
                   }

             		);
             	});
             });
                      // 비밀번호 재확인 부분
                      $(document).ready(function(e) {
                      	$(".check4").on("keyup", function(){
                            //check4라는 클래스에 입력을 감지
                      		var self = $(this);
                          var passwordconfirm;
                          form = document.member_form;
                          var pw = form.pw.value;
                      		if(self.attr("id") === "passwordconfirm"){
                      			passwordconfirm = self.val();

                      		}

//                      		alert (passwordconfirm);
             		     $.post( //post방식으로 pw_check.php에 입력한 pw값을 넘깁니다
             			    "pw_Confirm_check.php",
             			    { passwordconfirm : passwordconfirm , pw},


//                             { pw : pw },


                            function(data4){
                              if(data4 !='0'){ //만약 data3값이 전송되면
                                if (data4 == '비밀번호 불일치 다시 입력!')
                                {
                                  self.parent().parent().find("div[id=pw_Confirm_check]").html(data4); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("font-size", "12px"); //하나씩만해라
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("margin-bottom", "7px"); //마진 줘라
                                }

                                else if (data4 == '비밀번호 일치')
                                {
                                  self.parent().parent().find("div[id=pw_Confirm_check]").html(data4); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("color", "#0CAA0C",); //div 태그를 찾아 css효과로 녹색을 설정합니다
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("font-size", "12px"); //하나씩만해라
                                  self.parent().parent().find("div[id=pw_Confirm_check]").css("margin-bottom", "7px"); //마진 줘라
                        }
                     }
                   }

             		);
             	});
             });

// submit 넘길 때 아이디, 비번, 닉, 메일 체크하기
function check_join(){
  if(document.member_form.userid.value=="")
  {
    alert("아이디를 입력하세요 ;(");
    document.member_form.userid.focus();
    return;
  }
  if(document.member_form.pw.value=="")
  {
    alert("비밀번호를 입력하세요 ;(");
    document.member_form.pw.focus();
    return;
  }
  if(document.member_form.passwordconfirm.value=="")
  {
    alert("비밀번호를 확인하세요 ;(");
    document.member_form.passwordconfirm.focus();
    return;
  }
  if(document.member_form.name.value=="")
  {
    alert("이름을 입력하세요 ;(");
    document.member_form.name.focus();
    return;
  }
  if(document.member_form.nick.value=="")
  {
    alert("닉네임을 입력하세요 ;(");
    document.member_form.nick.focus();
    return;
  }
  if(document.member_form.birth.value=="")
  {
    alert("생년월일을 입력하세요 ;(");
    document.member_form.birth.focus();
    return;
  }
  if(document.member_form.phone1.value=="")
  {
    alert("전화번호를 입력하세요 ;(");
    document.member_form.phone1.focus();
    return;
  }
  if(document.member_form.phone2.value=="")
  {
    alert("전화번호를 입력하세요 ;(");
    document.member_form.phone2.focus();
    return;
  }
  if(document.member_form.phone3.value=="")
  {
    alert("전화번호를 입력하세요 ;(");
    document.member_form.phone3.focus();
    return;
  }
  if(document.member_form.email.value=="")
  {
    alert("이메일을 입력하세요 ;(");
    document.member_form.email.focus();
    return;
  }



  if(document.getElementById("id_check").textContent=="존재하는 아이디입니다.")
  {
    alert("아이디를 다시 입력하세요 ;(");
    document.member_form.userid.focus();
    return;
  }

  if(document.getElementById("pw_check").textContent=="5~16자 이상의 영문, 숫자 조합")
  {
    alert("비밀번호를 다시 입력하세요 ;(");
    document.member_form.pw.focus();
    return;
  }

  if(document.getElementById("pw_Confirm_check").textContent=="비밀번호 불일치 다시 입력!")
  {
    alert("비밀번호를 다시 확인하세요 ;(");
    document.member_form.passwordconfirm.focus();
    return;
  }

  if(document.getElementById("nick_check").textContent=="존재하는 닉네임입니다.")
  {
    alert("닉네임을 다시 입력하세요 ;(");
    document.member_form.nick.focus();
    return;
  }

  if((document.getElementById("email_check").textContent=="존재하는 이메일입니다.")||(document.getElementById("email_check").textContent=="올바른 형식의 이메일이 아닙니다."))
  {
    alert("이메일을 다시 입력하세요 ;(");
    document.member_form.email.focus();
    return;
  }

  alert("가입되었습니다 :D");
 // document.member_form.submit();
}


</script>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <title>Dreamers, 당신의 꿈 그리고 우리</title>
  </head>
  <body style="overflow-x:hidden; overflow-y:auto;">
    <section>

        <div id="join">
          <div class="join-content">
      <form name="member_form" method="post" enctype="multipart/form-data" action="insert.php">
         <a href="../lib/newindex.php"><img src = "../img/logoi.png" class="joinlogo"/></a>

        <legend class="idWrap">
                  <input type="text" id="userid" name="userid" class="check" required="required" maxlength="20" placeholder="아이디" autocomplete="off" />
                  <div id="id_check" class="id_check" name="id_check"></div>
        </legend>
<!--                      <a href="#"><img src="idcheck.png" onlink="check_id()"></a>-->
        <legend class="pwWrap">
                    <input type="password" id="pw" name="pw" class="check3" required="required" maxlength="30" placeholder="비밀번호" autocomplete="off" />
                    <div id="pw_check" class="pw_check" name="pw_check"></div>
        </legend>

      <legend class="pwConfirmWrap">
                    <input type="password" id="passwordconfirm" name="passwordconfirm" class="check4" required="required" maxlength="30" placeholder="비밀번호 재확인" autocomplete="off" />
                     <div id="pw_Confirm_check" class="pw_Confirm_check" name="pw_Confirm_check"></div>
        </legend>

                    <input type=text name="name" class="inpt" required="required" placeholder="이름" maxlength="5" autocomplete="off" />

                    <legend class="nickWrap">
                      <input type=text id="nick" name="nick" class="check2" required="required" placeholder="닉네임" autocomplete="off" maxlength="15" />
                      <div id="nick_check" name="nick_check" class="nick_check"></div>
                    </legend>
                     <input type="text" name="birth" class="inpt" required="required" placeholder="생년월일 ex 19991017" autocomplete="off" maxlength="8"/><br>
                      <div class="check-group">
                     <input id='radio1' type=radio name=sex value='M'><label for='radio1' class="m">남 자</label>
                         <input id='radio2' type=radio name=sex value='F'/><label for='radio2'>여 자</label></div><br>
                    <input type="text" name="phone1" class="inpt-phone" required="required" placeholder="010" maxlength="4" autocomplete="off" />
                   <input type="text" name="phone2" class="inpt-phone" required="required" placeholder="1234" maxlength="4" autocomplete="off" />
                  <input type="text" name="phone3" class="inpt-phone" required="required" placeholder="5678" maxlength="4" autocomplete="off" />

                  <legend class="emailWrap">
                    <input type=text id="email" name="email" class="check1" required="required"  maxlength="80" placeholder="abc@naver.com" autocomplete="off" />
                    <div id="email_check" name="email_check" class="email_check"></div>
                  </legend>
                    <input type="text" id="postnum" placeholder="우편번호" class="inpt-post_num" name="postnum">
                    <input type="button" onclick="postnum_execDaumPostcode()" value="우편번호 찾기" class="post_num_button">
                    <input type="text" id="address1" placeholder="도로명주소" class="inpt" name="address1" autocomplete="off">
                  <!-- <input type="text" id="sample4_jibunAddress" placeholder="지번주소" class="inpt"> -->
                    <input type="text" id="address2" placeholder="상세주소" class="inpt" name="address2"autocomplete="off">
<span id="guide" style="color:#999"></span>

<script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
<script>
    //본 예제에서는 도로명 주소 표기 방식에 대한 법령에 따라, 내려오는 데이터를 조합하여 올바른 주소를 구성하는 방법을 설명합니다.
    function postnum_execDaumPostcode() {
        new daum.Postcode({
            oncomplete: function(data) {
                // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                if(data.bname !== '' && /[동|로|가]$/g.test(data.bname)){
                    extraRoadAddr += data.bname;
                }
                // 건물명이 있고, 공동주택일 경우 추가한다.
                if(data.buildingName !== '' && data.apartment === 'Y'){
                   extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                }
                // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                if(extraRoadAddr !== ''){
                    extraRoadAddr = ' (' + extraRoadAddr + ')';
                }
                // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                if(fullRoadAddr !== ''){
                    fullRoadAddr += extraRoadAddr;
                }

                // 우편번호와 주소 정보를 해당 필드에 넣는다.
                document.getElementById('postnum').value = data.zonecode; //5자리 새우편번호 사용
                document.getElementById('address1').value = fullRoadAddr;
//                document.getElementById('sample4_jibunAddress').value = data.jibunAddress;

                // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                if(data.autoRoadAddress) {
                    //예상되는 도로명 주소에 조합형 주소를 추가한다.
                    var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                    document.getElementById('guide').innerHTML = '(예상 도로명 주소 : ' + expRoadAddr + ')';

                } else if(data.autoJibunAddress) {
                    var expJibunAddr = data.autoJibunAddress;
                    document.getElementById('guide').innerHTML = '(예상 지번 주소 : ' + expRoadAddr + ')';

                } else {
                    document.getElementById('guide').innerHTML = '';
                }

                document.getElementById('address2').focus();
            }
        }).open();
    }
</script>

                      <div class="submit-wrap">
                            <input type="button" value="가입하기" class="submit" onclick="check_join()">
                      </div>
                </form>
  </div>
</div>
    </section>
    </div>
    </div>

  </body>
</html>
