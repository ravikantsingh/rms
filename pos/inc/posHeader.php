<?php
if(!isset($_SESSION)) session_start();
if (!isset($_SESSION['fingerprint']) || $_SESSION['fingerprint'] != md5($_SERVER['HTTP_USER_AGENT'] . PHRASE. 'pos' )) {
	session_destroy();
	header('Location: '.HOST);    

}
