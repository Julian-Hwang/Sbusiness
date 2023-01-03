<?php
include('include/db.php');
include('include/inc.php');
login_check();
session_start();

$fileName = $_REQUEST['file_id'];
$query = "SELECT FILE_ID, SRV_FILE_NAME, USR_FILE_NAME FROM KPC_FILE WHERE FILE_ID = ?";
$stmt = mysqli_prepare($dbconn, $query);

$bind = mysqli_stmt_bind_param($stmt, "s", $fileName);
$exec = mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);

$name_orig = $row['USR_FILE_NAME'];
$name_save = $row['SRV_FILE_NAME'];

$fileDir = "./_upload";
$fullPath = $fileDir."/".$name_save;
$length = filesize($fullPath);

header("Content-Type: application/octet-stream");
header("Content-Length: $length");
header("Content-Disposition: attachment; filename=".iconv('utf-8','euc-kr',$name_orig));
header("Content-Transfer-Encoding: binary");

$fh = fopen($fullPath, "r");
fpassthru($fh);

mysqli_free_result($result);
mysqli_stmt_close($stmt);
mysqli_close($dbconn);

exit;
?>
