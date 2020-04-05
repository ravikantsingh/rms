<?php
include('../../../inc/scripts/config.php');
$id=$_POST['p'];
$val= ( $_POST['s'] != 'n/a' ) ? $_POST['s'].'%' : 'n/a' ;

$data='<select id="comboItems"  class="form-control" ><option value = "0"> No Items </option>';
if( $val != 'n/a'   ){
	$sql="SELECT `id`, `name` FROM `product_details` WHERE `category_id` = ?  AND `active` = '1' AND `deleted` != '1' AND `name` LIKE ? ";
	$sqlCheck=$dbh->prepare($sql);
	$runCheck=$sqlCheck->execute(array(
																		$id,
																		$val,
																 ));
}
else{
	$sql="SELECT  `id`, `name` FROM `product_details` WHERE `category_id` = ? AND `active` = '1' AND `deleted` != '1' ";
	$sqlCheck=$dbh->prepare($sql);
	$runCheck=$sqlCheck->execute(array(
																		$id,
																 ));
}
$rows=$sqlCheck->fetchAll();
if( $runCheck && $sqlCheck->rowCount() > 0){
	foreach( $rows as $row ){
				$data .= '<option value="'.$row['id'].'"> '.$row['name'].' </option>';

	}
	$data .= '</select>';
	echo $data.'&^&'.md5( rand(100, 999) );
}
else{
		echo '<select id="comboItems"  class="form-control" >
							<option value = "0"> No Items </option>

					</select>';
}
