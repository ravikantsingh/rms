<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=markAsPrepared( $dbh, $order_id);
				if($x) $_SESSION['check']=$check;

			}

	}
}
?>

<div class="row">
    <div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<h1 class="text-center">Welcome To <?php echo $college['name']; ?></h1>
						<h2 class="text-center"><?php echo $college['address']; ?></h2>
					</div>
				</div>
			</div>
		</div>
	<div class="tab-pane" id="" role="tabpanel" aria-labelledby="">
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container" id="displayList" >
						<?php echo getOrderListDisplay( $dbh ); ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
