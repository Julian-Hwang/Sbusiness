
<!doctype html>
<html lang="ko">
<head>
<?php
include '../_inc/title.php';
?>
</head>
 <body>
<?php
include '../_inc/header.php';
?>	
<?php
include '../_inc/mouse_1.php';
?>		
	<div class="h2_bg">
		<div class="h2_conts h2_bg01">
			<div class="navigation">
				<h2>오시는 길</h2>
				<span class="home"></span><span>센터소개</span><span>오시는 길</span>
			</div>
		</div>
	</div>

	<div class="sub_cont">
		<div>
			<h3 class="top">본사(서울)</h3>
			<!-- 지도 들어갈 공간입니다 -->
			<div id="map" style="background:#f1f1f1; width:100%; height:431px;"></div>

			<div class="map_guide_wrap">
				<div>
					<p>주소.(03170) 서울특별시 종로구 새문안로5가길 32 생산성빌딩</p>
					<p>TEL.02-724-1108, 1113</p>
				</div>
				<ul>
					<li class="subway">
						<div class="title">지하철 이용 시</div>
						<div>
							<p><span class="orange">3호선</span>경복궁역 6번 출구에서 밖으로 나오지 말고 <b>지하 현대아케이드를 관통</b>하면 생산성본부 지하 1층에 도착</p>
							<p><span class="purple">5호선</span>광화문역 <b>1번 출구</b>에서 우측으로 150미터 직진후 외교부청사 지나 횡단보도 건너서 왼쪽건물(우측은 정부청사)</p>
						</div>
					</li>
					<li class="bus">
						<div class="title">버스 이용 시</div>
						<div>
							<p><b>광화문</b> 또는 <b>경복궁역, 사직공원 가는 버스</b>를 타고 본부건물로 도착(KPC옆에 정부청사 있음)</p>
						</div>
					</li>
					<li class="train">
						<div class="title">기차 이용 시</div>
						<div>
							<p>
								<span class="blue">1호선</span>
								<span class="orange">3호선</span>
								서울역, 용산역에서 <b>지하철 1호선(청량리/의정부행)</b>을 타고, <b>종로3가역에서 3호선(구파발/대화행)</b>으로 갈아타신 후 <b>경복궁역에서 하차</b> <br>
								6번출구로 나와 지하 현대아케이드를 관통하면 본부 지하 1층에 도착함 (서울역에서 택시 이용시 비용은 약 5,000원 정도)
							</p>
						</div>
					</li>
					<li class="car">
						<div class="title">차량 이용 시</div>
						<div>
							<p>광화문 정면을 보고(이순신장군 동상을 지나) 유턴하면서 우측의 정부청사를 끼고 바로 우회전을 하여 작은 사거리를 지나 다음 건물을 끼고 우회전하여 두번째 건물이 본부 건물입니다.</p>
						</div>
					</li>
					<li class="parking">
						<div class="title">생산성빌딩 <br>주차장 안내</div>
						<div>
							<p>주차공간이 많이 부족하오니 되도록 대중교통을 이용해 주시기 바랍니다.</p>
							<ul>
								<li>주차요금 : 30분당 2,000원(일일 최대 36,000원)</li>
								<li>교육생 : 무료주차 최대 2시간</li>
							</ul>
							<span>- 2시간 이상 시 50% 할인 적용, 일일 최대 16,000원</span>
						</div>
					</li>
				</ul>
			</div>
		</div>
	</div>

	<?php
include '../_inc/footer.php';
?> </body>
<script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=82df064edaf37408564a383d38317ece"></script>
<script>

var mapContainer = document.getElementById('map'), // 지도를 표시할 div 
    mapOption = { 
        center: new kakao.maps.LatLng(37.5749478927023, 126.97354166090663), // 지도의 중심좌표
        level: 3 // 지도의 확대 레벨
    };

var map = new kakao.maps.Map(mapContainer, mapOption); // 지도를 생성합니다

// 마커가 표시될 위치입니다 
var markerPosition  = new kakao.maps.LatLng(37.5749478927023, 126.97354166090663); 

// 마커를 생성합니다
var marker = new kakao.maps.Marker({
    position: markerPosition
});

// 마커가 지도 위에 표시되도록 설정합니다
marker.setMap(map);

</script>

</html>
