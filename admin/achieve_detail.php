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

    $sql = "SELECT * FROM KPC_ACHIEVE WHERE IDX ='".$_GET["IDX"]."'";
    
    $result = mysqli_query($dbconn, $sql);
  
    $row = mysqli_fetch_array($result);


?>

</head>
<div id="wrap">
    <?php include ("include/header.php")?>
<!--싱세 화면-->
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
			<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/>홈페이지 관리</li>
			<li>주요실적관리</li>
		</ol>
			<h2>주요실적관리</h2>
            <form name="frm" id="frm" action="achieve_update_proc.php" method="post" enctype="multipart/form-data">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="10%"> <col width="35%"> <col width="15%"> <col width="*"> </colgroup>
					<tbody>
                        <tr>
                            <td colspan="4" style="text-align:center">주요실적</td>	
                        </tr>
                        <tr>
                            <th>기업 단체명</th>
                            <td colspan="3">
                                <input type="text" name="name" class="nor" style="width:100%;height:30px;" value="<?php echo $row['ACHIEVE_NAME'] ?>">
							</td>  
                        </tr>
                        <tr>
                            <th>주소</th>
                            <td colspan="3">
                                <input type="text" name="link" class="nor" style="width:100%;height:30px;" value="<?php echo $row['ACHIEVE_LINK'] ?>">
							</td>  
                        </tr>
                        <tr>
                            <th>분류</th>
                            <td colspan="3">
                                <select id="type" name="type">
                                    <option value="A" <?if($row['ACHIEVE_TYPE_CD'] == "A"){?>selected<?}?>>온라인진출지원</option>
                                    <option value="B" <?if($row['ACHIEVE_TYPE_CD'] == "B"){?>selected<?}?>>경영환경개선</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>사용 여부</th>
                            <td colspan="3">
                                <select id="state" name="state">
                                    <option value="Y" <?if($row['USE_YN'] == "Y"){?>selected<?}?>>YES</option>
                                    <option value="N" <?if($row['USE_YN'] == "N"){?>selected<?}?>>NO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>로고 이미지</th>
                            <td colspan="3"><img src="../sbusiness/_img/pc/cont/logo_bg.png" style="background:url('./_upload/achieve_image/<?php echo $row['LOGO_ID'] ?>')no-repeat 50% 50%;"></td>
                        </tr>
                        <tr>
                            <th>로고 바꾸기</th>
                            <td colspan="3">
                                <input type="file" name="file1" id="file1"/><br>
                                <?php
                                    // $file_sql = "SELECT * FROM KPC_FILE WHERE SELECT NOT_IDX={$_GET['IDX']} AND DEL_YN = 'N' ORDER BY REG_DATE DESC, IDX";
									$file_sql = "SELECT * FROM KPC_ACHIEVE WHERE IDX = {$_GET['IDX']}";
                                    $file_result = mysqli_query($dbconn, $file_sql);
									$fileRow = mysqli_fetch_array($file_result);
                                ?>
                                <a href="#" class="file" title='다운로드' onclick="window.open('./ach_download.php?&file_id=<?= $fileRow['LOGO_ID'];?>')"><?= $fileRow['LOGO_ID']; ?></a>
                                <a href="#" onclick="location.href='ach_delete.php?num=1&&file_id=<?= $fileRow['LOGO_ID'];?>'" title='삭제'> [삭제]</a>
                                <input type="hidden" name="exists_image" value="<?= $row['LOGO_ID'];?>"/>

                                
                            </td>
                        </tr>
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="achieve_sort.php" class="b_btn_big">목록</a>
			<a href="javascript:frm.submit()" id="gBtn1" class="r_btn_big"><span>수정</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

