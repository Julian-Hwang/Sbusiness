<html lang="utf-8">
<body>
<?php
$menu_on="achieve";
include ("include/adminHeader.php");
include('include/inc.php');
include('include/db.php');

login_check();

    $sql = "SELECT *FROM KPC_NOTICE WHERE IDX ='".$_GET["IDX"]."'";
    
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
            <form name="frm" id="frm" action="achieve_create_proc.php" method="post" enctype="multipart/form-data">
            <input type= "hidden" name="idx" value="<?=$row['IDX']?>" >
            <div class="ta_cont mt20">
				<table class="bbs_write" >
					<colgroup> <col width="10%"> <col width="35%"> <col width="15%"> <col width="*"> </colgroup>
					<tbody>
                        <tr>
                            <td colspan="4" style="text-align:center">주요실적</td>	
                        </tr>
                        <tr>
                            <th>기업명</th>
                            <td colspan="3">
                                <input type="text" name="name" class="nor" style="width:100%;height:30px;">
							</td>  
                        </tr>
                        <tr>
                            <th>주소</th>
                            <td colspan="3">
                                <input type="text" name="link" class="nor" style="width:100%;height:30px;">
							</td>  
                        </tr>
                        <tr>
                            <th>분류</th>
                            <td>
                                <select id="type" name="type">
                                    <option value="A">온라인진출지원</option>
                                    <option value="B">경영환경개선</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>사용 여부</th>
                            <td>
                                <select id="state" name="state">
                                    <option value="Y">YES</option>
                                    <option value="N">NO</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <th>로고 업로드</th>
                            <td colspan="3">
                                <input type="file" name="file1" id="file1"/>                              
                            </td>
                        </tr>
                    </tbody>
                    
            </div>  
                </table>   
        
	</div>
    <p class="c mt20">
			<a id="gBtn1" href="achieve_sort.php" class="b_btn_big">목록</a>
			<a href="javascript:frm.submit()" id="gBtn1" class="r_btn_big"><span>등록</span></a>
		</p>
    </form>
</div>
<div id="copyright">
	<p>Copyright ⓒ 2021 <span>Korea Productivity Center</span> All Rights Reserved.</p>
</div>
</body>
</html>

