//edu_course

/* 접수 popup: block ui in */
function edu_show(edu_type){
	$("body").css({"position" :  "fixed"});
	if(edu_set(edu_type)){
		$.blockUI({ 
			message:	$('#edu_popup'),
			css:{		top: '0'	}
		}); 
	}
}

/* 접수 popup: block ui in */
function course_show(edu_type, edu_mst_idx){
	/* course_popup.php.bak 를 사용해야함 */
	$("body").css({"position" :  "fixed"});
	if(course_set(edu_type, edu_mst_idx)){
		$.blockUI({ 
			message:	$('#course_popup'),
			css:{		top: '0'	}
		});
	}
}

function course_show_e(edu_type, edu_mst_idx, edu_mst_nm){
	$("body").css({"position" :  "fixed"});
	if(edu_type == "E"){
		if(course_set_e(edu_type, edu_mst_idx, edu_mst_nm)){
			$.blockUI({ 
				message:	$('#course_popup'),
				css:{		top: '0'	}
			});
		}
	}else{
		alert("잘못된 경로입니다.");
	}
}

/* 주니어 코딩 접수 popup: block ui in */
function jr_show(jrm_team, jrm_idx){
	var jr_type = "T";
	$("body").css({"position" :  "fixed"});
	if(junior_set(jrm_team, jrm_idx, jr_type)){
		$.blockUI({ 
			message:	$('#jr_popup'),
			css:{		top: '0'	}
		});
	}
}

/* 접수 popup: block ui out */
function popup_hide(){
	$("body").css({"position" :  ""});
	$.unblockUI();
}

/* 교육과정 list ajax */
function edu_set(edu_type){
//return false;
	$.ajax({
		type: "POST",
		url: "/popup/edu_ajax.php",
		data: {
			edu_type : edu_type
		},
		success: function (data) {
			$("#edu_popup_data").html(data);
			//$("#edu_popup_tr").html(data);

			var txt_tit = "단체접수 <span>일정보기 <img src='/_img/cont/cha01.png' alt='단체접수'/>";
			var txt_h3 = "";
			if(edu_type == "P"){		//개인
				txt_tit = "개인접수 <span>일정보기</span><img src='/_img/cont/cha02.png' alt='개인접수'/>";
				txt_h3 = "<h3>제주시 제주대학교(교육대학, 사라캠퍼스)</h3>";
			}else if(edu_type == "E"){	//행사
				txt_tit = "엄마·아빠와 함께하는<span> 코딩워크숍</span><img src='/_img/cont/cha01.png' alt='단체'/>";
				txt_h3 = "<h3>서귀포자기주도학습관</h3>";
			}else if(edu_type == "J"){	//행사
				txt_tit = "주니어<span> 코딩 페스티벌</span><img src='/_img/cont/cha01.png' alt='단체'/>";
				txt_h3 = "";
			}
			$(".txt_val").html(txt_tit);
			$("#edu_popup_h3").html(txt_h3);

			if(edu_type == "P"){
				$('.edu_popup_p').show();
				$('.jr_popup').hide();
			}else if(edu_type == "E"){
				$('.edu_popup_p').hide();
				$('.jr_popup').hide();
			}else if(edu_type == "J"){
				$('.jr_popup').show();
				$('.edu_popup_p').hide();
			}else{
				$('.edu_popup_p').hide();
				$('.jr_popup').hide();
			}
		}
	});
	return true;
}

