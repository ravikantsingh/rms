<?php
    $college=college($dbh);
    $url=explode("/",$_SERVER['REQUEST_URI']);
    if( $url[2] == 'cpadmin' || $url[1]=='cpadmin')
    $page_name='CP-Admin Login';
    else
    $page_name='College Official Login';
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Welcome To <?php echo $college['name']; ?></title>

    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../css/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../css/sb-admin-2.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
     <link rel="shortcut icon" type="image/png" href="<?php echo $college['favicon']; ?>">
</head>

<body style="background-color: #dedede;">

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    
                    <div class="row panel-heading" style= " margin: 0;">
                        <div class = "col-sm-6">
                            <a class="navbar-brand" href="#" style = "padding : 0;"> <img src="<?php echo $college['logo'] ?>" style="width:130px; height:40px;" class="logo"> </a>
                        </div>
                        <div class = "col-sm-6">
                            <h2 style="text-align: center; padding: 6px 0px"  class="panel-title" ><?php echo $page_name;?></h2>
                        </div>
                    </div>
                    <div class="panel-body">
                        <form role="form" method="post" enctype="multipart/form-data" action="./">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="User Name" name="username" type="text" autofocus required maxlength="20">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" required>
                                </div>
                                <button  class="btn btn-lg btn-primary btn-block" value="Let Me In " >Let Me In  <i class="fa fa-sign-in" aria-hidden="true"></i>
 </button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery -->
    <script src="../js/jquery.min.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="../js/metisMenu.min.js"></script>

    <!-- Custom Theme JavaScript -->
    <script src="../js/sb-admin-2.js"></script>

</body>

</html>