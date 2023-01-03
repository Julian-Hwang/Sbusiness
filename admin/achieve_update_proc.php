<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];

    if($_FILES["file1"]["name"] ){
        $imageFullname = strtolower($_FILES["file1"]["name"]);
        $imageNameSlice = explode(".",$imageFullname);
        $imageName = $imageNameSlice[0];
        $imageType = $imageNameSlice[1];
        $image_ext = array('jpg','jpeg','gif','png');
        if(array_search($imageType, $image_ext) === false){
            echo "<script> alert('jpg, jpeg, gif, png 확장자만 가능합니다.'); history.back();</script>";
        }
        $newImage = $imageName.".".$imageType;
        $dir="_upload/achieve_image/";
        move_uploaded_file($_FILES['file1']['tmp_name'],$dir.$newImage);
        chmod($dir.$newImage,0777);
    } else{
        $newImage=$_POST['exists_image'];
    }

    if(isset($_POST['type'])){
        $var = $_POST['type'];
        switch($var){
            case 'A':
                $type="온라인진출지원";
                break;
            case 'B':
                $type="경영환경개선";
                break;
            default:
                break;
        }
    }

    $sql="
        UPDATE KPC_ACHIEVE
            SET 
                LOGO_ID='{$newImage}',
                ACHIEVE_NAME='{$_POST['name']}',
                ACHIEVE_LINK='{$_POST['link']}',
                ACHIEVE_TYPE_CD='{$_POST['type']}',
                ACHIEVE_TYPE='{$type}',
                MOD_ID='".$member_id."',
                MOD_DATE=NOW(),
                USE_YN='{$_POST['state']}'
            WHERE
                IDX='{$_POST["idx"]}'
        ";

    $result=mysqli_query($dbconn,$sql);

    if($result ==true){
        echo "<script> alert('처리되었습니다.'); location.href='achieve_sort.php';</script>";
    } else{
        echo "<script> alert('처리를 다시 해주세요.'); history.back();</script>";
    }

?>