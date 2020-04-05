<?php

require('../inc/crypto/crypto.php');
/***************************global variable*******************************************/
$order_date='';
$order_time='';
$order_token='';
/***************************************************************************************/


function zGetCart( $dbh, $orderID ){
    $data = ''; $i=0; $array=array();$totTax=0;$subTot=0;$cart=array();
    $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `order_id` = ?");
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
        array_push( $array,  productFormatter( getProductNameFromID( $dbh, $result['product_id'] ), $result['quantity'] - $result['delivered'] ) ); 
        
      }
    }
    $items=implode('^',$array);
    array_push($cart, $items );
    array_push($cart, $stot );
    array_push($cart, $gst );
    array_push($cart, $table );
    
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
    $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `order_id` = ?");
    $run=$sql->execute( array( $orderID ) );
	$results= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $order_date=substr($results['date'],0,10);
        $order_time=substr($results['date'],11,18);
        // $order_token=substr($results['token'],6,10);
        $table_no=$results['table_no'];
        array_push($array,$order_date);
        array_push($array,$order_time);
        // array_push($array,$order_token);
        array_push($array,$table_no);
    }
    $data = implode('^', $array);
    return $data;    
}

function productFormatter( $item, $qty ){
	$z_item=$item;
	$z_qty=$qty;
	$z_amount=$amount;
	$z_rate=$rate;
	$data='';
	$z_tax=$tax;
	$spaceItem=29-strlen($item);
	$spaceQty=2-strlen($qty);
	for($i=1; $i<=($spaceItem+$spaceQty); $i++){
		$z_item.=' ';
	}
	for($j=1; $j <= $spaceRate; $j++){
		$z_qty .= ' ';
	}
	$data = $z_item.$z_qty.$z_rate.$z_amount.$z_tax;
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
	$tax_name.=' on Rs '.$amount;
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
	$z_total=str_pad('NET PAYABLE',$z_total_len," ");
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
            
                
                var w = window.open("http://100.150.200.150/printer/example/zkot.php?p=<?php echo $enc;?>&order=<?php echo $order;?>&mode=<?php echo $mode;?>", "popupWindow", "width= 20, height=50, left=100000, top=100000, scrollbars=no");
                var $w = $(w.document.body);
                $w.html("<textarea></textarea>");
            
        });
</script>
<?php

