

<div id="header">
		<div class="menu_wrap">
			<h1 class="logo"><a href="./admin_list.php"><img src="_img/comn/logo1.png" alt="kpcesg"/></a></h1> <!--200px*50px-->
			<ul class="menu">
				<li class="menu_memnber "><a href="admin_list.php" <?php if($menu_on=="admin") {?> class="on"<?}?>>관리자관리</a></li>
                <li class="menu_board"><a href="notice_admin.php" <?php if($menu_on=="notice") {?> class="on"<?}?>>공지관리</a></li>
			    <li class="menu_board"><a href="inquiry_admin.php" <?php if($menu_on=="inquiry") {?> class="on"<?}?>>문의사항관리</a></li>
                <li class="menu_board"><a href="achieve_sort.php" <?php if($menu_on=="achieve") {?> class="on"<?}?>>주요실적관리</a></li>
                <li class="menu_board"><a href="banner_admin.php" <?php if($menu_on=="banner") {?> class="on"<?}?>>배너관리</a></li>
			</ul>
		</div>
        <!-- class="on" -->

		<p class="gnb">
			<a class="my" href="#"><?php echo $_SESSION['mb_id']?> <img src="_img/comn/my.png" alt="나의ID"/>
			<a href="./logout.php" class="logout"><img src="_img/comn/logout.png" alt="로그아웃"/></a>
		</p>
	</div>