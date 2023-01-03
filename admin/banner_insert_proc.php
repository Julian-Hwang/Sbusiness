<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];
    if($_FILES["image1"]["name"]){
        $imageFullname = strtolower($_FILES["image1"]["name"]);
        $imageNameSlice = explode(".",$imageFullname);
        $imageName = $imageNameSlice[0];
        $imageType = $imageNameSlice[1];
        $image_ext = array('jpg','jpeg','gif','png');
        if(array_search($imageType, $image_ext) === false){
            echo "<script> alert('jpg, jpeg, gif, png 확장자만 가능합니다.'); history.back();</script>";
        }
        $newImage = $imageName.".".$imageType;
        $dir="_upload/banner_image/pc/";
        move_uploaded_file($_FILES['image1']['tmp_name'],$dir.$newImage);
        chmod($dir.$newImage,0777);
    }
    if($_POST['position']=='up'){
        if($_FILES["image2"]["name"]){
            $imageFullname = strtolower($_FILES["image2"]["name"]);
            $imageNameSlice = explode(".",$imageFullname);
            $imageName = $imageNameSlice[0];
            $imageType = $imageNameSlice[1];
            $image_ext = array('jpg','jpeg','gif','png');
            if(array_search($imageType, $image_ext) === false){
                echo "<script> alert('jpg, jpeg, gif, png 확장자만 가능합니다.'); history.back();</script>";
            }
            $newImageM = $imageName.".".$imageType;
            $dir="_upload/banner_image/mo/";
            move_uploaded_file($_FILES['image2']['tmp_name'],$dir.$newImageM);
            chmod($dir.$newImageM,0777);
        }
    }

    $url = $_POST['url'];
    if(substr($url,0,4) == 'http'){
        $url = $_POST['url'];
    } else {
        $url = 'http://'.$_POST['url'];
    }

    $sql="INSERT INTO KPC_BANNER
            (BAN_POSITION,BAN_TITLE,BAN_LINK,FILE_ID,FILE_ID_M,REG_ID, REG_DATE,USE_YN)
            VALUE(
                '{$_POST['position']}',
                '{$_POST['title']}',
                '{$url}',
                '{$newImage}',
                '{$newImageM}',
                '".$member_id."',
                NOW(),
                '{$_POST['state']}'
            )";

    $result=mysqli_query($dbconn,$sql);

    if($result ==true){
        echo "<script> alert('등록되었습니다.'); location.href='banner_admin.php';</script>";
    } else{
         echo "<script> alert('다시 작성 해주세요.'); history.back();</script>";
    }
?>