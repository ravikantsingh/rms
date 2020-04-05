<?php
require('../inc/scripts/config.php');
require('../inc/scripts/functions.php');

function token($dbh){
$token=0;
$date=date("ymd");
$date.='%';
    $sql=$dbh->prepare("SELECT `token` FROM `order_details` WHERE `token` LIKE ? ORDER BY `token` DESC LIMIT 0,1");
	$run=$sql->execute( array( $date ) );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$token= $result['token'];
		$token++;
    }
    else
    {
        $token=date("ymd").'0001';
    }
    
   return $token;
}
//echo token($dbh);

function preTime($dbh){
    $oc=0;
	$timing=20;
	$sql=$dbh->prepare("SELECT `order_id` FROM `order_details` WHERE `status`='1' AND `canceled`='0' AND `date`>='".date('Y-m-d 00:00:00')."'");
	$run=$sql->execute( array( $date ) );
	$result= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$oc=$count;
    }
	if($oc<=4)
	$timing=$timing;
	else if($oc<=6)
	$timing+=5;
	else if($oc<=8)
	$timing+=10;
	else if($oc<=10)
	$timing+=15;
	else if($oc<=12)
	$timing+=20;
	else if($oc<=14)
	$timing+=25;
	else if($oc<=16)
	$timing+=30;
	else if($oc<=18)
	$timing+=35;
	else if($oc<=20)
	$timing+=40;
	else if($oc<=22)
	$timing+=45;
	else if($oc<=24)
	$timing+=50;
	else if($oc<=26)
	$timing+=55;
	else if($oc<=28)
	$timing+=60;
	else if($oc<=30)
	$timing+=65;
	
	return $timing;
}
echo preTime($dbh);
?>