<?php include './include/adminHeader.php'?>

<head>
<script language="javascript">

$(document).ready(function(){
	$("#mb_id").focus();
});

function check_form(){	
	if($("#mb_id").val() == ""){
		alert("아이디을 입력하세요");
		$("#mb_id").focus();
		return;
	}
	if($("#mb_pw").val() == ""){
		alert("패스워드를 입력하세요");
		$("#mb_pw").focus();
		return;
	}
	$("#frm").submit();
}
</script>
</head>

<body>
        <div id="login_warp">
                <p class="lg_top">kpc 소상공인성장센터 관리자 페이지</p>
                <div class="login">
		<h1 class="login_logo"><img src="./_img/mem/login_logo.png" alt="KPCESG"/><h1> <!--최대 340px*130px-->
                <form name="frm" id="frm" action="process_adminLogin.php" method="post" >
                        <input type="hidden" name="rtn_page" value="">
			            <p class="lg_wrap">
                                <input type="text" name="mb_id" id="mb_id" value="" placeholder="아이디를 입력하세요">
                                <input class="mt10" type="password" name="mb_pw" id="mb_pw" value="" placeholder="비밀번호를 입력하세요" onKeyPress="if(event.keyCode==13){frm.submit();}"/>
                        </p>

                        <p class="mt25"><a class="login_btn" href="javascript:check_form();">로그인</a></p>
                        </form>
                <div>
        </div>
</body>

</html>

