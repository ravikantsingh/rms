<?php
    if( $range == 'custom' ){
        $range = array( 'custom', $from, $to);
    }
?>
<div class="row">
	<div class="tab-pane" role="tabpanel">
		<div class="col-sm-12 sm-fifty">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="flot-big-container">
						<form method="post" action="<?php echo "?option=".$option; ?>"  class="text-center" style="float: left; margin-left: 3px;" >
						    <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 ) ); ?>">
                            <input type="hidden" name="range" value="today">
                            <input type="submit" class="btn btn-default" value="Today">
						</form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: left; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="yesterday">
                            <input type="submit" class="btn btn-default" value="Yesterday">
                        </form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: left; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="thisweek">
                            <input type="submit" class="btn btn-default" value="This Week">
                        </form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: left; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="lastweek">
                            <input type="submit" class="btn btn-default" value="Last Week">
                        </form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: left; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="thismonth">
                            <input type="submit" class="btn btn-default" value="This Month">
                        </form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: left; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="lastmonth">
                            <input type="submit" class="btn btn-default" value="Last Month">
                        </form>
						<form class="text-center" action="<?php echo "?option=".$option; ?>" method="post"  style="float: right; margin-left: 3px;">
                            <input type="hidden" name="token" value="<?php echo md5( date('YmdHis').$option.rand( 10, 1000 )  ); ?>">
                            <input type="hidden" name="range" value="custom">
                            <label>From </label><input type="date" name="from" value="<?php echo ( isset( $from ) ) ? $from : ''; ?>" />
                            <label>To </label><input type="date" name="to" value="<?php echo ( isset( $from ) ) ? $to : ''; ?>">
                            <input type="submit" class="btn btn-default" value="Get">
                        </form>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>