<?php
if(isset($_POST) && !empty($_POST)){
	if(isset($_POST['name']) && isset($_POST['address']) && isset($_POST['email']) && isset($_POST['sms_name'])){
		if(!empty($_POST['name']) && !empty($_POST['address']) && !empty($_POST['email']) && !empty($_POST['sms_name'])){
			$post=$_POST;
			$logo=false; $favicon=false;
			$check=md5($_POST['name'].$_POST['address'].$_POST['email'].$_POST['sms_name'].$_POST['token']);
			if(!isset($_SESSION['check']) || $_SESSION['check']!=$check){
				if(isset($_FILES) && !empty($_FILES)){
					$file=array($_FILES['img_logo']);
					$logo=processFile($file, '../img/', 'logo.jpg');
					$file1=array($_FILES['favicon']);
					$favicon=processFile($file1, '../img/', 'favicon.ico');
					
				}
				if(!$logo){
					$tmp=explode('/',$college['logo']);
					$logo=array_pop($tmp);
				}
				if(!$favicon){
					$tmp=explode('/',$college['favicon']);
					$favicon=array_pop($tmp);
				}
				$x=updateRstInfo($dbh, $post, $logo, $favicon);
				if($x) $_SESSION['check']=$check;
			}
		}
	}
}
$college=rst_info($dbh);
if(!$college) $college= array_fill_keys(array('name', 'address', 'logo', 'favicon', 'contact', 'sms_name', 'reCaptcha', 'reCaptchaSiteKey', 'reCaptchaSecretKey', 'analyticsTrackerId'),'');

?>

 <div class="row">
        <div class="col-sm-12">
          <div class="panel panel-default">
            <ul class="nav nav-tabs tab-green">
              <li class=" active"> <a href="" data-toggle="tab">Restaurant Information</a> </li>
            </ul>
            <div class="tab-content">
              <input type="hidden" name="active_tab" id="active_tab" value="">
              <div class="tab-pane active" id="panel_tab3_example1">
                <div class="panel-heading"> <i class="fa fa-external-link-square"></i> Restaurant Information
                  <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a> <a class="btn btn-xs btn-link panel-refresh" href="#"> <i class="fa fa-refresh"></i> </a></div>
                </div>
                <div class="panel-body">
                  <form action="" role="form" class="smart-wizard form-horizontal" method="post" name="site_config"  enctype="multipart/form-data" accept-charset="utf-8" novalidate>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="co_name">Restaurant Name:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="name" autocomplete="Off" tabindex="1" value="<?php echo $college['name'];?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="college_address"> Restaurant Address:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <textarea class="form-control" name="address" id="college_address" tabindex="2" rows="6" cols="30" autocomplete="Off"><?php echo $college['address'];?></textarea>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Logo:</label>
                      <div class="fileupload fileupload-new col-sm-3" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;"><img src="<?php echo $college['logo'];?>" alt="" value="logo_login_page.png"> </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                        <div class="user-edit-image-buttons"> <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select Image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
                          <input type="file" id="img_logo" name="img_logo" tabindex="3" value="logo_login_page.png">
                          </span> <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload"> <i class="fa fa-times"></i>Remove </a> </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label"> Icon:</label>
                      <div class="fileupload fileupload-new col-sm-3" data-provides="fileupload">
                        <div class="fileupload-new thumbnail" style="width: 150px; height: 150px;"><img src="<?php echo $college['favicon'];?>" alt="" value="favicon.ico"> </div>
                        <div class="fileupload-preview fileupload-exists thumbnail" style="max-width: 150px; max-height: 150px; line-height: 20px;"></div>
                        <div class="user-edit-image-buttons"> <span class="btn btn-light-grey btn-file"><span class="fileupload-new"><i class="fa fa-picture"></i> Select Image</span><span class="fileupload-exists"><i class="fa fa-picture"></i> Change</span>
                          <input type="file" id="favicon" name="favicon" tabindex="4" value="favicon.ico">
                          </span> <a href="#" class="btn fileupload-exists btn-light-grey" data-dismiss="fileupload"> <i class="fa fa-times"></i>Remove </a> </div>
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="email">E-mail:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="email"  autocomplete="Off" tabindex="5" value="<?php echo $college['contact'];?>">
                      </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="img_logo">Name On SMS:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="sms_name" autocomplete="Off" tabindex="6" value="<?php echo $college['sms_name'];?>">
                        <span id="errmsg1"></span> </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="img_logo">Enable ReCaptcha:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="reCaptcha" autocomplete="Off" tabindex="6" value="<?php echo $college['reCaptcha'];?>">
                        <span id="errmsg1"></span> </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="img_logo">ReCaptcha Site Key:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="reCaptchaSiteKey" autocomplete="Off" tabindex="6" value="<?php echo $college['reCaptchaSiteKey'];?>">
                        <span id="errmsg1"></span> </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="img_logo">ReCaptcha Secret Key:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="reCaptchaSecretKey" autocomplete="Off" tabindex="6" value="<?php echo $college['reCaptchaSecretKey'];?>">
                        <span id="errmsg1"></span> </div>
                    </div>
                    <div class="form-group">
                      <label class="col-sm-2 control-label" for="img_logo">Google Analytics Tracker ID:<font color="#ff0000">*</font> </label>
                      <div class="col-sm-3">
                        <input class="form-control" type="text" name="analyticsTrackerId" autocomplete="Off" tabindex="6" value="<?php echo $college['analyticsTrackerId'];?>">
                        <span id="errmsg1"></span> </div>
                    </div>
                    <div class="form-group">
                      <div class="col-sm-2 col-sm-offset-2">
                      	<input type="hidden" value="<?php echo md5(date('Yhisd')); ?>" name="token" />
                        <button class="btn btn-bricky" name="site" type="submit" value="Update" tabindex="7"> Update </button>
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
     

<script src="../js/utils.js"></script>