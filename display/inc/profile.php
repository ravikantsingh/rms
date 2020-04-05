<?php
    
if(isset($_POST['submitName']))
{
    $name=$_POST['name'];
    $mobile=$_POST['mobile'];
    $update_date=$_POST['update_date'];
    $id='1';
    //$id=$_SESSION['id'];
    $sqlCheck=$dbh->prepare("UPDATE `user_log` SET `name`= ?,`mobile`= ?,`update_date`= ? WHERE `id`= ?");
	$runCheck=$sqlCheck->execute(array($name, $mobile, $update_date, $id));
	$count=$sqlCheck->rowCount();
	if($runCheck && $count >0){
		//return true;
		echo "Updated";
	}
	else{
		//return false;
		echo "Failed";
	}
}
if(isset($_POST['submitPass']))
{
    $npass=$_POST['npass'];
    $rtpass=$_POST['rtpass'];
    if($npass==$rtpass){
        $id='1';
        //$id=$_SESSION['id'];
        $update_date=date("Y-m-d h:i:s");
        $sqlCheck=$dbh->prepare("UPDATE `user_log` SET `password`= ?,`update_date`= ? WHERE `id`= ?");
    	$runCheck=$sqlCheck->execute(array(md5($npass), $update_date, $id));
    	$count=$sqlCheck->rowCount();
    	if($runCheck && $count >0){
    		//return true;
    		echo "Password Updated";
    	}
    	else{
    		//return false;
    		echo "Failed";
    	}
    }
    else{
        echo 'Both Password Did Not Match';
    }
}
?>
<div class="row">
            <div class="col-sm-12 sm-fifty">
                <div class="panel panel-default">
                    <div class="panel-heading"> <i class="clip-stats"></i> Add User
                        <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-big-container">
                            <form action="./?option=profile" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
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
                                    <select class="form-control" id="" disabled>
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
                                  <div class="col-sm-5 text-right">
                                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="update_date" id="" class=""/>
                                    <input class="btn btn-success" type="submit" name="submitName" value="Update">
                                  </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="flot-big-container">
                            <form action="./?option=profile" role="form" class="smart-wizard form-horizontal" method="post"  enctype="multipart/form-data" accept-charset="utf-8" name="formPass">
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">New Password:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" autocomplete="Off" tabindex="1" name="npass">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <label class="col-sm-2 control-label" for="co_name">Confirm Password:<font color="#ff0000">*</font> </label>
                                  <div class="col-sm-3">
                                    <input class="form-control" type="text" autocomplete="Off" tabindex="1"  name="rtpass">
                                  </div>
                                </div>
                                
                                <div class="form-group">
                                  <div class="col-sm-5 text-right">
                                    <input type="hidden" value="<?php echo date("Y-m-d H:i:s");?>" name="update_date" id="" class=""/>
                                    <input class="btn btn-success" type="submit" name="submitPass" value="Update">
                                  </div>
                                </div>
                                
                        </div>
                    </div>
                </div>
            </div>
        </div>