<?php
include('../../../../inc/scripts/config.php');
$field=$_POST['field'];
$val=$_POST['val'].'%';
//$field='sname';
//$val='josep%';
$msg='';
if($field=='txnid')
$sql="SELECT * FROM `transaction` WHERE `txnid` LIKE ? ";
else if($field=='paytm_id')
$sql="SELECT * FROM `transaction` WHERE `PAYTM_ID` LIKE ? ";
else if($field=='firstname')
$sql="SELECT * FROM `transaction` WHERE `firstname` LIKE ? ";
else if($field=='mobile')
$sql="SELECT * FROM `transaction` WHERE `mobile` LIKE ? ";
else if($field=='email')
$sql="SELECT * FROM `transaction` WHERE `email` LIKE ? ";
else if($field=='bank_ref_num')
$sql="SELECT * FROM `transaction` WHERE `bank_ref_num` LIKE ? ";
else if($field=='enrollment')
$sql="SELECT * FROM `transaction` WHERE `enrollment` LIKE ? ";
else if($field=='status')
$sql="SELECT * FROM `transaction` WHERE `status` LIKE ? ";
else if($field=='nostat')
$sql="SELECT * FROM `transaction` WHERE `status` IS NULL LIMIT 0,10";
else if($field=='amt')
$sql="SELECT * FROM `transaction` WHERE `amount` LIKE ? ";
	$sqlCheck=$dbh->prepare($sql);
		$runCheck=$sqlCheck->execute(array($val));
		$res=$sqlCheck->fetchAll();
foreach( $res as $row ) 
			foreach( $res as $row )
		{
			$colr = '';
			if( strtolower( str_replace( 'TXN_', '', $row['status']) ) =='success'){
						$colr='green';
			}
			else if( strtolower( str_replace( 'TXN_', '', $row['status']) ) =='failure'){
				$colr='red';
			}
			else
				$colr='cyan';
			echo '<tr id="tbody" class="tabledown">
            	<td class="countstart" align="center">'.$row['id'].'</td>
							<td class="hand UpdatePaymentHeader" align="center"><a id="update'.$row['txnid'].'" onclick="update(\''.$row['txnid'].'\',\''.$row['status'].'\',\''.$row['id'].'\',\''.$row['enrollment'].'\', \''.$row['gateway'].'\')" style="display:block; cursor:pointer;"><img src="../../img/update.png"></a></td>
              <td class="countstart" align="center">'.$row['txnid'].'</td>
              <td class="countstart" align="center">'.$row['enrollment'].'</td>
              <td class="countstart" align="center">'.$row['amount'].'</td>
              <td class="countstart" align="center">'.$row['bank_ref_num'].'</td>
              <td class="countstart" style="background-color:'.$colr.';" align="center">'.$row['status'].'</td>
              <td class="countstart" align="center">'.$row['response_Message'].'</td>
              <td class="countstart" align="center">'.$row['addedon'].'</td>
              <td class="countstart" align="center">'.$row['gateway'].'</td>
             </tr>';

		}
		echo $msg;
?>