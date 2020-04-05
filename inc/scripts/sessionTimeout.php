<?php
if(!isset($_SESSION)) session_start();
if ($_SESSION['timeout'] + 100* 60 < time() ){
	$auth = ( isset( $_SESSION['auth'] ) ) ? $_SESSION['auth'] : '';
	if(isset($_SESSION)) session_destroy();
	if(!isset($_SESSION)) session_start();
	$_SESSION['sessionExpired']=true;
	if( $auth==='backOffice'){
	    header('location:'.HOST.'backOffice/');
    	exit();
	}
	header('location:'.HOST);
	exit();
}

else{
	$_SESSION['timeout']=time();
}

?>