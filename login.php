<?php 
	include('includes/header.php');
	$email = '';
	if(isset($_GET['username']))
	{
		$email=$_GET['username'];
	}
?>

<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems">Welcome back!</h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fab fa-star"></i>
			<i class="fab fa-star"></i>
			<i class="fab fa-star"></i>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-8 col-lg-offset-2">
			<?php if(isset($_GET['done'])) { ?>
				<div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					Welcome to artist community! you are ready to go please login
				</div>
			<?php } if(isset($_GET['error404'])) { ?>
				<div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					User not found! seems email or password is incorrect
				</div>
			<?php } if(isset($_GET['mesg'])) { ?>
				<div class="alert alert-info">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_GET['mesg'] ?>
				</div>
			<?php }  ?>
			<form method="post" action="includes/controller.php" id="contactform">
				<div class="form">
					<input type="text" name="Username" value = "<?php echo $email?>" placeholder="User name *">
					<input type="password" name="Password" placeholder="Password *">
					<input type="submit" id="login" name = "login" class="clearfix btn" value="Login">
				</div>
			</form>
		</div>
	</div>
</div>
</div>
</section>

<?php include('includes/footer.php'); ?>