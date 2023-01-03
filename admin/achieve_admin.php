<html lang="utf-8">
<body>
<?php
$menu_on="achieve";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');
session_start();
login_check();
//admin_check();

    $last = $_GET['last']; //분류
    $search = $_GET['search_keyword']; //검색어
    $num = $_GET['num']; //정렬 순서

    $condition = "1=1";
    if($last != "") {
        if($last == "A"){
            $condition = "$condition"." AND "." ACHIEVE_TYPE_CD like '$last'";
        }else if($last == "B"){
            $condition = "$condition"." AND "." ACHIEVE_TYPE_CD like '$last'";
        }
    }

    if($search != "")
    {   
        $condition = "$condition"." AND "." ACHIEVE_NAME like '%{$search}%'";
    }

    if($num != "") {
        if($num == "A"){
            $condition = "$condition"."  order by ACHIEVE_SORT ASC";
        }else if($num == "D"){
            $condition = "$condition"."  order by ACHIEVE_SORT DESC";
        }
    }

    $sql="select * from KPC_ACHIEVE where $condition order by IDX DESC";

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
<style>
.nor#search_keyword {
    border-left: 1px solid #ccc;
}
</style>

<div id="wrap">
	
    <?php include ("include/header.php")?>
	<div id="container">
		<div id="left">
        <ul class="left_menu">
            <li>
                <a href="achieve_admin.php">주요실적관리</a>
                <a href="achieve_sort.php">주요실적정렬</a>
            </li>
	    </ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>주요실적관리</li>
			</ol>
            <h2>주요실적관리</h2>
            <form name="frm" id="frm"  action="./achieve_admin.php" method="get">
                <input type="hidden" name="SubmitMode"	id="SubmitMode"	value=""/>
                <input type="hidden" name="idx" id="idx"  value="">

                <ul class="search_c">
                    <li>
                        <p class="tit">분류</p>
                        <select name="last">
                            <option value="">--선택--</option>
                            <option value="A" <? if($_GET['last'] == 'A'){ ?> selected <? } ?> >온라인진출지원</option>
                            <option value="B" <? if($_GET['last'] == 'B'){ ?> selected <? } ?> >경영환경개선</option>
                        </select>
                    </li>
                    <li>
                        <p class="tit">정렬순서</p>
                        <select name="num">
                            <option value="">--선택--</option>
                            <option value="A" <? if($_GET['num'] == 'A'){ ?> selected <? } ?> >오름차순</option>
                            <option value="D" <? if($_GET['num'] == 'D'){ ?> selected <? } ?> >내림차순</option>
                        </select>
                    </li>
                    <li>
                        <p class="tit">검색</p>
                        <div class="search">
                            <p class="re_info">
                                <input type="text" class="nor" name="search_keyword" id="search_keyword" value="<? echo $_GET['search_keyword']; ?>" placeholder="검색어를 입력해주세요" style="width:220px;">
                                <a href="javascript:frm.submit()" class="dark_btn">검색</a>
                            </p>
                        </div>
                    </li>
                </ul>

                <div class="tabel_t">
					<p class="re_text">총 <span><?= $row_num ?></span>개의 게시물이 있습니다.</p>
				</div>
                <div class="ta_cont mt10">
                <table class="table01">
                <colgroup>
                    <col width="4%">
                    <col width="20%">
                    <col width="20%">
                    <col width="16%">
                    <col width="16%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">기업/단체명</th>
                        <th class="c">LINK URL</th>
                        <th class="c">정렬 순서</th>
                        <th class="c">분류</th>                       
                        <th class="c">관리</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row =(mysqli_fetch_array($result2))) {
                ?>
                            <tr>
                                <td class="c"><?= $i; ?></td>
                                <td class="c"><?= $row['ACHIEVE_NAME']; ?></td>
                                <td class="c"><?= $row['ACHIEVE_LINK']; ?></td>
                                <td class="c"><?= $row['ACHIEVE_SORT']; ?></td>
                                <td class="c"><?= $row['ACHIEVE_TYPE']; ?></td>
                                <td class="c">
                                    <a href="achieve_detail.php?IDX=<?= $row['IDX']; ?>" class="y_btn">관리</a>
                                </td>
                            </tr>
                            <?php $i++;} ?>
                        </tbody>
                    </table>
                 
                <p class="pagenation">
                <?php

                    $searchCon = "SubmitMode=".$_GET['SubmitMode']."&idx=".$_GET['idx']."&last=".$_GET['last']."&startDate=".$_GET['startDate']."&endDate=".$_GET['endDate']."&search_keyfield=".$_GET['search_keyfield']."&search_keyword=".$_GET['search_keyword']."";
                    
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
                    if($block_num >= $total_block){
                        echo "<a class='prev_next'><img src='_img/comn/next.png' alt='다음으로'></a>";
                    }else{
                        $next = $page + 1; 
                        echo "<a class='prev_next' href='?$searchCon&page=$next'><img src='_img/comn/next.png' alt='다음으로'></a>"; 
                    }
                    if($page >= $total_page){ 
                        echo "<a class='prev_next'><img src='_img/comn/last.png' alt='맨마지막'></a>";
                    }else{
                        echo "<a class='prev_next' href='?$searchCon&page=$total_page'><img src='_img/comn/last.png' alt='맨마지막'></a>"; 
                    }
                ?>
                </p>
            </div>
            <p class="r mt20"><a href="achieve_insert.php" class="r_btn_big"><span>등록</span></a></p>
            </form>	
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>

</html>
