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

  </head>

  <body>
    <div class="body">
      <div class="login-box">
                      <div class="login-heading">
                          <h3 class="login-title">User Registration</h3>
                      </div>
                      <div class="login-body">
                          <form role="form" method="post" enctype="multipart/form-data" action="./?option=register" class="login-form">
                              <fieldset>
                                  <div class="input-group">
                                      <input autocomplete="off" class=""  name="mobile" type="text" required maxlength="10" value="<?php echo ( isset( $post['mobile'] ) ) ? $post['mobile'] : ''; ?>" >
                                      <span> Mobile No. </span>
                                  </div>
                                  <div class="input-group" style="margin-bottom: 25px;">
                                      <input class=""  name="email" type="email"  value="<?php echo ( isset( $post['email'] ) ) ? $post['email'] : ''; ?>"  required>
                                      <span> Email </span>
                                  </div>
                                  <div class="input-group" style="margin-bottom: 25px;">
                                      <input class=""  name="name" type="text"  value="<?php echo ( isset( $post['name'] ) ) ? $post['name'] : ''; ?>"  required>
                                      <span> Name </span>
                                  </div>
                                  <div class="input-group">
                                      <input autocomplete="off" class=""  name="pin" type="text" required maxlength="4"  value="<?php echo ( isset( $post['pin'] ) ) ? $post['pin'] : ''; ?>" >
                                      <span> PIN </span>
                                  </div>
                                  <div class="input-group">
                                      <input autocomplete="off" class=""  name="cpin" type="text" required maxlength="4"  value="<?php echo ( isset( $post['cpin'] ) ) ? $post['cpin'] : ''; ?>" >
                                      <span>Confirm PIN </span>
                                  </div>
                                  <div class="radio-wrapper">
                                    <div class="input-radio">
                                        <input autocomplete="off" class=""  name="courseID" type="radio" required value="0" <?php echo ( isset( $post['courseID'] ) && $post['courseID'] == 0) ? 'selected = "selected"' : ''; ?> >
                                      <label >
                                          UG
                                      </label>
                                    </div>
                                    <div class="input-radio">

                                        <input autocomplete="off" class=""  name="courseID" type="radio" required value="1" <?php echo ( isset( $post['courseID'] ) && $post['courseID'] == 1 ) ? 'selected = "selected"' : ''; ?> >
                                      <label >
                                          PG
                                      </label>
                                    </div>
                                    <span> Applying For </span>
                                  </div>
                                  <div class="input-group">
                                    <input type="submit" class="" value="Register" />
                                  </div>
                              </fieldset>
                          </form>
                      </div>

                        <div class="login-body">
                        <form role="form" method="post" action="./" class="login-form">
                          <fieldset>
                            <a href="./?option=login">
                              <span class="register-icon"></span>Already have Account <span>Login</span>
                            </a>
                          </fieldset>
                        </form>
                      </div>
                  </div>
    </div>
    <div class="msg-bg error">
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
