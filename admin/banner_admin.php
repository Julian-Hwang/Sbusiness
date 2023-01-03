<html lang="utf-8">
<body>
<?php
$menu_on="banner";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');
session_start();
login_check();
//admin_check();

    $pos = $_GET['pos']; //배너위치
    $last = $_GET['last']; //사용 여부
    $category = $_GET['search_keyfield']; //검색 카테고리
    $search = $_GET['search_keyword']; //검색어


    $condition = "1=1";
    if($search != "")
    {
        if($category == "BAN_TITLE" ) {
            $condition = "$condition"." AND "." BAN_TITLE like '%{$search}%'";
        }
        
        if($category == "BAN_LINK" ) {
            $condition = "$condition"." AND "." BAN_LINK like '%{$search}%'";
        }
        
    }

    if($pos != "") {
        if($pos == "up"){
            $condition = "$condition"." AND "." BAN_POSITION like '$pos'";
        }else if($pos == "down"){
            $condition = "$condition"." AND "." BAN_POSITION like '$pos'";
        }
        
    }
    
    if($last != "") {
        if($last == "Y"){
            $condition = "$condition"." AND "." USE_YN like '$last'";
        }else if($last == "N"){
            $condition = "$condition"." AND "." USE_YN like '$last'";
        }
        
    }


    $sql="select * from KPC_BANNER where $condition order by REG_DATE DESC";

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
                <a href="banner_admin.php">배너관리</a>
            </li>
	    </ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>배너관리</li>
			</ol>
            <h2>배너관리</h2>
            <form name="frm" id="frm"  action="./banner_admin.php" method="get">
                <input type="hidden" name="SubmitMode"	id="SubmitMode"	value=""/>
                <input type="hidden" name="idx" id="idx"  value="">

                <ul class="search_c">
                    <li>
                        <p class="tit">배너위치</p>
                        <select name="pos">
                            <option value="">--선택--</option>
                            <option value="up" <? if($_GET['pos'] == "up"){ ?> selected <? } ?> >상단</option>
                            <option value="down" <? if($_GET['pos'] == "down"){ ?> selected <? } ?> >하단</option>
                        </select>
                    </li>
                    <li>
                        <p class="tit">사용여부</p>
                        <select name="last">
                            <option value="">--선택--</option>
                            <option value="Y" <? if($_GET['last'] == 'Y'){ ?> selected <? } ?> >YES</option>
                            <option value="N" <? if($_GET['last'] == 'N'){ ?> selected <? } ?> >NO</option>
                        </select>
                    </li>
                    <li>
                        <p class="tit">검색구분</p>
                        <div class="search">
                            <p class="f_l">
                                <select class="select01" name="search_keyfield" id="search_keyfield" class="customSelect" style="cursor:pointer">
                                    <option value="all" <? if($_GET['search_keyfield'] == 'all'){ ?> selected <? } ?>  >전체</option>
                                    <option value="BAN_TITLE"<? if($_GET['search_keyfield'] == 'BAN_TITLE'){ ?> selected <? } ?> >배너 제목</option>
                                    <option value="BAN_LINK"<? if($_GET['search_keyfield'] == 'BAN_LINK'){ ?> selected <? } ?> >LINK URL</option>
                                </select>
                            </p>
                            <p class="re_info">
                                <input type="text" class="nor" name="search_keyword" id="search_keyword" value="<? echo $_GET['search_keyword']; ?>" placeholder="검색어를 입력해주세요" style="width:220px;">
                                <a href="javascript:frm.submit()" class="dark_btn">검색</a>
                            </p>
                        </div>
                    </li>
                </ul>

            </form>	
                <div class="tabel_t">
					<p class="re_text">총 <span><?= $row_num ?></span>개의 게시물이 있습니다.</p>
                    <div class="re_sel">
                        <a href="banner_insert.php" class="dark_btn"><span>추가</span></a>
                    </div>
				</div>
            
                <div class="ta_cont mt10">
                <table class="table01">
                <colgroup>
                    <col width="4%">
                    <col width="8%">
                    <col width="10%">
                    <col width="20%">
                    <col width="22%">
                    <col width="8%">
                    <col width="6%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">배너 위치</th>
                        <th class="c">배너 제목</th>
                        <th class="c">파일</th>
                        <th class="c">LINK URL</th>
                        <th class="c">사용 여부</th>
                        <th class="c">관리</th>                  
                    <tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row =(mysqli_fetch_array($result))) {
                ?>
                            <tr>
                                <td class="c"><?= $i; ?></td>
                                <td class="c">
                                    <?php
                                        $p=$row['BAN_POSITION'];
                                        switch($p){
                                            case 'up': echo '상단'; break;
                                            case 'down': echo '하단'; break;
                                        }
                                    ?>
                                </td>
                                <td class="c"><?= $row['BAN_TITLE']; ?> </td>
                                <th class="c">
                                    <?php
                                        if($row['FILE_ID']){
                                            echo '<img src="./_upload/banner_image/pc/'.$row['FILE_ID'].'" style="width:150px; height:50px">';
                                        }
                                    ?>
                                </th>
                                <td class="c"><?= $row['BAN_LINK']; ?></td>
                                <td class="c">
                                    <?php
                                        $r=$row['USE_YN'];
                                        switch($r){
                                            case 'Y': echo 'YES'; break;
                                            case 'N': echo 'NO'; break;
                                        }
                                    ?>
                                </td>
                                <td class="c">
                                    <a href="banner_detail.php?IDX=<?= $row['IDX']; ?>" class="y_btn">관리</a>
                                </td>
                            </tr>
                            <?php $i++;} ?>
                            
                        </tbody>
                    </table>
                <p class="pagenation">
                    <?php
                        $searchCon = "&search_keyfield=".$_GET['search_keyfield']."&search_keyword=".$_GET['search_keyword']."";
                        
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
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>

</html>
