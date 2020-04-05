<?php
/////////////includes////////////////////////////////////
include_once('../inc/scripts/config.php');
include_once('../inc/scripts/functions.php');
include_once('../inc/scripts/filteration.php');
include_once('./inc/cookHeader.php');
include_once('../inc/scripts/sessionTimeout.php');
/////////////////////////////////////////////////////////
$username=(isset($_SESSION['user']))?$_SESSION['user']:'';
$sql=$dbh->prepare("SELECT * FROM `user_log` WHERE `username`= ? ");
	$run=$sql->execute(array($username));
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if($count==1){
	    foreach( $result as $key => $value ){
	        $$key = $value;
	    }
		$option='';
		if(isset($_GET['option'])) $option=$_GET['option'];
		include_once('./inc/dashboard.php');
	}
?>
