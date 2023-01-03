
<!doctype html>
<html lang="ko">
<?php
include '../_inc/title.php';
include '../_inc/db.php';

  //검색어
  $sch_word=$_GET['sch_word'];

  //검색범위
  $rangeOption = $_GET['rangeOption'];

  $condition = "1=1";
  
    if(empty($sch_word)){
    //검색어 x
    }else if($rangeOption=="title"){
        $condition = "$condition"." NOT_TITLE like '%{$sch_word}%'";
    }else if($rangeOption=="content"){
        $condition = "$condition"." NOT_CONTENT like '%{$sch_word}%'";
    }else{
        $condition = "$condition"." (NOT_TITLE like '%{$sch_word}%'
        OR NOT_CONTENT like '%{$sch_word}%')";
    }
    
  /* 검색된 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
  $sql = "SELECT * FROM KPC_NOTICE 
  where DEL_YN='N' AND $condition order by REG_DATE desc
  ";

  $result = mysqli_query($dbconn, $sql);

  if(isset($_GET['page'])){
      $page = $_GET['page'];
  }else{
      $page = 1;
  }

  $row_num = mysqli_num_rows($result); //게시판 총 레코드 수
  $list = 10; //한 페이지에 보여줄 개수
  $block_ct = 5; //블록당 보여줄 페이지 개수

  $block_num = ceil($page/$block_ct); // 현재 페이지 블록 구하기
  $block_start = (($block_num - 1) * $block_ct) + 1; // 블록의 시작번호
  $block_end = $block_start + $block_ct - 1; //블록 마지막 번호

  $total_page = ceil($row_num / $list); // 페이징한 페이지 수 구하기
  if($block_end > $total_page) $block_end = $total_page; //만약 블록의 마지박 번호가 페이지수보다 많다면 마지박번호는 페이지 수
  $total_block = ceil($total_page/$block_ct); //블럭 총 개수
  $start_num = ($page-1) * $list; //시작번호 (page-1)에서 $list를 곱한다.

  $sql2 = $sql." LIMIT $start_num, $list";  
  $result2 = mysqli_query($dbconn, $sql2);
 ?>
  <body>

<?php
include '../_inc/header.php';
include '../_inc/mouse_1.php';
?>	
	<div class="h2_bg">
		<div class="h2_conts h2_bg04">
			<div class="navigation">
				<h2>공지사항</h2>
				<span class="home"></span><span>공지사항</span><span>공지사항</span>
			</div>
		</div>
	</div>
    <form action="./notice.php" method="get" name="searchFrm" id="frm">
	<div class="sub_cont">
		<div>
			<div class="search_box">
                
				<p>
					<select name="rangeOption">
						<option value="all" <? if($_GET['rangeOption'] == 'all'){ ?> selected <? } ?>>전체</option>
						<option value="title" <? if($_GET['rangeOption'] == 'title'){ ?> selected <? } ?>>제목</option>
						<option value="content" <? if($_GET['rangeOption'] == 'content'){ ?> selected <? } ?>>내용</option>
					</select>
				</p>
				<p><input type="text" id="sch_word" name="sch_word" value="<? echo $_GET['sch_word']; ?>" placeholder="검색어를 입력하세요">
                <a href="javascript:frm.submit()">검색</a></p>
			</div>
            </form>

			<p class="total_p">전체 <b><?php echo $row_num;?></b>건의 자료가 검색되었습니다.</p>
			
			<ul class="bbs_list">
				<li class="cate">
					<p class="num">No</p>
					<p class="title">제목</p>
					<p class="file_t">첨부파일</p>
					<p class="date">작성일</p>
					<p class="views">조회수</p>
				</li>

                <?php
                  $firstsql = "SELECT * FROM KPC_NOTICE 
                  where NOTICE_YN = 'Y' AND DEL_YN='N' AND $condition order by REG_DATE desc
                  ";


                $result = mysqli_query($dbconn, $firstsql);

                $i = 1;
                while($row =(mysqli_fetch_array($result))) {
                    $file_sql = "SELECT * FROM KPC_FILE WHERE NOT_IDX={$row['IDX']}";
                    $file_result = mysqli_query($dbconn, $file_sql);
                    $fileRow = (mysqli_fetch_array($file_result));  
                ?> 
                <li onclick="location.href='./notice_view.php?notice_idx=<?= $row['IDX'] ?>'">
					<p class="num pinned">공지</p>
					<p class="title"><span class="pin"></span><a href="#"><?= $row['NOT_TITLE'] ?></a></p>
					<?php
                    if(isset($fileRow['IDX'])){?>
                    <p class="file_t"><span class="file"></span></p>
                    <?php }else{?>
                        <p class="file_t"></span></p>
                    <?php } ?>
					<p class="date"><?= substr($row['REG_DATE'],0,10); ?></p>
					<p class="views"><?= $row['NOT_VIEWNUM'] ?></p>
				</li>
                <?php $i++;} ?>

                <?php
                  $secondsql = "SELECT * FROM KPC_NOTICE 
                  where NOTICE_YN = 'N' AND DEL_YN='N' AND $condition order by REG_DATE desc
                  ";

                $sql2 = $secondsql." LIMIT $start_num, $list";  
                $result2 = mysqli_query($dbconn, $sql2);

                $i = 1;
                while($row =(mysqli_fetch_array($result2))) {
                    $file_sql = "SELECT * FROM KPC_FILE WHERE NOT_IDX={$row['IDX']}";
                    $file_result = mysqli_query($dbconn, $file_sql);
                    $fileRow = (mysqli_fetch_array($file_result));  
                ?> 
                <li onclick="location.href='./notice_view.php?notice_idx=<?= $row['IDX'] ?>'">
					<p class="num"><?= $start_num+$i; ?></p>
					<p class="title"><span class="pin"></span><a href="#"><?= $row['NOT_TITLE'] ?></a></p>

					<?php
                    if(isset($fileRow['IDX'])){?>
                    <p class="file_t"><span class="file"></span></p>
                    <?php }else{?>
                        <p class="file_t"></span></p>
                    <?php } ?>
                    
					<p class="date"><?= substr($row['REG_DATE'],0,10); ?></p>
					<p class="views"><?= $row['NOT_VIEWNUM'] ?></p>
				</li>
                <?php $i++;} ?>

			</ul>

			<div class="paging_box">
				<p>
                <?php

                    $searchCon = "&rangeOption=".$_GET['rangeOption']."&sch_word=".$_GET['sch_word']."";
                    
                    if($page <= 1)
                    { 
                        echo "<a class='prev_f'></a>"; 
                    }else{
                        echo "<a class='prev_f' href='?$searchCon&page=1'></a>"; 
                    }
                    if($page <= 1)
                    { 
                        echo "<a class='prev'></a>";
                    }else{
                        $pre = $page-1; 
                        echo "<a class='prev' href='?$searchCon&page=$pre'></a>"; 
                    }
                    for($i=$block_start; $i<=$block_end; $i++){ 
                        if($page == $i){ 
                        echo "<a class='on'>$i</a>"; 
                        }else{
                        echo "<a href='?$searchCon&page=$i'>$i</a>";
                        }
                    }
                    if($block_num >= $total_block){
                        echo "<a class='next'></a>";
                    }else{
                        $next = $page + 1; 
                        echo "<a class='next' href='?$searchCon&page=$next'></a>"; 
                    }
                    if($page >= $total_page){ 
                        echo "<a class='next_l'></a>";
                    }else{
                        echo "<a class='next_l' href='?$searchCon&page=$total_page'></a>"; 
                    }
                ?>
                </p>
            </div>
            </form>   

		</div>
	</div>

	<?php
include '../_inc/footer.php';
?> </body>
</html>
