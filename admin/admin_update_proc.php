<?php
    include('include/inc.php');
    include('include/db.php');

    login_check();

    if($_GET['mode'] == "update"){//수정
        if(!$_POST["mb_pw"] && !$_POST["mb_pw_check"]){//비밀번호 외 다른 정보 수정
            $sql="
            UPDATE KPC_MEMBER
                SET 
                    MEM_ID='{$_POST['mb_id']}',
                    MEM_NAME='{$_POST['mb_name']}',
                    MEM_TEL='{$_POST['mb_tel']}',
                    USE_YN='{$_POST['state']}'
                WHERE
                    IDX='{$_POST["idx"]}'
            ";
            $result=mysqli_query($dbconn,$sql);

            if($result == true){
                echo "<script> alert('처리되었습니다.'); location.href='admin_list.php';</script>";
            } else{
                echo "<script> alert('처리를 다시 해주세요.'); location.href='admin_list.php';</script>";
            }
        }
        else if($_POST["mb_pw"] && !$_POST["mb_pw_check"]){//첫번째 비밀번호만 입력
            echo "<script> alert('비밀번호를 제대로 입력해 주세요.'); history.back();</script>";
        }
        else if(!$_POST["mb_pw"] && $_POST["mb_pw_check"]){//비밀번호 확인만 입력
            echo "<script> alert('비밀번호를 제대로 입력해 주세요.'); history.back();</script>";
        }
        else if($_POST["mb_pw"] && $_POST["mb_pw_check"]){//비밀번호 둘 다 입력 

            if($_POST["mb_pw"] != $_POST["mb_pw_check"]){//불일치
                echo "<script> alert('비밀번호를 제대로 입력해 주세요.'); history.back();</script>";
            }
            else if($_POST["mb_pw"] == $_POST["mb_pw_check"]){//일치
                include('./password.php');

                $hashed = password_hash($_POST["mb_pw"], PASSWORD_DEFAULT);
                $sql = "UPDATE KPC_MEMBER SET MEM_PW = '$hashed' WHERE IDX='{$_POST["idx"]}'";
                $result = mysqli_query($dbconn,$sql);

                if($result == true){
                    echo "<script> alert('처리되었습니다.'); location.href='admin_list.php';</script>";
                } else{
                    echo "<script> alert('처리를 다시 해주세요.'); location.href='admin_list.php';</script>";
                }
            }
        }
        
    }else{//삭제
        $sql="
        UPDATE KPC_MEMBER
        SET 
            USE_YN = 'N',
            DEL_YN = 'Y'
        WHERE
            IDX='{$_GET['idx']}';
        ";

        $result=mysqli_query($dbconn,$sql);

        if($result == true){
            echo "<script> alert('처리되었습니다.'); location.href='admin_list.php';</script>";
        } else{
            echo "<script> alert('처리를 다시 해주세요.'); location.href='admin_list.php';</script>";
        }
    }

?>