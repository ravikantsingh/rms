
<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$range = ( isset( $post['range'] ) ) ? $post['range'] : 'today';
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if( isset( $action ) ){
				    switch( $action ){
				        case 'print':
				            include_once('../printer/send_cart_item.php');
				            $x = true;
				            break;
				    }
				}
				
				if($x) $_SESSION['check']=$check;

			}

	}
}
 if(isset($_POST) && !empty($_POST) ||  $tableMode == 1){
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
				    include_once('../printer/send_cart_item.php');
				}

			}

	}
	elseif(isset($_POST) && count($_POST) > 0 && isset( $_POST['showCart'] ) ){
	    $orderID = $_POST['orderID'];
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
        	    $mode =getSettings($dbh, 'table_mode');
        	    if( $mode != 1){
        	        $payable = getCart( $dbh, $orderID );
        	    }
        	    else{
        	        getCartTable( $dbh );
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
<?php 
}