<!doctype html>
<html lang="ko">
<?php
include '../_inc/title.php';
include '../_inc/db.php';
?>
 <body>
<?php
include '../_inc/header.php';
include '../_inc/mouse_1.php';
?>		
<?php
  $sql = "SELECT * FROM KPC_NOTICE WHERE IDX={$_GET['notice_idx']}";
  $result = mysqli_query($dbconn, $sql);
  $row = (mysqli_fetch_array($result));  

  $prev_idx = $_GET['notice_idx'];
  $prevsql = "SELECT * FROM KPC_NOTICE WHERE DEL_YN='N' AND IDX < $prev_idx ORDER BY IDX DESC LIMIT 1";
  $prevresult = mysqli_query($dbconn, $prevsql);
  $prevrow = (mysqli_fetch_array($prevresult));  

  $next_idx = $_GET['notice_idx'];
  $nextsql = "SELECT * FROM KPC_NOTICE WHERE DEL_YN='N' AND IDX > $next_idx ORDER BY IDX ASC LIMIT 1";
  $nextresult = mysqli_query($dbconn, $nextsql);
  $nextrow = (mysqli_fetch_array($nextresult));  

  //조회수
  $addViewCount = $row['NOT_VIEWNUM'] + 1;
  $viewAddsql = "UPDATE KPC_NOTICE SET NOT_VIEWNUM = $addViewCount WHERE IDX={$_GET['notice_idx']}";
  $visitedresult = mysqli_query($dbconn, $viewAddsql);
 ?>
<style>
p img {
    width: auto;
    max-width: 100%;
}
</style>
	<div class="h2_bg">
		<div class="h2_conts h2_bg04">
			<div class="navigation">
				<h2>공지사항</h2>
				<span class="home"></span><span>공지사항</span><span>공지사항</span>
			</div>
		</div>
	</div>

	<div class="sub_cont">
		<div>
			<div class="view_style">
				<div class="view_title">
					<div class="title"><span class="pin">공지</span><h5 class="top"><?php echo $row['NOT_TITLE'] ?></h5></div>
					<div class="detail">
						<p>작성일 : <?= $row['REG_DATE'] ?></p>
						<p>조회수 : <?= $row['NOT_VIEWNUM'] ?></p>
					</div>
				</div>
                <?php
                  $file_sql = "SELECT * FROM KPC_FILE WHERE NOT_IDX={$_GET['notice_idx']}";
                  $file_result = mysqli_query($dbconn, $file_sql);
                  $fileRow = (mysqli_fetch_array($file_result));  
                if(isset($fileRow['FILE_ID'])){
                ?>
				<div class="clip_box">
                    <p>
                        <?php
                            $file_sql = "SELECT * FROM KPC_FILE WHERE NOT_IDX={$_GET['notice_idx']}";
                            $file_result = mysqli_query($dbconn, $file_sql);
                            for($i=0; $i<2; $i++){
                                $fileRow[$i] = mysqli_fetch_array($file_result);
                            }
                        ?>
                        <a href="#" class="file" title='다운로드' onclick="window.open('./download.php?&file_id=<?= $fileRow[0]['FILE_ID'];?>')"><?= $fileRow[0]['USR_FILE_NAME']; ?></a>
                    </p>
                    <p><a href="#" class="file" title='다운로드' onclick="window.open('./download.php?file_id=<?= $fileRow[1]['FILE_ID']; ?>')"><?= $fileRow[1]['USR_FILE_NAME']; ?></a></p>
				</div>
                <?php } ?>
				<div class="view_cont">
                    <?= $row['NOT_CONTENT'] ?>
				</div>
				<div class="pagenation_detail">
                    <?php
                    if($prevrow){
                    ?>
					<p class="prev"><span>이전글</span><a href='./notice_view.php?notice_idx=<?= $prevrow['IDX']?>'><?php echo $prevrow['NOT_TITLE'] ?></a></p>
                    <?php 
                    }else{?>
                    <p class="prev"><span>이전글</span><a href="#" class="no_data">이전글이 없습니다.</a></p>
                    <?php } ?>

                    <?php
                    if($nextrow){
                    ?>
					<p class="next"><span>다음글</span><a href='./notice_view.php?notice_idx=<?= $nextrow['IDX']?>'><?php echo $nextrow['NOT_TITLE'] ?></a></p>
                    <?php 
                    }else{?>
                    <p class="next"><span>다음글</span><a href="#" class="no_data">다음글이 없습니다.</a></p>
                    <?php } ?>
				</div>
			</div>
			<p class="basic_btn"><a href="./notice.php">목록</a></p>
		</div>
	</div>

	<?php
include '../_inc/footer.php';
?> </body>
</html>
