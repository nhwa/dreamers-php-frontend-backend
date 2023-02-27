<?php
session_start();
error_reporting(0);
// echo "여기어디";

include ("../lib/dbconn.php");

$table=$_GET['table']; //테이블이름 받아온거
$num = $_GET['num'];  //parent임
$userid=$_SESSION['userid'];
$usernick=$_SESSION['usernick'];
$ripple_num=$_GET['ripple'];
$group_num=$num."_".$ripple_num;
$ripple_content=$_POST['ripple_content'];
$regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장
$ip=$_SERVER['REMOTE_ADDR'];  //방문자의 ip 주소 저장
$ripple_group_num=$_GET['group']; //그룹넘버 받아오기
// $riripple_content=$_POST['riripple_content'.$ripple_groupnum];
// $ririple=$_POST['riripple_form_'.$ripple_groupnum]; //리리플 댓글 폼 이름
$riripple_content=$_POST['eoeot'];


if ($riripple_content&&$userid!="")
{
	$ripple_group_num=$_GET['group']; //그룹넘버 받아오기
	$ripple_depth=1;
}
else
{
	$ripple_depth=0;
}

if($ripple_content){
			$sql = "insert into reply (parent,depth,id,nick,content,regist_day,ip) values($num,$ripple_depth,'{$_SESSION['userid']}','{$_SESSION['usernick']}','$ripple_content','$regist_day','$ip')";
	 		mysql_query($sql, $connect);  // $sql 에 저장된 명령 실행

			$sql="select * from reply where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
			$result=mysql_query($sql);
			$row=mysql_fetch_array($result);

		 $group_num=$row['parent']."_".$row['num'];
		 $sql = "update reply set group_num = '$group_num' where parent=$num and id='{$_SESSION['userid']}' and regist_day='$regist_day';";
				 mysql_query($sql);
}
else if($riripple_content){
			$sql = "insert into reply (parent,group_num,depth,id,nick,content,regist_day,ip) values($num,'$ripple_group_num',$ripple_depth,'{$_SESSION['userid']}','{$_SESSION['usernick']}','$riripple_content','$regist_day','$ip')";
			mysql_query($sql, $connect);
}

	    $sql = "select * from reply where parent=$num and depth=0 order by num desc";
	    $ripple_result = mysql_query($sql);

			$row_ripple = mysql_fetch_array($ripple_result);
			if($row_ripple){
				?>
				<hr>
				<?php
			}
			$ripple_total_record=mysql_num_rows($ripple_result);

			//전체페이지수 계산
			$scale=10;
			if($ripple_total_record%$scale==0)
			{
				$ripple_total_page=floor($ripple_total_record/$scale);
			}
			else{
				$ripple_total_page=floor($total_record/$scale)+1;
			}

			if(!$ripple_page)
			{
			$ripple_page=1;
		}

			//표시할페이지에따라 시작리플 계산
			$ripple_start=($ripple_page-1)*$scale;
			$number=$ripple_total_record - $ripple_start;

