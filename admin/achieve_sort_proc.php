<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];
    $row_num = $_POST['row_num'];
    
    $name = $_POST['ach_name'];
    $sort = $_POST['sort'];

    foreach($sort as $key=>$val){
        $sql="
        UPDATE KPC_ACHIEVE
            SET 
                ACHIEVE_SORT='".$val."',
                MOD_ID='".$member_id."',
                MOD_DATE=NOW()
            WHERE
                ACHIEVE_NAME='".$name[$key]."'
            and
                ACHIEVE_TYPE_CD='".$_POST["ach_code"]."'
        ";
        $result=mysqli_query($dbconn,$sql);
    }
    
    if($result ==true){
        echo "<script> alert('정렬되었습니다.'); location.href='achieve_sort.php';</script>";
    } else{
        echo "<script> alert('정렬을 실패했습니다.'); history.back();</script>";
    } 

?>