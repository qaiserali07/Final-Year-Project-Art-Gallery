<?php

	if($AuctionData['Total']>0)
	{
		echo '<section class="content-block" style="background-color:#00bba7;">
		<div class="container text-center">
			<div class="row">
				<div class="col-sm-10 col-sm-offset-1">
					<div class="item" data-scrollreveal="enter top over 0.4s after 0.1s">
						<h1 class="callactiontitle"> Exhibition is just stated! hurry up book your <span class="callactionbutton"><i class="fa fa-gift"></i> ART</span>
						</h1>
					</div>
				</div>
			</div>
		</div>
		</section>';
	}


?>


<div class="footer text-center">
	<div class="container">
		<div class="row">
			<p class="footernote">
				 Connect with Art Gallary
			</p>
			<ul class="social-iconsfooter">
				<li><a href="tel:#"><i class="fa fa-phone"></i></a></li>
				<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
				<li><a href="#"><i class="fab fa-twitter"></i></a></li>
			</ul>
			<p>
				 &copy; 2020 Art Gallary<br/>
			</p>
		</div>
	</div>
</div>

<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="includes/logout.php">Logout</a>
        </div>
      </div>
    </div>
</div>

<script src="js/jquery-.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/anim.js"></script> 	
<script src="js/validate.js"></script> 
<script src="js/all.js"></script> 
<script>  
jQuery(document).ready(function ($) {
	$('.fadeshop').hover(
		function(){
			$(this).find('.captionshop').fadeIn(150);
		},
		function(){
			$(this).find('.captionshop').fadeOut(150);
		}
	);
});
</script>
	
</body>
</html>