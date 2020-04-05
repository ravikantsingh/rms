<!--
Author: Agent_Smith
Author URL: https://think-exam.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<html lang="en">
<head>
<title><?php echo $college['name'];?> Admission <?php echo date('Y'); ?></title>
<link rel="icon" href="./images/favi.png" sizes="32x32" type="image/png">
 <!-- Meta-Tags -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="utf-8">
    <meta name="keywords" content="<?php echo $college['name'];?> Admission, AMS <?php echo date('Y'); ?>, Admission <?php echo date('Y'); ?> <?php echo $college['name'];?> ">
    <script>
        addEventListener("load", function () {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta-Tags -->
	
	<!-- css files -->
	<link href="css/zzfont-awesome.min.css" rel="stylesheet" type="text/css" media="all">
	<link href="css/zzstyle.css" rel="stylesheet" type="text/css" media="all"/>
	<!-- //css files -->
	
	<!-- google fonts -->
	<link href="//fonts.googleapis.com/css?family=Raleway:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
	<!-- //google fonts -->
	
</head>
<body>

<div class="signupform">
	<div class="container">
		<!-- main content -->
		<div class="agile_info">
			<div class="w3l_form">
				<div class="w3_info">
					<h2><?php echo $college['name'];?></h2>
					<p>Student Registration</p>
					  <p>Only For Selected Subjects*</p>
					<form role="form" method="post" enctype="multipart/form-data" action="./?option=register" class="login-form">
						<label>Mobile No.</label>
						<div class="input-group">
							<span class="fa fa-phone" aria-hidden="true"></span>
							<input autocomplete="off" class=""  name="mobile" type="text" placeholder="Enter Mobile No" required maxlength="10" value="" >
						</div>
						<label>Email ID</label>
						<div class="input-group">
							<span class="fa fa-envelope" aria-hidden="true"></span>
							<input class=""  name="email" type="email"  value=""  placeholder="Enter Email ID" required>
						</div>
						<label>Name</label>
						<div class="input-group">
							<span class="fa fa-user" aria-hidden="true"></span>
							<input class=""  name="name" type="text"  value=""  placeholder="Enter Your Name" required>
						</div>
						<!--<label>PIN</label>-->
						<!--<div class="input-group">-->
						<!--	<span class="fa fa-lock" aria-hidden="true"></span>-->
						<!--	<input autocomplete="off" class=""  name="pin" type="text" required maxlength="4"  placeholder="Enter PIN" value="" >-->
						<!--</div> -->
						<!--<label>Confirm PIN</label>-->
						<!--<div class="input-group">-->
						<!--	<span class="fa fa-lock" aria-hidden="true"></span>-->
						<!--	<input autocomplete="off" class=""  name="cpin" type="password" required maxlength="4"  placeholder="Confirm PIN" value="" >-->
						<!--</div>-->
						<!--<p>Note:- This 4 Digit PIN will be required at the time of Password Recovery.</p>-->
						<label>Applying For</label>
						<div class="input-group table" >
							<div class="subject_radio">
    							<span>UG</span>
    							<input autocomplete="off" class=""  name="courseID" type="radio" required value="0"  >
							</div>
							<div class="subject_radio">
    							<span>PG</span>
    							<input autocomplete="off" class=""  name="courseID" type="radio" required value="1"  >
							</div>
						</div>  
						<input type="hidden" name="pin" value="1234"/>
						<input type="hidden" name="cpin" value="1234"/>
						 					 
							<button class="btn btn-danger btn-block" type="submit">Register</button >                
					</form>
				</div>
			</div>
			<div class="w3_info">
				<h2><?php echo $college['name'];?> Login to your Account</h2>
				<p>Enter your details to login. Online Counselling Fee Payment</p>
				<form role="form" method="post" enctype="multipart/form-data" action="./" class="login-form">
					<label>Mobile No.</label>
					<div class="input-group">
						<span class="fa fa-phone" aria-hidden="true"></span>
						<input autocomplete="off" class=""  name="mobile" type="text" placeholder="Enter Mobile No" required maxlength="10">
					</div>
					<label>Password</label>
					<div class="input-group">
						<span class="fa fa-lock" aria-hidden="true"></span>
						<input class=""  name="password" type="password" value="" placeholder="Enter Password" >
					</div>
					<p>OR</p>
					<label>Date Of Birth</label>
					<div class="input-group">
						<span class="fa fa-calendar" aria-hidden="true"></span>
						<input class=""  name="dob" type="date" value="" placeholder="Enter DOB" >
					</div>
					<div class="login-check">
						 <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i> </i> Remember me</label>
					</div>						
						<button class="btn btn-danger btn-block" type="submit">Login</button >                
				</form>
				<!--<p class="account">By clicking login, you agree to our <a href="#">Terms & Conditions!</a></p>-->
				 <p class="account1">Forgot Password <a href="./?option=forgotPassword">Click Here</a></p> 
			</div>
		</div>
		<!-- //main content -->
	</div>
	<!-- footer -->
	<div class="footer">
		<p>&copy; 2019 Admission Management System. All Rights Reserved | Powered by <a href="https://think-exam.com/" target="blank">Perceptron Software Solution LLP.</a></p>
	</div>
	<!-- footer -->
</div>
  <div class="msg-bg <?php echo ( isset( $msgStatus ) && $msgStatus == 'success' )? 'success' : 'error';  ?>">
      <div class="msg-body">
        <?php echo (isset($msg) && !empty($msg)) ? $msg : ''; ?>
      </div>
    </div>
      <!-- jQuery -->
      <script src="./js/jquery.min.js"></script>
      <?php echo (isset($msg) && !empty($msg)) ? '<script type="text/javascript">
                                                    $(document).ready(function(){
                                                      $(\'.msg-bg\').addClass("open");
                                                      setTimeout(function(){
                                                        $(\'.msg-bg\').removeClass("open");
                                                      }, 10000);
                                                    });
                                                  </script>' : ''; ?>
</body>
</html>