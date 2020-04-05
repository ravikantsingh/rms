<?php
require('../../inc/scripts/config.php');
require('../../inc/scripts/functions.php');

$pmode=getPaymentMode( $dbh );$z=0;
foreach($pmode as $paymentMode){
    $rep_payment_total[$z]['0']=$paymentMode["slug"];
    $rep_payment_total[$z]['1']=0;
    $z++;
}

function zgetExpenseData( $dbh, $sdate, $edate){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `daily_expense` WHERE  `deleted` != 1 AND `date`>= ? AND `date`<= ?");
	$run = $sql->execute(array($sdate,$edate));
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}

    $data = '';
    $sdate='2019-11-24 00:00:00';
    $edate='2019-11-24 23:59:59';
    $j=0;
    $rep_amount=0;
    $rep_dis=0;
    $rep_tax=0;
    $rep_total=0;
    $rep_rounded=0;
    $final_rep='';
    $final_mode='';
    $mode_total=0;
    $expense_total=0;
    $final_exp='';
    $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `date`>= ? AND `date`<= ?");
    // var_dump($sql);
	$run=$sql->execute( array( $sdate,$edate ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    foreach( $results as $result ){
	        $j++;
	        $rep_amount+=$result['order_amount'];
	        $rep_dis+=$result['order_discount'];
	        $rep_tax+=$result['order_tax'];
	        $rep_total+=$result['order_total'];
	        $rep_rounded+=$result['order_rounded'];
	        $data.='<tr><td>'.$j.'</td><td>'.$result['token'].'</td><td colspan="4">'.$result['order_id'].'</td></tr>';
            $data.= '<tr><td>&nbsp;&nbsp;</td><td>Product</td><td>Price</td><td>Quantity</td><td>Sub Total</td><td>Tax</td></tr>';
            ///////////////////////////////item details fetch////////////////////////////////////////
            $i=0;$orderID=$result['order_id'];
            $sqlz=$dbh->prepare("SELECT * FROM `order_items` WHERE `order_id` = ?");
        	$runz=$sqlz->execute( array( $orderID ) );
        	$res= $sqlz->fetchAll(PDO::FETCH_ASSOC);
        	$countz=$sqlz->rowCount();
        	if( $runz && $countz > 0 ){
              foreach( $res as $zresult ){
                $i++;
                $data.= '<tr><td>&nbsp;&nbsp;</td><td>'.$zresult['item_name'].'</td><td>'.$zresult['item_price'].'</td><td>'.$zresult['item_qty'].'</td><td>'.$zresult['item_subTotal'].'</td><td>'.$zresult['item_tax'].'</td></tr>';
              }
            }
           ///////////////////////////////////mode fetch and calculation////////////////////////////////////// 
           $i=0;
           $orderID=$result['order_id'];
           $mode_val='';
            $sqlzz=$dbh->prepare("SELECT * FROM `order_ledger` WHERE `order_id` = ?");
        	$runzz=$sqlzz->execute( array( $orderID ) );
        	$resz= $sqlzz->fetchAll(PDO::FETCH_ASSOC);
        	$countzz=$sqlzz->rowCount();
        	if( $runzz && $countzz > 0 ){
              foreach( $resz as $zres){
                $i++;
                $mode_val.=$zres['mode'].'=> '.$zres['amount'].' ';
                $mode_total+=$zres['amount'];
                    for($z=0;$z<=count($rep_payment_total);$z++){
                        $temp=0;
                        if($rep_payment_total[$z]['0']==$zres['mode'])
                        {
                            $temp=$rep_payment_total[$z]['1']+$zres['amount'];
                            $rep_payment_total[$z]['1']=$temp;
                        }
                    }
              }
            }
           ////////////////////////////////////total fetch and calculation ///////////////////////////////////////
           //INSERT INTO `order_details`(`id`, `order_id`, `customer_id`, `order_amount`, `order_discount`, `order_tax`, `order_total`, `order_rounded`, `date`, `user_id`, `p_time`, `token`, `status`, `mode`, `canceled`)
            $data.='<tr><td>&nbsp;&nbsp;</td><td colspan="5">Sub Total= '.$result['order_amount'].' Tax= '.$result['order_tax'].' Net Total= '.$result['order_total'].' Payable= '.$result['order_rounded'].'</td></tr>';
           $data.= '<tr><td>&nbsp;&nbsp;</td><td colspan="5">'.$mode_val.'</td></tr>';
           $data.='<tr><td colspan="6">&nbsp;&nbsp;</td></tr>'; 
	    }
	}
	//////////////////////////////////////////////////////expanse calculation/////////////////////////////////////////////
	//INSERT INTO `daily_expense`(`id`, `expense`, `amount`, `date`, `user_id`, `deleted`)
	$expense=zgetExpenseData( $dbh, $sdate, $edate);
	$i=0;
	foreach($expense as $exp){
	    $i++;
	    if($exp['deleted']=='0')
	    $expense_total+=$exp['amount'];
	    $final_exp.='<tr><td>'.$i.'</td><td>'.$exp['expense'].'</td><td>'.$exp['amount'].'</td><td>'.$exp['date'].'</td><td>'.$exp['user_id'].'</td><td>'.$exp['deleted'].'</td></tr>';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	$final_rep.='<table border="1px" style="border:1px solid #000;border-collapse:collapse;">';
	$final_rep.='<tr><td>Amount</td><td>'.$rep_amount.'</td></tr>';
	$final_rep.='<tr><td>Discount</td><td>'.$rep_dis.'</td></tr>';
	$final_rep.='<tr><td>Tax</td><td>'.$rep_tax.'</td></tr>';
	$final_rep.='<tr><td>Net Amount</td><td>'.$rep_total.'</td></tr>';
	$final_rep.='<tr><td>Payable</td><td>'.$rep_rounded.'</td></tr>';
	$final_rep.='</table>';
	$final_mode.='<table border="1px" style="border:1px solid #000;border-collapse:collapse;">';
	for($z=0;$z<=count($rep_payment_total);$z++){
	    $final_mode.='<tr><td>'.$rep_payment_total[$z]['0'].'</td><td>'.$rep_payment_total[$z]['1'].'</td></tr>';
	}
	$final_mode.='<tr><td>Mode Total</td><td>'.$mode_total.'</td></tr>';
	$final_mode.='</table>';
	//var_dump($expense);
?>

<!DOCTYPE html>
<html>
<head>
	<title>Report</title>
</head>
<body>
    <table border='1px' style="border:1px solid #000;border-collapse:collapse;">
		<?php echo $data;?>
	</table>
	<?php echo $final_rep;?>
	<?php echo $final_mode;?>
	<table border='1px' style="border:1px solid #000;border-collapse:collapse;">
		<?php echo $final_exp;?>
	</table>
	<lable>Finale Balance:- <?php echo $mode_total-$expense_total;?></lable>
</body>
</html>