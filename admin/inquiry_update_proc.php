<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];

    if($_POST['state']==3){
        $sql="
            UPDATE KPC_INQUIRY 
                SET 
                    INQ_STATE='{$_POST['state']}',
                    INQ_PROC_ID='".$member_id."',
                    DEL_YN='{$_POST['del']}',
                    INQ_PROC_DATE=NOW()
                WHERE
                    IDX='{$_POST["idx"]}'
            ";
    }
    else{
        $sql="
            UPDATE KPC_INQUIRY 
                SET 
                    INQ_STATE='{$_POST['state']}',
                    INQ_PROC_ID='".$member_id."',
                    DEL_YN='{$_POST['del']}'
                WHERE
                    IDX='{$_POST["idx"]}'
            ";
    }
    $result=mysqli_query($dbconn,$sql);

    if($result ==true){
        echo "<script> alert('처리되었습니다.'); location.href='inquiry_admin.php';</script>";
    } else{
        echo "<script> alert('처리를 다시 해주세요.'); history.back();</script>";
    }

?>