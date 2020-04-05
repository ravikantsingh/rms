<div class="row">
    <div class="col-sm-6">
        <section id="tabs">
        	<div class="container" style="border: none;">
        	    <div class="row">
        	        <div class="cart"><i class="fa fa-cart-plus fa-3x"></i></div>
        	    </div>
        	    <div class="row cart-container">
        	        <form id="creatCartForm" method="post">
            	        <div class="cart-content">
            	            
            	        </div>
            	        <input type="hidden" name = "orderID" value="<?php echo generateRandomString( 4 ) .'-'. generateRandomString( 6 ).'-'.generateRandomString( 3 ); ?>" />
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
