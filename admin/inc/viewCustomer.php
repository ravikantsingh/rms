<?php

if( isset( $_GET['forcePass'] ) ){
    $password=md5('12345');
    $id=$_GET['forcePass'];
    $update_date=date("Y-m-d H:i:s");
    $x = updateTableField( $dbh, 'user_log', 'password', $password, 'id', $id  );
    if( $x ) updateTableField( $dbh, 'user_log', 'update_date', $update_date, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully activated.' : 'Some problem occurred.';
}
    $data = getCustomerTable( $dbh );
?>
 <div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> View User
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>

            <div class="panel-body">
                <div class="flot-big-container">
                    <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">
                                <caption>User Details</caption>
                                <tr class="th">
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>Discount</th>
                                    <th>Override</th>
                                    <th>Rate</th>
                                    <th>Action</th>
                                    
                                </tr>
                                <?php echo $data;?>
                            </table>

                </div>
            </div>
        </div>
    </div>
</div>
