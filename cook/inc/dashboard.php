<?php
	$college = rst_info($dbh);
	if(!$college) $college= array_fill_keys(array('name', 'address', 'logo', 'favicon', 'email', 'mobile'),'');
?>

<?php include_once('./inc/header.php'); ?>
<body>
<!-- start: MAIN CONTAINER -->
<div class="main-container">


  <!-- start: PAGE -->
  <!-- <div class="main-content"> -->
    <div class="container" style="min-height: 760px;">



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
  <!-- </div> -->
  <!-- end : PAGE -->
</div>
<!-- end: MAIN CONTAINER -->
<?php include_once('./inc/footer.php'); ?>
