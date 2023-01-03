<html lang="utf-8">
<body>
<?php
$menu_on="banner";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');

login_check();

    $sql = "SELECT *FROM KPC_NOTICE WHERE IDX ='".$_GET["IDX"]."'";
    
    $result = mysqli_query($dbconn, $sql);
  
    $row = mysqli_fetch_array($result);


?>

<script src="_js/edu.js" language="JavaScript" type="text/javascript"></script>
<script>
$(document).ready(function(){
    $('#position').change(function(){
        var result = $('#position').val();
        if(result == 'down'){
            $('#img_mo').hide();
        } else{
            $('#ima_mo').show();
        }
    })
});

function fn_submit(){
    if($("#position").val().trim()==""){
        alert("배너 위치를 선택해주세요");
        $("#position").focus();
        return false;
    }
    if($("input[name=image1]").val() == "") {
		alert("배너이미지(pc)를 첨부해주세요.");
		$("input[name=image1]").focus();
		return false;
	}
    if($("input[name=image2]").val() == "" && $("#position").val().trim()=="up") {
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
            <form name="frm" id="frm" action="banner_insert_proc.php" method="post" enctype="multipart/form-data">
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
                                <select id="position" name="position">
                                    <option value="">--선택--</option>
                                    <option value="up">상단</option>
                                    <option value="down">하단</option>
                                </select>
							</td>  
                        </tr>
                        <tr>
                            <th>제목</th>
                            <td colspan="3"><input type="text" name="title" class="nor" style="width:100%;height:30px;"></td>
                        </tr>
						<tr>
                            <th>LINK URL</th>
                            <td colspan="3"><input type="text" name="url" class="nor" style="width:100%;height:30px;"></td>
                        </tr>
                        <tr>
                            <th>배너 이미지(PC)*</th>
                            <td colspan="3">
                                <input type="file" name="image1" id="image1"/>                              
                            </td>
                        </tr>
                        <tr id='img_mo'>
                            <th>배너 이미지(모바일)*</th>
                            <td colspan='3'>
                                <input type='file' name='image2' id='image2'/>                              
                            </td>
                        </tr>                       
                        <tr>
                            <th>사용</th>
                            <td colspan="3">
                                <select id="state" name="state">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </td>
                        </tr>
                        
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="banner_admin.php" class="b_btn_big">목록</a>
			<a href="javascript:fn_submit()" id="gBtn1" class="r_btn_big"><span>등록</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

