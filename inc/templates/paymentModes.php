<div class="row ">
 <form  method="post" action="./?option=confirmOrder" id="confirmOrderForm" >
    <div class="cart-container">
        <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-body">
        <div class="flot-big-container">
            <?php
                $i = 1;
                
                $counter = 0;
	            foreach( $results as $result ){
	                if( $counter % 2 == 0 ){
	       ?>
	                     <div class="row" >
                            <?php }  ?>
                            <div class="col-sm-6 padding-10-hr margin-top">
                                <div class="card padding-5 checkbox-container" id="target-<?php echo $result['slug']; ?>" style="cursor: pointer;" data-id=" <?php echo $result['slug']; ?>">
                                    <div class="checkbox-mask" style="
                                            position: absolute;
                                            background-color: transparent;
                                            width: 100%;
                                            height: 100%;
                                            z-index: 1;
                                            " data-id="target-<?php echo $result['slug']; ?>" ></div>
                                     <i class="fa fa-check-circle-o product-added hide"></i>
                                
                                    <input type="hidden" id="<?php echo $result['slug']; ?>" data-name=" <?php echo $result['mode']; ?>" data-product-id=" <?php echo $result['id']; ?>"  />
                                    <div class="card-title card-label">
	                                    <?php echo $result['mode']; ?>
	                                </div>
                                    <div class="card-body min-height-75">
                                        <div class="col-sm-6">
                                        <img src="./images/modeLogo/<?php echo $result['slug']; ?>.png" class="payment-mode-img"/>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="text-center">
                                                <input class="myfunnel-switch-light" style="transform: scale( 0.6 );"  data-id="<?php echo $result['slug']; ?>" data-type="switch" data-clicked="0" type="checkbox"  value="1" >
                        			            <input type="hidden" id="<?php echo $result['slug']; ?>" name="<?php echo $result['slug']; ?>" value="" />
                                            </div>
                                            <div class="text-center">
                                                <input type="text" class="form-control" readonly name="<?php echo $result['slug']; ?>" id="amount-<?php echo $result['slug']; ?>" value=""/>
                                                
                                            </div>
                                        </div>
                	                </div>
	                                            
            	                </div>
        	                </div>
                            <?php
                		            $class = '';
                		            $counter++;
                		            if( $counter % 2 == 0 ){
                	                    
                        	?>
                        </div>
                        <?php   } ?>
    		      
    		    <?php } ?>
        </div>
        <input type="hidden" name = "orderID" value="<?php echo $orderID; ?>" />
        <input type="hidden" name = "date" value="<?php echo date( "Y-m-d H:i:s" ); ?>" />
        
            </div>
        </div>
    </div>
    </div>
    <div class="text-right padding-10-hr">
            <input type="button" class="btn btn-dark-grey" id="submit-pay-now"  value="Pay Now" />
        </div>
    
    </form>
</div>
