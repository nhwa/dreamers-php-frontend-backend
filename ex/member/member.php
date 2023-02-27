<?php include "../db.php"; ?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>회원가입 폼</title>
<link href = "idcheck.css" rel="stylesheet" text="text/css">
<script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
<script>
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
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("div").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
					self.parent().parent().find("div").css("font-size", "12px"); //하나씩만해라
				}
			}
		);
	});
});



$(document).ready(function(e) {
	$(".check1").on("keyup", function(){ //check라는 클래스에 입력을 감지
		var self = $(this);
		var email;

		if(self.attr("id") === "email"){
			email = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 euserid값을 넘깁니다
			"email_check.php",
			{ email : email },
			function(data){
				if(data){ //만약 data값이 전송되면
					self.parent().parent().find("div").html(data); //div태그를 찾아 html방식으로 data를 뿌려줍니다.
					self.parent().parent().find("div").css("color", "#F00",); //div 태그를 찾아 css효과로 빨간색을 설정합니다
					self.parent().parent().find("div").css("font-size", "12px"); //하나씩만해라
				}
			}
		);
	});
});

</script>
</head>
<body>
	<form method="post" action="member_ok.php" name="memform">
		<h1>회원가입 폼</h1>
			<fieldset>
				<legend>입력사항</legend>
					<table>
						<tr>
							<td>아이디</td>

							<td class="idWrap">
								<input type="text" name="userid" id="userid" class="check" placeholder="아이디"  required autocomplete="off" />
							<div id="id_check"></div></td>


						</tr>
						<tr>
							<td>비밀번호</td>
							<td class="pwWrap"><input type="password"  id="userpw" name="userpw" placeholder="비밀번호" required autocomplete="off" />
							</td>
						</tr>
						<tr>
							<td>이름</td>
							<td><input type="text"  name="name" placeholder="이름" required autocomplete="off" />
							</td>
						</tr>
						<tr>
							<td>주소</td>
							<td><input type="text"  name="adress" placeholder="주소" required autocomplete="off" /></td>
						</tr>
						<tr>
							<td>성별</td>
							<td>남<input type="radio" name="sex" value="남"> 여<input type="radio" name="sex" value="여"></td>
						</tr>
						<tr>
							<td>이메일</td>
							<td>
								<!-- <input type="text" name="email" required >@<select name="emadress"><option value="naver.com">naver.com</option><option value="nate.com">nate.com</option>
							<option value="hanmail.com">hanmail.com</option><option value="">직접 입력</option></select> -->
								<input type="text" name="email" required id="email" class="check1" autocomplete="off" />
							<div id="email_check"></div></td>
						</tr>
					</table>
				<input type="submit" value="가입하기" /><input type="reset" value="다시쓰기" />
		</fieldset>
	</form>
</body>
</html>
