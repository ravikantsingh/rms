<?php
/////////////includes////////////////////////////////////
include_once('../../inc/scripts/config.php');
include_once('../../inc/scripts/functions.php');
include_once('../../inc/scripts/header.php');
include_once('../../inc/scripts/sessionTimeout.php');
/////////////////////////////////////////////////////////

$uin=$_SESSION['uin'];
?>


<div class="row">
<div class="col-sm-12 sm-fifty">
          <div class="panel panel-default">
            <div class="panel-heading"> <i class="clip-stats"></i> Warning!
              <div class="panel-tools"> <a class="btn btn-xs btn-link panel-collapse collapses" href="#"> </a>  </div>
            </div>
            <div class="panel-body">
              <div class="flot-medium-container"> 
<h1 style="background:#D10508; color:#FFF; padding:3px 5px; text-align:center">Unauthorized Access Detected...</h1>
<h2 style="background:#D10508; color:#FFF; padding:3px 5px; text-align:center">Such activities may result in termination of<br/> your acount!</h2>
</div>
</div>
</div>
</div>
</div>

<script src="../js/utils.js"></script>