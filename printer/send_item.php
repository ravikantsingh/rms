<?php

require('../inc/crypto/crypto.php');
/***************************global variable*******************************************/
$order_date='';
$order_time='';
$order_token='';
/***************************************************************************************/

function zGetCart( $dbh, $orderID ){
    $data = ''; $i=0; $array=array();$totTax=0;$subTot=0;$cart=array();
    $sql=$dbh->prepare("SELECT * FROM `order_items` WHERE `order_id` = ?");
    //var_dump($sql);
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
      foreach( $results as $result ){
        // $i++;
        // if($data=='')
        //     $data.= $i.','.$result['item_name'].','.$result['item_price'].','.$result['item_qty'].','.$result['item_subTotal'].','.$result['item_tax'];
        // else
        //     $data.= '$'.$i.','.$result['item_name'].','.$result['item_price'].','.$result['item_qty'].','.$result['item_subTotal'].','.$result['item_tax'];
        array_push( $array,  productFormatter( $result['item_name'], $result['item_qty'], $result['item_price'], $result['item_subTotal'], number_format((float)$result['item_tax'], 2, '.', '')) ); 
        $totTax+=number_format((float)$result['item_tax'], 2, '.', '');
        $subTotal+=$result['item_subTotal'];
      }
    }
    //var_dump($array);
    $stot=subTotal($subTotal);
    //var_dump($stot);
    $gst=sgst('TAX (SGCT 2.5 + CGST 2.5)',$totTax,$subTotal);
    //var_dump($gst);
    $items=implode('^',$array);
    array_push($cart, $items );
    array_push($cart, $stot );
    array_push($cart, $gst );
    
    $return = implode('%', $cart);
    return $return;
}

function zGetMode($dbh, $orderID){
    $data = '';$i=0;$array=array();
    $sql=$dbh->prepare("SELECT * FROM `order_ledger` WHERE `order_id` = ?");
    //var_dump($sql);
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
       foreach( $results as $result ){
            array_push($array,zMode(strtoupper($result['mode']),$result['amount']));
       }
    }
    $data = implode('^', $array);
    return $data;
}

function zGetOderDetails($dbh, $orderID){
    $data = '';$array=array();$c_name='';$c_mob='';
    $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `order_id` = ?");
    // var_dump($sql);
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    //INSERT INTO `order_details`(`id`, `order_id`, `customer_id`, `order_amount`, `order_discount`, `order_tax`, `order_total`, `order_rounded`, `date`, `user_id`, `p_time`, `token`, `status`, `mode`
           // $data.= $results['order_amount'].','.$results['order_discount'].','.$results['order_tax'].','.$results['order_total'].','.$results['order_rounded'].','.$results['date'].','.$results['user_id'].','.$results['token'];
        $sqlz=$dbh->prepare("SELECT * FROM `customer_details` WHERE  `id` = ?");
        // var_dump($sql);
    	$runz=$sqlz->execute( array( $results['customer_id'] ) );
    	$resultsz= $sqlz->fetch(PDO::FETCH_ASSOC);
    	$countz=$sqlz->rowCount();
    	if( $runz && $countz > 0 ){
    	    $c_name=$resultsz['name'];
    	    $c_mob=$resultsz['mobile'];
    	}
	$gtot=grandTotal($results['order_total']);
    $n_pay=payable($results['order_rounded']);
    $tot_pay=netPaid($results['order_rounded']);
    $order_date=substr($results['date'],0,10);
    $order_time=substr($results['date'],11,18);
    $order_token=substr($results['token'],6,10);
    array_push($array,$order_date);
    array_push($array,$order_time);
    array_push($array,$order_token);
    array_push($array,$gtot);
    array_push($array,$n_pay);
    array_push($array,$tot_pay);
    array_push($array,$c_name);
    array_push($array,$c_mob);
    }
    $data = implode('^', $array);
    return $data;    
}

