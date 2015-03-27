<?php 

include('JLCap.php');


if($_GET['code']){
	$code = $_GET['code'];
}

//if not exists $_GET, $code IS false(random).   
$captcha = new JLCap($code);//Alternative for random:    $captcha = new JLCap();

//CHANGE TEXT
//$captcha->captchacode = 'sdsd';

//TEXT SIZE
//$captcha->size = 5;

//RGB COLOR FONT
//$captcha->rgbcolor = array(255,0,0);

//BACKGROUND IMAGE
//$captcha->loadImageBackground('confuse');

$captcha->captchaShow();


?>