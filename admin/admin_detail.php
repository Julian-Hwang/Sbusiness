<html lang="utf-8">
<body>
<?php
include('include/adminHeader.php');
include('include/inc.php');
include('include/db.php');

login_check();

$sql = "SELECT * FROM KPC_MEMBER WHERE IDX={$_GET['idx']}";
$result = mysqli_query($dbconn, $sql);
$row = (mysqli_fetch_array($result));   

?>
<script src="_js/edu.js" language="JavaScript" type="text/javascript"></script>
<script>
$(document).ready(function(){
	
});

function fn_submit(){
	if(checkForm("frm")){
		if(checkFileForm()){
			//$("#frm").submit();
			Editor.save();
		}
	}
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
            <a href="admin_list.php">관리자관리</a>	
		</li>
	</ul>
</div>
<div id="contents">
		<ol class="loca">
			<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/>홈페이지 관리</li>
			<li>관리자 정보 수정</li>
		</ol>
			<h2>관리자 정보 수정</h2>
            <form name="frm" id="frm" action="admin_update_proc.php?idx=<?= $row['IDX'] ?>&mode=update" method="post">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="160px"> <col width=""> </colgroup>
					<tbody>	
                        <tr>
                            <th>NO</th>
                            <td colspan="3"><?= $row['IDX']; ?></td>

                        </tr>
                        <tr>
                            <th>ID</th>
                            <td colspan="3"><input type="text" class="nor" name="mb_id" id="mb_id" value="<?= $row['MEM_ID'] ?>" style="width:220px;"></td>                  
                        </tr>
                        <tr>
                            <th>비밀번호</th>
                            <td colspan="3"><input type="password" class="nor" name="mb_pw" id="mb_pw" value="" placeholder="6자 이상 영자 숫자 조합" style="width:220px;"></td>                  
                        </tr>
                        <tr>
                            <th>비밀번호 확인</th>
                            <td colspan="3"><input type="password" class="nor" name="mb_pw_check" id="mb_pw_check" value="" style="width:220px;"></td>                  
                        </tr>
                        <tr>
                            <th>이름</th>
                            <td colspan="3"><input type="text" class="nor" name="mb_name" id="mb_name" value="<?= $row['MEM_NAME'] ?>" style="width:220px;"></td>
                        </tr>
                        <tr>
                            <th>휴대폰</th>
                            <td colspan="3"><input type="text" class="nor" name="mb_tel" id="mb_tel" value="<?= $row['MEM_TEL'] ?>" style="width:220px;"></td>
                        </tr>
                        <tr>
                            <th>사용유무</th>
                            <td>
                                <select id="state" name="state">
                                    <option value="Y" <?if($row['USE_YN'] == "Y"){?>selected<?}?>>사용</option>
                                    <option value="N" <?if($row['USE_YN'] == "N"){?>selected<?}?>>미사용</option>
                                </select>
                            </td>
                        </tr>
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="admin_list.php" class="b_btn_big">목록</a>
			<a href="javascript:frm.submit()" id="gBtn1" class="r_btn_big"><span>수정</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

