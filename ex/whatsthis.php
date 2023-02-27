



<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
<script type="text/javascript">
$(function(){
    $("#popbutton").click(function(){
        $('div.modal').modal({remote : 'whatsthat.php'});
    })
})
</script>
</head>
<body>
<button class="btn btn-default" id="popbutton">모달출력버튼</button><br/>
<div class="modal fade">
  <div class="modal-dialog">
    <div class="modal-content">

<!-- 시작부분 -->

<div class="pics">
  <div  class="btn btn-default" id="popbutton">  <!--모달 팝업 추가 -->
        <div class="modal-content">
 <div class="picnav">
    <div class="ih-item square effect6 bottom_to_top">
      <a href="#">
        <a href="#" data-needpopup-show="#small-popup">
          <div class="img"><img src=<?=$img_name ?> />
            <div class="info">
              <h3><?=$item_category ?></h3>
              <p><?=$item_subject ?></p>
              <h6><?=$item_nick ?>님</h6>
              <h6>조회 <?=$item_hit ?>&nbsp;&nbsp;&nbsp;추천 <?=$item_up ?></h6>
            </div>
          </div>
        </a>
      </a>
                    <!--  팝업 내부 -->
            <div id='small-popup' class="needpopup">
			    </div><!--small-popup 끝-->

    </div>  <!--ih-item square effect6 bottom_to_top 끝-->
  </div> <!--pic nav 끝-->
</div>
</div>
</div> <!--pics 끝-->

        <!-- remote ajax call이 되는영역  끝-->


    </div>
  </div>
</div>
</body>
</html>


출처: http://hellogk.tistory.com/37 [IT Code Storage]
