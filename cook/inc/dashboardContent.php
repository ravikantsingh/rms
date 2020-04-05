<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if(isset($_POST['tableMode'])){
				$x=markAsPreparedTable( $dbh,$_POST['delivered'], $order_id,$_POST['product_id']);
				if($x) $_SESSION['check']=$check;    
				    }
				else{
				$x=markAsPrepared( $dbh, $order_id);
				if($x) $_SESSION['check']=$check;
				}
			}

	}
}
$mode = getSettings( $dbh, 'table_mode' );
?>

<div class="row">
	<div class="tab-pane   '.$class.'" id="nav-'.$result['slug'].'" role="tabpanel" aria-labelledby="nav-'.$result['slug'].'-tab">'.
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<?php if($mode==0) echo getOrderList( $dbh ); else echo getCartList($dbh);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
