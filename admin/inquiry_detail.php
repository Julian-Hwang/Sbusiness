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

    $sql = "SELECT *FROM KPC_INQUIRY WHERE IDX ='".$_GET["IDX"]."'";
    
    $result = mysqli_query($dbconn, $sql);
  
    $row = mysqli_fetch_array($result);


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
            <a href="inquiry_admin.php">문의사항관리</a>	
		</li>
	</ul>
</div>
<div id="contents">
		<ol class="loca">
			<li><img class="mt5 mr5" src="_img/comn/home_img.png" alt="나의설정"/>홈페이지 관리</li>
			<li>ESG 문의 상세</li>
		</ol>
			<h2>ESG 문의 상세</h2>
            <form name="frm" id="frm" action="inquiry_update_proc.php" method="post">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="10%"> <col width="35%"> <col width="15%"> <col width="*"></colgroup>
					<tbody>
                        <tr>
                            <td colspan="4" style="text-align:center">문의 내용</td>	
                        </tr>	
                        <tr>
                            <th>작성자</th>
                            <td colspan="3"><?= $row['INQ_WRITER']; ?></td>

                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td colspan="3"><?= $row['INQ_EMAIL'] ?></td>                      
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td colspan="3"><?= $row['INQ_TITLE'] ?></td>
                        </tr>
                        <tr>
                            <th>내용</th>
                            <td colspan="3"><?= $row['INQ_CONT'] ?></td>  
                        </tr>
                        <tr>
                            <th>작성일</th>
                            <td colspan="3"><?= $row['INQ_WRITEDATE'] ?></td>
                        </tr>
                        <tr>
                            <th>처리일</th>
                            <td><?= $row['INQ_PROC_DATE'] ?></td>
                            <th>처리 아이디</th>
                            <td><?= $row['INQ_PROC_ID'] ?></td>
                        </tr>
                        <tr>
                            <th>처리 상태</th>
                            <td>
                                <select id="state" name="state">
                                    <option value="3" <?if($row['INQ_STATE'] == "3"){?>selected<?}?>>처리완료</option>
                                    <option value="2" <?if($row['INQ_STATE'] == "2"){?>selected<?}?>>처리중</option>
                                    <option value="1" <?if($row['INQ_STATE'] == "1"){?>selected<?}?>>문의접수</option>
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
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="inquiry_admin.php" class="b_btn_big">목록</a>
			<a href="javascript:frm.submit()" id="gBtn1" class="r_btn_big"><span>수정</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

