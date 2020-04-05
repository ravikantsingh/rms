<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=updatePaymentSettings($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}


if(isset( $_GET['subtab'] ) ){
	switch ($_GET['subtab']) {
		case 'payu':
			include_once('./inc/payu.php');
			break;
		case 'paytm':
			include_once('./inc/paytm.php');
			break;
		case 'ccav':
			include_once('./inc/ccav.php');
			break;
		default:
			// code...
			break;
	}
}
else{
?>
<style>
#searchfield {
	float: left;
	margin: 0px 0px 0px 0px;
}
#searchfield ul {
	width: auto;
	overflow: hidden;
}
#searchfield ul li {
	float: left;
	margin: 0px 0px 0px 5px;
	list-style: none;
}
.searchfilter {
	padding: 3px 0px 0px 0px;
	color: #355999;
	font-weight: bold;
}
#batch-searchfield {
	float: left;
}
div.pagination {
    padding: 6px;
    margin: 3px 0px 0px 0px;
    text-align: center;
    float: right;
}
#displayitem {
    width: auto;
    margin: 0 0 0 0px;
}
#displayitem2 {
    float: right;
    color: #355999;
    font-size: 8pt;
    margin: 3px 10px 0 10px;
    padding: 2px 0 4px 0px;
}
#displayitem1 {
    float: right;
    color: black;
    font-size: 8pt;
    margin: 10px 0 0 0px;
}
#displayitem4 {
    float: left;
    color: black;
    font-size: 8pt;
    margin: 2px 7px 0 0px;
}
div.pagination a {
    padding: 2px 5px 2px 5px;
    margin-right: 2px;
    font-size: 11px;
    text-decoration: none;
    color: #aaa;
    background: url(../images/nextback.jpg) repeat-x;
}
.displayfield {
    width: 65px;
    height: 22px;
    font-size: 8pt;
    border: 1px #b0b0b0 solid;
    padding: 3px 2px;
}
select{
    background-color: #FFFFFF;
    border: 1px solid #e2e2e4;
    border-radius: 4px !important;
    color: #858585;
    font-family: inherit;
    font-size: 14px;
    line-height: 1.2;
    padding: 5px 4px;
    transition-duration: 0.1s;
    box-shadow: none;
		min-width: 185px;
}
.card {
    position: relative;
    display: -webkit-box;
    display: -ms-flexbox;
    display: flex;
    -webkit-box-orient: vertical;
    -webkit-box-direction: normal;
    -ms-flex-direction: column;
    flex-direction: column;
    min-width: 0;
    word-wrap: break-word;
    background-color: #191c20;
    background-clip: border-box;
    border: 1px solid rgba(0, 0, 0, 0.125);
    border-radius: 0.25rem;
}
.card-body {
    -webkit-box-flex: 1;
    -ms-flex: 1 1 auto;
    flex: 1 1 auto;
    padding: 1.25rem;
}
.card-body a{
	display: block;
	text-decoration: none;
	color: #fff;
	text-align: center;
	text-transform: uppercase;
	font-size: 20px;
}
.grid-margin {
    margin-bottom: 10px;
}
</style>

<div class="row">
  <div class="col-sm-12 sm-fifty">
    <div class="panel panel-default">
      <div class="panel-heading"> <i class="fa fa-gear"></i> Payment Settings
        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
      </div>
      <div class="panel-body">
        <div class="flot-big-container">


                <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">

                <tbody>
                <?php

                $gatewayData = getPaymentSettings( $dbh );
								$gatewayList = array(
									'payu',
									'paytm',
									'ccav',
								);
								$select = '<select name= "gateway"  class="">';
								foreach ($gatewayList as $list) {
									$select .= '<option value= "'.$list.'" '.( ( $list == $gatewayData['gateway'] ) ? 'selected = "selected"' : '' ).'> '.$list.' </option>';
								}
								$select .= '</select>';
								?>
									<tr>
											<td align="center">
													<form action="./?option=paymentSettings" method="post" enctype="multipart/form-data" class="smart-wizard form-horizontal">


													<?php
													foreach($gatewayData as $list => $value){
														if( $list == 'gateway' ){
															echo '<div class="form-group">
																<label  class="col-sm-6 control-label"> '. strtoupper($list).' </label>'.$select.'</div>';
														}
														else{
					                ?>
													<div class="form-group">
														<label  class="col-sm-6 control-label"> <?php echo str_replace('_', ' ', strtoupper($list)); ?> </label>
														<input class="" type="text" name="<?php echo $list; ?>" value="<?php echo $value?>" />
													</div>


					                    <?php
															}
														}
					                    ?>
															<input type="hidden" name="token" value="<?php echo md5(date('hiYdms').rand(0,9999));?>" />

															<input type="submit" value="Save" class="btn btn-bricky " />
													</form>
											</td>
									</tr>
                </tbody>
            </table>

        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="col-sm-12 sm-fifty">
    <div class="panel panel-default">
      <div class="panel-heading"> <i class="fa fa-gear"></i> Gateway Settings
        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
      </div>
      <div class="panel-body">
        <div class="flot-big-container">
					<?php foreach ($gatewayList as $gateway): ?>
						<div class="col-md-4 grid-margin stretch-card">
	    				<div class="card">
								<div class="card-body">
									<a href="./?option=paymentSettings&subtab=<?php echo $gateway; ?>"> <?php echo $gateway; ?> </a>
								</div>
							</div>
						</div>
					<?php endforeach; ?>

        </div>
      </div>
    </div>
  </div>
</div>

</body></html>
<?php } ?>
