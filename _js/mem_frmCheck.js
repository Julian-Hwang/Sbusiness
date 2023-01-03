
//중복확인.
function dup_check( division ){
	//  아이디 유효성체크.
	check_validation( division );
}

/*
	회원폼 validatio 체크 함수.
	check_validation( String 구분  , Jquery element );
*/
function check_validation( division ){

	var result = true;

	switch(division){

		//회원 아이디
		case "mem_id" :{
			var $mem_id = $("#mem_id");
			var value = $mem_id.val();
			var str = "아이디";


			var blank_pattern = /[\s]/g;
			if( blank_pattern.test( value) == true){
				$("#"+division+"_info").text("공백은 사용할 수 없습니다.");
				$mem_id.focus();
				result = false;
				return;
			}

			if($.trim(value) == ""){
				$("#"+division+"_info").text("아이디를 입력해 주세요.");
				$mem_id.focus();
				result = false;
				break;
			}
			if( value.length < 6 ){
				$("#"+division+"_info").text("6자 이상 입력해 주세요.");
				$mem_id.focus();
				result = false;
				break;
			}
			if( value.length > 40){
				$("#"+division+"_info").text("40자 이하로 입력해 주세요.");
				$mem_id.focus();
				result = false;
				break;
			}
			var pattern = /^[a-z]{1}[a-z0-9+]{5,19}$/;
			if(!pattern.test(value)){
				$("#"+division+"_info").text("영문(소문자) + 숫자만 입력가능하며 첫번째 문자는 영문만 가능합니다.");
				$mem_id.focus();
				result = false;
				break;
			}
			break;
		}

		//회원 이메일
		case "mem_email" :{
			var str = "이메일";
			var $mem_email_head = $("#email_1");
			var $mem_email_tail = $("#email_2");
			var value = $mem_email_head.val() + "@" + $mem_email_tail.val();
			
			var pattern = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
			if(!pattern.test(value)){
				alert('이메일 형식이 올바르지 않습니다.');
				$mem_email_head.focus();
				result = false;
				break;
			}
			break;
		}

		//회원 휴대폰
		case "mem_mobile" :{
			var str = "휴대폰번호";
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
				alert(str + ' 형식이 올바르지 않습니다.');
				$mobile_2.focus();
				result = false;
				break;
			}
			break;
		}


	}//end of switch
	
	if(result){
		//유효성 체크 통과시 ajax 통해서 중복확인.
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
						$("#"+division+"_info").text("사용하실 수 있습니다.");
						//$("#"+division+"_info").attr("class" , "blue");
						$("#"+division+"_yn").val("Y");
					}
					else{
						$("#"+division+"_info").text("중복된 "+str+"가 존재합니다.");
						//$("#"+division+"_info").attr("class" , "red");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "mem_email" || division == "company_email"){
					if($.trim(data) == "0" ){
						alert("사용가능한 "+ str +" 입니다.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("중복된 "+ str +"이 존재합니다.");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "mem_mobile"){
					if($.trim(data) == "0" ){
						alert("사용가능한 "+ str +" 입니다.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("중복된 "+ str +"가 존재합니다.");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "admin_id"){
					if($.trim(data) == "0" ){
						$("#"+division+"_info").text("사용하실 수 있습니다.");
						//$("#"+division+"_info").attr("class" , "blue");
						$("#"+division+"_yn").val("Y");
					}
					else{
						$("#"+division+"_info").text("중복된 "+str+"가 존재합니다.");
						//$("#"+division+"_info").attr("class" , "red");
						$("#"+division+"_yn").val("");
					}
				}
				else if(division == "admin_email"){
					if($.trim(data) == "0" ){
						alert("사용가능한 이메일 입니다.");
						$("#"+division+"_yn").val("Y");

					}else{
						alert("중복된 이메일이 존재합니다.");
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