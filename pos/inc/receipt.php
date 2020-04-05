<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if( isset( $action ) ){
				    switch( $action ){
				        case 'print':
				            if( $orderID != '' ){
    				            include_once('../printer/send_item.php');
    				            $x = true;
				            }
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
<div class="row">
	<div class="tab-pane" role="tabpanel">
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<form class="text-center" action="./?option=receipt" method="post">
                            <input type="hidden" name="token" value="<?php echo md5( rand( 10 , 100 ).date('YmdHis') ); ?>"  />
                            <input type="hidden" name="action" value="print"  />
                            <div class="row" >
                                <div class="col-sm-4">
                                    <label class="label-chart"> Order ID </label>
                                </div>
                                <div class="col-sm-4"> <input type="text" class="form-control" name="orderID" value=""  /> </div>
                                <div class="col-sm-4"> <input type="submit" class="btn btn-default" value="Print Receipt" /></div>
                            </div>
                            
                            
                          </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
