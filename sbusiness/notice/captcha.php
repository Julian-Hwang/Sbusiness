<?php

    /* 자동가입방지 문자*/
	session_start();
	$_SESSION['capt'] = "";

	$captcha = '';

	/*패턴*/
	$patten = '123456789QWEERTYUIOPASZDFGHJKLZMXNCBVqpwoeirutyalskdjfhgzmxncbv'; //패턴 설정
	for($i = 0, $len = strlen($patten) -1; $i < 5; $i++){ //5가지 문자 생성
		$captcha .= $patten[rand(0, $len)];
	}
	
	$img = imagecreatetruecolor(60, 20); //크기
	imagefilledrectangle($img, 0,0,100,100,0xffffff); // 배경색
	imagestring($img, 4, 2, 2, $captcha, 0x000000); //문자 여백, 문자색상
	imagegif($img);
	imagedestroy($img);

    header('Content-Type: image/jpeg');
    $_SESSION['capt'] = $captcha;
?>