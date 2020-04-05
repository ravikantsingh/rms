<?php
$range = 'today';
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$range = ( isset( $post['range'] ) ) ? $post['range'] : 'today';
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if( isset( $action ) ){
				    switch( $action ){
				        case 'print':
				            include_once('../printer/send_item.php');
				            $x = true;
				            break;
				        case 'deliver':
				            $x = markAsDelivered( $dbh, $orderID);
				            break;
				        case 'cancel':
				            $x = cancelOrder( $dbh, $orderID);
				            break;
				    }
				}
				
				if($x) $_SESSION['check']=$check;

			}

	}
}
?>
<?php @include_once( './inc/dateMenu.php' ); ?>
<div class="row">
	<div class="tab-pane   '.$class.'" id="nav-'.$result['slug'].'" role="tabpanel" aria-labelledby="nav-'.$result['slug'].'-tab">'.
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<?php echo getOrderListPOS( $dbh, $_SESSION['user_id'], $range, 'pending' ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
