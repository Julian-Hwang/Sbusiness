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
    if($last == "") {
        $sql="select * from KPC_ACHIEVE order by IDX DESC";
    }else if($last == "A"){
        $sql="select * from KPC_ACHIEVE where ACHIEVE_TYPE_CD like '$last' order by IDX DESC";
    }else if($last == "B"){
        $sql="select * from KPC_ACHIEVE where ACHIEVE_TYPE_CD like '$last' order by IDX DESC";
    }

    $result = mysqli_query($dbconn, $sql);

    $row_num = mysqli_num_rows($result); //게시판 총 레코드 수

    $A="select * from KPC_ACHIEVE where ACHIEVE_TYPE_CD='A'";
    $count_A=mysqli_query($dbconn, $A);
    $num_A=mysqli_num_rows($count_A);

    $B="select * from KPC_ACHIEVE where ACHIEVE_TYPE_CD='B'";
    $count_B=mysqli_query($dbconn, $B);
    $num_B=mysqli_num_rows($count_B);

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
                <a href="achieve_sort.php">주요실적관리</a>
            </li>
	    </ul>
		</div>
		<div id="contents">
			<ol class="loca">
				<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/> 홈</li>
				<li>주요실적관리</li>
			</ol>
            <h2>주요실적관리</h2>
            <form name="frm" id="frm"  action="./achieve_sort.php" method="get">
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
                        <a href="javascript:frm.submit()" class="dark_btn">선택하기</a>
                    </li>
                </ul>
            </form>	
                <div class="tabel_t">
					<p class="re_text">총 <span><?= $row_num ?></span>개의 게시물이 있습니다.</p>
                    <div class="re_sel">
                        <a href="achieve_insert.php" class="dark_btn"><span>추가</span></a>
                    </div>
				</div>
            
            <form name="frm1" id="frm1"  action="achieve_sort_proc.php" method="POST">
                <div class="ta_cont mt10">
                <table class="table01">
                <colgroup>
                    <col width="4%">
                    <col width="20%">
                    <col width="10%">
                    <col width="20%">
                    <col width="12%">
                    <col width="8%">
                    <col width="8%">
                </colgroup>
                <thead>
                    <tr>
                        <th class="c">No</th>
                        <th class="c">기업/단체명</th>
                        <th class="c">로고 이미지</th>
                        <th class="c">LINK URL</th>
                        <th class="c">정렬 순서</th>
                        <th class="c">분류</th>
                        <th class="c">관리</th>                  
                    <tr>
                </thead>
                <tbody>
                <?php
                $i = 1;
                while($row =(mysqli_fetch_array($result))) {
                ?>
                            <tr>
                                <input type="hidden" name="row_num" value="<?= $row_num; ?>"/>
                                <input type="hidden" name="ach_name[]" value="<? echo $row['ACHIEVE_NAME'];?>"/>
                                <input type="hidden" name="ach_code" value="<? echo $row['ACHIEVE_TYPE_CD'];?>"/>
                                <td class="c"><?= $i; ?></td>
                                <td class="c"><?= $row['ACHIEVE_NAME']; ?> </td>
                                <th class="c">
                                    <?php
                                        if($row['LOGO_ID']){
                                            echo '<img src="./_upload/achieve_image/'.$row['LOGO_ID'].'" style="width:150px; height:50px">';
                                        }
                                    ?>
                                </th>
                                <td class="c"><?= $row['ACHIEVE_LINK']; ?></td>
                                <td class="c">
                                    <select name="sort[]">
                                        <option value="0">--선택--</option>
                                        <?php 
                                            if($row['ACHIEVE_TYPE_CD']=='A'){
                                                $total=$num_A;
                                            }else if($row['ACHIEVE_TYPE_CD']=='B'){
                                                $total=$num_B;
                                            }
                                            for($j=0;$j<$total ;$j++){
                                        ?>
                                                <option value="<?= $j+1;?>" <? if(($j+1) == $row['ACHIEVE_SORT']){?>selected<?}?>><?= $j+1;?></option>
                                        <?
                                            }
                                        ?>
                                    </select>
                                    
                                </td>
                                <td class="c"><?= $row['ACHIEVE_TYPE']; ?></td>
                                <td class="c">
                                    <a href="achieve_detail.php?IDX=<?= $row['IDX']; ?>" class="y_btn">관리</a>
                                </td>
                            </tr>
                            <?php $i++;} ?>
                            
                        </tbody>
                    </table>
                </div>
            </form>
            <p class="r mt20"><a href="javascript:frm1.submit()" class="r_btn_big"><span>저장</span></a></p>
        </div>
    </div>

    <div id="copyright">
        <p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
    </div>
</div>
</body>

</html>
