/********************************************************************
 *
 * Form ���� ��ũ��Ʈ �Լ� ����
 *
 *******************************************************************/
	// �� ���� �Լ�
	function checkForm(f) {
		var fObj;	// �� ���
		var fOId;	// �� ID �̸�
		var fTyp;	// �� ��� Type
		var fVal;	// �� ��� Value
		var fMsg;	// ��� �޽��� �Ӽ�
		var fNum;	// ���ڸ� �Է� �Ӽ�
		var fMax;	// �ִ� ���� ����
		var fMin;	// �ּ� ���� ����
		var fMxN;	// �ִ밪 ����
		var fMnN;	// �ּҰ� ����
		var fMal;	// ���� FORMAT
		var fLng;	// ���̰�
		var fKMax;	// �ִ� ���� ����(�ѱ�)
		var fNumEng;// ����, ���� üũ

		var rtnV    = true;

		$("#"+f+" input, #"+f+" select, #"+f+" textarea").each(function(){ 
			fObj	= $(this);
			fOId	= $(this).attr("id");
			fTyp	= toUpperCase(fObj.attr("type"));
			fVal	= fObj.val();
			fMsg	= fObj.attr("msg");		  // ��� �޽���
			fNum	= fObj.attr("chknum");	  // ���ڸ� ���� �����ϵ���
			fMax	= fObj.attr("maxlen");	  // �ִ� �Է±��ڼ� ����
			fKMax	= fObj.attr("maxlenK");	  // �ִ� �Է±��ڼ� �ѱ۸� ����
			fMin	= fObj.attr("minlen");	  // �ּ� �Է±��ڼ� ����
			fMxN	= fObj.attr("maxnum");	  // �ִ� ���� ����
			fMnN	= fObj.attr("minnum");	  // �ּ� ���� ����
			fMal	= fObj.attr("chkmail");	  // �̸��� üũ
			fLng	= fObj.attr("chklen");    // ����üũ			
			fNumEng = fObj.attr("chknumeng"); // ����, ���� üũ

			

			// üũ�ؾ� �ϴ� �ʼ� ������ Ȯ��
			var chkBool = false;
			if (fMsg != undefined || getLen(fVal) > 0) chkBool = true;

			// select Ÿ�� �ν� �Ұ��� �⺻ select box �� �ν�
			if (fTyp == "") fTyp = "SELECT-ONE";
			
			if (chkBool && fMsg != undefined && (fTyp == "TEXT" || fTyp == "HIDDEN" || fTyp == "TEXTAREA" || fTyp == "PASSWORD") && fVal.replace(/ /gi,"") == "") {				
				alert(fMsg + " �Է��� �ּ���");
				if (fTyp != "HIDDEN" ) {fObj.focus();}
				rtnV = false;
				return false;
			}
			if (chkBool && fMsg != undefined && (fTyp == "FILE") && fVal =="") {
				alert(fMsg + " �Է����ּ���");
				rtnV = false;
				return false;
			}
			if (chkBool && fMsg != undefined && (fTyp == "SELECT-ONE" || fTyp == "SELECT-MULTIPLE") && fVal =="") {
				alert(fMsg + " ������ �ּ���");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMsg != undefined && fTyp == "RADIO" && checkChecked(fOId,"radio") == false) {
				alert(fMsg + " ������ �ּ���");
				rtnV = false;
				//fObj.focus();
				return false;
			}
			if (chkBool && fMsg != undefined && fTyp == "CHECKBOX" && checkChecked(fOId,"checkbox") == false) {
				alert(fMsg + " ������ �ּ���");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fNum != undefined && isNaN(fVal)) {
				alert("���ڷθ� �Է��� �ּ���");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMax != undefined && fMax < getLen(fVal)) {
				alert("�Էµ� ���ڼ��� "+fMax+"�ں��� �۾ƾ��մϴ�.");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fKMax != undefined && fKMax < getLen(fVal)) {
				alert("�Էµ� ���ڼ��� "+fKMax+"�ں��� �۾ƾ��մϴ�.\n(���� "+fKMax+"��, �ѱ� "+Math.floor(fKMax/2)+"�� ���� �����մϴ�.)");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMin != undefined && fMin > getLen(fVal)) {
				alert("�Էµ� ���ڼ��� "+fMin+"�ں��� Ŀ���մϴ�.");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fLng != undefined && fLng != getLen(fVal)) {
				alert(""+fLng+"�ڸ��� �Է����ּ���.");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMxN != undefined && parseInt(fMxN) < parseInt(fVal)) {
				alert("�Էµ� ���ڴ� "+fMxN+"���� �۾ƾ��մϴ�.");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMnN != undefined && parseInt(fMnN) > parseInt(fVal)) {
				alert("�Էµ� ���ڴ� "+fMnN+"���� Ŀ���մϴ�.");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fMal != undefined && checkEmail(fVal) == false && fVal != "") {
				alert("�̸��� �ּҰ� �ùٸ��� �ʽ��ϴ�");
				rtnV = false;
				fObj.focus(); return false;
			}
			if (chkBool && fNumEng != undefined && checkNumEng(fVal) == false && fVal != "") {
				alert(fNumEng+" ����, ���ڸ� �����ؼ� �Է����ּ���.");
				rtnV = false;
				fObj.focus(); return false;
			}
			
		});

		return rtnV;
	}

	// ���� �ش��ϴ� ��Ʈ�ѵ��� �⺻�� ���� ������ �ֱ�
	function initForm(f) {
		var nLen;	// form ����� ����
		var ival;	// �� ����� default value �� ��! �ʱ�ȭ�ϰ��� �ϴ°�(��ġ��)
		var ivalin;	// �� ����� default value �� ��! �ʱ�ȭ�ϰ��� �ϴ°�(������)
		var fTyp;	// form ����� Ÿ��(select, radio, checkbox...)

		$("#"+f+" input, #"+f+" select").each(function(){ 
			fObj	= $(this);
			fOId	= $(this).attr("id");
			fTyp	= toUpperCase(fObj.attr("type"));
			ival	= $(this).attr("ival");
			ivalin	= $(this).attr("ivalin");

			// �̻��� ���̽� �߰� ����� �ʿ��� select Ÿ�� �ν� �Ұ�
			if (fTyp == "") fTyp = "SELECT-ONE";

			if (ival != undefined && fTyp == "SELECT-ONE") {
				for (i=0;i<$("#"+fOId+" option").length;i++) {
					if (ival == $("#"+fOId+" option:eq("+i+")").val()) {
						fObj.val(ival);
					}					
				}
			}
			if (ival != undefined && (fTyp == "RADIO" || fTyp == "CHECKBOX")) {
				if (ival == fObj.val()) {
					fObj.attr("checked","checked");
				}
			}
			if (ivalin != undefined && (fTyp == "RADIO" || fTyp == "CHECKBOX")) {
				if (ivalin.indexOf(fObj.val()) != -1) {
					fObj.attr("checked","checked");
				}
			}			
		});

	}
	// �迭 ����� ��� checked �Ȱ��� �ִ��� Ȯ��
	function checkChecked(objid,objType) {
		var ret = false;
		if($("input:"+objType+"[id='"+objid+"']:checked").val() == undefined) {
			ret = false;
		} else {
			ret = true;
		}
		return ret;
	}
	// �̸��� ��ȿ�� üũ
	function checkEmail(str){
	    var reg = /^((\w|[\-\.])+)@((\w|[\-\.])+)\.([A-Za-z]+)$/;
	    if (str.search(reg) != -1) {
			return true;
		}
		return false;
	}
	// ���� ���� ��ȯ (���� 1byte, �ѱ� 2byte ���)
	function getLen(str) {
		var len;
	    var temp;

	    len = str.length;
	    var tot_cnt = 0;

	    for(k=0;k < len;k++){
	    	temp = str.charAt(k);
	    	if(escape(temp).length > 4)
	    		tot_cnt += 2;
	    	else
	    		tot_cnt++;
	    }
	    return tot_cnt;
	}
	// �빮�� ��ȯ ex) toUpperCase(����)
	function toUpperCase(str) {
		var ret;
		str != null ? ret = str.toUpperCase() : ret = "";
		return ret;
	}
	// �����ϰ� ���ڸ� �����ؼ� �Է�
	function checkNumEng(str){
		var reg1 = /^[a-zA-Z0-9]{4,16}$/;
		var reg2 = /[a-zA-Z]/g;
		var reg3 = /[0-9]/g;

		return (reg1.test(str) && reg2.test(str) && reg3.test(str));
	}

	function checkFile(uploadImgObj,select,extension){	
		// �̹��� Ȯ���� ���
		var imgList  = "bmp,jpg,jpeg,gif,png";
		// ���� Ȯ���� ���
		var fileList = "hwp,doc,docx,ppt,pptx,xls,xlsx,pdf,wmv,zip";
		// ���ϸ��� �ִ� ����
		var MAX_FILE_NAME_LENGTH = 50;

		var existExt;

		// Ȯ���ڰ� null�� �ƴѰ�� ���޹��� Ȯ���ڷ� üũ
		// ������ �̹������� �ƴ��� üũ�Ͽ� ����� Array�� ��´�.
		if(!extension){
		existExt = select == "img" ? imgList : fileList;
		}else{
		existExt = extension;
		}
		var enableUploadFileExt = existExt.split(",");
		var uploadImgObjName = uploadImgObj.value;
		var startPoint = 0;
		var isImageFile = false;

		// File üũȮ��
		if(uploadImgObj.value == ""){
			return;
		}

		// ���� Ȯ���� üũ
		for(var i=uploadImgObjName.length-1; i>=0; i--) {
			if(uploadImgObjName.charAt(i) == ".") {
				startPoint = i;
				break;
			}
		}

		var uploadImgObjExt = uploadImgObjName.substring(startPoint+1,uploadImgObjName.length);
		for(i=0; i<enableUploadFileExt.length; i++) {
			if(uploadImgObjExt.toLowerCase() == enableUploadFileExt[i]){
				isImageFile = true;
				break;
			}
		}

		// file��
		var filename = uploadImgObjName.substring(uploadImgObjName.lastIndexOf('\\') + 1);

		if(filename.length > MAX_FILE_NAME_LENGTH){
			alert("���ϸ��� ��(" + MAX_FILE_NAME_LENGTH + "�ڰ� �Ѵ�)���� " + filename + "��(��) ÷���ϽǼ� �����ϴ�.");
			return false;
		}

		// ÷�� �Ұ����� ������ ���
		if(!isImageFile){
			alert("÷�� ������ ������ �ƴմϴ�.\n �̹����� ���ε� �����մϴ�.");			
			if (/(MSIE|Trident)/.test(navigator.userAgent)) { 
				// ie �϶� input[type=file] init.
				$("#"+uploadImgObj.name).replaceWith( $("#"+uploadImgObj.name).clone(true) );
			} else {
				// other browser �϶� input[type=file] init.
				$("#"+uploadImgObj.name).val("");
			}
		}
	}