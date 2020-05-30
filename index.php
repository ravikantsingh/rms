<?php

///include Files/////////////////////////
include_once('./inc/scripts/config.php');
include_once('./inc/scripts/functions.php');
////////////Filteration /////////////////
include_once('./inc/scripts/filteration.php');
/////End of Include Files////////////////
if( !isset( $_SESSION )) session_start();
if( isset( $_SESSION['msg'] ) ){
  $msg = $_SESSION['msg'];
  $msgStatus = ( isset($_SESSION['msg-status']) ) ? $_SESSION['msg-status'] : 'error';
  unset( $_SESSION['msg'] );
  unset( $_SESSION['msg-status'] );
}
///////////////////////////////////////
$date=date('Y-m-d H:i:s');

$option = (isset($_GET['option']) && !empty($_GET['option'])) ? trimSpecialCharacters(trim($_GET['option'])) : 'login';

/////////////////////////////////////////
switch ($option) {
    case 'logout':

    session_destroy() ;
    require_once( './login.html' );
    break;

  case 'login':
  default:
    include_once('./inc/scripts/login.php');
    require_once( './login.html' );
    break;
}