/* 교육신청 단체/개인 구별 */
function course_set(course_type, idx){
	//return false;
	document.getElementById("frm").reset();
	$("#edu_idx_val").text("교육일정(차수)을 선택하세요");
	$("#birth_y_val").text("1960 년");
	$("#birth_m_val").text("01 월");
	$("#birth_d_val").text("01 일");
	$("#mem_email_3_val").text("직접입력");
	$("#mem_mobile_1_val").text("010");

	var txt = "단체접수 <span>신청하기 <img src='/_img/cont/cha01.png' alt='단체접수'/>";

	$("#par_nm_div").hide();		// 학부모 성명 div
	$("#relate_div").hide();		// 학부모 관계 div
	$("#par_mobile_div").hide();	// 학부모 연락처 div
	$("#info1_div").hide();			// info div
	$("#par_nm_div").html("");		// 학부모 성명 html
	$("#relate_div").html("");		// 학부모 관계 html
	$("#par_mobile_div_num").html("");	// 학부모 연락처 html
	$("#info1_div").html("");		// info html
	$("#mem_nm_div").html("<span class='star'>*</span> 성명(교사)");		// 성명 text
	$("#school_div").html("<p class='tit'>소속학교</p><p class='text'><input type='text' name='school' id='school' maxlength='20' placeholder='소속학교를 입력하세요'/></p>");					// 소속학교 non chk
	$("#level_div").html("<p class='tit'>학년</p><p class='text'><input type='text' name='level' id='level' maxlength='4' placeholder='신청대상(학생) 학년을 입력하세요' chknum/></p>");		// 학년 non chk
	$("#person_div").html("<p class='tit'>인원</p><p class='text'><input type='text' name='person' id='person' placeholder='신청대상(학생) 인원을 입력하세요'  maxlength='4' chknum/></p>");	// 인원 non chk
	$("#person_div").show();		// 인원 div
	if(course_type == "P"){			//개인
		var txt = "개인접수 <span>신청하기</span><img src='/_img/cont/cha02.png' alt='개인접수'/>";

		$("#par_nm_div").html("");		// 학부모 성명 html
		$("#relate_div").html("");		// 학부모 관계 html
		$("#par_mobile_div_num").html("");	// 학부모 연락처 html
		$("#info1_div").html("");		// info html
		$("#mem_nm_div").html("<span class='star'>*</span> 성명(학생)");		// 성명 text
		$("#birth_y").val("1990|1990 년|birth_y").attr("selected", "selected");	// 생년 selected
		$("#birth_y_val").text("1990 년");										// 생년 text
		$("#school_div").html("<p class='tit'><span class='star'>*</span> 소속학교</p><p class='text'><input type='text' name='school' id='school' maxlength='20' msg='학교를' placeholder='소속학교를 입력하세요'/></p>");				// 소속학교 chk
		$("#level_div").html("<p class='tit'><span class='star'>*</span> 학년</p><p class='text'><input type='text' name='level' id='level' maxlength='4' msg='학년을' placeholder='신청대상(학생) 학년을 입력하세요' chknum/></p>");	// 학년 chk
		$("#person_div").html("");		// 인원 html
		$("#person_div").hide();		// 인원 div
	}else if(course_type == "E"){		//행사
		var txt = "엄마·아빠와 함께하는<span> 코딩워크숍</span> <span>신청하기</span><img src='/_img/cont/cha01.png' alt='단체'/>";
		
		$("#par_nm_div").html("<p class='tit'><span class='star'>*</span> 성명(학부모)</p><p class='text'><input type='text' name='par_nm' id='par_nm' msg='성명을' placeholder='성명을 입력하세요' maxlength='10'/></p>");		// 학부모 성명 html
		$("#relate_div").html("<p class='tit'><span class='star'>*</span> 관계</p><p class='text' style='padding:10px 0 0 15px; box-sizing:border-box;'><input name='relate' id='relate_f' value='부' type='radio' checked> <label for='relate_f'>부</label> <input name='relate' id='relate_m' value='모' type='radio'> <label for='relate_m'>모</label></p>");		// 학부모 관계 html
		$("#par_mobile_div_num").html("<p class='text' style='width:5px; margin: 5px 20px 0 20px'>-</p><p class='text' style='width:25%'><input type='text' id='par_mobile_2' msg='휴대폰을' maxlength='4' chknum/></p><p class='text' style='width:5px; margin: 5px 20px 0 20px'>-</p><p class='text' style='width:25%'><input type='text' id='par_mobile_3' msg='휴대폰을'  maxlength='4' chknum/></p>");	// 학부모 연락처 html
		$("#info1_div").html("<p class='tit'>워크숍에 바라는 점</p><p class='text'><input type='text' name='cors_info1' id='cors_info1'/></p>");		// info html
		$("#mem_nm_div").html("<span class='star'>*</span> 성명(학생)");		// 성명 text
		$("#birth_y").val("1990|1990 년|birth_y").attr("selected", "selected");	// 생년 selected
		$("#birth_y_val").text("1990 년");										// 생년 text
		$("#school_div").html("<p class='tit'><span class='star'>*</span> 소속학교</p><p class='text'><input type='text' name='school' id='school' maxlength='20' msg='학교를' placeholder='소속학교를 입력하세요'/></p>");				// 소속학교 chk
		$("#level_div").html("<p class='tit'><span class='star'>*</span> 학년</p><p class='text'><input type='text' name='level' id='level' maxlength='4' msg='학년을' placeholder='신청대상(학생) 학년을 입력하세요' chknum/></p>");	// 학년 chk
		$("#person_div").html("");		// 인원 html
		$("#person_div").hide();		// 인원 div
		$("#par_nm_div").show();		// 학부모 성명 div
		$("#relate_div").show();		// 학부모 관계 div
		$("#par_mobile_div").show();	// 학부모 연락처 div
		$("#info1_div").show();			// info div
	}
	$("#txt").html(txt);

	$("#edu_type").val(course_type);
	$.ajax({
		type: "POST",
		url: "/popup/course_ajax.php",
		data: {
			idx : idx
		},
		success: function (data) {
			$("#edu_idx").html(data);
		}
	});

	return true;
}

