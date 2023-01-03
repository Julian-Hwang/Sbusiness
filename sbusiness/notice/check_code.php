<?php

session_start();
include("../_inc/db.php");

    if($_SESSION['capt']==$_POST['captcha']){
        $email_array=array($_POST['email1'],$_POST['email2']);
        $email=implode("@",$email_array);
        $sql="insert into KPC_INQUIRY(INQ_WRITER,INQ_WRITEDATE,INQ_EMAIL,INQ_TITLE,INQ_CONT) value('{$_POST['author']}',NOW(),'$email','{$_POST['title']}','{$_POST['contents']}')";
        $result=mysqli_query($dbconn,$sql);
        echo "success";
    }else {
        echo "error";
    }

?>
