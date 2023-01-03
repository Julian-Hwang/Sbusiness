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

    $sql = "SELECT * FROM KPC_BANNER WHERE IDX ='".$_GET["IDX"]."'";
    
    $result = mysqli_query($dbconn, $sql);
  
    $row = mysqli_fetch_array($result);

?>
<script src="_js/edu.js" language="JavaScript" type="text/javascript"></script>

<script>
$(document).ready(function(){
    var result = $('#position').val();
    if(result == "down"){
        $('#img_mo').hide();
        $('#img_mo2').hide();
    } else {
        $('#img_mo').show();
        $('#img_mo2').show();
    }

    $('#position').change(function(){
        result = $('#position').val();

        if(result == 'down'){
            $('#img_mo').hide();
            $('#img_mo2').hide();
        } else{
            $('#img_mo').show();
            $('#img_mo2').show();
        }
    })
});

function fn_submit(){
    if($("#position").val().trim()==""){
        alert("배너 위치를 선택해주세요");
        $("#position").focus();
        return false;
    }
    if($("#exists_image").val() == "" && $("input[name=image1]").val() == "") {
		alert("배너이미지(pc)를 첨부해주세요.");
		$("input[name=image1]").focus();
		return false;
	}
    if($("#exists_imageM").val() == "" && $("input[name=image2]").val() == "" && $("#position").val()=="up") {
		alert("배너이미지(모바일)를 첨부해주세요.");
		$("input[name=image2]").focus();
		return false;
	}
	$("#frm").submit();
}


</script>
</head>
<div id="wrap">
    <?php include ("include/header.php")?>
<!--싱세 화면-->
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
			<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/>홈페이지 관리</li>
			<li>배너관리</li>
		</ol>
			<h2>배너관리</h2>
            <form name="frm" id="frm" action="banner_update_proc.php" method="post" enctype="multipart/form-data">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="10%"> <col width="35%"> <col width="15%"> <col width="*"> </colgroup>
					<tbody>
                        <tr>
                            <td colspan="4" style="text-align:center">배너</td>	
                        </tr>
                        <tr>
                            <th>배너 위치*</th>
                            <td colspan="3">
                                <select id="position" name="position" >
                                    <option value="">--선택--</option>
                                    <option value="up" <?if($row['BAN_POSITION'] == "up"){?>selected<?}?>>상단</option>
                                    <option value="down" <?if($row['BAN_POSITION'] == "down"){?>selected<?}?>>하단</option>
                                </select>
							</td>  
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td colspan="3"><input type="text" name="title" class="nor" style="width:100%;height:30px;" value="<?php echo $row['BAN_TITLE'] ?>"></td>
                        </tr>
                        <tr>
                            <th>LINK URL</th>
                            <td colspan="3"><input type="text" name="url" class="nor" style="width:100%;height:30px;" value="<?php echo $row['BAN_LINK'] ?>"></td>
                        </tr>
                        <tr>
                            <th>배너 이미지(pc)</th>
                            <td colspan="3"><img id="image1_ban" src="./_upload/banner_image/pc/<?php echo $row['FILE_ID'] ?>" style="width:500px; height:150px"></td>
                        </tr>
                        <tr>
                            <th>이미지 첨부(pc)*</th>
                            <td colspan="3">
                                <input type="file" name="image1" id="image1"/><br>
                                <?php
                                    // $file_sql = "SELECT * FROM KPC_FILE WHERE SELECT NOT_IDX={$_GET['IDX']} AND DEL_YN = 'N' ORDER BY REG_DATE DESC, IDX";
									$file_sql = "SELECT * FROM KPC_BANNER WHERE IDX = {$_GET['IDX']}";
                                    $file_result = mysqli_query($dbconn, $file_sql);
									$fileRow = mysqli_fetch_array($file_result);
                                ?>
                                <a href="#" class="file" title='다운로드' onclick="window.open('./banner_download.php?&file_id=<?= $fileRow['FILE_ID'];?>')"><?= $fileRow['FILE_ID']; ?></a>
                                <a href="#" onclick="location.href='banner_delete.php?num=1&&file_id=<?= $fileRow['FILE_ID'];?>'" title='삭제'> [삭제]</a>
                                <input type="hidden" id="exists_image" name="exists_image" value="<?= $row['FILE_ID'];?>"/>

                            </td>
                        </tr>
                        <tr id="img_mo">
                            <th>배너 이미지(모바일)</th>
                            <td colspan="3"><img id="image2_ban" src="./_upload/banner_image/mo/<?php echo $row['FILE_ID_M'] ?>" style="width:275px; height:250px"></td>
                        </tr>
                        <tr id="img_mo2">
                            <th>이미지 첨부(모바일)*</th>
                            <td colspan="3">
                                <input type="file" name="image2" id="image2"/><br>
                                <?php
                                    // $file_sql = "SELECT * FROM KPC_FILE WHERE SELECT NOT_IDX={$_GET['IDX']} AND DEL_YN = 'N' ORDER BY REG_DATE DESC, IDX";
									$file_sql = "SELECT * FROM KPC_BANNER WHERE IDX = {$_GET['IDX']}";
                                    $file_result = mysqli_query($dbconn, $file_sql);
									$fileRow = mysqli_fetch_array($file_result);
                                ?>
                                <a id='download' href="#" class="file" title='다운로드' onclick="window.open('./banner_download_m.php?&file_id=<?= $fileRow['FILE_ID_M'];?>')"><?= $fileRow['FILE_ID_M']; ?></a>
                                <a id="delete" href="#" onclick="location.href='banner_delete_m.php?num=1&&file_id=<?= $fileRow['FILE_ID_M'];?>'" title='삭제'> [삭제]</a>
                                <input type="hidden" id="exists_imageM" name="exists_imageM" value="<?= $row['FILE_ID_M'];?>"/>
                            </td>
                        </tr>
                        <tr>
                            <th>사용</th>
                            <td colspan="3">
                                <select id="state" name="state">
                                    <option value="Y" <?if($row['USE_YN'] == "Y"){?>selected<?}?>>YES</option>
                                    <option value="N" <?if($row['USE_YN'] == "N"){?>selected<?}?>>NO</option>
                                </select>
                            </td>
                        </tr>                       
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="banner_admin.php" class="b_btn_big">목록</a>
			<a href="javascript:fn_submit()" id="gBtn1" class="r_btn_big"><span>수정</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

