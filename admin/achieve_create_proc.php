<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];
    if($_FILES["file1"]["name"]){
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

    $sort="SELECT MAX(ACHIEVE_SORT)+1 FROM KPC_ACHIEVE WHERE ACHIEVE_TYPE_CD='{$_POST['type']}'";

    $sql="INSERT INTO KPC_ACHIEVE
            (LOGO_ID,ACHIEVE_NAME,ACHIEVE_LINK,ACHIEVE_TYPE_CD,ACHIEVE_TYPE,ACHIEVE_SORT,REG_ID, REG_DATE,USE_YN)
            VALUE(
                '{$newImage}',
                '{$_POST['name']}',
                '{$_POST['link']}',
                '{$_POST['type']}',
                '{$type}',
                (SELECT MAX(ACHIEVE_SORT)+1 FROM KPC_ACHIEVE KA WHERE ACHIEVE_TYPE_CD='{$_POST['type']}'),
                '".$member_id."',
                NOW(),
                '{$_POST['state']}'
            )";
    $result=mysqli_query($dbconn,$sql);

    if($result ==true){
        echo "<script> alert('등록되었습니다.'); location.href='achieve_sort.php';</script>";
    } else{
         echo "<script> alert('다시 작성 해주세요.'); history.back();</script>";
    }
?>