function course_set_e(course_type, idx, nm){
	//return false;
	document.getElementById("frm").reset();
	$("#edu_idx_val").text("교육일정(차수)을 선택하세요");
	$("#birth_m_val").text("01 월");
	$("#birth_d_val").text("01 일");
	$("#mem_email_3_val").text("직접입력");
	$("#mem_mobile_1_val").text("010");

	var txt = nm+" <span>신청하기</span><img src='/_img/cont/cha01.png' alt='단체'/>";
		
	$("#birth_y").val("1990|1990 년|birth_y").attr("selected", "selected");	// 생년 selected
	$("#birth_y_val").text("1990 년");										// 생년 text

	$("#txt").html(txt);

	$("#edu_type").val(course_type);
	$.ajax({
		type: "POST",
		url: "/popup/course_ajax.php",
		data: {
			idx : idx
		},
		success: function (data) {
			$("#edu_idx").html(data);
			$("#edu_idx_val").text($("#edu_idx option:eq(0)").text());
		}
	});

	return true;
}

/* 주니어 코딩 페스티벌 */
function junior_set(jr_team, idx, jr_type){
	document.getElementById("jrFrm").reset();
	
	for(var i=1; i<=jr_team; i++){
		$("#jrc_mobile_"+i+"1_val").text("010");
		$("#jrc_email_"+i+"3_val").text("직접입력");
		$("#par_mobile_"+i+"1_val").text("010");
	}
	
	var show_team = jr_team;

	if(jr_type == "I"){
		show_team = 1;
		$(".jrc_team_p").hide();
		$(".p_t").hide();
		$(".team_name").text("개인정보");
		$(".tit_mail").text("이메일");
	}else{
		$(".jrc_team_p").show();
		$(".p_t").show();
		$(".team_name").text("팀원정보");
		$(".tit_mail").text("대표 이메일");
	}
	$(".team_info").hide();
	for(var i=1; i<=show_team; i++){
		$(".team_"+i).show();
		$("#jrc_email_"+i+"2").attr("readonly",false);
	}

	$("input:radio[name='jrc_type']:radio[value='"+jr_type+"']").attr("checked",true);		/* 팀 기본 */
	$("input[name=jrm_idx]").val(idx);
	$("#jrm_team").val(jr_team);

	if((idx == "1"||idx == "2") && jr_type == "T"){
		$(".team_info_1").show();
	}else{
		$(".team_info_1").hide();
	}

	return true;
}

