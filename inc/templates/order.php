<div class="row cart-container">
    <form id="creatCartForm" method="post">
        <div class="cart-content">
            <div class="row product-row" >
		            <div class="col-sm-1"> S. No. </div>
		            <div class="col-sm-4"> Product </div>
		            <div class="col-sm-2 quantity"> Quantity x <span class="price-tag text-muted">  Rate </span></div>
		            <div class="col-sm-1 price"> Sub. (Rs.) </div>
                    <div class="col-sm-1 price"> Dis. </div>
                    <div class="col-sm-1 price"> Tax (Rs.) </div>
		            <div class="col-sm-2 price"> Total (Rs.) </div>
    		      </div>
            <?php
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
                                $tax .= ( empty( $tax ) ) ? getTaxFromId( $dbh, $id) :  ', '.getTaxFromId( $dbh, $id);
                                $rate = getTaxRateFromID( $dbh, $id );
                                $taxAmount += ( ($rowSubTotal - $rowDiscount )*$rate ) / 100;
                         }
                     }
            ?>
    		      <div class="row product-row" >
		            <div class="col-sm-1"> <?php echo $i++; ?> </div>
		            <div class="col-sm-4"> <?php echo $product['name']; ?> </div>
		            <div class="col-sm-2 quantity"> <?php echo $result['quantity']; ?> x <span class="price-tag text-muted">  Rs.<?php echo $result['price']; ?> </span></div>
                    <div class="col-sm-1 price"> <?php echo $rowSubTotal; ?> </div>
                    <div class="col-sm-1 price"> <?php echo round($rowDiscount, 2); ?> </div>
		            <div class="col-sm-1 price"> <?php echo round($taxAmount, 2); ?> </div>
		            <div class="col-sm-2 price"> <?php echo round($rowSubTotal + $taxAmount - $rowDiscount, 2); ?> </div>
    		      </div>
    		<?php
    		    $total +=  $rowSubTotal;
    		    $totalTax += $taxAmount;
                $totalDiscount += $rowDiscount;
    		    }
		    ?>
        </div>
        <input type="hidden" name = "orderID" value="<?php echo $orderID; ?>" />
        <input type="hidden" name = "date" value="<?php echo date( "Y-m-d H:i:s" ); ?>" />
    </form>
    <div class="cart-total text-right ">
        <span id="cart-total-label"> Sub Total : Rs. </span>
        <span id="cart-total"> <?php echo $total; ?> </span>
    </div>
    <div class="cart-total text-right ">
        <span id="cart-total-label"> Total Discount : Rs. </span>
        <span id="cart-total"> <?php echo $totalDiscount; ?> </span>
    </div>
    <div class="cart-total text-right ">
        <span id="cart-total-label">Tax: Rs. </span>
        <span id="cart-total"> <?php echo $totalTax; ?> </span>
    </div>
    <div class="cart-total text-right ">
        <span id="cart-total-label"> Total : Rs. </span>
        <span id="cart-total"> <?php echo $total + $totalTax - $totalDiscount; ?> </span>
    </div>
    <div class="cart-total text-right ">
        <span id="cart-total-label"> Payable : Rs. </span>
        <span id="cart-total"> <?php echo round(  $total+$totalTax - $totalDiscount, 0, PHP_ROUND_HALF_UP ); ?> </span>
    </div>
</div>
