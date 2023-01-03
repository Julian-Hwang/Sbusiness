<?php
    include('include/inc.php');
    include('include/db.php');

    login_check();

    if(!$_POST["mb_id"]){
        echo "<script> alert('아이디를 입력해 주세요.'); history.back();</script>";
    }
    else if(!$_POST["mb_pw"] || !$_POST["mb_pw_check"]){
        echo "<script> alert('비밀번호를 입력해 주세요.'); history.back();</script>";
    }
    else if($_POST["mb_pw"] != $_POST["mb_pw_check"]){//비밀번호 불일치
        echo "<script> alert('비밀번호가 불일치 합니다.'); history.back();</script>";
    }
    else if(!$_POST["mb_name"]){
        echo "<script> alert('이름을 입력해 주세요.'); history.back();</script>";
    }
    else if(!$_POST["mb_tel"]){
        echo "<script> alert('휴대폰 번호를 입력해 주세요.'); history.back();</script>";
    }
    else if($_POST["mb_pw"] == $_POST["mb_pw_check"]){//일치
        
        $sql = "SELECT MEM_ID FROM KPC_MEMBER WHERE DEL_YN ='N'";
        $result = mysqli_query($dbconn, $sql);
        while($row =(mysqli_fetch_array($result))) {
            if($row['MEM_ID'] == $_POST['mb_id']){
                echo "<script> alert('중복된 아이디입니다.'); history.back();</script>";
                break;
            }else{
                include('./password.php');

                $hashed = password_hash($_POST["mb_pw"], PASSWORD_DEFAULT);
        
                $sql = "INSERT INTO KPC_MEMBER
                (`MEM_ID`, `MEM_PW`, `MEM_NAME`, `MEM_TEL`, `USE_YN`, `DEL_YN`) 
                VALUES 
                ('{$_POST["mb_id"]}','$hashed','{$_POST["mb_name"]}','{$_POST["mb_tel"]}','{$_POST["state"]}','N')";
        
                $result = mysqli_query($dbconn,$sql);
        
                if($result == true){
                    echo "<script> alert('처리되었습니다.'); location.href='admin_list.php';</script>";
                } else{
                    echo "<script> alert('처리를 다시 해주세요.'); location.href='admin_list.php';</script>";
                }
            }
        }

    }
    
    // $sql = "SELECT MEM_ID FROM KPC_MEMBER WHERE DEL_YN ='N'";
    // $result = mysqli_query($dbconn, $sql);
    // while($row =(mysqli_fetch_array($result))) {
    //     if($row['MEM_ID'] == $_POST['mb_id']){
    //         echo "<script> alert('중복된 아이디입니다.'); history.back();</script>";
    //     }
    // }

        

?>