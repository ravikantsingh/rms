<?php


if( isset( $_GET['activate'] ) ){
    $id=$_GET['activate'];
    $x = updateTableField( $dbh, 'category', 'active', 1, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully activated.' : 'Some problem occurred.';
}
if( isset( $_GET['deactivate'] ) ){
    $id=$_GET['deactivate'];
    $x = updateTableField( $dbh, 'category', 'active', 0, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully deactivated.' : 'Some problem occurred.';
}
if( isset( $_GET['delete'] ) ){
    $id=$_GET['delete'];
    $x = updateTableField( $dbh, 'category', 'deleted', 1, 'id', $id  );
	$msg = ( $x ) ? 'Product successfully deleted.' : 'Some problem occurred.';
}
$data = getCategoryTable( $dbh );
?>
 <div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> View Category
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>

            <div class="panel-body">
                <div class="flot-big-container">
                    <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">
                                <caption>Category Details</caption>
                                <tr class="th">
                                    <th>S.No</th>
                                    <th>Name</th>
                                    <th>Slug</th>
                                    <th>Parent</th>
                                    <th>Status</th>
                                    <th>Creation Date</th>
                                    <th>Update Date</th>
                                    <th>Edit</th>
                                    <th>Activate</th>
                                    <th>Delete</th>
                                </tr>
                                <?php echo $data;?>
                            </table>

                </div>
            </div>
        </div>
    </div>
</div>
