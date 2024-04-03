<?php include('includes/header.php'); ?>

<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">Join us</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<?php if(isset($_GET['done'])) { ?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_GET['done'] ?>
				</div>
			<?php } ?>
			<form method="post" action="includes/controller.php" id="contactform">
				<div class="form">
					<div class = "row">
						<div class = "col-sm-6">
							<input type="text" name="FName" placeholder="First Name *">
						</div>
						<div class = "col-sm-6">
							<input type="text" name="LName" placeholder="Last Name *">
						</div>
					</div>
					<input type="text" name="Email" placeholder="Your E-mail Address *">
					<div class = "row">
						<div class = "col-sm-6">
							<input list = "Gender" name = "Gender" autocomplete = "off" placeholder = "Select Gender e.g Male, Female or Other"  >
							<datalist id = "Gender" >
								<option value="Male">Male</option>
								<option value="Female">Female</option>
								<option value="Other">Other</option>
							</datalist>
						</div>
						<div class = "col-sm-6">
							<input type="text" name="Contact" placeholder="Contact e.g. +44********** without 0">
						</div>
					</div>
					<input list = "Role" name = "Role" autocomplete = "off" placeholder = "Select Role *"  >
					<datalist id = "Role" >
						<option value="Beginner">Beginner</option>
						<option value="Professional">Professional</option>
					</datalist>
					<div class = "row">
						<div class = "col-sm-6">
						<small>Your Date of birth *</small>
						<input type="Date" value = "" name="DOB">
						</div>
						<div class = "col-sm-6" style = "margin-top: 28px">
							<input type="text" name="Profession" placeholder="Your profession *">
						</div>
					</div>
					<textarea col = "2" row = "2" name= "Address" placeholder  ="Your current address *"></textarea>
					<div class = "row">
						<div class = "col-sm-6">
							<input type="password" name="Password" placeholder="Password *">
						</div>
						<div class = "col-sm-6">
							<input type="password" name="ConfirmPassword" placeholder="Confirm Password *">
						</div>
					</div>
					<input type="submit" id="register" name = "register" class="clearfix btn" value="Register">
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</section>

<?php include('includes/footer.php'); ?>