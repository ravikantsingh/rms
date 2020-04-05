<?php
if( isset( $_GET['activate'] ) ){
    $id=$_GET['activate'];
    $x = updateTableField( $dbh, 'payment_mode', 'active', 1, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully activated.' : 'Some problem occurred.';
}
if( isset( $_GET['deactivate'] ) ){
    $id=$_GET['deactivate'];
    $x = updateTableField( $dbh, 'payment_mode', 'active', 0, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully deactivated.' : 'Some problem occurred.';
}
if( isset( $_GET['delete'] ) ){
    $id=$_GET['delete'];
    $x = updateTableField( $dbh, 'payment_mode', 'deleted', 1, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully deleted.' : 'Some problem occurred.';
}
$data = getPaymentModeTable( $dbh );
?>
 <div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> View Payment Mode
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            
            <div class="panel-body">
                <div class="flot-big-container">
                    <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">
                                <caption>Payment Mode Details</caption>
                                <tr class="th">
                                    <th>S.No</th>
                                    <th>Payment Mode</th>
                                    <th>Slug</th>
                                    <th>Status</th>
                                    <th>Edit</th>
                                    <th>Activate</th>
                                </tr>
                                <?php echo $data;?>
                            </table>

                </div>
            </div>
        </div>
    </div>
</div>