function productFormatter($item,$qty,$rate,$amount,$tax){
	$z_item=$item;
	$z_qty=$qty;
	$z_amount=$amount;
	$z_rate=$rate;
	$data='';
	$z_tax=$tax;
	$spaceItem=29-strlen($item);
	$spaceQty=2-strlen($qty);
	$spaceRate=5-strlen($rate);
	$spaceAmount=5-strlen($amount);
	$spaceTax=7-strlen($tax);
	//echo $spaceItem.' '.$spaceQty.' '.$spaceAmount;
	for($i=1;$i<=($spaceItem+$spaceQty);$i++){
		$z_item.=' ';
	}
	for($j=1;$j<=$spaceRate;$j++){
		$z_qty.=' ';
	}
	for($k=1;$k<=$spaceAmount;$k++){
		$z_rate.=' ';
	}
	for($l=1;$l<=$spaceTax;$l++){
		$z_amount.=' ';
	}
	//$z_amount=$amount;
	$data=$z_item.$z_qty.$z_rate.$z_amount.$z_tax;
	return $data;
}
function subTotal($subTot){
	$data='';
	$z_len=13-(strlen($subTot));//Rs 1234567.00
	$z_total_len=32+$z_len;
	$z_total=str_pad('SUB TOTAL',$z_total_len," ");
	$data=$z_total.$subTot.'.00';
	return $data;
}
function sgst($tax_name,$tax_amount,$amount){
	$data='';
	$tax_len=8-strlen($tax_amount);
	$tax_name.=' on '.$amount;
	$output=str_pad($tax_name,40+$tax_len," ");
	$data=$output.$tax_amount;
	return $data;
}
function cgst($tax_name,$tax_amount,$amount){
	$data='';
	$tax_len=8-strlen($tax_amount);
	$tax_name.=' on Rs '.$amount;
	$output=str_pad($tax_name,40+$tax_len," ");
	$data=$output.$tax_amount;
	return $data;
}
function grandTotal($grandTot){
	$data='';
	$z_len=13-(strlen($grandTot));//Rs 1234567.00
	$z_total_len=35+$z_len;
	$z_total=str_pad('GRAND TOTAL',$z_total_len," ");
	$data=$z_total.$grandTot;
	return $data;
}
function payable($payable){
	$data='';
	$z_len=13-(strlen($payable));//Rs 1234567.00
	$z_total_len=32+$z_len;
	$z_total=str_pad('NET PAYABLE (Discount 30 Percent)',$z_total_len," ");
	$data=$z_total.$payable.'.00';
	return $data;
}
function netPaid($payab){
	$data='';
	$z_len=13-(strlen($payab));//Rs 1234567.00
	$z_total_len=32+$z_len;
	$z_total=str_pad('Total Paid',$z_total_len," ");
	$data=$z_total.$payab.'.00';
	return $data;
}
function zMode($mode,$mode_amt){
    $data='';
	$z_len=13-(strlen($mode_amt));//Rs 1234567.00
	$z_total_len=32+$z_len;
	$z_total=str_pad($mode,$z_total_len," ");
	$data=$z_total.$mode_amt.'.00';
	return $data;
}
$id=$orderID;
$itm= zGetCart($dbh, $id);
$enc=encrypt($itm,'Alpha1991@');

$mode=zGetMode($dbh, $id);
$st1=explode("$",$mode);

$order=zGetOderDetails($dbh, $id);
?>
<script src='../js/jquery.min.js'></script>
<script>
     $(document).ready(function () {
            
                
                var w = window.open("http://100.150.200.150/printer/example/zdemo.php?p=<?php echo $enc;?>&order=<?php echo $order;?>&mode=<?php echo $mode;?>", "popupWindow", "width= 20, height=50, left=100000, top=100000, scrollbars=no");
                var $w = $(w.document.body);
                $w.html("<textarea></textarea>");
            
        });
</script>
<?php

