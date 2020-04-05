<?php

if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=addExpense($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}
?>
<div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> Daily Expense Ledger
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            <div class="panel-body">
                <div class="flot-big-container">
                    <form action="./?option=addExpense" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Expense:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" name="expense" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Amount:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" name="amount" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-5 text-right">
                            <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="date"/>
                            <input type="hidden" value="<?php echo $_SESSION['user_id'];?>" name="user_id"/>
                            <input class="btn btn-success" type="submit" name="submit" value="Save Expense">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>
<?php
if( isset( $_GET['delete'] ) ){
    $id=$_GET['delete'];
    $x = updateTableField( $dbh, 'daily_expense', 'deleted', 1, 'id', $id  );
	$msg = ( $x ) ? 'Expense successfully deleted.' : 'Some problem occurred.';
}

$data = getExpenseTable( $dbh );
?>
<div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> Daily Expense Ledger
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            
            <div class="panel-body">
                <div class="flot-big-container">
                    <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">
                                <caption>Daily Expense Ledger on <?php echo date("Y-m-d")?></caption>
                                <tr class="th">
                                    <th>S.No</th>
                                    <th>Expense</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Added By</th>
                                    <th>Delete</th>
                                </tr>
                                <?php echo $data;?>
                            </table>

                </div>
            </div>
        </div>
    </div>
</div>
