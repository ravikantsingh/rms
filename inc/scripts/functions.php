<?php
function addCart( $dbh, $posts, $orderID){
    $values = '';
    $date = $posts['date'];
    $mode = $posts['mode'];
    $table = '';
    $tablemode = getSettings( $dbh, 'table_mode' );
    if( $tablemode == 1){
        if( isset( $_POST['table'] ) ){

            $table = $posts['table'];
        }
    }
    $exc = array(  "date", "orderID", 'token', 'customer_name', 'mobile', 'mode', 'table'  );
    $c_id = addCustomer( $dbh, $posts['mobile'], $posts['customer_name']);
    if( $tablemode == 1){

        foreach( $posts as $key => $post ){
        if( in_array( $key, $exc) ) continue;

            $sqlCheck=$dbh->prepare( "UPDATE `cart` SET `quantity` = `quantity` + ?  WHERE `product_id` = ? AND `order_id` = ? " );
            $runCheck=$sqlCheck->execute( array($post[1] , $post[0], $orderID) );
        	$count=$sqlCheck->rowCount();
        	if( !($runCheck && $count >0) ){
        	    if( $values == '' ):
                    $values .= "( '". $orderID ."', ". $post[0] .", ". $post[1] .", '". $post[2] ."', '". $date ."', '". $mode ."', '".$c_id."', '".$table."' )";
                else:
                    $values .= ",( '". $orderID ."', ". $post[0] .", ". $post[1] .", '". $post[2] ."', '". $date ."', '". $mode ."', '".$c_id."', '".$table."'  )";
                endif;
        	}

        }
       if( $values != '' ){
            $sqlCheck=$dbh->prepare("INSERT INTO `cart`(`order_id`, `product_id`, `quantity`, `price`, `date`, `mode`, `customer_id`, `table_no`) VALUES ".$values);
            $runCheck=$sqlCheck->execute( );
            $count=$sqlCheck->rowCount();
       }

    }
    else{
        foreach( $posts as $key => $post ){
        if( in_array( $key, $exc) ) continue;


            if( $values == '' ):
                $values .= "( '". $orderID ."', ". $post[0] .", ". $post[1] .", '". $post[2] ."', '". $date ."', '". $mode ."', '".$c_id."', '".$table."' )";
            else:
                $values .= ",( '". $orderID ."', ". $post[0] .", ". $post[1] .", '". $post[2] ."', '". $date ."', '". $mode ."', '".$c_id."', '".$table."'  )";
            endif;
        }
        $sqlCheck=$dbh->prepare("INSERT INTO `cart`(`order_id`, `product_id`, `quantity`, `price`, `date`, `mode`, `customer_id`, `table_no`) VALUES ".$values);
        $runCheck=$sqlCheck->execute( );
    	$count=$sqlCheck->rowCount();
    }

	return ($runCheck && $count >0);
}
function addCustomer( $dbh, $mobile, $customer_name ){
    $sql = $dbh->prepare( "SELECT `id` FROM `customer_details` WHERE `mobile` = ?" );
	$run = $sql->execute( array( $mobile ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result['id'];
    }
    else{
        $date = date( 'Y-m-d H:i:s' );
        $sqlCheck=$dbh->prepare("INSERT INTO `customer_details`(`mobile`,`name`, `date`) VALUES (?, ?, ?)");
	    $runCheck=$sqlCheck->execute( array(
	                                        $mobile,
	                                        $customer_name,
	                                        $date
	                                        ) );

	    $sql = $dbh->prepare( "SELECT `id` FROM `customer_details` WHERE `mobile` = ?" );
    	$run = $sql->execute( array( $mobile ) );
    	$result = $sql->fetch(PDO::FETCH_ASSOC);
    	$count = $sql->rowCount();
    	if( $run && $count > 0 ){
    	    return $result['id'];
        }
	    return 0;
    }
}
function addCategory( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("INSERT INTO `category`(`category`,`active`, `slug`, `parent`, `date`) VALUES (?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute( array(
	    $category,
	    $active,
      $slug,
	    $parent,
	    $date,
	    ));

	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function addCombo( $dbh, $post){
  foreach( $post as $key => $value ){
      $$key = $value;
  }
  $expire_date = $expire_date.' 23:59:59';
  $discount = ( isset( $discount ) && $discountable ) ? $discount : 0;
  $tax = implode( ' ', $tax);
  $sqlCheck=$dbh->prepare("INSERT INTO `combo`( `name`, `slug`, `price`, `offer`, `tax`, `date`, `activation_date`, `expiry_date`, `active`, `discountable`, `discount`)  VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute( array(
	                                    $cname,
	                                    $slug,
	                                    $price,
	                                    $offer,
	                                    $tax,
	                                    $date,
                                      $active_date,
                                      $expire_date,
	                                    $active,
	                                    $discountable,
	                                    $discount,
	                                    ) );
	$count=$sqlCheck->rowCount();

	 if($runCheck && $count >0){
     $sql = $dbh->prepare("SELECT `id` FROM `combo` WHERE `slug` = '$slug' ");
     $run = $sql->execute( );
     $row = $sql->fetch( PDO::FETCH_ASSOC );
     $values = '';
     foreach( $comboItems as $value ){

         if( $values == '' ):
             $values .= "( '". $row['id'] ."', '". $value ."' )";
         else:
             $values .= ",( '". $row['id'] ."', '". $value ."' )";
         endif;
     }
     $sql = $dbh->prepare("INSERT INTO `combo_items`(  `combo_id`, `product_id` ) VALUES ".$values);
     $run = $sql->execute( array( ) );
     return ($run && $sql->rowCount() >0);
   }
}
function addDiscount( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $expire_date = $expire_date.' 23:00:00';
    $sqlCheck=$dbh->prepare("INSERT INTO `discounts`( `name`, `rate`, `type`, `criteria`, `cart_value`, `active_date`, `expire_date`, `date`, `active`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute( array(
	                                $name,
	                                $rate,
	                                $type,
	                                $criteria,
	                                $cart_value,
	                                $active_date,
	                                $expire_date,
	                                $date,
	                                $active,
	                                    ) );
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function addItems( $dbh, $orderID ){
    $name = '';
    $zdata='';
    $date=date( "Y-m-d H:i:s" );
    $customer_id='';
    $item_discount='';
    $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `order_id` = ?");
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
            $i = 1;
                $total = 0;
                $totalTax = 0;
                $customer = '';
                foreach( $results as $result ){
                  $tax = '';
                  $rate = '';
                  $taxAmount = 0;
                  if( $customer == '' ){
                    $customer = getCustomerDataSingle( $dbh, $result['customer_id'] );
                  }
                  $product = getProductDataSingle( $dbh, $result['product_id'] );
                  $rowSubTotal = $result['quantity']*$result['price'];
                  $rowDiscount = ( @$product['discountable'] ) ? getDiscount( $dbh, $product['discount'], $rowSubTotal, $customer ) : 0;
                  $result['tax'] = explode( ' ', $product['tax'] );
                  foreach( $result['tax'] as $id ){
                     if( !empty( $id ) ){
                            $tax .= ( empty( $tax ) ) ? getTaxFromId( $dbh, $id) :  ', '.getTaxFromId( $dbh, $id);
                            $rate = getTaxRateFromID( $dbh, $id );
                            $taxAmount += ( $rowSubTotal*$rate ) / 100;
                     }
                  }
                  updateProductSale( $dbh, $result['product_id'], $result['quantity']  );
                  if($zdata=='')
                      $zdata.="('".$orderID."','".$customer_id."','".$date."','".$result['product_id']."','".$product['name']."','".$result['price']."','".$result['quantity']."','".$rowSubTotal."','".$taxAmount."','".$rowDiscount."')";
                  else
                      $zdata.=",('".$orderID."','".$customer_id."','".$date."','".$result['product_id']."','".$product['name']."','".$result['price']."','".$result['quantity']."','".$rowSubTotal."','".$taxAmount."','".$rowDiscount."')";
       }
    }
  $sqlCheck=$dbh->prepare("INSERT INTO `order_items`(`order_id`, `customer_id`, `date`, `item_id`, `item_name`, `item_price`, `item_qty`, `item_subTotal`, `item_tax`, `item_discount`) VALUES ".$zdata);
	$runCheck=$sqlCheck->execute( );
	$count=$sqlCheck->rowCount( );

	return ($runCheck && $count >0);
}
function addProduct( $dbh, $post){
  foreach( $post as $key => $value ){
      $$key = $value;
  }
  $tax = implode( ' ', $tax);
  $sqlCheck=$dbh->prepare("INSERT INTO `product_details`(`category_id`, `name`, `slug`, `price`, `offer`, `date`, `tax`, `active`, `discountable`, `quantity`, `discount`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute( array(
	                                    $category_id,
	                                    $pname,
	                                    $slug,
	                                    $price,
	                                    $offer,
	                                    $date,
	                                    $tax,
	                                    $active,
	                                    $discountable,
	                                    $quantity,
	                                    $discount,
	                                    ) );
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function addTax( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("INSERT INTO `tax_details`(`name`,`slug`,`rate`,`active`, `date`) VALUES (?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute(array(
	                                $name,
	                                $slug,
	                                $rate,
	                                $active,
	                                $date,
	                                    ));
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function addPaymentMode( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("INSERT INTO `payment_mode`(`mode`, `slug`, `active`) VALUES (?, ?, ?)");
	$runCheck=$sqlCheck->execute(array(
	                                $pmode,
	                                $slug,
	                                $active,
	                                    ));
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function addUser( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $password=md5($_POST['password']);
    $sqlCheck=$dbh->prepare("INSERT INTO `user_log`(`name`, `mobile`, `username`, `password`, `role`, `status`, `date`) VALUES (?, ?, ?, ?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute( array(
	    $name,
	    $mobile,
	    $username,
	    $password,
	    $role,
	    $status,
	    $date,
	    ));
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function calculateTotalPaid( $post ){
    $total = 0;
    foreach( $post as $key => $value ){
        if( $key == "date" || $key == "orderID" || empty($value)) continue;
        $total += $value;
    }


	return $total;
}
function cancelOrder( $dbh, $orderID){
    $sqlCheck=$dbh->prepare("UPDATE `order_details` SET `canceled`= 1 WHERE `order_id`= ?");
	$runCheck=$sqlCheck->execute( array(
	                                    $orderID
	                                    ) );
	$count=$sqlCheck->rowCount();
    return ($runCheck && $count >0);
}
function getDiscount( $dbh, $id, $amount, $customer = false ){
  $date = date('Y-m-d H:i:s');
  $discount = 0;
  if( !$customer ){
    $customer['oad'] = 0;
    $customer['discount'] = 0;
    $customer['rate'] = 0;
  }
  $sql=$dbh->prepare("SELECT  `rate`, `type`, `criteria`, `cart_value` FROM `discounts` WHERE `active_date` <= ? AND `expire_date` >= ? AND `active` = 1 AND `deleted` = 0 AND `id` = ?");
	$run=$sql->execute( array(
                            $date,
                            $date,
                            $id,
                            ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
  if( $run && $count > 0  ){
    switch ( $result['type'] ) {
      case 'Percentage':
        $discount = $amount * $result['rate'] / 100;
        break;
      case 'Flat':
        $discount =  min( $result['rate'], $amount);
        break;
    }

  }
  if( $customer['discount'] == 1 && $customer['oad'] == 1 ){
    $discount = $discount + ( ( $amount - $discount ) * $customer['rate'] ) / 100 ;
  }
  else if( $customer['discount'] == 1 && $customer['oad'] == 0 ){
    $discount = ( $amount * $customer['rate'] ) / 100 ;
  }
  return $discount;
}
function createOrder( $dbh, $orderID, $paid = 0,$user_id){
    $p_time=preTime($dbh);
    $token=getToken($dbh);
    $tableMode = getSettings( $dbh, 'table_mode' );
    $mode='';
    $name = '';
    $customer_id = '';
    $date=date( "Y-m-d H:i:s" );
    $orderStatus = ( $tableMode == 1) ? 3 : 1;
    //////////////////////////////////////////////////////////

  $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `order_id` = ?");
	$run=$sql->execute( array( $orderID ) );
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
    $i = 1;
    $total = 0;
    $totalTax = 0;
    $totalDiscount = 0;
    $customer = '';
    foreach( $results as $result ){
        $tax = '';
        $rate = '';
        $taxAmount = 0;
        if( $customer == '' ){
          $customer = getCustomerDataSingle( $dbh, $result['customer_id'] );
        }
        $product = getProductDataSingle( $dbh, $result['product_id'] );
        $rowSubTotal = $result['quantity']*$result['price'];
        $rowDiscount = ( @$product['discountable'] ) ? getDiscount( $dbh, $product['discount'], $rowSubTotal, $customer ) : 0;
        $result['tax'] = explode( ' ', $product['tax'] );
         foreach( $result['tax'] as $id ){
             if( !empty( $id ) ){
                    $rate = getTaxRateFromID( $dbh, $id );
                    $taxAmount += ( ($rowSubTotal - $rowDiscount )*$rate ) / 100;
             }
         }
        $i++;
        $total +=  $rowSubTotal;
        $totalTax += $taxAmount;
        $totalDiscount += $rowDiscount;
        if( $mode == '' ){
            $mode = $result['mode'];
            $customer_id = $result['customer_id'];
        }
    }

    $orderTotal=$total+$totalTax- $totalDiscount;
    $orderRounded=round(  $total + $totalTax - $totalDiscount, 0, PHP_ROUND_HALF_UP );
    if( $paid < $orderRounded ){
        return '9';
    }
    elseif( $paid > $orderRounded ){
        return '8';
    }
    /////////////////////////////////////////////////////////
    $sqlCheck=$dbh->prepare("INSERT INTO `order_details`(`order_id`, `customer_id`, `order_amount`, `order_discount`, `order_tax`, `order_total`, `order_rounded`, `date`, `user_id`, `p_time`, `token`, `status`, `mode`) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ? )");
    $runCheck=$sqlCheck->execute( array(
	    $orderID,
	    $customer_id,
	    $total,
	    $totalDiscount,
	    $totalTax,
	    $orderTotal,
	    $orderRounded,
	    $date,
	    $user_id,
	    $p_time,
	    $token,
	    $orderStatus,
	    $mode,
	    ));
	$count=$sqlCheck->rowCount( );

	return ( $runCheck && $count >0 ) ? '1' : false;

}
function clearCart( $dbh, $ordrID ){
    $sqlCheck=$dbh->prepare( "DELETE FROM `cart` WHERE `order_id` = ?" );
	$runCheck=$sqlCheck->execute( array(
	                                $ordrID
	                                ));
}
function editCategory( $dbh, $post ){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("UPDATE `category` SET `category`=?,`active`=?, `slug` =?, `parent` = ?, `update_date` = ? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
	                                $category,
	                                $active,
                                  $slug,
	                                $parent,
	                                $date,
	                                $id,
	                                ));
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function editCombo( $dbh, $post ){
  foreach( $post as $key => $value ){
      $$key = $value;
  }
  $tax = implode( ' ', $tax);
  $discount = ( isset( $discount ) && $discountable ) ? $discount : 0;
  $sqlCheck=$dbh->prepare("UPDATE `combo` SET `name`= ?,`slug`= ?, `price`= ?,`offer`= ?,`tax`= ?,`date`= ?,`activation_date`= ?,`expiry_date`= ?,`active`= ?,`discountable`= ?,`discount`= ? WHERE `id` = ?");
	$runCheck=$sqlCheck->execute( array(
	                                    $cname,
	                                    $slug,
	                                    $price,
	                                    $offer,
	                                    $tax,
	                                    $date,
                                      $active_date,
                                      $expire_date,
	                                    $active,
	                                    $discountable,
                                      $discount,
	                                    $id
	                                    ) );
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function editProduct( $dbh, $post ){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $tax = implode( ' ', $tax);
    $discount = ( isset( $discount ) && $discountable ) ? $discount : 0;
    $sqlCheck=$dbh->prepare("UPDATE `product_details` SET `category_id`=?,`name`=?,`slug`=?,`price`=?,`offer`=?,`date`=?,`tax`=?,`active`=?,`discountable`=?,`discount`=?,`quantity`=? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
	                                    $category_id,
	                                    $pname,
	                                    $slug,
	                                    $price,
	                                    $offer,
	                                    $date,
	                                    $tax,
	                                    $active,
	                                    $discountable,
                                      $discount,
	                                    $quantity,
	                                    $id
	                                    ) );
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function editTax( $dbh, $post ){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("UPDATE `tax_details` SET `name`=?,`slug`=?,`rate`=?,`active`=?, `update_date` = ? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
                                        $name,
                                        $slug,
                                        $rate,
                                        $active,
                                        $date,
                                        $id
                                        ) );

	$count=$sqlCheck->rowCount();
	return ($runCheck && $count >0);
}
function editPaymentMode( $dbh, $post ){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("UPDATE `payment_mode` SET `mode`=?,`slug`=?,`active`=? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
                                        $pmode,
                                        $slug,
                                        $active,
                                        $id
                                        ) );

	$count=$sqlCheck->rowCount();
	return ($runCheck && $count >0);
}
function editUser( $dbh, $post ){
  foreach( $post as $key => $value ){
      $$key = $value;
  }

  $sqlCheck=$dbh->prepare("UPDATE `user_log` SET `name`= ?,`mobile`= ?,`role`= ?,`status`= ?,`update_date`= ? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
	                                    $name,
	                                    $mobile,
	                                    $role,
	                                    $status,
	                                    $update_date,
	                                    $id,
	                                    ) );
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function editCustomer( $dbh, $post ){
  foreach( $post as $key => $value ){
      $$key = $value;
  }
  $sqlCheck=$dbh->prepare("UPDATE `customer_details` SET `name`= ?,`mobile`= ?,`discount`= ?,`oad`= ?,`rate`= ? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute( array(
	                                    $name,
	                                    $mobile,
	                                    $discount,
	                                    $oad,
	                                    $rate,
	                                    $id,
	                                    ) );
	$count=$sqlCheck->rowCount();
  return ($runCheck && $count >0);
}
function generateRandomString($length = 10){
    $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
function getCart( $dbh, $orderID ){
    $name = '';
    $sql=$dbh->prepare("SELECT * FROM `cart` WHERE `order_id` = ?");
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
        require '../inc/templates/order.php';
    }
    return round(  $total+$totalTax - $totalDiscount, 0, PHP_ROUND_HALF_UP );
}
function getCartTable( $dbh ){
    $name = '';
    $sql=$dbh->prepare("SELECT * FROM `cart` WHERE 1 ORDER BY `order_id` ASC");
	$run=$sql->execute( array( $orderID ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
        require '../inc/templates/orderTable.php';

    }
    return round(  $total+$totalTax, 0, PHP_ROUND_HALF_UP );
}
function getCategoryFromId( $dbh, $id ){
    $name = '';
    $sql=$dbh->prepare("SELECT `category` FROM `category` WHERE `id` = ?");
	$run=$sql->execute( array( $id ) );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$name = $result['category'];
    }
    return $name;
}
function getCategoryOptions( $dbh, $value = 0, $parent = 0, $separator = '' ){
    $i = 0; $catData = '';
    if( $parent  ) $separator .= '-';
    $sql=$dbh->prepare("SELECT * FROM `category` WHERE `active`='1' AND `parent` = ?");
	$run=$sql->execute( array( $parent ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		foreach($results as $result){
		    $i++;
			$catData .= "<option value='".$result['id']."' ".( ( $value == $result['id'] ) ? 'selected' : '' ).">".$separator.' '.$result['category']."</option>";
			if(  $result['id'] != $parent ) $catData .= getCategoryOptions( $dbh, $value, $result['id'], $separator );
	    }
    }
    return $catData;
}
function getDiscountOptions( $dbh, $value = 0 ){
  $i = 0; $disData = '';
  $sql=$dbh->prepare("SELECT * FROM `discounts` WHERE `active`='1' AND `deleted` = '0' ");
	$run=$sql->execute(  );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		foreach($results as $result){
		  $i++;
			$disData .= "<option value='".$result['id']."' ".( ( $value == $result['id'] ) ? 'selected' : '' ).">".$result['name']." ( ".$result['rate'].( ($result['type'] == 'Flat') ? 'Flat' : '%' )." )</option>";
	    }
    }
    return $disData;
}
function getCategoryData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `category` WHERE  `deleted` != 1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getCategoryDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `category` WHERE `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getCategoryTable( $dbh ){
    $i = 1; $data = '';
    $results = getCategoryData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['category']."</td><td>".
    			$result['slug']."</td><td>".
    			getCategoryFromId( $dbh, $result['parent'] )."</td><td class='text-center'>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td>".
    			$result['date']."</td><td>".
    			$result['update_date']
    			."</td><td><a href='./?option=editCategory&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewCategory&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewCategory&activate=".$result['id']."'>Activate</a>" ) .
    			"</td><td><a href='./?option=viewCategory&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return ( $data != '' ) ? $data : '<tr ><td colspan="10" class="text-center"> No data found... </td></tr>';
}
function getDiscountData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `discounts` WHERE  `deleted` != 1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getDiscountDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `discounts` WHERE  `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getDiscountTable( $dbh ){
    $i = 1; $data = '';
    $results = getDiscountData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['name']."</td><td class='text-center'>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td>".
    			$result['rate']."</td><td>".
    			$result['type']."</td><td>".
    			$result['criteria']."</td><td> From ".
    			date_format( date_create( $result['active_date'] ), 'M d, Y H:i:s').' To '.date_format( date_create( $result['expire_date'] ), 'M d, Y H:i:s')."</td><td>".
    			$result['date']."</td><td>".
    			$result['update_date']
    			."</td><td><a href='./?option=editDiscount&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewDiscount&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewDiscount&activate=".$result['id']."'>Activate</a>" ) .
    			"</td><td><a href='./?option=viewDiscount&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return ( $data != '' ) ? $data : '<tr ><td colspan="12" class="text-center"> No data found... </td></tr>';
}
function getProductData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `product_details` WHERE `deleted` != 1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getComboData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `combo` WHERE `deleted` != 1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getProductDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `product_details` WHERE `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getComboDataSingle( $dbh, $id ){
  $data = '';
  $sql = $dbh->prepare("SELECT * FROM `combo` WHERE `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getProductNameFromID( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT `name` FROM `product_details` WHERE `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result['name'];
    }
    return false;
}
function getProductTable( $dbh ){
    $i = 1; $data = '';
    $results = getProductData( $dbh );
    if( $results ){
        foreach( $results as $result ){
             $tax = '';
             $result['tax'] = explode( ' ', $result['tax'] );
             foreach( $result['tax'] as $id ){
                 if( !empty( $id ) )
                    $tax .= ( empty( $tax ) ) ? getTaxFromId( $dbh, $id) :  ', '.getTaxFromId( $dbh, $id);
             }
    			$data.="<tr><td>".$i++."</td><td>".
    			getCategoryFromId( $dbh, $result['category_id'] )."</td><td>".
    			$result['name']."</td><td>".
    			$result['slug']."</td><td>".$result['price']."</td><td>".
    			$result['offer']."</td><td>".$result['discountable']."</td><td>".
    			$result['quantity']."</td><td>".
    			$tax
    			."</td><td>".$result['date']."</td><td class='text-center'>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td><a href='./?option=editProduct&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewProduct&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewProduct&activate=".$result['id']."'>Activate</a>" ) .
    			"</td><td><a href='./?option=viewProduct&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return ( $data != '' ) ? $data : '<tr ><td colspan="14" class="text-center"> No data found... </td></tr>';
}
function getComboItems( $dbh, $id){
  $data = '<table class="table table-striped table-hover table-full-width table-bordered">';
  $sql = $dbh->prepare("SELECT * FROM `combo_items` WHERE `combo_id` = ?");
  $run = $sql->execute( array( $id ) );
  $results = $sql->fetchAll(PDO::FETCH_ASSOC);
  $count = $sql->rowCount();
  if( $run && $count > 0 ){
    foreach ($results as $result) {
      $data .= '<tr><td>'.getProductNameFromID( $dbh, $result['product_id'] ).'</td></tr>';
    }
    return $data.'</table>';
  }
  return '';
}
function getComboTable( $dbh ){
    $i = 1; $data = '';
    $results = getComboData( $dbh );
    if( $results ){
        foreach( $results as $result ){
          $tax = '';
          $result['tax'] = explode( ' ', $result['tax'] );
          foreach( $result['tax'] as $id ){
             if( !empty( $id ) )
                $tax .= ( empty( $tax ) ) ? getTaxFromId( $dbh, $id) :  ', '.getTaxFromId( $dbh, $id);
          }
          $items = getComboItems( $dbh, $result['id'] );
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['name']."</td><td>".
    			$result['slug']."</td><td>".
          $result['price']."</td><td>".
          $result['offer']."</td><td>".
          $result['discountable']."</td><td>".
          $items."</td><td>".
    			$tax
    			."</td><td>".$result['date']."</td><td class='text-center'>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td><a href='./?option=editCombo&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewCombo&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewCombo&activate=".$result['id']."'>Activate</a>" ) .
    			"</td><td><a href='./?option=viewCombo&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return ( $data != '' ) ? $data : '<tr ><td colspan="13" class="text-center"> No data found... </td></tr>';
}
function getProductFromCategory( $dbh, $category ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `product_details` WHERE `deleted` != 1 AND `active` = 1 AND `category_id` = ?");
	$run = $sql->execute( array( $category ) );
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getSettings( $dbh, $key ){
    $sql = $dbh->prepare("SELECT `value` FROM `settings` WHERE  `keyname` = ?");
	$run = $sql->execute( array( $key ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result['value'];
    }
    return false;
}
function getTables($selected){
    $tables = array( array(1, 'table 1'), array(2, 'table 2'), array(3, 'table 3'), array(4, 'table 4'), array(5, 'table 5'), array(6, 'table 6'), array(7, 'table 7'), array(8, 'table 8'), array(9, 'table 9'), array(10, 'table 10'), array(11, 'table 11'), array(12, 'table 12'), array(13, 'table 13'), array(14, 'table 14'), array(15, 'table 15'));
    $opt = '<select name="table" class="form-control">';
    foreach($tables as $table ){
        $opt .= '<option value="'.$table[0].'" '.( ( $selected && $selected == $table[0] ) ? "selected" : '' ).'>'.$table[1].'</option>';
    }
    $opt .= '</select>';
    echo $opt;
}
function getTaxData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `tax_details` WHERE  `deleted` != 1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getTaxDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `tax_details` WHERE  `deleted` != 1 AND `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getPaymentMode( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `payment_mode` WHERE `active`='1' AND `deleted`='0'");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}

function getPaymentModes( $dbh, $orderID ){
    $name = '';
    $sql=$dbh->prepare("SELECT * FROM `payment_mode` WHERE `active` = '1'");
	$run=$sql->execute(  );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){

        require '../inc/templates/paymentModes.php';
    }
}
function getPaymentModeSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `payment_mode` WHERE `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getTaxTable( $dbh ){
    $i = 1; $data = '';
    $results = getTaxData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['name']."</td><td>".
    			$result['slug']."</td><td>".
    			$result['rate']."</td><td class='text-center'>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td>".
    			$result['date']."</td><td>".
    			$result['update_date']
    			."</td><td><a href='./?option=editTax&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewTax&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewTax&activate=".$result['id']."'>Activate</a>" ) .
    			"</td><td><a href='./?option=viewTax&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return $data;
}
function getOrderItems( $dbh, $order_id ){
  $sql=$dbh->prepare("SELECT * FROM `order_items` WHERE `order_id` = ?");
	$run=$sql->execute( array( $order_id ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
    return $results;
  }
  return false;
}
function getOrderList( $dbh ){
    $content = '';
  $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `status` = '1' AND  `canceled` = '0' AND `token` != 0 ORDER BY `token` ASC");
	$run=$sql->execute( array(  ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $class = '';
      $counter = 0;
      foreach( $results as $result ){
        $items = getOrderItems( $dbh, $result['order_id'] );
        if( !$items ) continue;

        if( $counter % 3 == 0 ){
             $content .= '<div class="row" style="margin: 0; display: flex;" >
                          ';
        }
            $date = date_add(date_create( $result['date']), date_interval_create_from_date_string( '+'.$result['p_time'].' minutes' ) );
            $date = date_format($date, 'Y-m-d H:i:s');
            $t  = $result['p_time']*60;
            $rt = strtotime( $date ) - strtotime( date('Y-m-d H:i:s') ) ;
            $p  = ($t != 0 ) ? min( ( ( ( $t - $rt )*100  ) / $t), 100 ) : 0;
            $barClass = ( $p < 85 ) ? 'progress-bar-green' : ( ( $p < 95 ) ? 'progress-bar-orange' : 'progress-bar-red' );
                $content .= '
                            <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                <div class="card padding-5" data-id="'.$result['order_id'].'" style="height:100%;">

                                    <input type="hidden" id="'.$result['order_id'].'"  />

                                    <div class="card-body min-height-75"> ';

                                    $content .= '<div class="progress-bar-container">
                                                  <div class="progress-loading">
                                                  <div class="progress-loading-bar '. $barClass .'" style="width:'.$p.'%" data-t="'.$t.'" data-rt="'.($t - $rt).'">
                                                  </div>
                                                  </div>
                                                </div>';
                                    $content .= '<div class="item-container">';
                                    foreach ( $items as $item ) {
                                      $content .= '<div class="item-table">
                                                    <div class="item-name">  '.$item['item_name'].'</div><div class="item-qty"> '.$item['item_qty'].'</div>
                                                  </div>';
                                    }
                                    $content .= '</div>';
                  	                $content .= '<div class="card-header-label '. $barClass .'">'.$result['token'].' '.$result['mode'].'</div>';
                  	                $content .= '</div>
                                    <form class="text-right" action="./" method="post">
                                      <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                      <input type="hidden" name="order_id" value="'. $result['order_id'].'"  />
                                      <input type="submit" class="btn btn-default" value="Mark Prepared" />
                                    </form>
              	                </div>
          	                </div>
                  	        ';
	            $class = '';



            $content .= '';
            $counter++;
            if( $counter % 3 == 0 ){

                  $content .= '</div>';
              }

	    }
    }
    if( $content == '' ){
        $content .= '<div class="message-text">There are no orders for now...</div>';
    }
    return $content;
}
function getOrderListDisplay( $dbh ){
    $content = '';
  $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE ( `status` = '1' OR `status` = '2' ) AND  `canceled` = '0' AND `token` != 0 ORDER BY `token` ASC");
	$run=$sql->execute( array(  ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $class = '';
      $counter = 0;$display = 1;
      $contenthash = array();
      foreach( $results as $result ){
        array_push( $contenthash, $result['status'] );
        $items = getOrderItems( $dbh, $result['order_id'] );
        if( !$items ) continue;

        if( $counter % 9 == 0 ){
             $content .= '<div class="display-wrapper" id = "display-'.( $display++ ).'" '.( ($display > 2) ? 'style = "display: none;"' : '' ).' >';
        }
        if( $counter % 3 == 0 ){
             $content .= '<div class="row" style="margin: 0; display: flex;" >
                          ';
        }
            $date = date_add(date_create( $result['date']), date_interval_create_from_date_string( '+'.$result['p_time'].' minutes' ) );
            $date = date_format($date, 'Y-m-d H:i:s');
            $t  = $result['p_time']*60;
            $rt = strtotime( $date ) - strtotime( date('Y-m-d H:i:s') ) ;
            $p  = ($t != 0 ) ? min( ( ( ( $t - $rt )*100  ) / $t), 100 ) : 0;
            $barClass = ( $p < 85 ) ? 'progress-bar-green' : ( ( $p < 95 ) ? 'progress-bar-orange' : 'progress-bar-red' );
            $barClass = ( $result['status'] == 2 ) ?  'progress-bar-blue' : $barClass ;
                $content .= '
                            <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                <div class="card padding-5" data-id="'.$result['order_id'].'" style="height:100%;">

                                    <input type="hidden" id="'.$result['order_id'].'"  />

                                    <div class="card-body min-height-120"> ';

                                    $content .= '<div class="progress-bar-container">
                                                  ';
                                    $content .=   ( $result['status'] != 2 ) ?    '<div class="progress-loading"><div class="progress-loading-bar '. $barClass .'" style="width:'.$p.'%" data-t="'.$t.'" data-rt="'.($t - $rt).'"> </div></div>' : '<div class ="order-text blink" > Your order is ready... </div>';
                                    $content .=     '

                                                </div>';
                                    $token = substr($result['token'],6,10)*1;
                  	                $content .= '<div class="card-header-label-display '. $barClass .'">'.$token.'</div>';
                  	                $content .= '</div>
              	                </div>
          	                </div>
                  	        ';
	            $class = '';



            $content .= '';
            $counter++;
            if( $counter % 3 == 0 ){

                $content .= '</div>';
            }
            if( $counter % 9 == 0 ){

                $content .= '</div>';
            }

	    }
	    $content .= '<input type="hidden" value="1" id="activeDisplay" data-display = "'.($display-1).'" />';
    }
    $content .= '<input type="hidden" value="'.md5( implode(' ', $contenthash ) ).'" id="content" />';
    return $content;
}
function getOrderListPOS( $dbh, $user_id, $range = 'today', $case = 'all' ){
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
    switch( $case ){
        case 'all':
            $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `user_id` = ? AND ( `status` = '1' OR `status` = '2' ) AND `token` != 0 AND ( `date` >= '".$from."' AND  `date` <= '".$to."' ) ORDER BY `token` ASC");
	        break;
        case 'canceled':
            $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `user_id` = ? AND `canceled` = '1'  AND `token` != 0 AND ( `date` >= '".$from."' AND  `date` <= '".$to."' ) ORDER BY `token` ASC");
            $formAction = 'canceledOrders';
            break;
        case 'prepared':
            $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `user_id` = ? AND `status` = '2'  AND `token` != 0 AND ( `date` >= '".$from."' AND  `date` <= '".$to."' ) ORDER BY `token` ASC");
            $formAction = 'preparedOrders';
            break;
        case 'pending':
            $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `user_id` = ? AND `status` = '1' AND `canceled` = '0'   AND `token` != 0 AND ( `date` >= '".$from."' AND  `date` <= '".$to."' ) ORDER BY `token` ASC");
            $formAction = 'pendingOrders';
            break;
        case 'delivered':
            $sql=$dbh->prepare("SELECT * FROM `order_details` WHERE `user_id` = ? AND `status` = '3' AND `canceled` = '0'   AND `token` != 0 AND ( `date` >= '".$from."' AND  `date` <= '".$to."' ) ORDER BY `token` ASC");
            $formAction = 'pendingOrders';
            break;
    }
    $run=$sql->execute( array( $user_id ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $class = '';
      $counter = 0;
      foreach( $results as $result ){
        $items = getOrderItems( $dbh, $result['order_id'] );
        if( !$items ) continue;

        if( $counter % 3 == 0 ){
             $content .= '<div class="row order-list"  >
                          ';
        }
            $date = date_add(date_create( $result['date']), date_interval_create_from_date_string( '+'.$result['p_time'].' minutes' ) );
            $date = date_format($date, 'Y-m-d H:i:s');
            $t  = $result['p_time']*60;
            $rt = strtotime( $date ) - strtotime( date('Y-m-d H:i:s') ) ;
            $p  = ($t != 0 ) ? min( ( ( ( $t - $rt )*100  ) / $t), 100 ) : 0;
            $barClass = ( $p < 85 ) ? 'progress-bar-green' : ( ( $p < 95 ) ? 'progress-bar-orange' : 'progress-bar-red' );
            if( $result['canceled'] ):
              $barClass = 'progress-bar-yellow';
            endif;
                $content .= '
                            <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                <div class="card padding-5" data-id="'.$result['order_id'].'" style="height:100%;">

                                    <input type="hidden" id="'.$result['order_id'].'"  />

                                    <div class="card-body min-height-75"> ';
                                    if( $result['canceled'] ):
                                      $content .= '<div class="mask"><span>Cancelled...</span></div>';
                                    endif;
                                    $content .= '<div class="progress-bar-container">
                                                  <div class="progress-loading">';
                                    if( !$result['canceled']):
                                      $content .= '<div class="progress-loading-bar '. $barClass .'" style="width:'.$p.'%" data-t="'.$t.'" data-rt="'.($t - $rt).'">
                                                   </div>';
                                    endif;
                                    $content .= '</div>
                                                </div>';
                                    $content .= '<div class="item-container">';
                                    foreach ( $items as $item ) {
                                      $content .= '<div class="item-table">
                                                    <div class="item-name">  '.$item['item_name'].'</div><div class="item-qty"> '.$item['item_qty'].'</div>
                                                  </div>';
                                    }
                                    $content .= '</div>';
                  	                $content .= '<div class="card-header-label '. $barClass .'">'.$result['token'].'</div>';
                                    $content .= '</div>';
                                    if( !$result['canceled']):
                                      $content .= '<table><tr><td><form class="text-center" action="./?option='.$formAction.'" method="post">
                                        <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                        <input type="hidden" name="orderID" value="'. $result['order_id'].'"  />
                                        <input type="hidden" name="action" value="cancel"  />
                                        <input type="submit" class="btn btn-default btn-block" value="Cancel" />
                                      </form></td>';
                                      $content .= '<td><form class="text-center" action="./?option='.$formAction.'" method="post">
                                        <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                        <input type="hidden" name="orderID" value="'. $result['order_id'].'"  />
                                        <input type="hidden" name="action" value="print"  />
                                        <input type="submit" class="btn btn-default btn-block" value="Print" />
                                      </form></td>';
                                      if( $result['status'] === '2' ){
                                        $content .= '<td><form class="text-center" action="./?option='.$formAction.'" method="post">
                                          <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                          <input type="hidden" name="orderID" value="'. $result['order_id'].'"  />
                                          <input type="hidden" name="action" value="deliver"  />
                                          <input type="submit" class="btn btn-default btn-light-grey btn-block" value="Deliver" />
                                        </form></td>';
                                      }
                	                $content .='</tr></table>';
                                endif;
                                $content .='</div>
          	                </div>
                  	        ';
	            $class = '';



            $content .= '';
            $counter++;
            if( $counter % 3 == 0 ){

                  $content .= '</div>';
              }

	    }
    }
    return $content;
}
function getPaymentModeTable( $dbh ){
    $i = 1; $data = '';
    $results = getPaymentMode( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['mode']."</td><td>".
    			$result['slug']."</td><td>".
    			( ( $result['active'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td>".
    			"</td><td><a href='./?option=editPaymentMode&id=".$result['id']."'>Edit</a></td><td>".
    			( ( $result['active'] ) ? "<a href='./?option=viewPaymentMode&deactivate=".$result['id']."'>Deactivate</a>" : "<a href='./?option=viewPaymentMode&activate=".$result['id']."'>Activate</a>" ) .
    			"</td></tr>";
    	    }
    }
    return $data;
}
function getUserData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `user_log` WHERE  1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getCustomerData( $dbh ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `customer_details` WHERE  1");
	$run = $sql->execute();
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getCustomerDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `customer_details` WHERE  `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getUserDataSingle( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT * FROM `user_log` WHERE  `id` = ? ");
	$run = $sql->execute( array( $id ) );
	$result = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $result;
    }
    return false;
}
function getUserNameFromId( $dbh, $id ){
    $data = '';
    $sql = $dbh->prepare("SELECT `name` FROM `user_log` WHERE  `id` = ? ");
    $run = $sql->execute( array( $id ) );
    $result = $sql->fetch(PDO::FETCH_ASSOC);
    $count = $sql->rowCount();
    if( $run && $count > 0 ){
        return $result['name'];
    }
    return '';
}
function getUserTable( $dbh ){
    $i = 1; $data = '';
    $results = getUserData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['name']."</td><td>".
    			$result['mobile']."</td><td>".$result['username']."</td><td>".
    			$result['role']."</td><td class='text-center'>".
    			( ( $result['status'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td>".
    			$result['date']."</td><td>".
    			$result['update_date']
    			."</td><td><a href='./?option=editUser&id=".$result['id']."'>Edit</a></td><td><a href='./addUser.php?forcePass=".$result['id']."' class='text-danger'>Force Password Reset</a></td></tr>";
    	    }
    }
    return $data;
}
function getCustomerTable( $dbh ){
    $i = 1; $data = '';
    $results = getCustomerData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['name']."</td><td>".
    			$result['mobile']."</td><td class='text-center'>".
          ( ( $result['discount'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td  class='text-center'>".
    			( ( $result['oad'] ) ? '<i class="fa fa-check-circle-o text-success"></i>' : '<i class="fa fa-times-circle-o text-danger"></i>' )."</td><td>".
    			$result['rate']
    			."</td><td><a href='./?option=editCustomer&id=".$result['id']."'>Edit</a></td></tr>";
    	    }
    }
    return $data;
}
function getTabMenu( $dbh, $table ){
    $menu = '';
    $class = 'active';
    $sql=$dbh->prepare("SELECT * FROM `".$table."` WHERE `active` = 1 AND `deleted` != 1");
	$run=$sql->execute( array(  ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    foreach( $results as $result ){
	        if( !$result['parent'] )
		    $menu .= '<a class="nav-item nav-link '.$class.'" id="nav-'.$result['slug'].'-tab" data-toggle="tab" href="#nav-'.$result['slug'].'" role="tab" aria-controls="nav-'.$result['slug'].'" aria-selected="true">'.$result['category'].'</a>';
		    $class = '';
	    }
    }
    return $menu;
}
function getTabContent( $dbh, $table ){
    $content = '';
    $sql=$dbh->prepare("SELECT * FROM `".$table."` WHERE `active` = 1 AND `deleted` != 1");
	$run=$sql->execute( array(  ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $class = 'active';
        foreach( $results as $result ){
	        if( !$result['parent'] ){
	            $products = getProductFromCategory( $dbh, $result['id'] );


	            $content .= '<div class="tab-pane   '.$class.'" id="nav-'.$result['slug'].'" role="tabpanel" aria-labelledby="nav-'.$result['slug'].'-tab">'.
	                        '<div class="col-sm-12 sm-fifty">
                                <div class="panel panel-default">
                                    <div class="panel-body">
                                        <div class="flot-big-container">';

                $counter = 0;
	            foreach( $products as $product ){
	                if( $counter % 3 == 0 ){
	                     $content .= '<div class="row" >
                                    ';
	                }
	                $content .= '
    	                                <div class="col-sm-4 padding-10-hr margin-top">
    	                                    <div class="card padding-5 add-product" data-id="'.$product['slug'].'"> <i class="fa fa-check-circle-o product-added hide"></i>

        	                                    <input type="hidden" id="'.$product['slug'].'" data-name="'.$product['name'].'" data-product-id="'.$product['id'].'"  data-price="'.( ( $product['offer'] ) ? $product['offer'] : $product['price'] ).'" />
        	                                    <div class="card-title card-label">
            	                                            '.( ( $product['offer'] ) ? '<span style="text-decoration: line-through;" class="text-muted"> Rs. '.$product['price'].'</span>'.' Rs. '.$product['offer'] : ' Rs. '.$product['price']).'
            	                                            </div>
    	                                            <div class="card-body min-height-75">';
                            	                $content .= '<div class="card-lower-label">'.$product['name'].'</div>';
                            	                $content .= '</div>

                        	                </div>
                    	                </div>
                    	            ';
		            $class = '';

		            $counter++;
		            if( $counter % 3 == 0 ){
        	            $content .= '
                    	                </div>';
	                }
	            }
	            if( $counter % 3 != 0 ){

        	            $content .= '
                    	                </div>';
	                }
	            $content .= '</div></div></div></div></div>';
	        }
	    }
    }
    return $content;
}
function getTaxFromId( $dbh, $id ){
    $name = '';
    $sql=$dbh->prepare("SELECT `name`, `rate` FROM `tax_details` WHERE `id` = ?");
	$run=$sql->execute( array( $id ) );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$name = $result['name'] . " ( ".$result['rate']."% ) ";
    }
    return $name;
}
function getTaxRateFromId( $dbh, $id ){
    $rate = 0;
    $sql=$dbh->prepare("SELECT `rate` FROM `tax_details` WHERE `id` = ? AND `active`='1' AND `deleted` != 1 ");
	$run=$sql->execute( array( $id ) );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$rate = $result['rate'];
    }
    return $rate;
}
function getTaxOptions( $dbh , $value = array( 0 )){
    $i = 0;
    $taxData = '';
    if( !is_array($value) && !empty( $value ) ){
        $value = explode( ' ', $value);
    }
    $sql=$dbh->prepare("SELECT * FROM `tax_details` WHERE `active`='1'");
	$run=$sql->execute();
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if($run && $count>0){
		foreach($results as $result){
		    $i++;
			$taxData.='<div class="form-group">
			            <label  class="col-sm-3 control-label"> '.$result['name'].'( '.$result['rate'].'% )  </label>
            			<div class="col-sm-3">
            			    <input class="myfunnel-switch-light"  data-id="tax'.$i.'" type="checkbox"  value="'.$result['id'].'" '. ( ( in_array( $result['id'], $value ) ) ? "Checked" : "" ) .'>
            			    <input type="hidden" id="tax'.$i.'" name="tax[]" value="'.( ( in_array( $result['id'], $value ) ) ? $result['id'] : "" ).'" />
            			</div>
            			</div>';


    	}
    }
    return $taxData;
}
function InsertOrderLedger( $dbh, $post ){
    $orderID = $post['orderID'];
    $values = '';
    $date = $post['date'];
    foreach( $post as $key => $value ){
        if( $key == "date" || $key == "orderID" || empty($value)) continue;
        if( $values == '' ):
            $values .= "( '". $orderID ."', '". $key ."', ". $value .", '". '' ."', '". $date ."' )";
        else:
            $values .= ",( '". $orderID ."', '". $key ."', ". $value .", '". '' ."', '". $date ."' )";
        endif;
    }
    $sqlCheck=$dbh->prepare("INSERT INTO `order_ledger`( `order_id`, `mode`, `amount`, `customer_id`, `date` ) VALUES ".$values);
    $runCheck=$sqlCheck->execute( );
	$count=$sqlCheck->rowCount( );

	return ($runCheck && $count >0);
}
function login( $dbh, $username, $password){
	$sql=$dbh->prepare("SELECT * FROM `user_log` WHERE `username`= ? AND `status` = 1 ");
	$run=$sql->execute(
	                    array(
	                        $username
	                        )
	                    );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if($count==1){
		if(md5($password)=== $result['password']){
			if(!isset($_SESSION))  session_start();
			$_SESSION['fingerprint'] = md5($_SERVER['HTTP_USER_AGENT'] . PHRASE. $result['role'] );
			$_SESSION['timeout']=time();
			$_SESSION['user']=$username;
			$_SESSION['name']=$result['name'];
			$_SESSION['role']=$result['role'];
			$_SESSION['user_id']=$result['id'];
			if (file_exists( './'.$result['role'].'/' ) ){
			        header('location:./'.$result['role'].'/');
        			exit('Authentication Successful...');
			}

		}
	}
}
function markAsPrepared( $dbh, $order_id){
  $sqlCheck=$dbh->prepare("UPDATE `order_details` SET `status`= '2' WHERE `order_id`= ?");
  $runCheck=$sqlCheck->execute(array(
      $order_id,
      ));
  $count=$sqlCheck->rowCount();
  return ($runCheck && $count >0);
}
function markAsDelivered( $dbh, $order_id){
  $sqlCheck=$dbh->prepare("UPDATE `order_details` SET `status`= '3' WHERE `order_id`= ?");
  $runCheck=$sqlCheck->execute(array(
      $order_id,
      ));
  $count=$sqlCheck->rowCount();
  return ($runCheck && $count >0);
}
function processFile($file, $path, $imageName='', $x=false, $y=false){
	  if(isset($file)){
		 foreach($file as $keyPhoto => $image){
			 $name= explode('.',$image['name']);
			 $count=count($name);
	 	 if($name[$count-1]=='jpg' || $name[$count-1]=='jpeg' ||  $name[$count-1]=='png'){
			 				if($imageName==''){
								$saveto =$path.md5(date('Ymdhis').$name[0].$keyPhoto).'.'.$name[$count-1];
								$nameToImage[1]= md5(date('Ymdhis').$name[0].$keyPhoto).'.'.$name[$count-1];
							}
							else{
								$saveto =$path.$imageName;
								$nameToImage[1]= $imageName;
							}
							$typeok = TRUE;
							move_uploaded_file($image['tmp_name'], $saveto);


	 switch($image['type']){
								case "image/jpeg": $src=@imagecreatefromjpeg($saveto);  break;
								case "image/pjpeg": $src=@imagecreatefromjpeg($saveto);  break;
								case "image/png":  $src=@imagecreatefrompng($saveto);break;
								default: $typeok = FALSE; break;
							}
							if(!$src) $typeok=false;
				if ($typeok){
								list($w, $h) = getimagesize($saveto);
								$max = 200;
								$tw = $w;
								$th = $h;
								if ($w > $h && $max < $w)
								{
									$th = $max / $w * $h;
									$tw = $max;
								}
								elseif ($h > $w && $max < $h)
								{
									$tw = $max / $h * $w;
									$th = $max;
								}
								elseif ($max < $w)
								{
									$tw = $th = $max;
								}
					if($x && $y){
						$tw=$x;
						$th=$y;
					}


			$tmp = imagecreatetruecolor($tw, $th);
			imagealphablending( $tmp, false );
            imagesavealpha( $tmp, true );
			imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
								imageconvolution($tmp, array(
									array(-1, -1, -1),
									array(-1, 16, -1),
									array(-1, -1, -1)
								), 8, 0);
								if($image['type']=='png'){
								    imagepng($tmp, $saveto);
								}
								else
								imagejpeg($tmp, $saveto);
								imagedestroy($tmp);
								imagedestroy($src);
							}
				else{
					unlink($saveto);
					return false;
				}
						}
			 else{
				return false;
			 }
		 }
		 return $nameToImage[1];
	 }
}
function rst_info($dbh){
	$sql=$dbh->prepare("SELECT * FROM `rst_info` WHERE 1");
	$run=$sql->execute();
	if($run){
		$result= $sql->fetch(PDO::FETCH_ASSOC);
		$count=$sql->rowCount();
		if($count>0)
		return $result;
	}
	else{
		return false;
	}
}
function splitWord($word){
	$tmp=str_split($word);
	$return='';
	foreach($tmp as $char){
		if(ord($char)>=65 && ord($char)<=90){
			$return.=' '.$char;
		}
		else{
			$return.=$char;
		}
	}
	return $return;
}
function trimSpecialCharacters($val){
	$x=array("'",'<','>','\\','*','#','$','"','%','!','^','&','(',')');
	$y=array('','','','','','','','','','','','','','');
	$val=str_replace($x,$y,$val);
	return $val;
}
function trimArray(array $array){
  $flag=false;
  foreach($array as $key=>$tmp){
    $array[$key]=trim($tmp);
  }
  return $array;
}
function updateRstInfo($dbh, $post, $logo, $favicon){
	$date=date('Y-m-d H:i:s');
	$logo=HOST.'img/'.$logo;
	$favicon=HOST.'img/'.$favicon;
	$sql=$dbh->prepare("UPDATE `rst_info` SET `name`=?,`logo`=?, `favicon`=?, `address`=?,`contact`=?,`sms_name`=?, `reCaptcha`=?,`reCaptchaSiteKey`=?,`reCaptchaSecretKey`=?, `analyticsTrackerId`=? WHERE 1");
	$run=$sql->execute(array($post['name'],$logo, $favicon, $post['address'], $post['email'], $post['sms_name'],  $post['reCaptcha'], $post['reCaptchaSiteKey'], $post['reCaptchaSecretKey'], $post['analyticsTrackerId']));
	if($run){
		return true;
	}
	else{
		return false;
	}
}
function updateProductSale( $dbh, $id, $value = 1, $type = 'up' ){
  switch ( $type ) {
    case 'down':
      $sqlCheck=$dbh->prepare("UPDATE `product_details` SET `sale`= `sale` - ? WHERE `id`= ?");
      break;

    default:
      $sqlCheck=$dbh->prepare("UPDATE `product_details` SET `sale`= `sale` + ? WHERE `id`= ?");
      break;
  }

	$runCheck=$sqlCheck->execute(array(
	    $value,
	    $id,
	    ));
	$count=$sqlCheck->rowCount();
	return ($runCheck && $count >0);
}
function updateTableField( $dbh, $table, $field, $value, $whereKey, $whereValue  ){
    $sqlCheck=$dbh->prepare("UPDATE `".$table."` SET `".$field."`= ? WHERE `".$whereKey."`= ?");
	$runCheck=$sqlCheck->execute(array(
	    $value,
	    $whereValue,
	    ));
	$count=$sqlCheck->rowCount();
	return ($runCheck && $count >0);
}
function addExpense( $dbh, $post){
    foreach( $post as $key => $value ){
        $$key = $value;
    }
    $sqlCheck=$dbh->prepare("INSERT INTO `daily_expense`(`expense`, `amount`, `date`, `user_id`) VALUES (?, ?, ?, ?)");
	$runCheck=$sqlCheck->execute(array(
	                                $expense,
	                                $amount,
	                                $date,
	                                $user_id,
	                                    ));
	$count=$sqlCheck->rowCount();

	return ($runCheck && $count >0);
}
function getExpenseData( $dbh ){
    $data = '';
    $date=date("Y-m-d",strtotime("-1 day"));
    $date.=' 23:59:59';
    $sql = $dbh->prepare("SELECT * FROM `daily_expense` WHERE  `deleted` != 1 AND `date`> ?");
	$run = $sql->execute(array($date));
	$results = $sql->fetchAll(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results;
    }
    return false;
}
function getExpenseTable( $dbh ){
    $i = 1; $data = '';
    $results = getExpenseData( $dbh );
    if( $results ){
        foreach( $results as $result ){
    			$data.="<tr><td>".$i++."</td><td>".
    			$result['expense']."</td><td>".
    			$result['amount']."</td><td>".
    			$result['date']."</td><td>".
    			getUserNameFromId( $dbh, $result['user_id'] )."</td>".
    			"<td><a href='./?option=addExpense&delete=".$result['id']."' class='text-danger'>Delete</a></td></tr>";
    	    }
    }
    return $data;
}
function getToken($dbh){
$token=0;
$date=date("ymd");
$date.='%';
    $sql=$dbh->prepare("SELECT `token` FROM `order_details` WHERE `token` LIKE ? ORDER BY `token` DESC LIMIT 0,1");
	$run=$sql->execute( array( $date ) );
	$result= $sql->fetch(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$token= $result['token'];
		$token++;
    }
    else
    {
        $token=date("ymd").'0001';
    }

   return $token;
}
function preTime($dbh){
    $oc=0;
	$timing=20;
	$sql=$dbh->prepare("SELECT `order_id` FROM `order_details` WHERE `status`='1' AND `canceled`='0' AND `date`>='".date('Y-m-d 00:00:00')."'");
	$run=$sql->execute( array(  ) );
	$result= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
		$oc=$count;
    }
	if($oc<=4)
	$timing=$timing;
	else if($oc<=6)
	$timing+=5;
	else if($oc<=8)
	$timing+=10;
	else if($oc<=10)
	$timing+=15;
	else if($oc<=12)
	$timing+=20;
	else if($oc<=14)
	$timing+=25;
	else if($oc<=16)
	$timing+=30;
	else if($oc<=18)
	$timing+=35;
	else if($oc<=20)
	$timing+=40;
	else if($oc<=22)
	$timing+=45;
	else if($oc<=24)
	$timing+=50;
	else if($oc<=26)
	$timing+=55;
	else if($oc<=28)
	$timing+=60;
	else if($oc<=30)
	$timing+=65;

	return $timing;
}

/***************************************************UTILITY********************************************************/

function firstDayOf($period, DateTime $date = null)
{
    $period = strtolower($period);
    $validPeriods = array('year', 'quarter', 'month', 'week');

    if ( ! in_array($period, $validPeriods))
        throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));

    $newDate = ($date === null) ? new DateTime() : clone $date;

    switch ($period) {
        case 'year':
            $newDate->modify('first day of january ' . $newDate->format('Y'));
            break;
        case 'quarter':
            $month = $newDate->format('n') ;

            if ($month < 4) {
                $newDate->modify('first day of january ' . $newDate->format('Y'));
            } elseif ($month > 3 && $month < 7) {
                $newDate->modify('first day of april ' . $newDate->format('Y'));
            } elseif ($month > 6 && $month < 10) {
                $newDate->modify('first day of july ' . $newDate->format('Y'));
            } elseif ($month > 9) {
                $newDate->modify('first day of october ' . $newDate->format('Y'));
            }
            break;
        case 'month':
            $newDate->modify('first day of this month');
            break;
        case 'week':
            $newDate->modify(($newDate->format('w') === '0') ? 'monday last week' : 'monday this week');
            break;
    }

    return $newDate;
}
function lastDayOf($period, DateTime $date = null)
{
    $period = strtolower($period);
    $validPeriods = array('year', 'quarter', 'month', 'week');

    if ( ! in_array($period, $validPeriods))
        throw new InvalidArgumentException('Period must be one of: ' . implode(', ', $validPeriods));

    $newDate = ($date === null) ? new DateTime() : clone $date;

    switch ($period)
    {
        case 'year':
            $newDate->modify('last day of december ' . $newDate->format('Y'));
            break;
        case 'quarter':
            $month = $newDate->format('n') ;

            if ($month < 4) {
                $newDate->modify('last day of march ' . $newDate->format('Y'));
            } elseif ($month > 3 && $month < 7) {
                $newDate->modify('last day of june ' . $newDate->format('Y'));
            } elseif ($month > 6 && $month < 10) {
                $newDate->modify('last day of september ' . $newDate->format('Y'));
            } elseif ($month > 9) {
                $newDate->modify('last day of december ' . $newDate->format('Y'));
            }
            break;
        case 'month':
            $newDate->modify('last day of this month');
            break;
        case 'week':
            $newDate->modify(($newDate->format('w') === '0') ? 'now' : 'sunday this week');
            break;
    }

    return $newDate;
}

