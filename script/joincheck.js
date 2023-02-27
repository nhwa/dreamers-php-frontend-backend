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
	$(".check2").on("keyup", function(){ //check2라는 클래스에 입력을 감지
		var self = $(this);
		var nick;

		if(self.attr("id") === "nick"){
			nick = self.val();
		}

		$.post( //post방식으로 nick_check.php에 입력한 nick값을 넘깁니다
			"nick_check.php",
			{ nick : nick },
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
	$(".check1").on("keyup", function(){ //check1라는 클래스에 입력을 감지
		var self = $(this);
		var email;

		if(self.attr("id") === "email"){
			email = self.val();
		}

		$.post( //post방식으로 id_check.php에 입력한 userid값을 넘깁니다
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
