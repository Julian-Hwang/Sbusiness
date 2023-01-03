<?
include_once "../__RootDIR__.php";
include_once $RootDIR."/_inc/_header.php";


$DownInfo = $_REQUEST["FILE_INFO"];

$ARR_FILE_INFO = explode("|",$DownInfo);
if (count($ARR_FILE_INFO) != "3") {
	echo "<script>alert('입력이 올바르지 않습니다.');history.go(-1);</script>";
	exit;
}


$file_path = $ADMIN_IMG_DIR."".$ARR_FILE_INFO[0];
$file_name = $ARR_FILE_INFO[1];
$file_name_usr = $ARR_FILE_INFO[2];


if($file_name && $file_path) {
	if(file_exists($file_path."/".$file_name)) {
		header("Content-Type: doesn/matter");
		header("content-length: ". filesize($file_path."/".$file_name));
		header("Content-Disposition: attachment; filename=$file_name_usr");
		header("Content-Transfer-Encoding: binary");
		header("Pragma: no-cache");
		header("Expires: 0");

		if(is_file($file_path."/".$file_name)) {
			$fp = fopen($file_path."/".$file_name, "r");
		
			if(!fpassthru($fp)) {
				fclose($fp);
			}
		}
	}
	else {
		echo "<script>alert('파일이 존재하지 않습니다.');history.go(-1);</script>";
	}
}
else {
	echo "<script>alert('파일이 존재하지 않습니다.');history.go(-1);</script>";
}


?>