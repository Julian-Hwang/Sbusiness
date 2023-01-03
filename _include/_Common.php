<?
/*	
	비밀번호 초기화 함수
	이후 mds 암호화 로직 적용해야함.2015-01-13
*/
function get_mem_pwd() {
	return  str_pad(mt_rand(1,99999999) , 8 , 0 , STR_PAD_LEFT);
}

/*
	날짜형식 무조건 yyyy.m.d로 변환
*/
function setDateFormat($date) {

	return date("Y.m.d" , strtotime($date));

}

/*
	날짜형식 무조건 m.d로 변환
*/
function setDateFormat2($date) {

	return date("m.d" , strtotime($date));

}

/*
	날짜형식 무조건 yy.m.d로 변환
*/
function setDateFormat3($date) {

	return date("y.m.d" , strtotime($date));

}

/*
	공백, Null 체크, 기본값설정.
*/
function isNull( $val , $return ) {
	$result = $val;
	if(trim($val) == "" || trim($val)==="") {
		$result = $return;
	}
	return $result;
}

/*
	이전페이지 체크함수. 프로세스페이지에서 url 직접접근 막기용도.
	매게변수 Array or String .. 해당프로세스페이지 이전페이지가 여려개일경우, 배열로 값 넘김.

	ex) 
	$refer = array();
	$refer[0] = "/member/join_form.php";
	$refer[1] = "/member/modify.php";
	check_referer( $refer );

*/
function check_referer( $url ) {

	if(gettype($url) == "array") {
		$flag = false;
		foreach($url as $key=>$val){
			if( strpos ($_SERVER["HTTP_REFERER"], $val ) == true ) {
				$flag = true;
				break;
			}
		}
		if($flag == false) {
			AlertMoveReplace("잘못된 접근입니다.1" , "/");
		}

	}else{
		if( strpos ($_SERVER["HTTP_REFERER"], $url ) === false) {
			AlertMoveReplace("잘못된 접근입니다.2" , "/");
		}

	}
}
 
function check_dir($dir) {
	if(!is_dir($dir)) {
		mkdir($dir, 0777);
		chmod($dir, 0777);
	}
}

/* 사용자 로그인 체크 */
function user_login_check(){

	if($_SERVER[QUERY_STRING]) $login_refer_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
	else $login_refer_page = urlencode($_SERVER[PHP_SELF]);

	if(!$_SESSION[ss_member_idx] || !$_SESSION[ss_member_idx] ) {
		echo "<script>alert('로그인이 필요합니다.'); location.href='/v2/member/login.php?refer_page=" . $login_refer_page . "';</script>";
		exit;
	}

}


//사용자 고객센터 페이징
//<a href="#" class="next_back"><img src="../_img/bbs/p_first.png" alt="next"></a>
//<a href="#" class="next_back"><img src="../_img/bbs/p_back.png" alt="last"></a>
//<a class="on" href="#">1</a><a href="#">2</a><a href="#">3</a><a href="#">4</a><a href="#">5</a>
//<a href="#" class="next_back"><img src="../_img/bbs/p_next.png" alt="next"></a>
//<a href="#" class="next_back"><img src="../_img/bbs/p_last.png" alt="last"></a>
//user_paging("#", "100", "7", "10")

function user_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 5;

	if($temp == 0) {
		$a = 5 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 5 - $temp;
		
	}
	$start = $page - $a;		//페이지의 10단위 최소
	$end = $page + $b;			//페이지의 10단위 최대

	//처음페이지
	if($page > 5) {
		echo "<a href='".$link."&page=1' class='next_back'><img src='/_img/bbs/p_first.png' alt='next'></a>&nbsp;";
	}

	//이전페이지
	if($page > 5) {
		$back_page = $start - 1;
		echo "<a href='".$link."&page=".$back_page."' class='next_back'><img src='/_img/bbs/p_back.png' alt='last'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<a href='#' class='on'>".$i."</a>&nbsp;";
		else echo "<a href='".$link."&page=".$i."'>".$i."</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='".$link."&page=".$next_page."' class='next_back'><img src='/_img/bbs/p_next.png' alt='next'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='".$link."&page=".$total_page."' class='next_back'><img src='/_img/bbs/p_last.png' alt='last'></a>";
	}
}

