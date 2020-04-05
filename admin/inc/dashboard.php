<?php
	$college = rst_info($dbh);
	if(!$college) $college= array_fill_keys(array('name', 'address', 'logo', 'favicon', 'email', 'mobile'),'');
?>

<?php include_once('./inc/header.php'); ?>
<body>
<?php include_once('./inc/header-nav.php'); ?>
<!-- start: MAIN CONTAINER -->
<div class="main-container">

	<?php include_once('./inc/sidebar.php'); ?>

  <!-- start: PAGE -->
  <div class="main-content">
    <div class="container" style="min-height: 760px;">
      <!-- start: PAGE HEADER -->
      <div class="row">
        <div class="col-sm-12">
          <!-- start: PAGE TITLE & BREADCRUMB -->
          <ol class="breadcrumb">
            <li> <i class="clip-pencil"></i> <a href="./index.php?option=dashboardContent"> <?php echo 'Dashboard </a>/<a href="./index.php?option='.$option.'"> '.splitWord(ucfirst($option)); ?> </a> </li>
            <li> <a href="#" target="_blank"> <i class="clip-info help_top_icon" title="Click here to see more help on this page!"></i> </a> </li>

            <!-- start: TIME -->
            <li class="pull-right"> <span class="date" style="padding: 0px 0px 0px 10px;">
              <timestamp id="date"><?php echo date('D, M d, Y'); ?></timestamp>
              </span>
              <div id="clock"><?php echo date('h:i:s A'); ?></div>
            </li>
            <!-- end: TIME -->
          </ol>
          <!-- end: PAGE TITLE & BREADCRUMB -->
          <!-- start: PAGE HEADER -->
          <div class="page-header">
            <h1><?php echo ($option!='') ?splitWord(ucfirst($option)):'Dashboard'; ?> </h1>
          </div>
        </div>
      </div>
      <!-- end: PAGE HEADER -->

      <script>
			    jQuery(document).ready(function ()
			    {

			        jQuery("#close_link").click(function ()
			        {
			            jQuery("#message_box").fadeOut(1000);
			            jQuery("#message_box").removeClass('ok');
			        });
			    });
			</script>

      <!--site header-->

      <!-- start: PAGE CONTENT -->
      <?php
			  if($option==''){
				include_once('./inc/dashboardContent.php');
			  }
			  else if($option!==''){
				  if(file_exists('./inc/'.$option.'.php')){
					  include_once('./inc/'.$option.'.php');
				  }
				  else{
					  include('./inc/error.php');
				  }
			  }

		  ?>
  	</div>
    <!-- end: PAGE CONTAINER -->
  </div>
  <!-- end : PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<?php include_once('./inc/footer.php'); ?>
