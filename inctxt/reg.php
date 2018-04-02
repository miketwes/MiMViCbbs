<?php
$livereg = false;

$errmsg_arr = array();
$errflag = false;
if(isSet($_POST['username']))
{
$u = trim($_POST['username']);
}
if(isSet($_POST['password1']))
{
$pwd = trim($_POST['password1']);
}
if(isSet($_POST['password2']))
{
$pwd1 = trim($_POST['password2']);
}
if(isSet($_POST['email']))
{
$eml = trim($_POST['email']);
}
if(isSet($_POST['code']))
{
$code = $_POST['code'];
if ($code != $_SESSION["vercode"] OR $_SESSION["vercode"]=='')  { 
  $errmsg_arr[] = 'The numbers you entered not match the number verification. Please try again. ';
  $errflag = true;
}
}
if(!$u || !$pwd || !$pwd1 || !$eml  || !$code){
$errmsg_arr[] = 'all data cant be empty';
  $errflag = true;
}
    $temp_len = (strlen ( $u ) + mb_strlen ( $u, 'utf-8' )) / 2;
    if ($temp_len <= 5 || $temp_len >= 15) {
    $errmsg_arr[] = 'user 6-14 (chinese 3-7)';
  $errflag = true;
    }

        $reg = '/^[\x{4e00}-\x{9fa5}a-zA-Z0-9]+$/u'; 
        if (!preg_match ( $reg, $u )) {
  $errmsg_arr[] = 'user not match the rule';
  $errflag = true;
        } 
$len = strlen($eml);
if(!preg_match("/^\w+([-+.]\w+)*@\w+([-.]\w+)*\.\w+([-.]\w+)*$/", $eml)){
$errmsg_arr[] = 'email not meet the rule';
$errflag = true;
}
if($len<= 13 || $len >= 31){ 
$errmsg_arr[] = 'email length 13-30';
$errflag = true;
}
/*
include './style/user/ve.php';
$ve = new SmtpValidator();
$rese = $ve->validate($eml);
if($rese['valid'] == false ){
$errmsg_arr[] = 'email invalid';
$errflag = true;}
*/

$lenp = strlen($pwd);
   if($lenp <= 5 || $lenp >= 21) {
		$errmsg_arr[] = 'Password 6-20';
		$errflag = true;
	}


	if($u == '') {
		$errmsg_arr[] = 'First name missing';
		$errflag = true;
	}	
	if($pwd == '') {
		$errmsg_arr[] = 'Password missing';
		$errflag = true;
	}
	if($pwd1 == '') {
		$errmsg_arr[] = 'Confirm password missing';
		$errflag = true;
	}
	if( strcmp($pwd, $pwd1) != 0 ) {
		$errmsg_arr[] = 'Passwords do not match';
		$errflag = true;
	}
	if($u != '') {
		
		 
     $cu = $db->select("users", 'COUNT(username)', "username = ?",array($u,),1 );
     
		
		
                if ($cu > 0) {
                $errmsg_arr[] = 'username already in use';
		$errflag = true; }


}

if($errflag) {


		$_SESSION['msgtoyou'] = $errmsg_arr;
		session_write_close();
             
                header("Location: " . BASE_URL . I_N . 'msgtoyou');              
		exit();
	}

$pwd = md5($pwd);
$time = time();

  $info = array('username' => $u, 'password' => $pwd,  'email' => $eml, 'time' => $time, 'avatar' => 1, 'ip' => $ip,'act' => '');
  $db->insert('users', $info);

                $msg  = '谢您在福彩3D注册, 欢迎登陆发帖参与讨论!';
                $path = '/' . I_N . 'loginform';
                echo "<meta http-equiv='Content-Type'' content='text/html; charset=utf-8'>";
                al($msg, $path);

/*

if(!isset($activation)){$activation = md5(uniqid(rand(), true));}


  $info = array('username' => $u, 'password' => $pwd,  'email' => $eml, 'time' => $time, 'avatar' => 1, 'ip' => $ip,'act' => $activation);
  $db->insert('users', $info);


if($livereg == true ){

include 'style/user/email.php';

}else{$_SESSION['msgtoyou'] = '<p>'.$u.'</p><div><font color="green">感谢您在福彩3D注册, 欢迎发帖参与讨论, 激活码将于24小时内发至您的邮箱:' . $eml .
                    ' ,清注意查收.</font></div>';
}

 header("Location: " . BASE_URL . I_N . 'msgtoyou');       

*/