function fn_submit(){
	if($(':checkbox[name="checks"]:checked').val() != "Y"){
		alert("이용약관에 동의해주세요.");
		return;
	}
	var edu_idx = $("#edu_idx").val().split("|");
	if(edu_idx[0] == ""){
		alert("교육일정을 선택하세요.");
		return;
	}

	if(checkForm("frm")){
		var birth_y = $("#birth_y").val().split("|");
		var birth_m = $("#birth_m").val().split("|");
		var birth_d = $("#birth_d").val().split("|");
		var mobile_1 = $("#mem_mobile_1").val().split("|");
		var par_mobile_1 = $("#par_mobile_1").val().split("|");
		$("#edu_idx_selected").val( edu_idx[0] );
		$("#mem_birth").val( birth_y[0]+"-"+birth_m[0]+"-"+birth_d[0] );
		$("#mem_email").val( $("#mem_email_1").val()+"@"+$("#mem_email_2").val() );
		$("#mem_mobile").val( mobile_1[0]+"-"+$("#mem_mobile_2").val()+"-"+$("#mem_mobile_3").val() );

		if($("#edu_type").val() == "E"){
			$("#par_mobile").val( par_mobile_1[0]+"-"+$("#par_mobile_2").val()+"-"+$("#par_mobile_3").val() );
		}

		$("#frmSubmitBtn").hide();
		$("#frm").submit();
	}
}

function jr_submit(){
	if($(':checkbox[name="jr_checks"]:checked').val() != "Y"){
		alert("이용약관에 동의해주세요.");
		return;
	}
	if(checkJrForm()){
		if(checkForm("jrFrm")){
			var cnt = $("#jrm_team").val();
			for(var i=1; i<=cnt; i++){
				var jrc_mobile = $("#jrc_mobile_"+i+"1").val().split("|");
				var par_mobile = $("#par_mobile_"+i+"1").val().split("|");
				$("#jrc_mobile_"+i).val( jrc_mobile[0]+"-"+$("#jrc_mobile_"+i+"2").val()+"-"+$("#jrc_mobile_"+i+"3").val() );
				$("#jrc_email_"+i).val( $("#jrc_email_"+i+"1").val()+"@"+$("#jrc_email_"+i+"2").val() );
				$("#jrc_par_mobile_"+i).val( par_mobile[0]+"-"+$("#par_mobile_"+i+"2").val()+"-"+$("#par_mobile_"+i+"3").val() );
			}

			$("#jrFrmSubmitBtn").hide();
			$("#jrFrm").submit();
		}
	}
}

function checkJrForm(){
	var jr_type		= $(":radio[name='jrc_type']:checked").val();
	var jr_team		= $("#jrm_team").val();
	var jr_idx		= $("#jrm_idx").val();

	if(jr_type == "I"){
		jr_team		= 1;
	}

	if($("input[name='jrc_team_nm']").val() == "" && jr_type == "T"){
		alert("팀명을 입력해 주세요");
		$("input[name='jrc_team_nm']").focus();
		return false;
	}

	for(var i=1; i<=jr_team; i++){
		if($("input[name='jrc_nm["+i+"]']").val() == ""){
			alert("성명을 입력해 주세요");
			$("input[name='jrc_nm["+i+"]']").focus();
			return false;
		}
		if($("input[name='jrc_school["+i+"]']").val() == ""){
			alert("학교를 입력해 주세요");
			$("input[name='jrc_school["+i+"]']").focus();
			return false;
		}
		if($("input[name='jrc_level["+i+"]']").val() == ""){
			alert("학년을 입력해 주세요");
			$("input[name='jrc_level["+i+"]']").focus();
			return false;
		}
		if($("#jrc_mobile_"+i+"2").val() == ""){
			alert("휴대전화를 입력해 주세요");
			$("#jrc_mobile_"+i+"2").focus();
			return false;
		}
		if($("#jrc_mobile_"+i+"3").val() == ""){
			alert("휴대전화를 입력해 주세요");
			$("#jrc_mobile_"+i+"3").focus();
			return false;
		}
		if($("#jrc_email_"+i+"1").val() == ""){
			alert("이메일을 입력해 주세요");
			$("#jrc_email_"+i+"1").focus();
			return false;
		}
		if($("#jrc_email_"+i+"2").val() == ""){
			alert("이메일을 입력해 주세요");
			$("#jrc_email_"+i+"2").focus();
			return false;
		}
		if($("#par_mobile_"+i+"2").val() == ""){
			alert("부모님연락처를 입력해 주세요");
			$("#par_mobile_"+i+"2").focus();
			return false;
		}
		if($("#par_mobile_"+i+"3").val() == ""){
			alert("부모님연락처를 입력해 주세요");
			$("#par_mobile_"+i+"3").focus();
			return false;
		}
	}

	if(jr_type == "T" && (jr_idx == "1"||jr_idx == "2")){
		var jrc_etc_1 = $("#jrc_etc_1").val();
		if(jrc_etc_1.trim() == ""){
			alert("동기를 서술해주세요");
			$("#jrc_etc_1").focus();
			return false;
		}
		var jrc_etc_2 = $("#jrc_etc_2").val();
		if(jrc_etc_2.trim() == ""){
			alert("경험을 서술해주세요");
			$("#jrc_etc_2").focus();
			return false;
		}
		var jrc_etc_3 = $("#jrc_etc_3").val();
		if(jrc_etc_3.trim() == ""){
			alert("목표를 서술해주세요");
			$("#jrc_etc_3").focus();
			return false;
		}
	}

	return true;
}