function getCartList( $dbh ){
    $content = '';
  $sql=$dbh->prepare("SELECT * FROM `cart` WHERE 1 ORDER BY `table_no`");
  //var_dump($sql);
	$run=$sql->execute( array( ) );
	$results= $sql->fetchAll(PDO::FETCH_ASSOC);
	$count=$sql->rowCount();
	if( $run && $count > 0 ){
	    $class = '';
      $counter = 0;
      foreach( $results as $result ){
          if($result['delivered']<$result['quantity']){
              $qty=$result['quantity']-$result['delivered'];
        $item = getProductDataSingle( $dbh, $result['product_id'] );

        if( !$item ) continue;

        if( $counter % 3 == 0 ){
             $content .= '<div class="row" style="margin: 0; display: flex;" >
                          ';
        }
            $date = date_add(date_create( $result['date']), date_interval_create_from_date_string( '+'.$result['p_time'].' minutes' ) );
            $date = date_format($date, 'Y-m-d H:i:s');
            $t  = $result['p_time']*60;
            $rt = strtotime( $date ) - strtotime( date('Y-m-d H:i:s') ) ;
            $p  = ($t != 0 ) ? min( ( ( ( $t - $rt )*100  ) / $t), 100 ) : 0;
            $barClass = ( $p < 85 ) ? 'progress-bar-green' : ( ( $p < 95 ) ? 'progress-bar-orange' : 'progress-bar-red' );
                $content .= '
                            <div class="col-sm-4 padding-10-hr margin-top" style="flex:1;">
                                <div class="card padding-5" data-id="'.$result['order_id'].'" style="height:100%;">

                                    <input type="hidden" id="'.$result['order_id'].'"  />

                                    <div class="card-body min-height-75"> ';

                                    $content .= '<div class="progress-bar-container">
                                                  <div class="progress-loading">
                                                  <div class="progress-loading-bar '. $barClass .'" style="width:'.$p.'%" data-t="'.$t.'" data-rt="'.($t - $rt).'">
                                                  </div>
                                                  </div>
                                                </div>';
                                    $content .= '<div class="item-container">';

                                      $content .= '<div class="item-table">
                                                    <div class="item-name">  '.$item['name'].'</div><div class="item-qty"> '.$qty.'</div>
                                                  </div>';

                                    $content .= '</div>';
                  	                $content .= '<div class="card-header-label '. $barClass .'">Table '.$result['table_no'].'</div>';
                  	                $content .= '</div>
                                    <form class="text-right" action="./" method="post">
                                      <input type="hidden" name="token" value="'.md5( $result['order_id'].date('YmdHis') ).'"  />
                                      <input type="hidden" name="order_id" value="'. $result['order_id'].'"  />
                                      <input type="hidden" name="tableMode" value="1"  />
                                      <input type="hidden" name="product_id" value="'. $result['product_id'].'"  />
                                      <input type="hidden" name="delivered" value="'. ($result['delivered']+$qty).'"  />
                                      <input type="submit" class="btn btn-default" value="Mark Prepared" />
                                    </form>
              	                </div>
          	                </div>
                  	        ';
	            $class = '';



            $content .= '';
            $counter++;
            if( $counter % 3 == 0 ){

                  $content .= '</div>';
              }
            }
	    }
    }
    if( $content == '' ){
        $content .= '<div class="message-text">There are no orders for now...</div>';
    }
    return $content;
}
function markAsPreparedTable( $dbh, $delivered,$order_id,$product_id){
  $sqlCheck=$dbh->prepare("UPDATE `cart` SET `delivered`= ? WHERE `order_id`= ? AND `product_id`=?");
  $runCheck=$sqlCheck->execute(array(
      $delivered,
      $order_id,
      $product_id,
      ));
  $count=$sqlCheck->rowCount();
  return ($runCheck && $count >0);
}
function getTableNoFromOrderId($dbh,$order_id){
    $sql = $dbh->prepare("SELECT `table_no` FROM `cart` WHERE `order_id`=?");
	$run = $sql->execute(array($order_id));
	$results = $sql->fetch(PDO::FETCH_ASSOC);
	$count = $sql->rowCount();
	if( $run && $count > 0 ){
	    return $results['table_no'];
    }
    return false;
}
