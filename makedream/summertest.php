<!DOCTYPE html>
<html lang="ko">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!-- include libraries(jQuery, bootstrap) -->
<link href="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.css" rel="stylesheet">
<script src="http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.js"></script>
<script src="http://netdna.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.js"></script>
<script src='//cdnjs.cloudflare.com/ajax/libs/jquery.form/3.51/jquery.form.min.js'></script>

<!-- include summernote css/js-->
<link href="/sn/summernote.css" rel="stylesheet">
<script src="/sn/summernote.min.js"></script>

<!-- include summernote-ko-KR -->
<script src="/sn/lang/summernote-ko-KR.js"></script>
</head>
<body>
	<div id="summernote">Hello Summernote</div>
	<div>
		<p style="text-align:center;">
			<a href="javascript:save();" class="btn btn-primary">저장</a>
			<a href="javascript:default_value();" class="btn btn-default">디폴트값</a>
		</p>
	</div>
	<form name="inform" id="inform" method="post" action="summernote_result.php">
		<input type="hidden" name="content" id="content" value="" />
	</form>
<script>
$(document).ready(function() {
	$('#summernote').summernote({
		height:300,
		minHeight:100,
		maxHeight:null,
		focus:true,
		lang: 'ko-KR',
		callbacks: {
			onImageUpload: function(files){
				sendFile(files[0], $(this));
			}
		}
	});

	function sendFile(file, editor) {
		var data = new FormData();
		data.append("uploadFile", file);
		$.ajax({
			data: data,
			type: "POST",
			url: "/sn/image_upload.php",
			enctype: 'multipart/form-data',
			cache: false,
			contentType: false,
			processData: false,
			success: function(dd){
				data = jQuery.parseJSON(dd);

				if(data.status == "OK"){
					editor.summernote('insertImage', data.url);
				} else {
					alert(data.message);
				}
			},
			error: function(data){
				console.log(data);
			}
		});
	}
});

function save(){
	var markupStr = $('#summernote').summernote('code');
	$("#content").val(markupStr);
	$("#inform").submit();
}

function default_value(){
	var markupStr = '디폴트 값';
	$('#summernote').summernote('code', markupStr);
}
</script>
</body>
</html>
