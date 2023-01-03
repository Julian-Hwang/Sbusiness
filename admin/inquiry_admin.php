<html lang="utf-8">
<body>
<?php
$menu_on="inquiry";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');
session_start();
login_check();
//admin_check();

    $last = $_GET['last']; //처리상태
    $category = $_GET['search_keyfield']; //검색 카테고리
    $search = $_GET['search_keyword']; //검색어
    $Sdate = $_GET['startDate']; //작성일 시작
    $Edate = $_GET['endDate']; //작성일 끝
    $Sdate_1 = $_GET['startDate_1']; //처리일 시작
    $Edate_1 = $_GET['endDate_1']; //처리일 끝


    $condition = "1=1";
    if($search != "")
    {
        if($category == "INQ_WRITER" ) {
            $condition = "$condition"." AND "." INQ_WRITER like '%{$search}%'";
        }
        
        if($category == "INQ_EMAIL" ) {
            $condition = "$condition"." AND "." INQ_EMAIL like '%{$search}%'";
        }
        
        if($category == "INQ_TITLE" ) {
            $condition = "$condition"." AND "." INQ_TITLE like '%{$search}%'";
        }
        
        if($category == "INQ_PROC_ID" ) {
            $condition = "$condition"." AND "." INQ_PROC_ID like '%{$search}%'";
        }
    }

    if($last != "") {
        if($last == "Y"){
            $condition = "$condition"." AND "." INQ_STATE like '$last'";
        }else if($last == "N"){
            $condition = "$condition"." AND "." INQ_STATE like '$last'";
        }
        else if($last == "X"){
            $condition = "$condition"." AND "." INQ_STATE like '$last'";
        }
        
    }

    if($Sdate && $Edate != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_WRITEDATE,'%Y-%m-%d')  BETWEEN '$Sdate' AND  '$Edate'";
    }
    else if($Sdate != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_WRITEDATE,'%Y-%m-%d') >= '$Sdate'";
    }
    else if($Edate != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_WRITEDATE,'%Y-%m-%d')  <= '$Edate'";
    }

    if($Sdate_1 && $Edate_1 != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_PROC_DATE,'%Y-%m-%d')  BETWEEN '$Sdate_1' AND  '$Edate_1'";
    }
    else if($Sdate_1 != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_PROC_DATE,'%Y-%m-%d') >= '$Sdate_1'";
    }
    else if($Edate_1 != "" ) {
        $condition = "$condition"." AND "." DATE_FORMAT(INQ_PROC_DATE,'%Y-%m-%d')  <= '$Edate_1'";
    }

    $sql="select * from KPC_INQUIRY where $condition order by INQ_WRITEDATE DESC";

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

<div id="wrap">
	<?php include ("include/header.php")?>

	<div id="container">
		<div id="left">
        <ul class="left_menu">
		<li>
            <a href="inquiry_admin.php">문의사항관리</a>	
		</li>
	</ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>ESG 문의 관리</li>
			</ol>
            <h2>ESG 문의 관리</h2>
            <form name="frm" id="frm"  action="./inquiry_admin.php" method="get">
                <input type="hidden" name="SubmitMode"	id="SubmitMode"	value=""/>
                <input type="hidden" name="idx" id="idx"  value="">

                <ul class="search_c">
                    <li>
                        <p class="tit">처리 상태</p>
                        <select name="last">
                            <option value="">--선택--</option>
                            <option value="Y" <? if($_GET['last'] == 'Y'){ ?> selected <? } ?> > 처리완료</option>
                            <option value="N" <? if($_GET['last'] == 'N'){ ?> selected <? } ?> > 처리중</option>
                            <option value="X" <? if($_GET['last'] == 'X'){ ?> selected <? } ?> > 문의접수</option>
                        </select>
                    </li>

                    <li>
                        <p class="tit">작성일</p>
                        <input class="nor" type="date" value="<? echo $_GET['startDate'];?>" name="startDate"> ~ <input class="nor" type="date" value="<? echo $_GET['endDate'];?>" name="endDate">
                    </li>

                    <li>
                        <p class="tit">처리일</p>
                        <input class="nor" type="date" value="<? echo $_GET['startDate_1'];?>" name="startDate_1"> ~ <input class="nor" type="date" value="<? echo $_GET['endDate_1'];?>" name="endDate_1">
                    </li>

                    <li>
                        <p class="tit">검색구분</p>
                        <div class="search">
                            <p class="f_l">
                                <select class="select01" name="search_keyfield" id="search_keyfield" class="customSelect" style="cursor:pointer">
                                    <option value="all" <? if($_GET['search_keyfield'] == 'all'){ ?> selected <? } ?>  >전체</option>
                                    <option value="INQ_WRITER" <? if($_GET['search_keyfield'] == 'INQ_WRITER'){ ?> selected <? } ?>>작성자</option>
                                    <option value="INQ_EMAIL" <? if($_GET['search_keyfield'] == 'INQ_EMAIL'){ ?> selected <? } ?> >이메일</option>
                                    <option value="INQ_TITLE"<? if($_GET['search_keyfield'] == 'INQ_TITLE'){ ?> selected <? } ?> >제목</option>
                                    <option value="INQ_PROC_ID"<? if($_GET['search_keyfield'] == 'INQ_PROC_ID'){ ?> selected <? } ?> >처리 아이디</option>
                                </select>
                            </p>
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
                    <col width="8%">
                    <col width="20%">
                    <col width="16%">
                    <col width="16%">
                    <col width="8%">
                    <col width="8%">
                    <col width="12%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">작성자</th>
                        <th class="c">작성일</th>
                        <th class="c">이메일</th>
                        <th class="c">제목</th>
                        <th class="c">처리 상태</th>
                        <th class="c">처리 아이디</th>
                        <th class="c">처리일</th>
                        <th class="c">관리</th>
                    <tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row =(mysqli_fetch_array($result2))) {
                ?>
                            <tr>
                                <td class="c"><?= $start_num+$i; ?></td>
                                <td class="c"><?= $row['INQ_WRITER']; ?></td>
                                <td class="c"><?= $row['INQ_WRITEDATE']; ?></td>
                                <td class="c"><?= $row['INQ_EMAIL']; ?></td>
                                <td class="c"><?= $row['INQ_TITLE']; ?></td>
                                <td class="c">
                                    <?php
                                        $r=$row['INQ_STATE'];
                                        switch($r){
                                            case '3': echo '처리완료'; break;
                                            case '2': echo '처리중'; break;
                                            case '1': echo '문의접수'; break;
                                        }
                                    ?>
                                </td>
                                <td class="c"><?= $row['INQ_PROC_ID']; ?></td>
                                <td class="c"><?= $row['INQ_PROC_DATE']; ?></td>
                                <td class="c">
                                    <a href="inquiry_detail.php?IDX=<?= $row['IDX']; ?>" class="y_btn">관리</a>
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
            </form>	
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>

</html>
