<html lang="utf-8">
<body>
<?php
$menu_on="notice";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');

session_start();
login_check();
//admin_check();

    $sql = "SELECT * FROM KPC_NOTICE WHERE IDX ='".$_GET["IDX"]."'";
    
    $result = mysqli_query($dbconn, $sql);
  
    $row = mysqli_fetch_array($result);


?>
<script src="_js/edu.js" language="JavaScript" type="text/javascript"></script>
<script src="daumeditor/js/editor_loader.js" type="text/javascript" charset="utf-8"></script>	

<script>
function fn_submit(){
	if(checkForm("frm")){
		$("#frm").submit();
		Editor.save();
	}
}

function validForm(editor) {
	// Place your validation logic here

	// sample : validate that content exists
	var validator = new Trex.Validator();
	var contents = editor.getContent();
	if (!validator.exists(contents)) {
		alert('내용을 입력하세요');
		return false;
	}

	return true;
}

function setForm(editor) {
	var i, input;
	var form = editor.getForm();
	var contents = editor.getContent();

	// 본문 내용을 필드를 생성하여 값을 할당하는 부분
	var textarea = document.createElement('textarea');
	textarea.name = 'contents';
	textarea.value = contents;
	form.createField(textarea);

	/* 아래의 코드는 첨부된 데이터를 필드를 생성하여 값을 할당하는 부분으로 상황에 맞게 수정하여 사용한다.
	 첨부된 데이터 중에 주어진 종류(image,file..)에 해당하는 것만 배열로 넘겨준다. */
	var images = editor.getAttachments('image');
	for (i = 0; i < images.length; i++) {
		// existStage는 현재 본문에 존재하는지 여부
		if (images[i].existStage) {
			// data는 팝업에서 execAttach 등을 통해 넘긴 데이터
			//alert('attachment information - image[' + i + '] \r\n' + JSON.stringify(images[i].data));
			input = document.createElement('input');
			input.type = 'hidden';
			input.name = 'attach_image';
			input.value = images[i].data.imageurl;  // 예에서는 이미지경로만 받아서 사용
			form.createField(input);
		}
	}

	var files = editor.getAttachments('file');
	for (i = 0; i < files.length; i++) {
		input = document.createElement('input');
		input.type = 'hidden';
		input.name = 'attach_file';
		input.value = files[i].data.attachurl;
		form.createField(input);
	}
	return true;
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
            <a href="notice_admin.php">공지관리</a>	
		</li>
    </ul>
</div>
<div id="contents">
		<ol class="loca">
			<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/>홈페이지 관리</li>
			<li>ESG 공지 상세</li>
		</ol>
			<h2>ESG 공지 상세</h2>
            <form name="frm" id="frm" action="notice_update_proc.php" method="post" enctype="multipart/form-data">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="10%"> <col width="35%"> <col width="15%"> <col width="*"> </colgroup>
					<tbody>
                        <tr>
                            <td colspan="4" style="text-align:center">공지사항</td>	
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td colspan="3"><input type="text" name="title" class="nor" style="width:100%;height:30px;" value="<?php echo $row['NOT_TITLE'] ?>"></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td colspan="3">
<? 
								$daumSeq = 1;
								$daumName = "contents";
								$daumDefault = $row['NOT_CONTENT'] ?? NULL;
								$areaHeight = 200;
								include "daumeditor/daumeditor.php"; 
?>
							</td>  
                        </tr>
                        <tr>
                            <th>작성일</th>
                            <td colspan="3"><?= $row['REG_DATE'] ?></td>
                        </tr>
                        <tr>
                            <th>수정일</th>
                            <td colspan="3"><?= $row['MOD_DATE'] ?></td>
                        </tr>
                        <tr>
                            <th>상단 공지 여부</th>
                            <td>
                                <select id="state" name="state">
                                    <option value="Y" <?if($row['NOTICE_YN'] == "Y"){?>selected<?}?>>YES</option>
                                    <option value="N" <?if($row['NOTICE_YN'] == "N"){?>selected<?}?>>NO</option>
                                </select>
                            </td>
                            <th>삭제여부</th>
                            <td>
                                <select id="del" name="del">
                                    <option value="Y" <?if($row['DEL_YN'] == "Y"){?>selected<?}?>>YES</option>
                                    <option value="N" <?if($row['DEL_YN'] == "N"){?>selected<?}?>>NO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>파일 업로드1</th>
                            <td colspan="3">
                                <input type="file" name="file1" id="file1"/><br>
                                <?php
                                    // $file_sql = "SELECT * FROM KPC_FILE WHERE SELECT NOT_IDX={$_GET['IDX']} AND DEL_YN = 'N' ORDER BY REG_DATE DESC, IDX";
									$file_sql = "SELECT * FROM KPC_FILE WHERE FILE_ID = (SELECT NOT_ATTACH1 FROM KPC_NOTICE WHERE IDX = {$_GET['IDX']})";
                                    $file_result = mysqli_query($dbconn, $file_sql);
									$fileRow = mysqli_fetch_array($file_result);
                                ?>
                                <a href="#" class="file" title='다운로드' onclick="window.open('./download.php?&file_id=<?= $fileRow['FILE_ID'];?>')"><?= $fileRow['USR_FILE_NAME']; ?></a>
                                <a href="#" onclick="location.href='deletefile.php?num=1&&file_id=<?= $fileRow['FILE_ID'];?>'" title='삭제'> [삭제]</a>
                                
                            </td>
                        </tr>
                        <tr>
                            <th>파일 업로드2</th>
                            <td colspan="3">
                                <input type="file" name="file2" id="file2"/><br>
                                <?php
                                    // $file_sql = "SELECT * FROM KPC_FILE WHERE SELECT NOT_IDX={$_GET['IDX']} AND DEL_YN = 'N' ORDER BY REG_DATE DESC, IDX";
									$file_sql2 = "SELECT * FROM KPC_FILE WHERE FILE_ID = (SELECT NOT_ATTACH2 FROM KPC_NOTICE WHERE IDX = {$_GET['IDX']})";
                                    $file_result2 = mysqli_query($dbconn, $file_sql2);
									$fileRow2 = mysqli_fetch_array($file_result2);
                                ?>
                                <a href="#" class="file" title='다운로드' onclick="window.open('./download.php?file_id=<?= $fileRow2['FILE_ID']; ?>')"><?= $fileRow2['USR_FILE_NAME']; ?></a>
                                <a href="#" onclick="location.href='deletefile.php?num=2&&file_id=<?= $fileRow2['FILE_ID'];?>'"> [삭제]</a>
                                
                            </td>
                        </tr>
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="notice_admin.php" class="b_btn_big">목록</a>
			<a href="javascript:fn_submit()" id="gBtn1" class="r_btn_big"><span>수정</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

