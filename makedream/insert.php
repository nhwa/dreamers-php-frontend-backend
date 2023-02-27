<?php
 session_start();

 error_reporting(0);

 $table="makedream";
?>


<!-- var htmlStr = $('#summernote').summernote('code'); -->
<meta charset="utf-8">
<?php
	if(!$_SESSION['userid']) {
		echo("
		<script>
	     window.alert('로그인 후 이용해 주세요.')
	     history.go(-1)
	   </script>
		");
		exit;
	}

// $id=$_SESSION['userid'];
// $nick=$_SESSION['usernick'];

  $num=$_GET['num'];
  $category=$_POST['sel_cate'];
	$subject=$_POST['subject'];
	$content=$_POST['content'];
	$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
	$hit=0; //조회수 초기화
	$up=0; //추천수 초기화
	$ip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장
	$mode=$_GET['mode'];

  // echo("
  // <script>
  //    window.alert('$num');
  //  </script>
  // ");


  //제목, 내용 없으면 다시 돌아가게 하자
  if(($subject=="")||($content==""))
  {
    echo("
    <script>
       window.alert('작성을 똑바로 해 주세요.')
       history.go(-1)
     </script>
    ");
  }
else{
	// echo $subject;
	// echo $content;
	// echo $regist_day;
	// echo $_SESSION['userid'];
	// echo $table;
	// echo $ip;

	// 다중 파일 업로드


	$files = $_FILES["upfile"];
	$count = count($files["name"]);
  $upload_dir="./data/";

	for ($i=0; $i<$count; $i++)
	{
		$upfile_name[$i]     = $files["name"][$i];
		$upfile_tmp_name[$i] = $files["tmp_name"][$i];
		$upfile_type[$i]     = $files["type"][$i];
		$upfile_size[$i]     = $files["size"][$i];
		$upfile_error[$i]    = $files["error"][$i];

		$file = explode(".", $upfile_name[$i]);
		$file_name = $file[0];
		$file_ext  = $file[1];

      // echo("
      // <script>
      //    window.alert('$upfile_name[$i]');
      //  </script>
      // ");

		if (!$upfile_error[$i])
		{
			$new_file_name = date("Y_m_d_H_i_s");
			$new_file_name = $new_file_name."_".$i;
			$copied_file_name[$i] = $new_file_name.".".$file_ext;
			$uploaded_file[$i] = $upload_dir.$copied_file_name[$i];

			if( $upfile_size[$i]  > 50000000 ) {
				echo("
				<script>
				alert('업로드 파일 크기가 지정된 용량(50MB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
				history.go(-1)
				</script>
				");
				exit;
			}

			if (($upfile_type[$i] != "image/gif") &&
				($upfile_type[$i] != "image/jpeg") &&
				($upfile_type[$i] != "image/png") )
			{
				echo("
					<script>
						alert('JPG, GIF, PNG 이미지 파일만 업로드 가능합니다!');
						history.go(-1)
					</script>
					");
				exit;
			}

			if (!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i]) )
			{
				echo("
					<script>
					alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
					history.go(-1)
					</script>
				");
				exit;
			}
		}
	}
	include "../lib/dbconn.php";       // dconn.php 파일을 불러옴

	if ($mode=="modify")
	{
		$num_checked = count($_POST['del_file']);
		$position = $_POST['del_file'];

		for($i=0; $i<$num_checked; $i++)                      // delete checked item
		{
			$index = $position[$i];
			$del_ok[$index] = "y";
		}

		$sql = "select * from $table where num=$num";   // get target record
		$result = mysql_query($sql);
		$row = mysql_fetch_array($result);

		for ($i=0; $i<$count; $i++)					// update DB with the value of file input box
		{

			$field_org_name = "file_name_".$i;
			$field_real_name = "file_copied_".$i;

			$org_name_value = $upfile_name[$i];
			$org_real_value = $copied_file_name[$i];
			if ($del_ok[$i] == "y")
			{
				$delete_field = "file_copied_".$i;
				$delete_name = $row[$delete_field];
				$delete_path = "./data/".$delete_name;

				unlink($delete_path);

				$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
				mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
			}
			else
			{
				if (!$upfile_error[$i])
				{
					$sql = "update $table set $field_org_name = '$org_name_value', $field_real_name = '$org_real_value'  where num=$num";
					mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
				}
			}
		}
		$sql = "update $table set category='$category', subject='$subject', content='$content' where num=$num";
		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행
	}
	else
	{
		// if ($html_ok=="y")
		// {
		// 	$is_html = "y";
		// }
		// else
		// {
		// 	$is_html = "";
		// 	$content = htmlspecialchars($content);
		// }

		// $sql = "insert into $table (id, nick, subject, content, regist_day, hit, is_html, ";
		// $sql .= " file_name_0, file_name_1, file_name_2, file_copied_0,  file_copied_1, file_copied_2) ";
		// $sql .= "values('$userid', '$username', '$usernick', '$subject', '$content', '$regist_day', 0, '$is_html', ";
		// $sql .= "'$upfile_name[0]', '$upfile_name[1]',  '$upfile_name[2]', '$copied_file_name[0]', '$copied_file_name[1]','$copied_file_name[2]')";
		// mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

$sql="insert into $table (id, nick, category, subject, content, regist_day,file_name_0,file_name_1, file_name_2, file_copied_0, file_copied_1,file_copied_2, hit,up,ip) ";
$sql.= "values('{$_SESSION['userid']}', '{$_SESSION['usernick']}', '$category', '$subject', '$content', '$regist_day',
'{$upfile_name[0]}','{$upfile_name[1]}','{$upfile_name[2]}','{$copied_file_name[0]}','{$copied_file_name[1]}','{$copied_file_name[2]}',$hit,$up,'$ip');";

		// $sql="insert into $table (id, nick, subject, content, regist_day, ";
		// $sql.="file_name_0, file_name_1, file_name_2, file_copied_0,  file_copied_1, file_copied_2, hit, up, ip) ";
		// $sql.= "values('{$_SESSION['userid']}', '{$_SESSION['usernick']}', '$subject', '$content', '$regist_day', ";
		// $sql.="'{$upfile_name[0]}', '{$upfile_name[1]}', '{$upfile_name[2]}', ";
		// $sql.="'{$copied_file_name[0]}', '{$copied_file_name[1]}','{$copied_file_name[2]}', $hit, $up, '{$ip}'";
		// $result=mysql_query($sql, $connect);

    mysql_query($sql, $connect);
		// if($result)
		// echo "성공";
		// else {
		// 	echo "실패";
		}
		}

	mysql_close();                // DB 연결 끊기

// echo ("<script>window.alert("안들어감");</script>");
	echo "
	   <script>
	    location.href ='../lib/newindex.php?table=$table&page=$page&mode=$mode';
	   </script>
	// ";
?>
