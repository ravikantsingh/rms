<?php
if(isset($_POST['username']) && isset($_POST['password'])){
	$password=$_POST['password'];
	$username=$_POST['username'];
	adminLogin($dbh,$username,$password);
}
?>