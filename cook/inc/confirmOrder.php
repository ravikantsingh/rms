<?php
 if(isset($_POST) && !empty($_POST)){
	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if( !isset($_SESSION['check']) || $_SESSION['check']!=$check ){
			    $orderID = $post['orderID'];
				$x = createOrder( $dbh, $orderID, calculateTotalPaid(  $post ) );

				if( $x && $x !== '9' && $x !== '8' ) {
				    $_SESSION['check']=$check;
				    InsertOrderLedger( $dbh, $post );
				    addItems($dbh, $orderID);
				}

			}

	}
?>
<div class="row">
    <div class="col-sm-12">
        <section id="tabs">
        	<div class="container" style="border: none;">
        	    <div class="row">
        	        <div class="cart"><i class="fa fa-cart-plus fa-3x"></i></div>
        	    </div>
              <?php
                 if( !isset( $x ) ){
              ?>
                  <form  method="post" action="./?option=pos">
                        <div class="cart-container">
                            <div class="col-sm-12 sm-fifty">
                            <div class="panel panel-default">
                                <div class="panel-body">
                            <div class="flot-big-container">
                               <h2>
                                   It seems you refreshed the page...We do not create same order twice...
                               </h2>
                            <div>

                            </div>
                            </div>
                        </div>
                        </div>
                        <div class="text-right padding-10-hr">
                                <input type="submit" class="btn btn-dark-grey"  value="Go to POS" />
                        </div>

                    </form>
              <?php
                }
        	       else if( $x === '8' ||  $x === '9'){
        	    ?>
        	    <form  method="post" action="./?option=cart">
                    <div class="cart-container">
                        <div class="col-sm-12 sm-fifty">
                        <div class="panel panel-default">
                            <div class="panel-body">
                        <div class="flot-big-container">
                           <h2>
                               <?php
                                if( $x === '9' ){
                                    echo 'Paid amount is less than payable';
                                }
                                else{
                                    echo 'Paid amount is greater than payable';
                                }
                               ?>
                           </h2>
                        <div>
                        <input type="hidden" name = "orderID" value="<?php echo $orderID; ?>" />
                        <input type="hidden" name = "showCart" value="1" />
                        <input type="hidden" name = "date" value="<?php echo date( "Y-m-d H:i:s" ); ?>" />

                        </div>
                        </div>
                    </div>
                    </div>
                    <div class="text-right padding-10-hr">
                            <input type="submit" class="btn btn-dark-grey"  value="Retry" />
                    </div>

                </form>
                <?php
        	        }
                  else if( $x === '1' ){
                    ?>
                    <form  method="post" action="./?option=pos">
                          <div class="cart-container">
                              <div class="col-sm-12 sm-fifty">
                              <div class="panel panel-default">
                                  <div class="panel-body">
                              <div class="flot-big-container">
                                 <h2>
                                     Order Placed Successfully...
                                 </h2>
                              <div>

                              </div>
                              </div>
                          </div>
                          </div>
                          <div class="text-right padding-10-hr">
                                  <input type="submit" class="btn btn-dark-grey"  value="Go to POS" />
                          </div>

                      </form>
                    <?php
                  }
        	    ?>

        	</div>
        </section>
    </div>

</div>
<?php
}
else{
?>
<div class="row">
    <div class="col-sm-12 text-center">
        <h1>Congratulations!</h1>
        <h2>We heard you were looking for nothing, and you got it.</h2>
    </div>
</div>
<?php } ?>
