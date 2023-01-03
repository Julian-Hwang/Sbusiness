<!doctype html>
<html lang="ko">
<?php
    include "_inc/index_title.php";
    include "_inc/db.php";
?>
 <body>
 <header>
	<?php
    include "_inc/index_header.php";
    ?>
</header>
<?php
include '_inc/mouse_1.php';
?>	
	<div class="visual_wrap">
		<div class="fade">
            <?php
                $i=1;
                $up="SELECT * FROM KPC_BANNER WHERE BAN_POSITION='up' AND USE_YN='Y'";
                $result_up=mysqli_query($dbconn, $up);
                
                while($row=(mysqli_fetch_array($result_up))){
            ?>
                <div class="vis01" style="width:100%;height:auto;">
                <p class="img pc" style="max-height:600px;"><img src="_img/pc/main/banner_slider.png" style="background:url('../admin/_upload/banner_image/pc/<?php echo $row['FILE_ID']; ?>')no-repeat 30% 50% /cover;"/></p>
                <p class="img tablet"style="max-height:900px;"><img src="_img/pc/main/banner_slider.png" style="background:url('../admin/_upload/banner_image/mo/<?php echo $row['FILE_ID_M']; ?>')no-repeat 100% 100% /cover;"/></p>
                <p class="img mobile"style="max-height:900px;"><img src="_img/pc/main/banner_slider.png" style="background:url('../admin/_upload/banner_image/mo/<?php echo $row['FILE_ID_M']; ?>')no-repeat 100% 100% /cover;"/></p>
                </div>
            <?php
                $i++;}
            ?>

		</div>
	</div>

	<div class="bg_wrap">
		<div class="all_wrap">
			<div class="business">
				<div>
					<div class="cen">
						<div class="section_title">
							<span>BUSINESS</span>
							<p>주요 사업영역 소개</p>
						</div>
						<div class="boxes">
							<div class="b01" onclick="location.href='online/online01.php'">
								<div>
									<div class="txt">
										<p>온라인 경쟁력 강화</p>
										<p class="change01">온라인에서 성공적으로 <br>채널 안착을 위한 각 단계 지원</p>
										<ul class="change02">
											<li>온라인 역량강화 교육 및 컨설팅</li>
											<li>제품의 경쟁력 강화 및 파악(디자인, 소비자 조사 등)</li>
											<li>홍보 경쟁력 강화 (상세페이지, 홍보콘텐츠 등)</li>
											<li>상품화 지원 (산업재산권 출원 등)</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="b02" onclick="location.href='online/online02.php'">
								<div>
									<div class="txt">
										<p>온라인특별기획전</p>
										<p class="change01">매출활성화를 위한 맞춤형 <br>기획전·펀딩·라이브커머스 등 지원</p>
										<ul class="change02">
											<li>쿠폰(프로모션) 기획전 지원</li>
											<li>크라우드펀딩 지원</li>
											<li>라이브커머스 지원</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="b03" onclick="location.href='support/support01.php'">
								<div>
									<div class="txt">
										<p>경영환경개선</p>
										<p class="change01">경쟁력 강화, 자립기반 확충으로 <br>지역경제·상권 활성화</p>
										<ul class="change02">
											<li>참여 소상공인 평가 및 선정</li>
											<li>참여기업별 기본교육 및 맞춤형 컨설팅 지원</li>
											<li>참여기업별 경영환경개선 비용지원</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="b04" onclick="location.href='support/academy01.php'">
								<div>
									<div class="txt">
										<p>협업아카데미</p>
										<p class="change01">협동조합 설립·운영에 관한 <br>기본교육 및 컨설팅 지원</p>
										<ul class="change02">
											<li>소상공인협동조합관련 상담 및 교육</li>
											<li>인큐베이팅</li>
											<li>네트워크 및 연구회 지원</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="b05" onclick="location.href='support/cluster.php'">
								<div>
									<div class="txt">
										<p>클러스터 지원</p>
										<p class="change01">산·학·연 기관 연계를 통한 <br>협업 프로젝트 및 사업화 지원</p>
										<ul class="change02">
											<li>소상공인 맞춤형 교육 및 개별·그룹별 멘토링 지원</li>
											<li>소상공인 네트워킹 및 사업화 지원</li>
											<li>협업 시제품 개발, 공동기획전 등 프로젝트 수행 지원</li>
										</ul>
									</div>
								</div>
							</div>
							<div class="b06" onclick="location.href='support/digital.php'">
								<div>
									<div class="txt">
										<p>디지털화 지원</p>
										<p class="change01">현장 중심의 기술도입 확산을 위한 <br>소상공인 디지털 전환 시스템 구축</p>
										<ul class="change02">
											<li>소상공인 발굴, 선정 평가 지원</li>
											<li>현장 및 디지털화 여건 분석 및 최적 솔루션 제안</li>
											<li>기술도입 후 현장 적용 및 활용 사후 점검</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="news">
				<div>
					<div class="cen">
						<div class="section_title">
							<span>TODAY'S NEWS</span>
							<p>새롭고 다양한 소식</p>
						</div>
						<div class="section">
							<ul class="notice">
                                <?php 

                                  $sql = "SELECT *,
                                  LEFT(REGEXP_REPLACE(NOT_CONTENT,'<[^>]+>',''),20) NOT_CONTENT
                                  FROM KPC_NOTICE WHERE DEL_YN='N' order by REG_DATE desc limit 4";
                                  $result = mysqli_query($dbconn, $sql);

									while($row =(mysqli_fetch_array($result))) {
									$createDate = $row['REG_DATE'];
									$createDay = substr($createDate,8,2);
									$createYear = str_replace("-",".",substr($createDate,0,7));
                                ?>
								<li onclick="location.href='notice/notice_view.php?notice_idx=<?= $row['IDX'] ?>'">
									<div class="date">
										<p><?= $createDay ?></p>
										<span><?= $createYear ?></span>
									</div>
									<div class="txt">
										<p><?= $row['NOT_TITLE'] ?> </p>
										<span><?= $row['NOT_CONTENT'] ?></span>
									</div>
								</li>
                                <?php }?>
							</ul>
							<div class="banner">
								<div class="pop_area slider center">
                                    <?php
                                        $i=1;
                                        $up="SELECT * FROM KPC_BANNER WHERE BAN_POSITION='down' AND USE_YN='Y'";
                                        $result_up=mysqli_query($dbconn, $up);
                                        
                                        while($row=(mysqli_fetch_array($result_up))){
                                    ?>
                                        <div><a href="<?php echo $row['BAN_LINK'] ?>" target='_blank'><p><img src="_img/pc/main/banner_slider.png" style="background:url('../admin/_upload/banner_image/pc/<?php echo $row['FILE_ID'] ?>')no-repeat 50% 50% /cover;"></p></a></div>
                                    <?php 
                                        $i++;} 
                                    ?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<script>
	//비주얼
	$('.fade').slick({
		dots: true,
		infinite: true,
		speed: 500,
		fade: false,
		draggable: true,
		cssEase: 'linear'
	});

	//배너
	$('.center').slick({
		  dots: true,
		  infinite: true,
		  centerMode: true,
		  speed: 500,
		  fade: false,
		  cssEase: 'linear',
		  autoplay: true,
		  slidesToShow : 1,		// 한 화면에 보여질 컨텐츠 개수
		  slidesToScroll : 1,		//스크롤 한번에 움직일 컨텐츠 개수
		  draggable: true,
		   variableWidth: true,
		  responsive: [
	     { 
			 breakpoint: 1079,
		settings: { 
		    variableWidth: true,
            slidesToShow: 1,
          },
		breakpoint: 590,
		settings: { 
            slidesToShow: 1,
			 variableWidth: false,
			 centerMode:false
          }
		}] 
		});		

	</script>

<?php
include '_inc/index_footer.php';
?>	

	 </body>
</html>
