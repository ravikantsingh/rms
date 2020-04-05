<?php
if(isset( $username ) && isset($password) ){
  	$msg = login( $dbh, $username, $password );
}
