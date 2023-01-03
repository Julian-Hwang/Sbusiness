
/*
		<----DaumEditor 관련 함수.
*/
	var config = Array();
	$(document).ready(function(){
		EditorJSLoader.ready(function (Editor) {
			var clear_str_head = "";
			var clear_str_tail = "";
			config.forEach(function(value, index) {
				clear_str_head		+= " new Editor(config["+index+"]); ";
				clear_str_head		+= " Editor.getCanvas().observeJob(Trex.Ev.__IFRAME_LOAD_COMPLETE, function() { ";
				clear_str_head		+= "	Editor.modify({ content: $('#daumDefault"+index+"').val()	}); ";
				clear_str_head		+= "	if(Editor.config.areaHeight > 0){	Editor.getCanvas().setCanvasSize({height:Editor.config.areaHeight}); } ";
				clear_str_tail		+= " });";
			});
			eval(clear_str_head + clear_str_tail);
		});
		$(".tx-image").mouseover(function (){
			var seq = $(this).attr("seq");
			Editor.switchEditor(seq);
		});
	});

	function setForm(editor,sub3) {
        var content = editor.getContent();		
		var seq = editor.getInitializedId();
		//var contentChk	= content.replace(/(<([^>]+)>)/gi, "");	//(빈값 체크용) 태그 제거 정규식
		//var contentChk	= content.replace(/&nbsp;/gm, "");
		if(content == "<p>&nbsp;</p>" || content == "<p><br></p><p><br></p>" || content == ""){					
			alert("내용을 입력해주세요.");
			//$("#daumDefault"+seq).focus();
			return false;
		}		
		$("#daumDefault"+seq).val(content);
        return true;
	}
	
	//실제 submit 함수.
	function saveContent() {
		var sub = "0";
		var sub2 = 0;
		var sub3 = 0;

		config.forEach(function(value, index) {
			sub3++;
		});
		config.forEach(function(value, index) {
			Editor.switchEditor(index);
			sub = "0";
			if(sub2 == 0){
				if(setForm(Editor,sub3)){
					sub = "1";
				}else{
					sub2++;
				}					
			}
		});

		if(sub == "1"){
			Editor.getForm().submit();		
		}
		return;
	}
/*
	DaumEditor 관련 함수.--->
*/