function fn_submit_e(){
	if($(':checkbox[name="checks"]:checked').val() != "Y"){
		alert("이용약관에 동의해주세요.");
		return;
	}
	var edu_idx = $("#edu_idx").val().split("|");
	if(edu_idx[0] == ""){
		alert("교육일정을 선택하세요.");
		return;
	}

	if($(':checkbox[name="insurance_yn"]:checked').val() == "Y"){
		if($("#mem_num_1").val() == ""){
			alert("주민등록번호를 입력하세요.");
			$("#mem_num_1").focus();
			return;
		}

		if($("#mem_num_2").val() == ""){
			alert("주민등록번호를 입력하세요.");
			$("#mem_num_2").focus();
			return;
		}

		var member_num = $("#mem_num_1").val() + $("#mem_num_2").val();
		if(!memberNumCheck(member_num)){
			alert("주민등록번호가 유효하지 않습니다.");
			$("#mem_num_1").focus();
			return;
		}
	}

	if(checkForm("frm")){
		var birth_y = $("#birth_y").val().split("|");
		var birth_m = $("#birth_m").val().split("|");
		var birth_d = $("#birth_d").val().split("|");
		var mobile_1 = $("#mem_mobile_1").val().split("|");
		var par_mobile_1 = $("#par_mobile_1").val().split("|");
		$("#edu_idx_selected").val( edu_idx[0] );
		$("#mem_birth").val( birth_y[0]+"-"+birth_m[0]+"-"+birth_d[0] );
		$("#mem_email").val( $("#mem_email_1").val()+"@"+$("#mem_email_2").val() );
		$("#mem_mobile").val( mobile_1[0]+"-"+$("#mem_mobile_2").val()+"-"+$("#mem_mobile_3").val() );

		if($("#edu_type").val() == "E"){
			$("#par_mobile").val( par_mobile_1[0]+"-"+$("#par_mobile_2").val()+"-"+$("#par_mobile_3").val() );
		}

		$("#frmSubmitBtn").hide();
		$("#frm").submit();
	}
}

function memberNumCheck(num){ /* 주민등록번호 유효성검사 */
	var sum = 0;
	if (num.length != 13) {
		return false;
	} else if (num.substr(6, 1) != 1 && num.substr(6, 1) != 2 && num.substr(6, 1) != 3 && num.substr(6, 1) != 4) {
		return false;
	}

	for (var i = 0; i < 12; i++) {
		sum += Number(num.substr(i, 1)) * ((i % 8) + 2);
	}

	if (((11 - (sum % 11)) % 10) == Number(num.substr(12, 1))) {
		return true;
	}

	return false;
}