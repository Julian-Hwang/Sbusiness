<?php
    include './include/db.php';
    include('./password.php');

    session_start();

    if(isset($_POST['mb_id']) && isset($_POST['mb_pw'])){

            $mb_id = mysqli_real_escape_string($dbconn, $_POST['mb_id']);
            $mb_pw = mysqli_real_escape_string($dbconn, $_POST['mb_pw']);
        
            $sql = "SELECT * FROM KPC_MEMBER WHERE MEM_ID = '$mb_id' AND USE_YN = 'Y' AND DEL_YN = 'N'";
            $result = mysqli_query($dbconn,$sql);
    
    
            if(mysqli_num_rows($result) === 1){
                $row = mysqli_fetch_assoc($result);
                
                if(password_verify($mb_pw,$row['MEM_PW'])){
                    $_SESSION['mb_id'] = $row['MEM_ID'];
                    $_SESSION['mb_name'] = $row['MEM_NAME'];
                    $_SESSION['mb_idx'] = $row['IDX'];
                    echo header("location:./admin_list.php");
                } else {
                    echo "<script> alert('패스워드가 일치하지 않습니다.'); location.href='./admin_login.php';</script>";
                }
        
            } else {
                echo "<script> alert('아이디가 일치하지 않습니다.'); location.href='./admin_login.php';</script>";
            }
    } else {
        echo "<script> alert('알 수 없는 에러.'); location.href='./admin_login.php';</script>";
    }
    ?>

