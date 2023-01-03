//edu_course

/* ���� popup: block ui in */
function edu_show(edu_type){
	$("body").css({"position" :  "fixed"});
	if(edu_set(edu_type)){
		$.blockUI({ 
			message:	$('#edu_popup'),
			css:{		top: '0'	}
		}); 
	}
}

/* ���� popup: block ui in */
function course_show(edu_type, edu_mst_idx){
	/* course_popup.php.bak �� ����ؾ��� */
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
		alert("�߸��� ����Դϴ�.");
	}
}

/* �ִϾ� �ڵ� ���� popup: block ui in */
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

/* ���� popup: block ui out */
function popup_hide(){
	$("body").css({"position" :  ""});
	$.unblockUI();
}

/* �������� list ajax */
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

			var txt_tit = "��ü���� <span>�������� <img src='/_img/cont/cha01.png' alt='��ü����'/>";
			var txt_h3 = "";
			if(edu_type == "P"){		//����
				txt_tit = "�������� <span>��������</span><img src='/_img/cont/cha02.png' alt='��������'/>";
				txt_h3 = "<h3>���ֽ� ���ִ��б�(��������, ���ķ�۽�)</h3>";
			}else if(edu_type == "E"){	//���
				txt_tit = "�������ƺ��� �Բ��ϴ�<span> �ڵ���ũ��</span><img src='/_img/cont/cha01.png' alt='��ü'/>";
				txt_h3 = "<h3>�������ڱ��ֵ��н���</h3>";
			}else if(edu_type == "J"){	//���
				txt_tit = "�ִϾ�<span> �ڵ� �佺Ƽ��</span><img src='/_img/cont/cha01.png' alt='��ü'/>";
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

/* ������û ��ü/���� ���� */
function course_set(course_type, idx){
	//return false;
	document.getElementById("frm").reset();
	$("#edu_idx_val").text("��������(����)�� �����ϼ���");
	$("#birth_y_val").text("1960 ��");
	$("#birth_m_val").text("01 ��");
	$("#birth_d_val").text("01 ��");
	$("#mem_email_3_val").text("�����Է�");
	$("#mem_mobile_1_val").text("010");

	var txt = "��ü���� <span>��û�ϱ� <img src='/_img/cont/cha01.png' alt='��ü����'/>";

	$("#par_nm_div").hide();		// �кθ� ���� div
	$("#relate_div").hide();		// �кθ� ���� div
	$("#par_mobile_div").hide();	// �кθ� ����ó div
	$("#info1_div").hide();			// info div
	$("#par_nm_div").html("");		// �кθ� ���� html
	$("#relate_div").html("");		// �кθ� ���� html
	$("#par_mobile_div_num").html("");	// �кθ� ����ó html
	$("#info1_div").html("");		// info html
	$("#mem_nm_div").html("<span class='star'>*</span> ����(����)");		// ���� text
	$("#school_div").html("<p class='tit'>�Ҽ��б�</p><p class='text'><input type='text' name='school' id='school' maxlength='20' placeholder='�Ҽ��б��� �Է��ϼ���'/></p>");					// �Ҽ��б� non chk
	$("#level_div").html("<p class='tit'>�г�</p><p class='text'><input type='text' name='level' id='level' maxlength='4' placeholder='��û���(�л�) �г��� �Է��ϼ���' chknum/></p>");		// �г� non chk
	$("#person_div").html("<p class='tit'>�ο�</p><p class='text'><input type='text' name='person' id='person' placeholder='��û���(�л�) �ο��� �Է��ϼ���'  maxlength='4' chknum/></p>");	// �ο� non chk
	$("#person_div").show();		// �ο� div
	if(course_type == "P"){			//����
		var txt = "�������� <span>��û�ϱ�</span><img src='/_img/cont/cha02.png' alt='��������'/>";

		$("#par_nm_div").html("");		// �кθ� ���� html
		$("#relate_div").html("");		// �кθ� ���� html
		$("#par_mobile_div_num").html("");	// �кθ� ����ó html
		$("#info1_div").html("");		// info html
		$("#mem_nm_div").html("<span class='star'>*</span> ����(�л�)");		// ���� text
		$("#birth_y").val("1990|1990 ��|birth_y").attr("selected", "selected");	// ���� selected
		$("#birth_y_val").text("1990 ��");										// ���� text
		$("#school_div").html("<p class='tit'><span class='star'>*</span> �Ҽ��б�</p><p class='text'><input type='text' name='school' id='school' maxlength='20' msg='�б���' placeholder='�Ҽ��б��� �Է��ϼ���'/></p>");				// �Ҽ��б� chk
		$("#level_div").html("<p class='tit'><span class='star'>*</span> �г�</p><p class='text'><input type='text' name='level' id='level' maxlength='4' msg='�г���' placeholder='��û���(�л�) �г��� �Է��ϼ���' chknum/></p>");	// �г� chk
		$("#person_div").html("");		// �ο� html
		$("#person_div").hide();		// �ο� div
	}else if(course_type == "E"){		//���
		var txt = "�������ƺ��� �Բ��ϴ�<span> �ڵ���ũ��</span> <span>��û�ϱ�</span><img src='/_img/cont/cha01.png' alt='��ü'/>";
		
		$("#par_nm_div").html("<p class='tit'><span class='star'>*</span> ����(�кθ�)</p><p class='text'><input type='text' name='par_nm' id='par_nm' msg='������' placeholder='������ �Է��ϼ���' maxlength='10'/></p>");		// �кθ� ���� html
		$("#relate_div").html("<p class='tit'><span class='star'>*</span> ����</p><p class='text' style='padding:10px 0 0 15px; box-sizing:border-box;'><input name='relate' id='relate_f' value='��' type='radio' checked> <label for='relate_f'>��</label> <input name='relate' id='relate_m' value='��' type='radio'> <label for='relate_m'>��</label></p>");		// �кθ� ���� html
		$("#par_mobile_div_num").html("<p class='text' style='width:5px; margin: 5px 20px 0 20px'>-</p><p class='text' style='width:25%'><input type='text' id='par_mobile_2' msg='�޴�����' maxlength='4' chknum/></p><p class='text' style='width:5px; margin: 5px 20px 0 20px'>-</p><p class='text' style='width:25%'><input type='text' id='par_mobile_3' msg='�޴�����'  maxlength='4' chknum/></p>");	// �кθ� ����ó html
		$("#info1_div").html("<p class='tit'>��ũ�� �ٶ�� ��</p><p class='text'><input type='text' name='cors_info1' id='cors_info1'/></p>");		// info html
		$("#mem_nm_div").html("<span class='star'>*</span> ����(�л�)");		// ���� text
		$("#birth_y").val("1990|1990 ��|birth_y").attr("selected", "selected");	// ���� selected
		$("#birth_y_val").text("1990 ��");										// ���� text
		$("#school_div").html("<p class='tit'><span class='star'>*</span> �Ҽ��б�</p><p class='text'><input type='text' name='school' id='school' maxlength='20' msg='�б���' placeholder='�Ҽ��б��� �Է��ϼ���'/></p>");				// �Ҽ��б� chk
		$("#level_div").html("<p class='tit'><span class='star'>*</span> �г�</p><p class='text'><input type='text' name='level' id='level' maxlength='4' msg='�г���' placeholder='��û���(�л�) �г��� �Է��ϼ���' chknum/></p>");	// �г� chk
		$("#person_div").html("");		// �ο� html
		$("#person_div").hide();		// �ο� div
		$("#par_nm_div").show();		// �кθ� ���� div
		$("#relate_div").show();		// �кθ� ���� div
		$("#par_mobile_div").show();	// �кθ� ����ó div
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
	$("#edu_idx_val").text("��������(����)�� �����ϼ���");
	$("#birth_m_val").text("01 ��");
	$("#birth_d_val").text("01 ��");
	$("#mem_email_3_val").text("�����Է�");
	$("#mem_mobile_1_val").text("010");

	var txt = nm+" <span>��û�ϱ�</span><img src='/_img/cont/cha01.png' alt='��ü'/>";
		
	$("#birth_y").val("1990|1990 ��|birth_y").attr("selected", "selected");	// ���� selected
	$("#birth_y_val").text("1990 ��");										// ���� text

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

/* �ִϾ� �ڵ� �佺Ƽ�� */
function junior_set(jr_team, idx, jr_type){
	document.getElementById("jrFrm").reset();
	
	for(var i=1; i<=jr_team; i++){
		$("#jrc_mobile_"+i+"1_val").text("010");
		$("#jrc_email_"+i+"3_val").text("�����Է�");
		$("#par_mobile_"+i+"1_val").text("010");
	}
	
	var show_team = jr_team;

	if(jr_type == "I"){
		show_team = 1;
		$(".jrc_team_p").hide();
		$(".p_t").hide();
		$(".team_name").text("��������");
		$(".tit_mail").text("�̸���");
	}else{
		$(".jrc_team_p").show();
		$(".p_t").show();
		$(".team_name").text("��������");
		$(".tit_mail").text("��ǥ �̸���");
	}
	$(".team_info").hide();
	for(var i=1; i<=show_team; i++){
		$(".team_"+i).show();
		$("#jrc_email_"+i+"2").attr("readonly",false);
	}

	$("input:radio[name='jrc_type']:radio[value='"+jr_type+"']").attr("checked",true);		/* �� �⺻ */
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
		alert("�̿����� �������ּ���.");
		return;
	}
	var edu_idx = $("#edu_idx").val().split("|");
	if(edu_idx[0] == ""){
		alert("���������� �����ϼ���.");
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
		alert("�̿����� �������ּ���.");
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
		alert("������ �Է��� �ּ���");
		$("input[name='jrc_team_nm']").focus();
		return false;
	}

	for(var i=1; i<=jr_team; i++){
		if($("input[name='jrc_nm["+i+"]']").val() == ""){
			alert("������ �Է��� �ּ���");
			$("input[name='jrc_nm["+i+"]']").focus();
			return false;
		}
		if($("input[name='jrc_school["+i+"]']").val() == ""){
			alert("�б��� �Է��� �ּ���");
			$("input[name='jrc_school["+i+"]']").focus();
			return false;
		}
		if($("input[name='jrc_level["+i+"]']").val() == ""){
			alert("�г��� �Է��� �ּ���");
			$("input[name='jrc_level["+i+"]']").focus();
			return false;
		}
		if($("#jrc_mobile_"+i+"2").val() == ""){
			alert("�޴���ȭ�� �Է��� �ּ���");
			$("#jrc_mobile_"+i+"2").focus();
			return false;
		}
		if($("#jrc_mobile_"+i+"3").val() == ""){
			alert("�޴���ȭ�� �Է��� �ּ���");
			$("#jrc_mobile_"+i+"3").focus();
			return false;
		}
		if($("#jrc_email_"+i+"1").val() == ""){
			alert("�̸����� �Է��� �ּ���");
			$("#jrc_email_"+i+"1").focus();
			return false;
		}
		if($("#jrc_email_"+i+"2").val() == ""){
			alert("�̸����� �Է��� �ּ���");
			$("#jrc_email_"+i+"2").focus();
			return false;
		}
		if($("#par_mobile_"+i+"2").val() == ""){
			alert("�θ�Կ���ó�� �Է��� �ּ���");
			$("#par_mobile_"+i+"2").focus();
			return false;
		}
		if($("#par_mobile_"+i+"3").val() == ""){
			alert("�θ�Կ���ó�� �Է��� �ּ���");
			$("#par_mobile_"+i+"3").focus();
			return false;
		}
	}

	if(jr_type == "T" && (jr_idx == "1"||jr_idx == "2")){
		var jrc_etc_1 = $("#jrc_etc_1").val();
		if(jrc_etc_1.trim() == ""){
			alert("���⸦ �������ּ���");
			$("#jrc_etc_1").focus();
			return false;
		}
		var jrc_etc_2 = $("#jrc_etc_2").val();
		if(jrc_etc_2.trim() == ""){
			alert("������ �������ּ���");
			$("#jrc_etc_2").focus();
			return false;
		}
		var jrc_etc_3 = $("#jrc_etc_3").val();
		if(jrc_etc_3.trim() == ""){
			alert("��ǥ�� �������ּ���");
			$("#jrc_etc_3").focus();
			return false;
		}
	}

	return true;
}

function fn_submit_e(){
	if($(':checkbox[name="checks"]:checked').val() != "Y"){
		alert("�̿����� �������ּ���.");
		return;
	}
	var edu_idx = $("#edu_idx").val().split("|");
	if(edu_idx[0] == ""){
		alert("���������� �����ϼ���.");
		return;
	}

	if($(':checkbox[name="insurance_yn"]:checked').val() == "Y"){
		if($("#mem_num_1").val() == ""){
			alert("�ֹε�Ϲ�ȣ�� �Է��ϼ���.");
			$("#mem_num_1").focus();
			return;
		}

		if($("#mem_num_2").val() == ""){
			alert("�ֹε�Ϲ�ȣ�� �Է��ϼ���.");
			$("#mem_num_2").focus();
			return;
		}

		var member_num = $("#mem_num_1").val() + $("#mem_num_2").val();
		if(!memberNumCheck(member_num)){
			alert("�ֹε�Ϲ�ȣ�� ��ȿ���� �ʽ��ϴ�.");
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

function memberNumCheck(num){ /* �ֹε�Ϲ�ȣ ��ȿ���˻� */
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