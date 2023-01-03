<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];

    $sql1="
        INSERT INTO KPC_NOTICE
        (NOT_TITLE, NOT_CONTENT,REG_ID,REG_DATE,NOTICE_YN,DEL_YN)
        VALUE(
            '{$_POST['title']}',
            '{$_POST['contents']}',
            '".$member_id."',
            NOW(),
            '{$_POST['state']}',
            'N'
        )
    ";
    $result1=mysqli_query($dbconn,$sql1);

    $idx="select IDX from KPC_NOTICE where NOT_TITLE = '{$_POST['title']}' and REG_ID = '".$member_id."'";

    $dir = "./_upload/";
    $ext_str = "hwp,xls,doc,xlsx,docx,pdf,jpg,gif,png,txt,ppt,pptx";
    $allowed_extensions = explode(',', $ext_str);
    $max_file_size = 5242880;

    for($i=1; $i<=2; $i++){
        if($_FILES["file$i"]['name']){
            $file = $_FILES["file$i"];
            $ext = substr($file['name'], strrpos($file['name'], '.') + 1);
    
            // 확장자 체크   
            if(!in_array($ext, $allowed_extensions)){
              echo "<script> alert('업로드할 수 없는 확장자 입니다.');history.back();</script>";
                exit;
            }
    
            // 파일 크기 체크   
            if($file['size'] >= $max_file_size) {
              echo "<script> alert('5MB 까지만 업로드 가능합니다.');history.back();</script>";
              exit;
            }
    
            $path = md5(microtime()) . '.' . $ext;
            if(move_uploaded_file($file['tmp_name'], $dir.$path)) {
                $query = "INSERT INTO KPC_FILE (NOT_IDX, FILE_ID, USR_FILE_NAME, SRV_FILE_NAME, REG_ID, REG_DATE, DEL_YN) VALUES(($idx),?,?,?,'".$member_id."',now(),'N')";
                $file_id = md5(uniqid(rand(), true));
                $name_orig = $file['name'];
                $name_save = $path;
                $stmt = mysqli_prepare($dbconn, $query);
                $bind = mysqli_stmt_bind_param($stmt, "sss", $file_id, $name_orig, $name_save);
                $exec = mysqli_stmt_execute($stmt);
                mysqli_stmt_close($stmt);
                
                $attIdx = "NOT_ATTACH".$i;
                $notIDX = mysqli_query($dbconn,$idx);
                $idxrow = mysqli_fetch_array($notIDX);
                $upd_query = "UPDATE KPC_NOTICE SET ".$attIdx." = '".$file_id."' WHERE IDX = '".$idxrow['IDX']."'";
                $updresult = mysqli_query($dbconn,$upd_query);
            }else {
                echo "<script> alert('파일이 업로드 실패. 잠시 후 다시 시도 해주세요.'); history.back();</script>";
                exit;
            }
        } 

    }

echo "<script> alert('입력되었습니다.'); location.href='notice_admin.php';</script>";

?>