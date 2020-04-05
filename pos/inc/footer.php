
<div class="footer clearfix">
  <div class="col-sm-2"></div>
  <div class="footer-inner"> Perceptron © <?php echo date('Y'); ?>
    <div class="footer-items"> <span class="go-top"><i class="clip-chevron-up"></i></span> </div>
    - <a href="#" target="_blank" style="text-decoration: none; color: #169ac3;">Developed by Perceptron Software Solutions </a> </div>
</div>

<!--[if lt IE 9]>
<script src="./js/respond.min.js"></script>
<script src="./js/excanvas.min.js"></script>
<![endif]-->
<script src="./js/jquery-ui-1.10.2.custom.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./js/less-1.5.0.min.js"></script>
<script src="./js/bootstrap-colorpalette.js"></script>
<script src="./js/bootstrap-switch.min.js"></script>
<script src="./js/bootstrap-fileupload.min.js"></script>
<script src="./js/main.js"></script>
<script src="./js/admin.js"></script>
<script src="./js/util.js"></script>
<script src="./js/jquery.smartWizard.js"></script>
<script src="./js/jquery.flot.js" type="text/javascript"></script>
<script>
	jQuery(document).ready(function () {
		Main.init();
		Index.init();
		$(".core-box").addClass("slideUp");
		$(".badge").addClass("fadeIn");
                $('[data-toggle="tooltip"]').tooltip();
		//$(".panel").addClass("bigEntrance");

	});

        function hidealert(){
        $("#alert2").hide();
        }

</script>
<div id="notificator"></div>
<div class="message-container">
    <div  class="message-wrapper">
        <div  class="message-head">
        x
        </div>
        <div  class="message-body">
        yyy
        </div>
        <div  class="message-foot">
        <input type="button" class="btn btn-default" value="Okay"/>
        </div>
    </div>
</div>
</body>
</html>
