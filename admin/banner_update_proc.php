<?php
    session_start();

    include("include/db.php");
    include('include/inc.php');
    login_check();

    $member_id = $_SESSION['mb_id'];

    if($_FILES["image1"]["name"] ){
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
    } else{
        $newImage=$_POST['exists_image'];
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
        }else{
            $newImageM=$_POST['exists_imageM'];
        }
    }

    //link url 앞에 http없으면 추가해주기
    $url = $_POST['url'];
    if(substr($url,0,4) == 'http'){
        $url = $_POST['url'];
    } else {
        $url = 'http://'.$_POST['url'];
    }

    $sql="
        UPDATE KPC_BANNER
            SET 
                BAN_POSITION='{$_POST['position']}',
                BAN_TITLE='{$_POST['title']}',
                BAN_LINK='{$url}',
                FILE_ID='{$newImage}',
                FILE_ID_M='{$newImageM}',
                MOD_ID='".$member_id."',
                MOD_DATE=NOW(),
                USE_YN='{$_POST['state']}'
            WHERE
                IDX='{$_POST["idx"]}'
        ";

    $result=mysqli_query($dbconn,$sql);

    if($result ==true){
        echo "<script> alert('처리되었습니다.'); location.href='banner_admin.php';</script>";
    } else{
        echo "<script> alert('처리를 다시 해주세요.'); history.back();</script>";
    }

?>