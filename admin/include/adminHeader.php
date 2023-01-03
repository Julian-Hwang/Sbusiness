
<head>
<title>한국생산성본부 소상공인성장센터 - 관리자 </title>
<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="generator" content="editplus">
<meta name="author" content="">
<meta name="keywords" content="">
<meta name="description" content="">

<meta name="copyright" content="한국생산성본부 소상공인성장센터">
<meta property="og:title" content="한국생산성본부 소상공인성장센터">
<meta property="og:url" content="https://sbusiness.cafe24.com/admin/notice_admin.php">
<meta property="og:image" content="https://sbusiness.cafe24.com/admin/_img/comn/ogimg.jpg"/>

<link rel="stylesheet" type="text/css" href="./_css/default.css">
<link rel="shortcut icon" href="http://esgedu.kpc.or.kr/_img/favicon.ico">
<script type="text/javascript" src="//code.jquery.com/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="./_js/pop_layer.js"></script>
<script type="text/javascirpt" src="./_js/common.js"></script>
<script src="./_js/jquery-1.8.3.min.js" language="JavaScript" type="text/javascript"></script>
<script src="./_js/common.js" language="JavaScript" type="text/javascript"></script>
<script src="./_js/frmCheck.js" language="javascript" ></script>
<script src="./_js/navigation.js" language="JavaScript" type="text/javascript"></script>

<link  href="./_js/jquery.ui/jquery-ui.css" type="text/css" rel="stylesheet"  media="screen" />
<script src="./_js/jquery.ui/jquery.ui.datepicker.js" language="JavaScript" type="text/javascript"></script>
<script src="./_js/jquery.ui/jquery-ui.js" language="JavaScript" type="text/javascript"></script>

<script>
$(document).ready(function(){
	/* 기능 사용 유무 체크 */
	var boardVal = "";

	//boardval을 | 기준으로 끊어서 저장
	var boardArr = boardVal.split('|');
	for(var i=1; i<=2; i++){
		if(boardArr[i] == 0){
			$(".board_view_"+i).remove();
		}
	}
});


/*	삭제	*/
function del_row(idx){

	var submitFlag = false;
	
	if(arguments.length > 0){
		$(arguments).each(function (key, value){
			idx +=  ", "+value;
		})
		submitFlag = true;
	}else{
		var $Checked = $("input[type=checkbox].chk:not([disabled]):checked");
		if($Checked.length > 0){
			
			$("input[type=checkbox].chk:not([disabled]):checked").each(function (){
				idx +=  ", "+$(this).val();
			});
			submitFlag = true;
		}
	}
	if(submitFlag == false){
		return;
	}
	
	if(confirm("삭제 하시겠습니까?")){
		$("#SubmitMode").val("ajax_del");
		$("#idx").val(idx);
		$("#frm").attr("method" , "post").attr("action" , "./admin_proc.php").submit();
	}

}
</script>
</head>