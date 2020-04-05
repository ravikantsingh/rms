<?php

if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=addDiscount($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}
?>
<div class="row">
    <div class="col-sm-12 sm-fifty">
        <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> Discount Management
                <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
            </div>
            <div class="panel-body">
                <div class="flot-big-container">
                    <form action="./?option=addDiscount" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Label:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" name="name" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Rate:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" name="rate" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Type:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <select class="form-control" name="type" >
                                <option value="Percentage">Percentage</option>    
                                <option value="Flat">Flat</option>    
                            </select>
                          </div>
                        </div>
                         <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Criteria:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <select class="form-control" name="criteria" id="criteria" >
                                <option value="Flat">Flat</option>    
                                <option value="MCV">Min. Cart Value</option>    
                            </select>
                          </div>
                        </div>
                        <div class="form-group hidden" id="criteria_value">
                          <label class="col-sm-2 control-label" for="co_name">Min. Cart Value:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="text" name="cart_value" autocomplete="Off" tabindex="1" value="0">
                          </div>
                        </div>
                        
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Activation Date:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="date" name="active_date" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        <div class="form-group">
                          <label class="col-sm-2 control-label" for="co_name">Expire Date:<font color="#ff0000">*</font> </label>
                          <div class="col-sm-3">
                            <input class="form-control" type="date" name="expire_date" autocomplete="Off" tabindex="1" value="">
                          </div>
                        </div>
                        
                         <div class="form-group">
                            <label class="col-sm-2 control-label" for="co_name">Status:<font color="#ff0000">*</font> </label>
                            <div class="col-sm-3">
                                <input class="myfunnel-switch-light"  data-id="active" data-type="switch" type="checkbox"  value="1" checked>
            			        <input type="hidden" id="active" name="active" value="1" />
                            </div>
                        </div>
                        <div class="form-group">
                          <div class="col-sm-5 text-right">
                            <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="date"/>
                            <input class="btn btn-success" type="submit" name="submit" value="Add Discount">
                          </div>
                        </div>
                    </form>
                </div>
            </div>
           
        </div>
    </div>
</div>
<script type="text/javascript">
    $('#criteria').change( function(){
        var $this = $(this);
        if( $this.val() == 'MCV' ){
            $('#criteria_value').removeClass( 'hidden' );
        }
        else{
            $('#criteria_value').addClass( 'hidden' );
        }
    });
</script>