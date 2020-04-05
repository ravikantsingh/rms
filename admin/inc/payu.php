<?php

?>
<div class="row">
  <div class="col-sm-12 sm-fifty">
    <div class="panel panel-default">
      <div class="panel-heading"> <i class="fa fa-gear"></i> PAYU Settings
        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
      </div>
      <div class="panel-body">
        <div class="flot-big-container">


                <table class="table table-striped table-hover table-full-width table-bordered" style="white-space:nowrap;">

                <tbody>
                <?php

                $gatewayData = getPaymentSettings( $dbh, 'payu' );
								?>
									<tr>
											<td align="center">
													<form action="./?option=paymentSettings" method="post" enctype="multipart/form-data" class="smart-wizard form-horizontal">


													<?php
													foreach($gatewayData as $list => $value){

					                ?>
													<div class="form-group">
														<label  class="col-sm-6 control-label"> <?php echo str_replace('_', ' ', strtoupper($list)); ?> </label>
														<input class="" type="text" name="<?php echo $list; ?>" value="<?php echo $value?>" />
													</div>


					                    <?php

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
