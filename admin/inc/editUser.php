<?php
if(isset($_POST) && !empty($_POST)){

	if(isset($_POST) && count($_POST) > 0 ){
			$post=$_POST;
			$check=md5(implode('', $_POST));
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				$x=editUser($dbh, $post);
				if($x) $_SESSION['check']=$check;

			}

	}
}
/////////////////////////////////////////Fetch Part//////////////////////////////////////////////////////
if( isset($_GET['id']) ){
    $product = getUserDataSingle( $dbh, $_GET['id'] );
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
                    <div class="panel-heading"> <i class="clip-stats"></i> Edit User
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-big-container">
                            <form action="./?option=editUser&id=<?php echo $_GET['id'];?>" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
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
                                  <label class="col-sm-2 control-label" for="co_name">Username:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" autocomplete="Off" tabindex="1" value="<?php echo $username;?>" disabled>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Role:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <select name="role" id="" class="form-control">
                                        <option value="0">Select One</option>
                                        <option value="admin"  <?php if($role=='admin') echo 'selected';?>>Admin</option>
                                        <option value="office"  <?php if($role=='office') echo 'selected';?>>Manager</option>
                                        <option value="pos"  <?php if($role=='pos') echo 'selected';?>>Sales</option>
                                        <option value="cook"  <?php if($role=='cook') echo 'selected';?>>Cook</option>
                                        <option value="display"  <?php if($role=='display') echo 'selected';?>>Display</option>
                                    </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Status:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="myfunnel-switch-light"  data-id="active" data-type="switch" type="checkbox"  value="1" <?php echo ( $status == 1 ) ? 'checked="checked"' : ''; ?>>
            			            <input type="hidden" id="active" name="status" value="<?php echo $status ?>" />
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
        
