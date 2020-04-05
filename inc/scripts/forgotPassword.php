<?php

if(!isset($_SESSION)) session_start();
if(isset($_POST['mobile']) ) { //&& isset($_POST['pin'])  ){

	//////////////////////////Varius level of data Validation//////////////////////////////

	$ok=!checkArrayForEmpty($_POST);
	$ok=($ok && is_numeric($_POST['mobile']) && strlen($_POST['mobile'])==10)?true:false;
	//$ok=($ok && is_numeric($_POST['pin']) && strlen($_POST['pin'])==4)?true:false;
	$post=trimArray($_POST);
	if( isRecaptchaEnabled( $dbh ) ){
        $res = ( isset( $_POST['g-recaptcha-response'] ) ) ? post_captcha( $dbh, $_POST['g-recaptcha-response']) : false;
        if( !$res ){
          $ok = false;
        }
      }
	///////////////////////////////////////////////////////////////////////////////////////
	if($ok){
    $date=date('Y-m-d H:i:s');
    ////////////////////////////////////
		$sqlCheck=$dbh->prepare("SELECT * FROM `main` WHERE `mobile`= ?");
		$runCheck=$sqlCheck->execute(array($post['mobile']));
		$count=$sqlCheck->rowCount();
		$result = $sqlCheck->fetch( PDO::FETCH_ASSOC );
		if( $count==1 ){ //&& $post['pin'] == $result['mpin'] ){
        ///////////////////////////////////////////////////////////////////////////////////

        $tp = password();
        $epassword = password_hash($tp,PASSWORD_DEFAULT);
        $ip='';
        if(isset($_SERVER['REMOTE_ADDR'])) $ip=$_SERVER['REMOTE_ADDR'];
        // $message="Dear ".$post['name']." , Your Login Details are: Password: ".$tp." Keep it safe and Don't Share.";

        $sql=$dbh->prepare("UPDATE `main` SET `password` = ? WHERE `mobile` = ?");
    		$run=$sql->execute( array( $epassword, $post['mobile'] ) );
  			if($run){
					// include_once('./classes/notifications.php');
					// $ntf = new Notifications( $dbh );
					// $title = "Account registration complete.";
					// $notification = "Dear ".$post['name'].", you have successfully registered your account with us. Make sure to complete your form on tiime and submit.";
					// $ntf->insertNotification( $notification, $title, $enrollment );

          //sendSms($post['mobile'],$message);

					require('./classes/sms/Textlocal.class.php');

					$Textlocal = new Textlocal('balliaunique@gmail.com', '3fcb901304a5777b712551cece5462a5c7ccdfc8c1c2d539a9b431fb45ed53c9');

					$numbers = array($post['mobile']);
					$sender = 'THKEXM';
					//$message = 'Hi, Thank you for registering with '.$college['sms_name'].'. Your Password is '.$tp.'.';
                    $message = 'Hi '.getStudentNameFromMobile( $dbh,  $post['mobile'] ).', Your new password for login in '.$college['sms_name'].' is '.$tp.'. Please change it after login.';
					$response = $Textlocal->sendSms($numbers, $message, $sender);
					/////////////////////////////////////////////////////////////
					
				    include_once('./classes/notifications.php');
                      $ntf = new Notifications( $dbh );
                      $title = "Attempt For Password Reset";
                      $enrollment = fetchField( $dbh,  'main', 'enrollment', '`mobile` = '.$post['mobile']);
                      $m = ( $enrollment != NULL ) ? fetchField( $dbh,  'main', 'gender', '`enrollment` = '.$enrollment) : 'Mr./Ms.';
                      if( $m != 'Mr./Ms.' ) $m = ( $m == 'Female' ) ? 'Ms.' : 'Mr.';
                      $notification = "Greatings! <br /> ".$m." ".getStudentNameFromMobile( $dbh,  $mobile ).",<br />
                      Your password reset was successful. We recommend you to update your password using combinations that are hard to guess.
                      Try using combination of letters,
                      numbers and special characters.
                      Keep length of password atleast 8 characters.
                      And frequently change your password.<br />If this password reset attempt was not done by you someone has your pin.";
                      $ntf->insertNotification( $notification, $title, $enrollment );
                      $ntf->sendNotificationfunction($enrollment, $title, $notification);
					
					/////////////////////////////////////////////////////////////
					$_SESSION['msg']  = 'Your Password reset is successful. We have send a SMS to the registered number with password to login.';
					$_SESSION['msg-status'] = 'success';
					header('location: '.HOST.'?option=login');
  			}
  			else{
  				$msg = 'Some Problem Occured While Making Your registration.';
        }
        /////////////////////////////////////////////////////////////////////////////////
      }
			else{
				$msg =  'Could not reset your password. Please contact Administration.' ;
			}
	}
	else{
		$msg = 'Information you provided, is wrong in some way. Your Password Reset was not successful.';
	}

}
