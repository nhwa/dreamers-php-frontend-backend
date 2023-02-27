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

  <textarea class="form-control" name="eoeot" placeholder="대댓글을 입력하세요 :)"   id="comment4" style="resize: none;" ></textarea>
   <!-- onclick="if(this.value=='') alert('대댓글 내용을 입력하세요!');
document.riripple_form.eoeot.focus();"
onblur="if(this.value!='')" -->

                                                                                <!-- 수정중 -->
    <span class="write_button"><button type="button" class="btn btn-info btn-sm" onclick="riri_check(<?=$ripple_num?>)"><b>댓글달기</b></button></span>
<?= $bttype ?></div>
<br>
</div>
<!--  여기까지 원래 숨겨져야하는 부분 -->
</form>
