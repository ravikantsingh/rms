<?php
    $orderID = generateRandomString( 4 ) .'-'. generateRandomString( 6 ).'-'.generateRandomString( 3 );
    
    if( $tableMode == 1){
        if( isset( $_POST['orderID'] ) ){
            $orderID = $_POST['orderID'];
        }
    }
?>
<div class="row">
    <div class="col-sm-6">
        <section id="tabs">
        	<div class="container" style="border: none;">
        	    <div class="row">
        	        <div class="cart"><i class="fa fa-cart-plus fa-3x"></i></div>
        	    </div>
        	    <div class="row cart-container">
        	        <form id="creatCartForm" method="post">
        	            <div class="row">
                        	<div class="tab-pane" role="tabpanel">
                        		<div class="col-sm-12 sm-fifty">
                        			<div class="panel panel-default">
                        				<div class="panel-body">
                        					<div class="flot-big-container">
                        						
                                                    <input type="hidden" name="token" value="<?php echo md5( rand( 10 , 100 ).date('YmdHis') ); ?>"  />
                                                    <input type="hidden" id="tableModeFlag" value="<?php echo ($tableMode==1)?1:0; ?>"  />
                                                    
                                                    <div class="row" >
                                                        <?php if( $tableMode!=1 ){?>
                                                        <div class="col-sm-3">
                                                            <input type="text" class="form-control" name="mobile"  id="mobile" value="" placeholder="Mobile" />
                                                        </div>
                                                        <div class="col-sm-3"> <input type="text" class="form-control" name="customer_name"  id="customer_name" value="" placeholder="Name"  /> </div>
                                                        <?php }?>
                                                        <div class="col-sm-3"> 
                                                            <select class="form-control" name="mode" >
                                                                <option value="Dine-In"> Dine-In </option>
                                                                <option value="Delivery"> Delivery </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-sm-3"> 
                                                            <?php
                                                            echo ( $tableMode == 1) ? getTables(getTableNoFromOrderId($dbh,$orderID)) : '<input type="hidden" name="table"  id="table" value="0"   />';
                                                            ?>
                                                        </div>
                                                        
                                                    </div>
                                                    <div class="row" id="search_result" >
                                                        
                                                    </div>
                                                    
                                                
                        					</div>
                        				</div>
                        			</div>
                        		</div>
                        	</div>
                        </div>
            	        <div class="cart-content">
            	            
            	        </div>
            	        <input type="hidden" id = "action" value="<?php echo ( $tableMode == 1 ) ? './?option=tables' : './?option=cart'; ?>" />
            	        
            	        <input type="hidden" name = "orderID" value="<?php echo $orderID; ?>" />
            	        <input type="hidden" name = "date" value="<?php echo date( "Y-m-d H:i:s" ); ?>" />
        	        </form>
        	        <div class="cart-total text-right ">
        	            <span id="cart-total-label"> Total : Rs. </span>
        	            <span id="cart-total"> 0 </span>
        	        </div>
        	    </div>
        	    <div class="text-right">
        	        <input type="button" class="btn btn-dark-grey" id="clearTheCart" value="Clear The Cart" />
        	        <input type="button" class="btn btn-dark-grey" id="creatCart" value="Checkout" />
        	    </div>
        	</div>
        </section>
    </div>
    <div class="col-sm-6">
        <section id="tabs">
        	<div class="container" style="border: none;">
        		<!--<h6 class="section-title h1">Menu</h6>-->
        		<div class="row">
        			<div class="col-xs-12 ">
        				<span class="scroll-left"><i class="fa fa-chevron-circle-left" aria-hidden="true"></i></span>
        				    <span class="scroll-right"><i class="fa fa-chevron-circle-right" aria-hidden="true"></i></span>
        					<nav>
        				    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        						<?php echo getTabMenu( $dbh, 'category' );  ?>
        					</div>
        				</nav>
        				<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
        					<?php echo getTabContent( $dbh, 'category'); ?>
        				</div>
        			
        			</div>
        		</div>
        	</div>
        </section>
    </div>
</div>
