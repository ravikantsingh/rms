<?php
 if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 && !isset( $_POST['showCart'] ) ){
			$post=$_POST;
			foreach( $_POST as $key => $value ){
			    if( is_array( $_POST[ $key ] ) ){
			        $_POST[ $key ] = implode( ' ', $_POST[ $key ]);
			    }
			}
			$check=md5(implode('', $_POST));
			if( !isset($_SESSION['check']) || $_SESSION['check']!=$check ){
				$x=addCart( $dbh, $post, $orderID );
				if($x) {
				    $_SESSION['check']=$check;
				    $orderID = $post['orderID'];
				}

			}

	}
	elseif(isset($_POST) && count($_POST) > 0 && isset( $_POST['showCart'] ) ){
	    $orderID = $_POST['orderID'];
	}
?>
<div class="row">
    <div class="col-sm-6">
        <section id="tabs">
        	<div class="container" style="border: none;">
        	    <div class="row">
        	        <div class="cart"><i class="fa fa-cart-plus fa-3x"></i></div>
        	    </div>
        	    <?php 
        	        $payable = getCart( $dbh, $orderID );
        	    ?>
        	</div>
        </section>
    </div>
    <div class="col-sm-6">
        <section id="tabs">
        	<div class="container" style="border: none;">
        	    <div class="row">
        	        <div class="cart">
        	            <i class="fa fa-money fa-3x"></i> 
        	            <span style="right: 50px; position: absolute; font-size: 18px;">Payable Amount: Rs. <span id="payable-amount"><?php echo $payable; ?></span></span>
        	            <input type="hidden" id = "payable" value="<?php echo $payable; ?>">
        	        </div>
        	    </div>
        	    
            	    <?php 
        	            getPaymentModes( $dbh, $orderID );
        	        ?>
        	        
        	        
    	    
        	    
        	</div>
        </section>
    </div>
    <div class="payment-panel-container"  style="display: none;">
        <div class="payment-box text-center">
            <table id="noteHolder" width="100%">
                 
                  <tr>
                  	<td width="20%" style="padding:5px;">
                    	<table width="100%" class="note" id="leftSideNote">
                        
                        	<tr align="center" valign="middle">
                            	<td>1</td></tr><tr align="center" valign="middle">
                            	<td>2</td></tr><tr align="center" valign="middle">
                            	<td>5</td></tr><tr align="center" valign="middle">
                            	<td>10</td></tr><tr align="center" valign="middle">
                            	<td>20</td>
                            </tr>
                        </table>
                    </td>
                  	<td width="60%" align="center">
                    <table width="100%">
                        <tr align="center" valign="middle" class="numPadTop">
                          <td class="numPadTopRow" ><span id="cashPadInput" >0.0 </span></td>
                          
                        </tr>
                      </table>
                    	<div align="right">
                  <table width="100%" id="cashPadTop">
                    <tr align="center">
                      <td width="22%" id="numPadPlus" title="Click to activate addition mode.">+</td>
                      <td width="22%" id="numPadMinus" title="Click to activate subtraction mode.">-</td>
                    </tr>
                  </table>
                </div>
                <table id="numPad" class="numPad" style="background:#ffc" width="96%">
                  <tr><td colspan="2" align="right" valign="middle" style="font-size:24px; padding-right:10px" id="numPadAmount" class="numPadTopRow"></td><td id="numPadOK">OK</td></tr>
                  <tr align="center">
                    <td> 1 </td>
                    <td> 2 </td>
                    <td> 3 </td>
                  </tr>
                  <tr align="center">
                    <td> 4 </td>
                    <td> 5 </td>
                    <td> 6 </td>
                  </tr>
                  <tr align="center">
                    <td> 7 </td>
                    <td> 8 </td>
                    <td> 9 </td>
                  </tr>
                  <tr valign="middle" align="center">
                    <td class="" > . </td>
                    <td> 0 </td>
                    <td class="numPadX" id="numPadX"> x
                      <input type="hidden" id="selectedRow" value="0" /></td>
                  </tr>
                </table>
                    </td>
                  	<td width="20%"  style="padding:5px;">
                    	<table width="100%" class="note" id="rightSideNote">
                        	<tr align="center" valign="middle" >
                            	<td>50</td></tr><tr align="center" valign="middle">
                            	<td>100</td></tr><tr align="center" valign="middle">
                            	<td>200</td></tr><tr align="center" valign="middle">
                            	<td>500</td></tr><tr align="center" valign="middle">
                            	<td>2000</td>
                            </tr>
                        </table>
                    </td>
                  </tr>
                </table>
                <input type="hidden" id="operatorSelector" value="+" />
                <input type="button" class="btn btn-default"  value="Close" style="width:40%" id="close-cashpad" />
                <input type="button" class="btn btn-success" value="Done" style="width:40%" id="done-cashpad" data-target = "" />
        </div>
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