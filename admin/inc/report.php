<?php
$range = 'today';
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$range = ( isset( $post['range'] ) ) ? $post['range'] : 'today';
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if( isset( $action ) ){
				    switch( $action ){
				        case 'print':
				            include_once('../printer/send_item.php');
				            $x = true;
				            break;
				        case 'deliver':
				            $x = markAsDelivered( $dbh, $orderID);
				            break;
				        case 'cancel':
				            $x = cancelOrder( $dbh, $orderID);
				            break;
				    }
				}
				
				if($x) $_SESSION['check']=$check;

			}

	}
}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//var_dump($rep_payment_total);
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
function finalResult($dbh,$range){
/*************************************************************************/
$pmode=getPaymentMode( $dbh );$z=0;
foreach($pmode as $paymentMode){
    $rep_payment_total[$z]['0']=$paymentMode["slug"];
    $rep_payment_total[$z]['1']=0;
    $z++;
}

$content = '';
    $formAction = 'orders'; $to =''; $from = '';
    if( is_array( $range) ){
        $to = $range[2];
        $from = $range[1];
        $range = $range[0];
    }
    switch( $range ){
        case 'today':
            $from = date('Y-m-d').' 00:00:00';
            $to = date('Y-m-d').' 23:59:59';
            break;
        case 'custom':
            $from = $from.' 00:00:00';
            $to = $to.' 23:59:59';
            break;
        case 'yesterday':
            $from = date('Y-m-d', strtotime( '-1 day' ) ).' 00:00:00';
            $to = date('Y-m-d',  strtotime( '-1 day' ) ).' 23:59:59';
            break;
        case 'thisweek':
            $firstday = date('Y-m-d', strtotime("this week"));
            $from = $firstday.' 00:00:00';
            $to = date( 'Y-m-d' ).' 23:59:59';
            break;
        case 'lastweek':
            $date = firstDayOf('week', new DateTime( date('Y-m-d', strtotime('last week')) ) );
            $fday = $date->format( 'Y-m-d' ) ;
            $date = lastDayOf('week', new DateTime( date('Y-m-d', strtotime('last week')) ) );
            $lday = $date->format( 'Y-m-d' ) ;
            $from = $fday.' 00:00:00';
            $to = $lday.' 23:59:59';
            break;
        case 'lastmonth':
            $date = firstDayOf('month', new DateTime( date('Y-m-d', strtotime('previous month')) ) );
            $fday = $date->format( 'Y-m-d' ) ;
            $date = lastDayOf('month', new DateTime( date('Y-m-d', strtotime('previous month')) ) );
            $lday = $date->format( 'Y-m-d' ) ;
            $from = $fday.' 00:00:00';
            $to = $lday.' 23:59:59';
            break;
        case 'thismonth':
            $date = firstDayOf('month', new DateTime( date('Y-m-d', strtotime('this month')) ) );
            $fday = $date->format( 'Y-m-d' ) ;
            $date = lastDayOf('month', new DateTime( date('Y-m-d', strtotime('previous month')) ) );
            $to = date( 'Y-m-d' ).' 23:59:59';
            $from = $fday.' 00:00:00';
            break;
        
    }
/*************************************************************************/
    $data = '<table class="table table-bordered table-hover table-responsive table-striped text-center">';
    $data .= '<thead><tr>
                    <th class="text-center">S.No.</th>
                    <th class="text-center">Order ID</th>
                    <th class="text-center">Items</th>
                    <th class="text-center">Sub Total</th>
                    <th class="text-center">Discount</th>
                    <th class="text-center">Tax</th>
                    <th class="text-center">Net</th>
                    <th class="text-center">Payable</th>
                    <th class="text-center"> Mode </th>
                    </tr></thead>';
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
    $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `date`>= ? AND `date`<= ?");
    
	$run=$sql->execute( array( $from,$to ) );
	
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
	        $item = '<table class="table table-bordered table-hover table-responsive table-striped text-center" style="margin: 0;">';
            $i=0;$orderID=$result['order_id'];
            $sqlz=$dbh->prepare("SELECT * FROM `order_items` WHERE `order_id` = ?");
        	$runz=$sqlz->execute( array( $orderID ) );
        	$res= $sqlz->fetchAll(PDO::FETCH_ASSOC);
        	$countz=$sqlz->rowCount();
        	if( $runz && $countz > 0 ){
              foreach( $res as $zresult ){
                $i++;
                
                $item .= '<tr><td>'.$i.'</td><td>'.$zresult['item_name'].'</td><td>'.$zresult['item_price'].'</td><td>'.$zresult['item_qty'].'</td><td>'.$zresult['item_subTotal'].'</td><td>'.$zresult['item_tax'].'</td></tr>';
              }
            }
            $item .= '</table>';
	        $data.='<tr><td>'.$j.'</td><td>'.$result['order_id'].'</td><td><input type="button" value="+" class="btn btn-default item-btn" data-id="item-'.$j.'" data-on="0" /><div class="display-items" id="item-'.$j.'">'.$item.'</div></td>';
            ///////////////////////////////item details fetch////////////////////////////////////////
            
           ///////////////////////////////////mode fetch and calculation////////////////////////////////////// 
           $i=0;
           $orderID=$result['order_id'];
           $mode_val = '<table class="table table-bordered table-hover table-responsive table-striped text-center" style="margin: 0;">';
            $sqlzz=$dbh->prepare("SELECT * FROM `order_ledger` WHERE `order_id` = ?");
        	$runzz=$sqlzz->execute( array( $orderID ) );
        	$resz= $sqlzz->fetchAll(PDO::FETCH_ASSOC);
        	$countzz=$sqlzz->rowCount();
        	if( $runzz && $countzz > 0 ){
              foreach( $resz as $zres){
                $i++;
                $mode_val.='<tr><td>'.$zres['mode'].'</td><td> '.$zres['amount'].'</td></tr> ';
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
            $mode_val.= '</table>';
           ////////////////////////////////////total fetch and calculation ///////////////////////////////////////
           $data.='<td > '.$result['order_amount'].' </td><td> '.$result['order_discount'].' </td><td> '.$result['order_tax'].' </td><td> '.$result['order_total'].' </td><td> '.$result['order_rounded'].'</td>';
           $data.= '<td><input type="button" value="+" class="btn btn-default mode-btn" data-id="mode-'.$j.'" data-on="0"  /><div class="display-modes" id="mode-'.$j.'"> '.$mode_val.'</div></td></tr>';
            
	    }
	}
	//$data.='</table>';
	//////////////////////////////////////////////////////expanse calculation/////////////////////////////////////////////
	$expense=zgetExpenseData( $dbh, $from, $to);
	$i=0;
	if($expense){
	    $final_exp='<table  class="table table-bordered table-hover table-responsive table-striped text-center">';
	
	foreach($expense as $exp){
	    $i++;
	    if($exp['deleted']=='0')
	    $expense_total+=$exp['amount'];
	    $final_exp.='<tr><td>'.$i.'</td><td>'.$exp['expense'].'</td><td>'.$exp['amount'].'</td><td>'.$exp['date'].'</td><td>'.getUserNameFromId( $dbh, $exp['user_id'] ).'</td><td>'.$exp['deleted'].'</td></tr>';
	}
	$final_exp.='</table>';
	}
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	//$final_rep.='<table border="1px" style="border:1px solid #000;border-collapse:collapse;">';
	$data.='<thead><tr><th colspan="3" class="text-right" > Total Sum</th><th class="text-center">'.$rep_amount.'</th><th class="text-center">'.$rep_dis.'</th><th class="text-center">'.$rep_tax.'</th><th class="text-center">'.$rep_total.'</th><th class="text-center">'.$rep_rounded.'</th><th></th></tr></thead>';
    $data .= '</table>';
	$final_mode.='<table class="table table-bordered table-hover table-responsive table-striped text-center">';
	for($z=0;$z<count($rep_payment_total);$z++){
	    $final_mode.='<tr><td>'.$rep_payment_total[$z]['0'].'</td><td>'.$rep_payment_total[$z]['1'].'</td></tr>';
	}
	$final_mode.='<tr><td>Mode Total</td><td>'.$mode_total.'</td></tr>';
	$final_mode.='</table>';
	//var_dump($rep_payment_total);
	//////////////////////////////////////////////////////////////////////////////
	$f_balance=$mode_total-$expense_total;
	$zzz=$data.$final_rep.$final_mode.$final_exp.'<lable>Finale Balance:- '.$f_balance.'</lable>';
	return $zzz;
}
?>
<?php @include_once( './inc/dateMenu.php' ); ?>
<div class="row">
	<div class="tab-pane" role="tabpanel">
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<?php echo finalResult($dbh,$range);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
