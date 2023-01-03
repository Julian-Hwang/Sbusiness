$(document).ready(function(){
	var one_exit = true;
	var two_exit = true;
	$(".OneDepth li p").each(function(){
		if($(this).attr("class") == "pic_on" && one_exit == true){
			$("#navi").html($(this).children('a').html());
			one_exit = false;
		}
	});
	$(".TwoDepth li").each(function(){
		if($(this).attr("class") == "here" && two_exit == true){
			$("#navi").html($("#navi").html()+'&nbsp;<img src="../_img/comn/h3_icon.gif" style="padding:4px 4px 0 4px;"/>&nbsp;'+$(this).children('a').html());
			two_exit = false;
		}
	});
});
