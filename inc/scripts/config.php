<?php
date_default_timezone_set('Asia/Kolkata');
$local=true;
$whitelist = array(
    '127.0.0.1',
    '::1'
);

if(!in_array($_SERVER['REMOTE_ADDR'], $whitelist)){
    $local=false;
}
$root = realpath($_SERVER["DOCUMENT_ROOT"]);
$host ='localhost';

if($local){
  ini_set("display_errors", "on");
  define("HOST", "//localhost/rstm/");
  define("HOSTDIR", $root.'/rstm/');
  $port = '21';
  $user = 'root';
  $pass ='' ;
  $db = 'rstm';

}
else{
  ini_set("display_errors", "off");
  define("HOST", "http://pizzapoint.ga/");
  define("HOSTDIR", $root.'/');
  $port = '21';
  $user = 'pizzapoi_pos';
  $pass ='Beta1991@' ;
  $db = 'pizzapoi_pos';
}


define("WORKING_KEY", 'hh77675*&&65%^%KJKLJ5455454lk%$$7MMJ8');
define("OPEN_ADMIT_CARD_DATE","2019-07-17 15:35:59");
define("CLOSE_ADMIT_CARD_DATE","2019-09-30 15:35:59");
define("OPEN_COUNSELLING_DATE","2019-09-02 08:23:59");
define("CLOSE_COUNSELLING_DATE","2019-09-05 23:59:59");
define("REGISTRATION_CLOSED_DATE", "2019-08-05 23:59:59");
define("ADMISSION_FEE_CLOSE_DATE", "2019-09-05 23:59:59");
define("PHRASE", "alpha1991college");
define("OG_DESCRIPTION", "");
define("OG_IMG", '');
define("OG_TITLE", "");

try{
  $dbh = new PDO('mysql:dbname='.$db.';host='.$host, $user, $pass);
}
catch(PDOException $e){
  echo '<center><h1 style="color:red"> Some Error Occured</h1><h3>Please Check Back in some time</h3><h4>We are try our best to resolve the issue.</h4><h5>...</h5></center>';
  exit();
}
