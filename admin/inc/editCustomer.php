<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=editCustomer($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}
/////////////////////////////////////////Fetch Part//////////////////////////////////////////////////////
if( isset($_GET['id']) ){
    $product = getCustomerDataSingle( $dbh, $_GET['id'] );
    if( $product ){
        foreach( $product as $key => $value ){
            $$key = $value;
        }
    }
}
//////////////////////////////////////////////////////////////////////////////////////////////////
?>
<div class="row">
            <div class="col-sm-12 sm-fifty">
                <div class="panel panel-default">
                    <div class="panel-heading"> <i class="clip-stats"></i> Edit Customer
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-big-container">
                            <form action="./?option=editCustomer&id=<?php echo $_GET['id'];?>" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Name:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="name" autocomplete="Off" tabindex="1" value="<?php echo $name;?>">
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Mobile:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" name="mobile" autocomplete="Off" tabindex="1" value="<?php echo $mobile;?>">
                                  </div>
                                </div>

                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Discount:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="myfunnel-switch-light"  data-id="discount" data-type="switch" type="checkbox"  value="1" <?php echo ( $discount == 1 ) ? 'checked="checked"' : ''; ?>>
            			            			<input type="hidden" id="discount" name="discount" value="<?php echo $discount ?>" />
                                  </div>
                                </div>

																<div class="form-group">
																	<label class="col-sm-2 control-label" for="co_name">Override All:<font color="#ff0000">*</font> </label>
																	<div class="col-sm-3">
																		<input class="myfunnel-switch-light"  data-id="oad" data-type="switch" type="checkbox"  value="1" <?php echo ( $oad == 1 ) ? 'checked="checked"' : ''; ?>>
																		<input type="hidden" id="oad" name="oad" value="<?php echo $oad ?>" />
																	</div>
																</div>
																<div class="form-group">
																	<label class="col-sm-2 control-label" for="co_name">Rate(%):<font color="#ff0000">*</font> </label>
																	<div class="col-sm-3">
																		<input class="form-control" type="text" name="rate" autocomplete="Off" tabindex="1" value="<?php echo $rate;?>">
																	</div>
																</div>
                                <div class="form-group">
                                  <div class="col-sm-5 text-right">
                                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="update_date" id="" class="btn btn-success"/>
                                    <input type="hidden" value="<?php echo $_GET['id'];?>" name="id" />
                                    <input class="btn btn-success" type="submit" name="submit" value="Confirm Edit">
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