// v2 페이징 10단위
function user_paging_2($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
		
	}
	$start = $page - $a;		//페이지의 10단위 최소
	$end = $page + $b;			//페이지의 10단위 최대

	//처음페이지
	if($page > 10 ) {
		echo "<a href='".$link."&page=1' class='next_back'><img src='../_img/bbs/first.png' alt='처음으로'></a>&nbsp;";
	}

	//이전페이지
	if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='".$link."&page=".$back_page."' class='first_back'><img src='../_img/bbs/back.png' alt='이전으로'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<a href='#' class='on'>".$i."</a>&nbsp;";
		else echo "<a href='".$link."&page=".$i."'>".$i."</a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='".$link."&page=".$next_page."' class='next_back'><img src='../_img/bbs/next.png' alt='다음으로'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='".$link."&page=".$total_page."' class='first_back'><img src='../_img/bbs/last.png' alt='끝으로'></a>";
	}
}

function admin_paging($link, $total, $page, $size) {
	if($total == 0) return;

	$total_page = ceil($total / $size);
	$temp = $page % 10;

	if($temp == 0) {
		$a = 10 - 1;
		$b = $temp;
	}
	else {
		$a = $temp - 1;
		$b = 10 - $temp;
		
	}
	$start = $page - $a;		//페이지의 10단위 최소
	$end = $page + $b;			//페이지의 10단위 최대

	//처음페이지
	if($page > 10) {
		echo "<a href='".$link."&page=1' class='none'><img src='/admin/_img/bbs/prev2.gif' class='num01'></a>&nbsp;";
	}

	//이전페이지
	if($page > 10) {
		$back_page = $start - 1;
		echo "<a href='".$link."&page=".$back_page."' class='none'><img src='/admin/_img/bbs/prev.gif' class='num01 pr15'></a>&nbsp;";
	}

	//페이지 출력
	for($i = $start; $i <= $end; $i++) {
		if($i > $total_page) break;

		if($page == $i) echo "<strong> ".$i." </strong>&nbsp;";
		else echo "<a href='".$link."&page=".$i."'> ".$i." </a>&nbsp;";
	}

	//다음페이지
	if($end < $total_page) {
		$next_page = $end + 1;
		echo "<a href='".$link."&page=".$next_page."' class='none'><img src='/admin/_img/bbs/next.gif' class='num01 pl5'></a>&nbsp;";
	}

	//마지막 페이지
	if($end < $total_page) {
		echo "<a href='".$link."&page=".$total_page."' class='none'><img src='/admin/_img/bbs/next2.gif' class='num01'></a>";
	}
}

// 메일주소
function getEmail($email){
	$_EMAIL = array();
	$_EMAIL[] = "naver.com";
	$_EMAIL[] = "chol.com";
	$_EMAIL[] = "dreamwiz.com";
	$_EMAIL[] = "empal.com";
	$_EMAIL[] = "freechal.com";
	$_EMAIL[] = "gmail.com";
	$_EMAIL[] = "hanafos.com";
	$_EMAIL[] = "hanmail.net";
	$_EMAIL[] = "hanmir.com";
	$_EMAIL[] = "hiphone.net";
	$_EMAIL[] = "hotmail.com";
	$_EMAIL[] = "korea.com";
	$_EMAIL[] = "lycos.co.kr";
	$_EMAIL[] = "nate.com";
	$_EMAIL[] = "netian.com";
	$_EMAIL[] = "paran.com";
	$_EMAIL[] = "yahoo.com";
	$_EMAIL[] = "yahoo.co.kr";

	$str ="<option value=''>직접입력</option>";

	for($i=0; $i<count($_EMAIL); $i++){
		$selected = "";
		if($_EMAIL[$i]==$email) $selected = "selected";

		$str.= "<option value='".$_EMAIL[$i]."' ".$selected.">".$_EMAIL[$i]."</option>";
	}

	return $str;
}

