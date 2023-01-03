
<!doctype html>
<html lang="ko">
<?php
include '../_inc/title.php';
include '../_inc/db.php';

?>
 <body>
<?php
include '../_inc/header.php';
?>	
<?php
include '../_inc/mouse_1.php';
?>		
	<div class="h2_bg">
		<div class="h2_conts h2_bg05">
			<div class="navigation">
				<h2>주요실적</h2>
				<span class="home"></span><span>주요실적</span>
			</div>
		</div>
	</div>

	<div class="sub_cont">
		<div>
			<h3 class="top">온라인진출지원</h3>
			<div class="logo_list">
				<ul>
                    <?php
                        $i=1;
                        $TYPE_A = "SELECT * FROM KPC_ACHIEVE WHERE ACHIEVE_TYPE_CD = 'A' AND USE_YN = 'Y' ORDER BY ACHIEVE_SORT ";
                        $result_A= mysqli_query($dbconn, $TYPE_A);
                        while($row=(mysqli_fetch_array($result_A))){
                    ?>
					        <li><p><img src="../_img/pc/cont/logo_bg.png" style="background:url('/sbusiness/admin/_upload/achieve_image/<?php echo $row['LOGO_ID'] ?>')no-repeat 50% 50%;"></p></li>
                    <?php 
                        $i++;} 
                    ?>
				</ul>
			</div>
			<h3>경영환경개선</h3>
			<div class="logo_list">
				<ul>
                    <?php
                        $i=1;
                        $TYPE_B = "SELECT * FROM KPC_ACHIEVE WHERE ACHIEVE_TYPE_CD = 'B' AND USE_YN = 'Y' ORDER BY ACHIEVE_SORT ";
                        $result_B= mysqli_query($dbconn, $TYPE_B);
                        while($row=(mysqli_fetch_array($result_B))){
                    ?>
					        <li><p><img src="../_img/pc/cont/logo_bg.png" style="background:url('/sbusiness/admin/_upload/achieve_image/<?php echo $row['LOGO_ID'] ?>')no-repeat 50% 50%;"></p></li>
                    <?php 
                        $i++;} 
                    ?>
				</ul>
			</div>
		</div>
	</div>

	<?php
include '../_inc/footer.php';
?>  </body>
</html>
