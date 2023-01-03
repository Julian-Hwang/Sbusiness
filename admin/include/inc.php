<?php
  ini_set( 'display_errors', '0' );
  session_start();

  //회원로그인체크
    $isLogin = FALSE;
    function login_check(){
        if( !$_SESSION["mb_id"] || !$_SESSION["mb_name"] ) {
            echo "<script> alert('로그인 후 이용해주세요.'); location.href='./admin_login.php'; </script>";
            exit;
        } else $isLogin = TRUE;
    }

?>