// echo $number;
			// for($i=$ripple_start; $i<$ripple_start+$scale && $i<$ripple_total_record; $i++)
			for($i=$ripple_start; $i<$ripple_total_record; $i++)
			{
				mysql_data_seek($ripple_result, $i);
				$row_ripple=mysql_fetch_array($ripple_result);

				$ripple_num = $row_ripple[num];
				$ripple_id = $row_ripple[id];
				$ripple_nick = $row_ripple[nick];
				$depth=$row_ripple[depth];
				$ripple_content = str_replace("\r\n", "<br>", $row_ripple[content]);
				$ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
				// if($depth=='0'){
				// $ripple_content = str_replace("\r\n", "<br>", $row_ripple[content]);
				// $ripple_content = str_replace(" ", "&nbsp;", $ripple_content);
				// }
				// else{
				// 	$riripple_content = str_replace("\r\n", "<br>", $row_ripple[content]);
				// 	$riripple_content = str_replace(" ", "&nbsp;", $ripple_content);
				// }
				$ripple_date = $row_ripple[regist_day];
				$group_num = $row_ripple[group_num];

				$sql="select * from reply where parent=$num";
				$result2=mysql_query($sql, $connect);
				$num_ripple=mysql_num_rows($result2);

				// 11.26  대댓글 추가부분 2nJoy
				// $ripple_depth=$row[depth];
        //
				// $space="";
				// for($j=0; $j<$ripple_depth; $j++)
				// {
				// 	$space="&nbsp;&nbsp;".$space;
				// }
				// $group_num=$row[group_num];
				// $ord=$row[ord];
?>
<div class="ripple_show">
				<div class="rrip_title">
					<font color="#222" size="4"><b><?=$ripple_nick?></b></font> <font color="#e54063"><span class="glyphicon glyphicon-comment"></span></font>
					<div class="rip_del">
					<?php
					if(($_SESSION['userid']=="ad
					min") || ($_SESSION['userid']==$ripple_id))
								echo "<a href='../makedream/delete_ripple.php?table=$table&num=$num&ripple_num=$ripple_num'>
								<button type='button' class='merong2'>삭제</button></a>";
					?>
				</div>
				</div>
			<div class="rrip_content"><?=$ripple_content?></div>
			<div class="regiday"><?=$ripple_date?></div>
</div>

			<div class="riripple">
				<!-- 대댓글 달기 -->
				<button type="button" href="#hidden_ririple<?=$ripple_num?>" class="merong3" data-toggle="collapse">대댓글</button>
				<!-- 이부분은 원래 숨겨져있어야함 -->
					<div class="hidden_ririple<?=$ripple_num?>" class="collapse">
						<div class="riripple_contentarea">
							<?php
								$sql="select * from reply where parent=$item_num and group_num='$group_num' and depth!=0 order by num;";
								$riripple_result=mysql_query($sql, $connect);
								$riripple_total_record=mysql_num_rows($riripple_result);

								for($z=0; $z<$riripple_total_record; $z++){

								$row_riripple=mysql_fetch_array($riripple_result);
								$riripple_id=$row_riripple[id];
								$riripple_num=$row_riripple[num];
								$riripple_content = str_replace("\r\n", "<br>", $row_riripple[content]);
								$riripple_content = str_replace(" ", "&nbsp;", $riripple_content);
								$riripple_nick=$row_riripple[nick];
								$riripple_regist_day=$row_riripple[regist_day];


										?>
													<div class="riripple_wrap">
														<div class="rrip_del">
														<?php
														if(($_SESSION['userid']=="admin") || ($_SESSION['userid']==$riripple_id))
																	echo "<a href='../makedream/delete_ripple.php?table=$table&num=$item_num&ripple_num=$riripple_num'>
																	<button type='button' class='merong2'>삭제</button></a>";
														?>
													</div>
														<div class="riripple_content">
															<font color="#222" size="4"><b><?=$riripple_nick?></b></font> <font color="#e54063"><span class="glyphicon glyphicon-comment"></span></font>
														</div>
															<div class="rrip_content"><?=$riripple_content?></div>
														<div class="regiday"><?=$riripple_regist_day?></div>

													</div>
								<?php
									 }

							 ?>
<!-- 리리플 띄우는 곳 -->
					<form  name="riripple_form<?=$ripple_num?>" class="riripple_form"  method="post" action="../makedream/insert_ripple.php?&table=<?=$table?>&num=<?=$item_num?>&group=<?=$group_num?>">
						<div class="form-group">
							<!-- <input type=text name=rep> -->
							<!-- <textarea  class="form-control" rows="1" id="comment" name="ripple_content" style="resize: none;"></textarea> -->

							<textarea class="form-control" name="eoeot" placeholder="대댓글을 입력하세요 :)" id="comment4" style="resize: none;" ></textarea>
							 <!-- onclick="if(this.value=='') alert('대댓글 내용을 입력하세요!');
						document.riripple_form.eoeot.focus();"
						onblur="if(this.value!='')" -->

						 																																								<!-- 수정중 -->
								<span class="write_button"><button type="button" class="btn btn-info btn-sm" onclick="riri_check(<?=$ripple_num?>)"><b>댓글달기</b></button></span>
						<?= $bttype ?></div>
						<br>
					</div>
					</form>
										<!--  여기까지 원래 숨겨져야하는 부분 -->
										<?php
														// $number--;
													}
										?>
