<!DOCTYPE html>
<html lang="en">
  <head prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta content="article"property="og:type">
    <meta content="<?php echo HOST; ?>"property="og:url">
    <meta content="<?php echo OG_TITLE; ?>"property="og:title">
    <meta content="<?php echo OG_DESCRIPTION ?>"property="og:description">
    <meta content="<?php echo OG_IMG ?>"property="og:image">

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Authentication Panel</title>

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link href="./login/css/login.css" rel="stylesheet">
    <?php echo ( isRecaptchaEnabled( $dbh ) ) ? '<script src="https://www.google.com/recaptcha/api.js" async defer></script>' : ''; ?>
 
  </head>

  <body>
    <div class="body">
      <div class="login-box">
                      <div class="login-heading">
                          <h3 class="login-title">Forgot Password</h3>
                      </div>
                      <div class="login-body">
                          <form role="form" method="post" enctype="multipart/form-data" action="./?option=forgotPassword" class="login-form">
                              <fieldset>
                                  <div class="input-group">
                                      <input autocomplete="off" class=""  name="mobile" type="text" required maxlength="10">
                                      <span> Mobile No. </span>
                                  </div>
                                  <!--<div class="input-group">-->
                                  <!--    <input class=""  name="pin" type="password" value="" required>-->
                                  <!--    <span> PIN </span>-->
                                  <!--</div>-->
                                  <!--<a href="./?option=login"><span class="forget-password-icon"></span>To Go to Login Page <span>Click Here</span></a>-->
                                  
                                  <div class="input-group">
                                      <div class="g-recaptcha" data-sitekey="<?php echo getReCaptchaSiteKey( $dbh ); ?>"></div>
                                  </div>
                                  <div class="input-group">
                                    <input type="submit" class="" value="Reset My Password" />
                                  </div>
                              </fieldset>
                          </form>
                      </div>
                      <?php if($college['registration']){?>
                        <div class="login-body">
                        <form role="form" method="post" action="./" class="login-form">
                          <fieldset>
                            <a href="./">
                              <span class="register-icon"></span>To Go to Login Page <span>Click Here</span></span>
                            </a>
                          </fieldset>
                        </form>
                      </div>
                    <?php } ?>
                  </div>
    </div>
    <div class="msg-bg <?php echo (isset($msgStatus) && !empty($msgStatus)) ? $msgStatus : 'error'; ?>">
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
