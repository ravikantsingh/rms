<?php

if(!isset($_SESSION)) session_start();
if(isset($_POST['mobile']) && isset($_POST['email']) && isset($_POST['pin']) && isset($_POST['cpin']) ){

	//////////////////////////Varius level of data Validation//////////////////////////////

	$ok=!checkArrayForEmpty($_POST);
	$ok=($ok && is_numeric($_POST['mobile']) && strlen($_POST['mobile'])==10)?true:false;
	$ok=($ok && is_numeric($_POST['pin']) && strlen($_POST['pin'])==4)?true:false;
	$ok=( $ok && $_POST['pin'] == $_POST['cpin'] )?true:false;
	$post=trimArray($_POST);
	///////////////////////////////////////////////////////////////////////////////////////
	if($ok){
    $date=date('Y-m-d H:i:s');
    ////////////////////////////////////
		$sqlCheck=$dbh->prepare("SELECT * FROM `main` WHERE `mobile`= ?");
		$runCheck=$sqlCheck->execute(array($post['mobile']));
		$count=$sqlCheck->rowCount();
		if($count==0 && $date<=REGISTRATION_CLOSED_DATE){
        ///////////////////////////////////////////////////////////////////////////////////

        $tp=password();
        $epassword = password_hash($tp,PASSWORD_DEFAULT);
        $ip='';
        if(isset($_SERVER['REMOTE_ADDR'])) $ip=$_SERVER['REMOTE_ADDR'];
            $message="Dear ".$post['name']." , Your Login Details are: Password: ".$tp." Keep it safe and Don't Share.";
    
            $sql=$dbh->prepare("INSERT INTO `main`(`sname`, `courseID`, `mobile`,`email`,`mpin`,`ip`, `password`, `reg_date`) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    		$run=$sql->execute(array($post['name'], $post['courseID'], $post['mobile'], $post['email'], $post['pin'], $ip, $epassword, $date));
  			if($run){
  			        
  			        $enrollmentBase = getEnrollmentBase( $dbh ) ;
  			        $sql=$dbh->prepare("UPDATE `main` SET  `enrollment`= `id` + $enrollmentBase WHERE `mobile` = ? ");
            		$run=$sql->execute( array( $post['mobile'] ) );
            		if($run && $sql->rowCount()){
            			
    					// include_once('./classes/notifications.php');
    					// $ntf = new Notifications( $dbh );
    					// $title = "Account registration complete.";
    					// $notification = "Dear ".$post['name'].", you have successfully registered your account with us. Make sure to complete your form on tiime and submit.";
    					// $ntf->insertNotification( $notification, $title, $enrollment );
    
    					require('./classes/sms/Textlocal.class.php');
    
    					$Textlocal = new Textlocal('balliaunique@gmail.com', '3fcb901304a5777b712551cece5462a5c7ccdfc8c1c2d539a9b431fb45ed53c9');
    
    					$numbers = array($post['mobile']);
    					$sender = 'THKEXM';
    					$message = 'Hi, Thank you for registering with '.$college['name'].'. Your Password is '.$tp.'.';
    
    					$response = $Textlocal->sendSms($numbers, $message, $sender);
    					$_SESSION['msg']  = 'Your account is successfully registered. We have send a SMS on the number you provided
    					with password to login.';
    					$_SESSION['msg-status'] = 'success';
    					header('location: '.HOST.'?option=login');
            		}
  			}
  			else{
  				$msg = 'Some Problem Occured While Making Your registration.';
        }
        /////////////////////////////////////////////////////////////////////////////////
      }
			else{
				$msg = ( $date<=REGISTRATION_CLOSED_DATE ) ? 'It seems this number is already registered with us. Try with different number.' : 'Registration is closed.';
			}
	}
	else{
		$msg = 'Information you provided, is wrong in some way. Your registration was not successfull.';
	}

}
