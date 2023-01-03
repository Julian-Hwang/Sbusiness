<?php
	session_start();
	/* include ("captcha.php");
	$_SESSION['capt'] = $captcha; */
?>
<!doctype html>
<html lang="ko">
<?php
include '../_inc/title.php';
?>
 <body>
<?php
include '../_inc/header.php';
?>	
<?php
include '../_inc/mouse_1.php';
?>		
	<div class="h2_bg">
		<div class="h2_conts h2_bg04">
			<div class="navigation">
				<h2>문의하기</h2>
				<span class="home"></span><span>공지사항</span><span>문의하기</span>
			</div>
		</div>
	</div>

	<form name = "frm" id="frm" action="check_code.php" method="post" enctype="multipart/form-data">
		<div class="sub_cont">
			<div>
				<ul class="bbs_write">
					<li>
						<div class="title">작성자<span class="star">*</span></div>
						<div><input type="text" class="w400" id="author" name="author"></div>
					</li>
					<li>
						<div class="title">이메일<span class="star">*</span></div>
						<div class="mail_wrap">
							<p>
								<input type="text" id="email1" name="email1">
								<span>@</span>
								<input type="text" id="email2" name="email2">
							</p>
							<p>
								<select name="selectemail" id="selectemail">
									<option value="">직접입력</option>
									<option value="naver.com">naver.com</option>
									<option value="hanmail.com">hanmail.com</option>
									<option value="gmail.com">gmail.com</option>
								</select>
							</p>
						</div>
						
					</li>
					<li>
						<div class="title">제목<span class="star">*</span></div>
						<div><input type="text" id="title" name="title"></div>
					</li>
					<li>
						<div class="title">내용<span class="star">*</span></div>
						<div>
							<p class="textcont"><textarea name="contents" id="contents" spellcheck="false"></textarea></p>
						</div>
					</li>
					<li class="random_input">
						<div class="title">자동입력방지<span class="star">*</span></div>
						<div>
							<input type="text" name="captcha" id="captcha" style="width:150px;">
							<p class="random_img" style="width:151px; display:inline-block;">
								<img src="captcha.php" alt="captcha" id="capt_img" title="captcha">
							</p>
							<a class="refresh" href="javascript:void(0);" onclick="refresh();">새로고침</a>
						</div>
					</li>

				</ul>

				<div class="agreement">
					<p>개인정보 수집 및 이용에 대한 안내</p>
					<div class="agreement_cont">
						<p class="agrmnt01">KPC 한국생산성본부에서는 개인정보의 수집, 이용 등 처리에 있어 아래의 사항을 정보주체에게 안내합니다.</p>
						<p>
							1. 개인정보의 수집, 이용 목적<br>
							- 고객 문의처리<br>
							2. 수집하는 개인정보의 항목<br>
							- 필수항목 : 성함, 이메일 주소<br>
							3. 개인정보의 보유 및 이용기간<br>
							- 관련법령에 따라 3년간 보관후 삭제
						</p>
					</div>
					<div class="check">
						<p class="basic_check">
							<input type="checkbox" id="agreeChk1">
							<label for="agreeChk1"><b class="org">[필수]</b> 개인정보 수집 및 이용에 동의합니다</label>
						</p>
					</div>
				</div>

				<p class="basic_btn"><a href="" class="pop_btn">문의하기</a></p>
			</div>
		</div>
	</form>

	<div id="pop" class="popup s_popup">
		<p class="alert_icon"></p>
		<p class="tt">
			문의가 완료되었습니다.<br>
			담당자가 확인 후 연락드리겠습니다.
		</p>
		<div class="btn">
			<p><a href="inquiry.php" class="x">확인</a></p>
		</div>
	</div>
	
	<script>
		// 팝업 스크립트
		$(document).ready(function() {  
			$(".popup").hide()
			$(".pop_btn").click(function(event){
				event.preventDefault();
				if($("#author").val().trim()==""){
					alert("작성자를 입력해주세요");
					$("#author").focus();
					return false;
				}
				if($("#email1").val().trim()==""){
					alert("앞쪽 이메일을 입력해주세요");
					$("#email1").focus();
					return false;
				}
				if($("#selectemail").is('1')){
            		if($("#email2").val().trim() == ""){
                		alert("뒤쪽 이메일을 입력해주세요.");
                		$("#email2").focus();
                		return false;
            		}
        		}
				if($("#title").val().trim()==""){
					alert("제목을 입력해주세요");
					$("#title").focus();
					return false;
				}
				if($("#contents").val().trim()==""){
					alert("내용을 입력해주세요");
					$("#contents").focus();
					return false;
				}
				if($("#agreeChk1").is(':checked')==false){
					alert("사전 동의사항 확인 및 동의 체크후 진행해주세요.");
					$("#agreeChk1").focus();
					return false;
				}
				
				if($("#captcha").val() == ""){
					alert("자동입력방지를 입력해주세요");
					$("#captcha").focus();
					return false;
				}  else {
					var captcha = $("#captcha").val();
					var author = $("#author").val();
					var email1 = $("#email1").val();
					var email2 = $("#email2").val();
					var title = $("#title").val();
					var contents = $("#contents").val();;
					$.ajax({
						url: "check_code.php",
						method:"POST",
						data: {
							captcha,
							author,
							email1,
							email2,
							title,
							contents
						},
						success:function(msg){
							if(msg == 'success'){
								$("#pop").fadeIn();
							} else {
								alert('자동입력방지 코드를 다시 입력해주세요');
								return false;
							}
						}
					});
				} 
			});	
	
			$(".popup .close, .popup .x").click(function(){
				$(".popup").fadeOut();
			});	
		}); 
	</script>
	<script type="text/javascript">
		$("#selectemail").change(function(){
			$("#email2").val($("#selectemail").val());
		});
	</script>
	<script type="text/javascript">
		/* 문자 새로고침 */
		function refresh(){
			document.getElementById("capt_img").src="captcha.php?waste="+Math.random();			
		}
	</script>
	<?php
include '../_inc/footer.php';
?> </body>
</html>
