<html lang="utf-8">
<body>
<?php
$menu_on="admin";
include('include/adminHeader.php');
include('include/inc.php');
include('include/db.php');
   
login_check();

    
  $sch_word=$_GET['sch_word'];//검색어
  $rangeOption = $_GET['rangeOption'];//검색범위
  $use_yn = $_GET['use_yn']; //사용유무

  $condition = "1=1";
  
    if(empty($sch_word)){
    //검색어 x
    }else if($rangeOption=="admin_id"){
        $condition = "$condition"."  AND MEM_ID like '%{$sch_word}%'";
    }else if($rangeOption=="admin_nm"){
        $condition = "$condition"."  AND MEM_NAME like '%{$sch_word}%'";
    }else{
        $condition = "$condition"."  AND MEM_ID like '%{$sch_word}%'
        OR MEM_NAME like '%{$sch_word}%'";
    }

    if($use_yn == "Y"){
        $condition = "$condition"."  AND USE_YN = 'Y'";
        }else if($use_yn == "N"){
            $condition = "$condition"."  AND USE_YN = 'N'";
        }else{
            //전체
        }
    
    /* 검색된 관리자 정보 가져오기  limit : (시작번호, 보여질 수) */
  $sql = "SELECT * FROM KPC_MEMBER 
  WHERE DEL_YN = 'N' AND $condition
  ";

  $result = mysqli_query($dbconn, $sql);

  if(isset($_GET['page'])){
      $page = $_GET['page'];
  }else{
      $page = 1;
  }

  $row_num = mysqli_num_rows($result); //게시판 총 레코드 수
  $list = 20; //한 페이지에 보여줄 개수
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
<head>
<script>
/*	삭제	*/
function del_row(idx){
	
	if(confirm("삭제 하시겠습니까?")){
        location.href = "./admin_update_proc.php?idx="+idx;
	}
}
</script>
</head>

<body>
	<div id="wrap">
	<?php include ("include/header.php")?>

		<div id="container">

			<div id="left">
                <ul class="left_menu">
                    <li>
                        <a href="admin_list.php">관리자관리</a>	
                    </li>
                </ul>
            </div>
			<div id="contents">
				<ol class="loca">
					<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/> 홈</li>
					<li>관리자 관리</li>
				</ol>
				<h2>관리자 관리</h2>
				<form action="admin_list.php" name="frm" id="frm" method="get">
                <!-- 검색 -->
				<ul class="search_c">
					<li>						
                        <p class="tit">사용유무</p>
						<div class="search">
							<p class="f_l">
								<select class="select01" name="use_yn" id="use_yn" class="customSelect" style="cursor:pointer">
									<option value="A" <? if($_GET['use_yn'] == 'A'){ ?> selected <? } ?>>전체</option>
									<option value="Y" <? if($_GET['use_yn'] == 'Y'){ ?> selected <? } ?>>사용</option>
									<option value="N" <? if($_GET['use_yn'] == 'N'){ ?> selected <? } ?>>미사용</option>
								</select>
							</p>
						</div>
                    </li>
                    <li>
						<p class="tit">검색</p>
						<div class="search">
							<p class="f_l">
								<select class="select02" name="rangeOption" id="rangeOption" class="customSelect" style="cursor:pointer">
									<option value="all" <? if($_GET['rangeOption'] == 'all'){ ?> selected <? } ?>>전체</option>
									<option value="admin_id" <? if($_GET['rangeOption'] == 'admin_id'){ ?> selected <? } ?>>아이디</option>
									<option value="admin_nm" <? if($_GET['rangeOption'] == 'admin_nm'){ ?> selected <? } ?>>이름</option>
								</select>
							</p>
							<p class="re_info">
								<input type="text" class="nor" name="sch_word" id="sch_word" value="<? echo $_GET['sch_word']; ?>" placeholder="검색어를 입력해주세요" style="width:220px;">
								<a href="javascript:frm.submit()" class="dark_btn">검색</a>
							</p>
						</div>
					</li>
				</ul>
                </form>	

				<div class="tabel_t">
					<p class="re_text">총 <span><?= $row_num ?></span>명의 관리자가 있습니다.</p>
				</div>
				<div class="ta_cont mt10">
					<table class="table01">
						<colgroup>
                        <col width="6%">
                        <col width="*">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        </colgroup>
						<thead>
							<tr>
								<th class="c">No</th>
								<th class="c">ID</th>
								<th class="c">이름</th>
                                <th class="c">휴대폰</th>
                                <th class="c">사용유무</th>
								<th class="c">관리</th>
							<tr>
						</thead>
                        <?php
                        $i = 1;
                        while($row =(mysqli_fetch_array($result2))) {
                        ?> 
                        						<tbody>
							<tr>
								<td class="c"><?= $row['IDX'] ?></th>
								<td class="c"><?= $row['MEM_ID'] ?></a></th>
								<td class="c"><?= $row['MEM_NAME'] ?></td>
								<td class="c"><?= $row['MEM_TEL'] ?></td>
                                <td class="c">
                                    <?php
                                        $r=$row['USE_YN'];
                                        switch($r){
                                            case 'Y': echo '사용'; break;
                                            case 'N': echo '미사용'; break;
                                        }
                                    ?>
                                </td>
								<td class="c"><a href="./admin_detail.php?idx=<?= $row['IDX'] ?>" class="y_btn">수정</a>
								    <a href="javascript:del_row('<?= $row['IDX'] ?>');" class="r_btn"><span>삭제</span></a></td>
							</tr>
						</tbody>
                        <?php $i++;} ?>
					</table>
					<p class="pagenation">
                <?php

                    $searchCon = "&idx=".$_GET['idx']."&rangeOption=".$_GET['rangeOption']."&sch_word=".$_GET['sch_word']."&use_yn=".$_GET['use_yn']."";
                    
                    if($page <= 1)
                    { 
                        echo "<a class='prev_next'><img src='_img/comn/first.png' alt='맨처음'></a>"; 
                    }else{
                        echo "<a class='prev_next' href='?$searchCon&page=1'><img src='_img/comn/first.png' alt='맨처음'></a>"; 
                    }
                    if($page <= 1)
                    { 
                        echo "<a class='prev_next'><img src='_img/comn/prev.png' alt='이전으로'></a>";
                    }else{
                        $pre = $page-1; 
                        echo "<a class='prev_next' href='?$searchCon&page=$pre'><img src='_img/comn/prev.png' alt='이전으로'></a>"; 
                    }
                    for($i=$block_start; $i<=$block_end; $i++){ 
                        if($page == $i){ 
                        echo "<a class='on'><strong>$i</strong></a>"; 
                        }else{
                        echo "<a href='?$searchCon&page=$i'>$i</a>";
                        }
                    }
                    if($block_num > $total_block){
                        echo "<a class='prev_next'><img src='_img/comn/next.png' alt='다음으로'></a>";
                    }else{
                        $next = $page + 1; 
                        echo "<a class='prev_next' href='?$searchCon&page=$next'><img src='_img/comn/next.png' alt='다음으로'></a>"; 
                    }
                    if($page > $total_page){ 
                        echo "<a class='prev_next'><img src='_img/comn/last.png' alt='맨마지막'></a>";
                    }else{
                        echo "<a class='prev_next' href='?$searchCon&page=$total_page'><img src='_img/comn/last.png' alt='맨마지막'></a>"; 
                    }
                ?>
					</p>
				</div>
				
				<p class="r mt20"><a href="admin_create.php" class="r_btn_big">등록</a></p>
                
			</div>
		</div>

	</div>

<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>

</html>
