// JavaScript Document

$(document).ready(function(){
	/*	왼쪽메뉴 아코디언 마우스 leave 이벤트	*/
	$(".lmn > li[OverEvent] ").mouseleave(function (){
		if($(this).find("ul").css("display") == "block"){
			this.className = 'out';
		}else{
			this.className = '';
		}
	});
});

/*
	페이지이동.
	팝업창인지 부모창인지 구분하여이동.
*/
function go_page(url){
	if(opener){
		opener.location.href= url;
		opener.focus();
	}else{
		location.href= url;
	}
}

//input 공백체크용 
function check_input( id, str ){
	if( $("#"+id).length > 0 ){
		if($("#"+id).val() == ""){
			alert(str);
			$("#"+id).focus();
			return false;
		}
	}
	return true;
}

/*
	이미지 경로 오류시 대체 이미지설정
	이미지 사이즈 설정하지않음.
*/
function isIE() { return ((navigator.appName == 'Microsoft Internet Explorer') || ((navigator.appName == 'Netscape') && (new RegExp("Trident/.*rv:([0-9]{1,}[\.0-9]{0,})").exec(navigator.userAgent) != null))); }
function setNoImg(  ){

	$(document).find("img").each(function (){
		//ie 일 경우만 img 캐시 문제로 src값 변경.
		if(isIE()){
			$(this).attr("src" , $(this).attr("src")+"?"+new Date().getTime());
		}

		$(this).error(function (){
			$(this).attr("src" , "/_img/bbs/noImg.jpg");
			//이미지로드 실패
		});
		$(this).load(function (){
			//이미지로드성공.
		});
	});

}

/*	
	숫자만 입력. 천단위콤마. 
	input[num_only] 에 적용됨
*/
function set_num_only(){
	$('input[num_only]').css({'imeMode':'disabled' , 'text-align' : 'right'}).keypress(function(event) {
		if(event.which && (event.which < 48 || event.which > 57) ) {
			event.preventDefault();
		}
	}).keyup(function(){
		if( $(this).val() != null && $(this).val() != '' ) {
			var tmps = $(this).val().replace(/[^0-9]/g, '');
			var tmps2 = tmps.replace(/(\d)(?=(\d\d\d)+(?!\d))/g, "$1,");
			$(this).val(tmps2);
		}
	}).focus(function (){
		if($(this).val() == 0){
			$(this).val("");
		}
	});
}

/*	
	숫자만 입력. 천단위콤마X. 
	input[num_only] 에 적용됨
*/
function num_only(){
	$('input[num_only]').css({'imeMode':'disabled'}).keypress(function(event) {
		if(event.which && (event.which < 48 || event.which > 57) ) {
			event.preventDefault();
		}
	}).keyup(function(){
		if( $(this).val() != null && $(this).val() != '' ) {
			var tmps = $(this).val().replace(/[^0-9]/g, '');
			$(this).val(tmps);
		}
	}).focus(function (){
		if($(this).val() == 0){
			$(this).val("");
		}
	});
}

/*	
	HTML tag 제거
*/
function htmlTag(cont){
	var cont2 = cont.replace(/(<([^>]+)>)/gi, "");
	var cont3 = cont2.replace(/&nbsp;/gm, " ");
	return cont3;
}

/*	
	신청현황 popup
*/
function popup_edu(idx,state){
	var pop = window.open("/admin/edu/master_pop.php?idx="+idx+"&search_cors_state="+state , 'pop' , 'width=1000, height=750, scrollbars=yes');
	pop.focus();
}

/*	
	신청현황 popup v2
*/
function popup_edu_v2(idx,state){
	var pop = window.open("/intra/edu/master_pop.php?idx="+idx+"&search_cors_state="+state , 'pop' , 'width=1000, height=750, scrollbars=yes');
	pop.focus();
}
/*
	수료증 출력함수
*/
function Print_certificate(idx){
	window.open('/_inc/certificate.php?idx='+idx, 'Pop_certificate', 'height=900, width=910,toolbar=no,status=no,scrollbars=yes,resizable=no,menubar=no' );
	
	window.open('/_inc/certificate_info.php' , 'pop_certificate_info' , 'width=500, height=200, scrollbars=no');	
}
/*
	수료증 출력함수 v2
*/
function Print_certificate_v2(idx){
	window.open('/v2/_inc/certificate.php?idx='+idx, 'Pop_certificate', 'height=900, width=910,toolbar=no,status=no,scrollbars=yes,resizable=no,menubar=no' );
	
	window.open('/_inc/certificate_info.php' , 'pop_certificate_info' , 'width=500, height=200, scrollbars=no');	
}
function Print_certificate_v2_sch(idx){
	window.open('/v2/_inc/certificate_sch.php?idx='+idx, 'Pop_certificate', 'height=900, width=910,toolbar=no,status=no,scrollbars=yes,resizable=no,menubar=no' );
	
	window.open('/_inc/certificate_info.php' , 'pop_certificate_info' , 'width=500, height=200, scrollbars=no');	
}

/* popup: block ui in */
function popup_show(pop_id){
	$("body").css({"position" :  "fixed"});
	$.blockUI({
		message: $('#'+pop_id),
		css:{	 top: '0'	}
	});
	
	/* popup 중앙 정렬 */
	$('#'+pop_id+"_in").css("top", ( $(window).height() - $("#"+pop_id+"_in").height() ) / 2+$(window).scrollTop() + "px");
	$('#'+pop_id+"_in").css("left", ( $(window).width() - $("#"+pop_id+"_in").width() ) / 2+$(window).scrollLeft() + "px");
}

function popup_hide(){
	$("body").css({"position" :  ""});
	$.unblockUI();
}

/*	
	popup open
*/
function popup_open(url){
	var pop = window.open(url , 'pop' , 'width=1000, height=750, scrollbars=yes');
	pop.focus();
}