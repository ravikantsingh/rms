<?php 
if(!isset($_SESSION)) session_start();
$ip='';
if(isset($_SERVER['REMOTE_ADDR'])) $ip=$_SERVER['REMOTE_ADDR'];
if (!isset($_SESSION['fingerprint']) || $_SESSION['fingerprint'] != md5($_SERVER['HTTP_USER_AGENT'] . PHRASE .$ip)) {       
    session_destroy();
	if(!isset($_SESSION)) session_start();
	$_SESSION['sessionExpired']=true;
    header('Location: '.HOST.'cpadmin/');
    exit();     
}
if (!isset($_SESSION['auth']) || $_SESSION['auth']!='admin') {       
    session_destroy();
	if(!isset($_SESSION)) session_start();
	$_SESSION['sessionExpired']=true;
    header('Location: '.HOST.'cpadmin/');
    exit();     
}
?>
