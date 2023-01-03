<?php
include('include/db.php');
include('include/inc.php');
login_check();
session_start();

$fileName = $_REQUEST['file_id'];
$query = "SELECT LOGO_ID FROM KPC_ACHIEVE WHERE LOGO_ID = ?";
$stmt = mysqli_prepare($dbconn, $query);

$bind = mysqli_stmt_bind_param($stmt, "s", $fileName);
$exec = mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name_save = $row['LOGO_ID'];

$fileDir = "./_upload/achieve_image";
$fullPath = $fileDir."/".$name_save;
$length = filesize($fullPath);

header("Content-Type: application/octet-stream");
header("Content-Length: $length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$name_save));
header("Content-Transfer-Encoding: binary");

$fh = fopen($fullPath, "r");
fpassthru($fh);

mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($dbconn);

exit;
?>