// 전화번호 국번
function getPhone($phone1){
	$_PHONE = array();
	$_PHONE[] = "02";
	$_PHONE[] = "031";
	$_PHONE[] = "032";
	$_PHONE[] = "033";
	$_PHONE[] = "041";
	$_PHONE[] = "042";
	$_PHONE[] = "043";
	$_PHONE[] = "051";
	$_PHONE[] = "052";
	$_PHONE[] = "053";
	$_PHONE[] = "054";
	$_PHONE[] = "055";
	$_PHONE[] = "061";
	$_PHONE[] = "062";
	$_PHONE[] = "063";
	$_PHONE[] = "064";
	$_PHONE[] = "070";

	$str ="<option value=''>선택</option>";

	for($i=0; $i<count($_PHONE); $i++){
		$selected = "";
		if($_PHONE[$i]==$phone1) $selected = "selected";

		$str.= "<option value='".$_PHONE[$i]."' ".$selected.">".$_PHONE[$i]."</option>";
	}

	return $str;

}

// 휴대전화
function getMobile($mobile1){
	$_MOBILE = array();
	$_MOBILE[] = "010";
	$_MOBILE[] = "011";
	$_MOBILE[] = "016";
	$_MOBILE[] = "017";
	$_MOBILE[] = "018";
	$_MOBILE[] = "019";

	$str ="<option value=''>선택</option>";

	for($i=0; $i<count($_MOBILE); $i++){
		$selected = "";
		if($_MOBILE[$i]==$mobile1) $selected = "selected";

		$str.= "<option value='".$_MOBILE[$i]."' ".$selected.">".$_MOBILE[$i]."</option>";
	}

	return $str;

}

/* <!--alert 페이지 이동함수모음 */
	function ErrorBack($message) {
		echo "
				<script language=JavaScript> alert ('".$message."');
						if(history.length <= 1){
							location.href='/';
						}else{
							history.back();
						}
				</script>
				
				";
		exit;
	}

	function AlertMove($message, $move_url) {
		echo "<script language=JavaScript>";

		if($message){
			echo "alert ('".$message."');";

		}

		if($move_url){
			echo "location.href='".$move_url."';";
		}
		echo "</script>";
		exit;
	}

	function AlertMoveReplace($message, $move_url) {
		echo "<script language=JavaScript>";

		if($message){
			echo "alert ('".$message."');";
		}

		echo "location.replace('".$move_url."');";
		echo "</script>";
		exit;
	}


	/*	
		$message ="처리되었습니다."
		$scrpit ="parent.reload();"
	*/	
	function AlertClose($message , $scrpit=""){	
		echo "<script>";
		if($message !="" ) {
			echo " alert('".$message."'); ";
		}
		echo " window.close(); ";
		if($scrpit != "") {
			echo $scrpit;
		}
		echo "</script>";
		exit;
	}
		


/* alert 페이지 이동함수모음--> */


