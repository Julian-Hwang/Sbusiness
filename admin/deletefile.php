<?php
    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];
    $fileId = $_GET['file_id'];
    $num = $_GET['num'];
    // $sql="UPDATE KPC_FILE
    //         SET
    //             MOD_ID='".$member_id."',
    //             MOD_DATE=NOW(),
    //             DEL_YN='Y'
    //         WHERE
    //             FILE_ID='".$fileId."';
    //     ";
    $sql="UPDATE KPC_NOTICE
            SET
                NOT_ATTACH".$num." = '',
                MOD_ID='".$member_id."',
                MOD_DATE=NOW()
            WHERE
                NOT_ATTACH".$num." = '".$fileId."'
        ";
    $result=mysqli_query($dbconn, $sql);
    if($result === false) {
        echo "<script> alert('파일삭제를 실패했습니다.'); history.back();</script>";
    } else {
        echo "<script> alert('파일삭제가 완료되었습니다.'); history.back();</script>";
    }
?>