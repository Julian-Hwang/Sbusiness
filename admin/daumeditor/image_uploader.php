<?
include('../include/adminHeader.php');
include('../include/inc.php');
include('../../_include/_Common.php');

$upload_folder = "/sbusiness/www/admin/_upload/editor/";

$file_image = attach_file_singel("image_file",$upload_folder);
$file_srv = $file_image["srv"];
$file_usr = $file_image["usr"];
$file_size = $file_image["size"];
$imageurl = "/admin/_upload/editor/".$file_srv;

//echo "upload_folder - ".$upload_folder."<br>";
//echo "file_srv - ".$file_srv."<br>";
//echo "file_usr - ".$file_usr."<br>";
//echo "file_size - ".$file_size."<br>";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Daum에디터 - 이미지 첨부</title> 
<script src="./js/popup.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="jquery.form.js"></script>
<link rel="stylesheet" href="./css/popup.css" type="text/css"  charset="utf-8"/>
<script type="text/javascript">
 function initUploader(){
     var _opener = PopupUtil.getOpener();
     if (!_opener) {
         alert('잘못된 경로로 접근하셨습니다.');
         return;
     }
     
     var _attacher = getAttacher('image', _opener);
     registerAction(_attacher);

    if (typeof(execAttach) == 'undefined') { //Virtual Function
         return;
     }
  
  var _mockdata = {
   'imageurl': '<?=$imageurl; ?>',
   'filename': '<?=$file_usr; ?>',
   'filesize': '<?=$file_size; ?>',
   'imagealign': 'C',
   'originalurl': '<?=$imageurl; ?>',
   'thumburl': '<?=$imageurl; ?>',
  };
  
  parent.execAttach(_mockdata);
  closeWindow();
 }
</script>
</head>
<body onload="initUploader();">
</body>
</html>