/*	<-- 로그인 체크 함수모음.*/
	function admin_login_check() {		
		//InsMenuLog();
		if($_SERVER["QUERY_STRING"]) $login_rtn_page = urlencode($_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"]);
		else $login_rtn_page = urlencode($_SERVER["PHP_SELF"]);

		if(!$_SESSION["ss_admin_id"] || !$_SESSION["ss_admin_nm"] ) {
			echo "<script>location.href='/admin/index.php?rtn_page=" . $login_rtn_page . "';</script>";
			exit;
		}
	}


	//회원로그인체크
	function mem_login_check() {
		if($_SERVER["QUERY_STRING"]) $login_rtn_page = urlencode($_SERVER["PHP_SELF"] . "?" . $_SERVER["QUERY_STRING"]);
		else $login_rtn_page = urlencode($_SERVER["PHP_SELF"]);

		if(!$_SESSION["ss_member_id"] || !$_SESSION["ss_member_idx"] ) {
			echo "<script>
						alert('로그인 후 이용해주세요.');
						location.href='/v2/member/login.php?referPage=".$login_rtn_page."';
				</script>";
			exit;
		}
	}

	//모바일회원로그인체크
	function mem_login_check_m() {
		if($_SERVER[QUERY_STRING]) $login_rtn_page = urlencode($_SERVER[PHP_SELF] . "?" . $_SERVER[QUERY_STRING]);
		else $login_rtn_page = urlencode($_SERVER[PHP_SELF]);

		if(!$_SESSION["ss_mem_id"] || !$_SESSION["ss_mem_idx"] ) {
			echo "<script>
						alert('로그인 후 이용해주세요.');
						location.href='/m/member/login.php?referPage=".$login_rtn_page."';
				</script>";
			exit;
		}
	}

	// 회원세션 비우기.
	function destroy_session() {
		$_SESSION["ss_mem_idx"]		= "";		//회원기본키
		$_SESSION["ss_mem_id"]		= "";		//아이디
		$_SESSION["ss_mem_name"]	= "";		//이름
		$_SESSION["ss_mem_tel"]		= "";		//유선전화
		$_SESSION["ss_mem_mobile"]	= "";		//휴대전화
		$_SESSION["ss_mem_email"]	= "";		// 회원구분 1=일반, 2=기업
	}
/* 로그인체크 함수 --> */

### test ip 
function testip()
{
	if($_SERVER['REMOTE_ADDR'] == "211.51.234.144" || $_SERVER['REMOTE_ADDR'] == "124.111.40.93" || $_SERVER['REMOTE_ADDR'] == "124.111.40.94"){
		return 1;
	}
	//return 0;
	return 1;
}

### 디버그 함수
function wd($data)
{
	if($_SERVER['REMOTE_ADDR'] == "211.51.234.144" || $_SERVER['REMOTE_ADDR'] == "1.234.136.60" || $_SERVER['REMOTE_ADDR'] == "211.51.234.144"){
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
	}
}

### 디버그 함수
function wde($data)
{
	if($_SERVER['REMOTE_ADDR'] == "211.51.234.144" || $_SERVER['REMOTE_ADDR'] == "1.234.136.60" || $_SERVER['REMOTE_ADDR'] == "211.51.234.144"){
		print "<xmp style=\"display:block;font:9pt 'Bitstream Vera Sans Mono, Courier New';background:#202020;color:#D2FFD2;padding:10px;margin:5px;\">";
		print_r($data);
		print "</xmp>";
	}
	echo exit;
}


/*******************************************************************************
SMS 발송
*******************************************************************************/
function SendSMS($from_num, $to_num, $message, $msg_type, $ps_code ) {
	//SendSMS(발송번호, 수신번호, 메세지, 메세지 타입, 단체/개인 )

	//$from_num = "0232115011";		//임시 입력.
	$from_num = "0647548345";

	$sms_site_id	= "getcoding";

	$sms_sql		= "";
	$sms_log_sql	= "";

	$from_num = str_replace("-","",$from_num);
	$to_num = str_replace("-","",$to_num);
	//$to_num = "01062507943";

	$sms_sql .= "INSERT INTO em_tran( tran_phone, tran_callback, tran_status, tran_date, tran_msg, tran_id, tran_etc1, tran_etc2 , tran_etc3 )  values  ";
	$sms_sql .= "  ('".$to_num."'";
	$sms_sql .= ", '".$from_num."'";
	$sms_sql .= ", '1'";
	$sms_sql .= ", sysdate() ";
	$sms_sql .= ", '".$message."'";
	$sms_sql .= ", '".$sms_site_id."'";
	$sms_sql .= ", '".$msg_type."'";
	$sms_sql .= ", '".$_SERVER['REMOTE_ADDR']."'";
	$sms_sql .= ", '".$ps_code."'";
	$sms_sql .= ") ";

	//echo $sms_sql;
	//exit;

	$SMSDbcon=mysql_connect("1.234.27.149","sms_emma","niceduri") or die("데이터베이스 연결에 실패하였습니다.");
	mysql_select_db("sms_emma",$SMSDbcon);
	mysql_query($sms_sql,$SMSDbcon);

//	mysql_close($SMSDbcon);
}

/*
	파일 수정폼.
*/
function FileModiFiyForm($fileSrvNM , $fileUsrNM , $Name , $mode){
	if( $fileSrvNM != "" && $fileSrvNM != ""){
		echo "<input type='file'  name='".$Name."' style='height:25px;padding:0 0 0 0;' /></br>";
		echo "<label><input type='checkbox' value='Y' name='".$Name."_del' style='border:0;'/>삭제시 체크</label>";
		echo "<input type='hidden' value='".$fileSrvNM."' name='".$Name."_srv_org' />";
		echo "<input type='hidden' value='".$fileUsrNM."' name='".$Name."_usr_org' />";
		echo "<a href='/_include/download_file.php?FILE_INFO=".$mode."|".$fileSrvNM."|".$fileUsrNM ."'>[".$fileUsrNM."]</a>";
	}else{
		echo "<p><input type='file'  name='".$Name."' style='height:25px;padding:0 0 0 0;' /></p>";
	}
}

/*
	파입업로드.
	(업로드경로, 용량제한, tag이름, 삭제할파일, 재생성할 파일명, 파일 타입제한 형식제한)
*/
function UploadFile($FileSaveDir, $MaxUploadMaga, $FormFieldName, $DeleteFile, $RenameFile, $filType) {
	echo "<font size=2 color=red>";																				//에러메시지 빨간색으로 보여주기 위해
	if(!is_dir($FileSaveDir)) {																					//디렉토리 존재  확인
		if(!mkdir($FileSaveDir,0777)){
			ErrorBack("파일을 저장할 디렉토리 만들기에 실패하였습니다.");
		}
	}
	if ($_FILES[$FormFieldName]['size'] > 0) {																	// 4.1.0 이전의 $_FILES 대신에 $HTTP_POST_FILES를 사용, 업로드 되었을경우
		$MaxFileSize=1024 * 1024 * $MaxUploadMaga;																//업로드 최대 사이즈 설정하기(MB)
		$TargetFileName = $_FILES[$FormFieldName]['name'];
		$TargetFileName = preg_replace("/[ #\&\+\-%@=\/\\\:;,\'\"\^`~\_|\!\?\*$#<>()\[\]\{\}]/i","", trim($TargetFileName));
		$UpFileName = explode(".", $TargetFileName);
		$UpFileType =  strtolower($UpFileName[count($UpFileName) - 1]);

		if ($RenameFile != "" && $RenameFile != "rand") {
			$TargetFileName = $RenameFile;																		//원하는 이름을 파일이름 재설정.".".$UpFileType
		}else if($RenameFile == "rand"){
			$TargetFileName = date("ymd").str_pad(mt_rand(0,999) , "3" , "0", STR_PAD_LEFT).".".$UpFileType;  
		}else {
			$i = 0;
			while(file_exists("$FileSaveDir/$TargetFileName")) {
				$TargetFileName = $UpFileName[0]."[".$i++."].".$UpFileType;										//동일 파일명 처리 : 기존파일명(숫자).확장자
			}
		}

		if(preg_match("/^(php|html|php3|html|htm|asp|jsp|phtml|cgi|jhtml|exe)$/i",$UpFileType))	{				//파일 타입제한 형식제한
			ErrorBack("업로드 할수 없는 파일 형식입니다. 업로드에 실패 하였습니다.");
		}  else {

			if($filType == "img"){																				//파일 타입제한 형식제한(img)	20161014 추가
				if(preg_match("/^(jpg|gif|png)$/i",$UpFileType)){
				}else{
					ErrorBack("업로드 할수 없는 파일 형식입니다. jpg, gif, png 파일 형식이 업로드 가능합니다.");
				}
			}

			if($MaxFileSize < $_FILES[$FormFieldName]['size'])	{
				ErrorBack("파일 업로드 용량을 초과했습니다. 최대 업로드 용량은 ".$MaxUploadMaga."MB입니다.");
			} else {
				if (@move_uploaded_file($_FILES[$FormFieldName]['tmp_name'], "$FileSaveDir/$TargetFileName")) {	//업로드된파일 옴기기
					chmod("$FileSaveDir/$TargetFileName",0757);

					if ($DeleteFile != "" ) {																	// 삭제될 파일명이 있을 경우
						if ($DeleteFile != $TargetFileName) {													//지울파일과 업로드한 파일이 같지 않을 경우
							if (file_exists("$FileSaveDir/$DeleteFile")) {
								unlink("$FileSaveDir/$DeleteFile");												//이전 파일 삭제(파일 수정시 이전파일명)
							}
						}
					}
					echo "</font>";																				//빨간색 폰트 닫음
					return $TargetFileName;																		//업로드된 파일명 반환
				} else {
					echo  ">>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
					echo "</font>";																				//빨간색 폰트 닫음
					return $DeleteFile;																			//삭제될 파일명 반환(파일 수정시 이전파일명)
				}
			}
		}
	} else {																									//php.ini 설정 상태로 인하여 업로드 실패하였을 경우
																												//(upload_tmp_dir, file_uploads,post_max_size, upload_max_filesize,max_execution_time)
		echo "</font>";																						    //빨간색 폰트 닫음
		return $DeleteFile;																						//삭제될 파일명 반환(파일 수정시 이전파일명)
	}
}


// 멀티 파일 업로드
function attach_file($form_name, $upload_folder) {
	$file_info = array();
	for($i = 0; $i < count($_FILES[$form_name]); $i++) {	
		if($_FILES[$form_name][name][$i] && $_FILES[$form_name][size][$i]) {
			$file_ext = strtolower(substr(strrchr($_FILES[$form_name][name][$i], "."), 1));
			$file_name = $_FILES[$form_name][name][$i];
			$file_path = date("YmdHis")."_".$i.".".$file_ext;
			$file_upload_path = $upload_folder ."/". $file_path;
		
			if(is_uploaded_file($_FILES[$form_name][tmp_name][$i])) {
				move_uploaded_file($_FILES[$form_name][tmp_name][$i], $file_upload_path);
				chmod($file_upload_path, 0777);
			} else {
				echo  "<font size=2 color=red> >>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
				echo "</font>";																						    	//빨간색 폰트 닫음
				return;
			}
			$file_info[$i][srv] = $file_path;
			$file_info[$i][usr] = $file_name;
		}
	}	
	return $file_info;
}

function attach_file_singel($form_name, $upload_folder) {
	$file_info = array();
	if($_FILES[$form_name]["name"]) {
		
		$file_name = $_FILES[$form_name]["name"];
		$file_ext = strtolower(substr(strrchr($_FILES[$form_name]["name"], "."), 1));
					
		$file_path = date("YmdHis").str_pad(mt_rand(1,9999) , 4 , 0 , STR_PAD_LEFT).".".$file_ext;
		$file_upload_path = $upload_folder ."/". $file_path;

		if(preg_match("/(php|html|php3|html|htm|asp|jsp|phtml|cgi|jhtml|exe)/i",$file_ext))	{								//파일 타입제한 형식제한
			echo " >>>>>>>>>>>업로드 할수 없는 파일 형식입니다. 업로드에 실패 하였습니다.<<<<<<<<<<<<<br>";
			echo "</font>";																								    //빨간색 폰트 닫음
			return;
		}
		
		if(is_uploaded_file($_FILES[$form_name]["tmp_name"])) {
			if(@move_uploaded_file($_FILES[$form_name]["tmp_name"], $file_upload_path)) {  //업로드된파일 옴기기
			 chmod($file_upload_path,0777);
			} else {
				echo  "<font size=2 color=red> >>>>>>>>>>임시 파일을 파일 저장 디렉토리로 옮기는 과정의 에러가 발생하여 업로드에 실패하였습니다.<<<<<<<<<<<<<br>";
				echo "</font>";																						    	//빨간색 폰트 닫음
				return;
			}
		}
		$file_image["srv"] = $file_path;
		$file_image["usr"] = $file_name;
		$file_image["size"] = $_FILES[$form_name]["size"];
	}		
	return $file_image;
}

?>