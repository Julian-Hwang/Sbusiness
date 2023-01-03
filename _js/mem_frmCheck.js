
//�ߺ�Ȯ��.
function dup_check( division ){
	//  ���̵� ��ȿ��üũ.
	check_validation( division );
}

/*
	ȸ���� validatio üũ �Լ�.
	check_validation( String ����  , Jquery element );
*/
function check_validation( division ){

	var result = true;

	switch(division){

		//ȸ�� ���̵�
		case "mem_id" :{
			var $mem_id = $("#mem_id");
			var value = $mem_id.val();
			var str = "���̵�";


			var blank_pattern = /[\s]/g;
			if( blank_pattern.test( value) == true){
				$("#"+division+"_info").text("������ ����� �� �����ϴ�.");
				$mem_id.focus();
				result = false;
				return;
			}

			if($.trim(value) == ""){
				$("#"+division+"_info").text("���̵� �Է��� �ּ���.");
				$mem_id.focus();
				result = false;
				break;
			}
			if( value.length < 6 ){
				$("#"+division+"_info").text("6�� �̻� �Է��� �ּ���.");
				$mem_id.focus();
				result = false;
				break;
			}
			if( value.length > 40){
				$("#"+division+"_info").text("40�� ���Ϸ� �Է��� �ּ���.");
				$mem_id.focus();
				result = false;
				break;
			}
			var pattern = /^[a-z]{1}[a-z0-9+]{5,19}$/;
			if(!pattern.test(value)){
				$("#"+division+"_info").text("����(�ҹ���) + ���ڸ� �Է°����ϸ� ù��° ���ڴ� ������ �����մϴ�.");
				$mem_id.focus();
				result = false;
				break;
			}
			break;
		}

		//ȸ�� �̸���
		case "mem_email" :{
			var str = "�̸���";
			var $mem_email_head = $("#email_1");
			var $mem_email_tail = $("#email_2");
			var value = $mem_email_head.val() + "@" + $mem_email_tail.val();
			
			var pattern = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
			if(!pattern.test(value)){
				alert('�̸��� ������ �ùٸ��� �ʽ��ϴ�.');
				$mem_email_head.focus();
				result = false;
				break;
			}
			break;
		}

		//ȸ�� �޴���
		case "mem_mobile" :{
			var str = "�޴�����ȣ";
			var $mobile_1 = $("#mobile_1");
			var $mobile_2 = $("#mobile_2");
			var $mobile_3 = $("#mobile_3");

			var $birth_1 = $("#birthday_y");
			var $birth_2 = $("#birthday_m");
			var $birth_3 = $("#birthday_d");

			var value = $mobile_1.val() + "-" + $mobile_2.val() + "-" + $mobile_3.val();
			var mem_birth = $birth_1.val() + "-" + $birth_2.val() + "-" + $birth_3.val();

			var pattern = /(\d{3})-(\d{3,4})-(\d{4})/;

			if(!pattern.test(value)){
				alert(str + ' ������ �ùٸ��� �ʽ��ϴ�.');
				$mobile_2.focus();
				result = false;
				break;
			}
			break;
		}


	}//end of switch
	
	if(result){
		//��ȿ�� üũ ����� ajax ���ؼ� �ߺ�Ȯ��.
		//$("#"+division+"_info").attr("class" , "blue");
		$.ajax({
			type: "POST",
			url: "/member/check_duplicate.php",
			data: {
				division : division
				,value : value
				,submitMode : submitMode
				,mem_idx	: Glo_mem_idx
				,mem_div	: Glo_mem_div
				,mem_birthday : mem_birth
			},
			success: function (data) {

				if(division == "mem_id" || division == "company_id"){
					if($.trim(data) == "0" ){
						$("#"+division+"_info").text("����Ͻ� �� �ֽ��ϴ�.");
						//$("#"+division+"_info").attr("class" , "blue");
						$("#"+division+"_yn").val("Y");
					}
					else{
						$("#"+division+"_info").text("�ߺ��� "+str+"�� �����մϴ�.");
						//$("#"+division+"_info").attr("class" , "red");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "mem_email" || division == "company_email"){
					if($.trim(data) == "0" ){
						alert("��밡���� "+ str +" �Դϴ�.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("�ߺ��� "+ str +"�� �����մϴ�.");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "mem_mobile"){
					if($.trim(data) == "0" ){
						alert("��밡���� "+ str +" �Դϴ�.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("�ߺ��� "+ str +"�� �����մϴ�.");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "admin_id"){
					if($.trim(data) == "0" ){
						$("#"+division+"_info").text("����Ͻ� �� �ֽ��ϴ�.");
						//$("#"+division+"_info").attr("class" , "blue");
						$("#"+division+"_yn").val("Y");
					}
					else{
						$("#"+division+"_info").text("�ߺ��� "+str+"�� �����մϴ�.");
						//$("#"+division+"_info").attr("class" , "red");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "admin_email"){
					if($.trim(data) == "0" ){
						alert("��밡���� �̸��� �Դϴ�.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("�ߺ��� �̸����� �����մϴ�.");
						$("#"+division+"_yn").val("");
					}
				}
			}
		});
	}else{
		//$("#"+division+"_info").attr("class" , "red");
	}

	
	return result;
}

function check_password( division ){

}

function duplChkCancle(division){
	$("#"+division+"_yn").val("");
}