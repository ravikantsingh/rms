<?php
include('../../../inc/scripts/config.php');
include('../../../inc/scripts/functions.php');
$key = '%'.$_POST['key'].'%';
$msg = '';
$sql = "SELECT * FROM `customer_details` WHERE `mobile` LIKE ? ";
$sqlCheck = $dbh->prepare($sql);
$runCheck = $sqlCheck->execute(array( $key ));
$results = $sqlCheck->fetchAll();
if( $runCheck ){
    foreach($results as $result){
        $msg .= '<div class="row search-value" data-mobile ="'.$result['mobile'].'" data-name ="'.$result['name'].'" >
                    <div class="col-sm-4">
                    <p class="description" >'.$result['mobile'].'</p>
                    </div>
                    <div class="col-sm-8"> <p class="description" >'.$result['name'].'</p> </div>

                </div>';
    }
}



echo $msg;
?>
