<?php include('includes/header.php'); ?>

<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>Change your authentication</h4>
        </div>
        <div class="card-body">
            <?php if(isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_GET['error'] ?>
				</div>        
            <?php } ?>
            <div class="form-group">
                <label>Provide your email</label>
                <input type="text" name = "Email" placeholder = "Your account email!" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your email?
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Old Password</label>
                <input type="password" name = "Old_password" placeholder = "Your account email!" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your old password?
                </div>
            </div>
            <div class="form-group mb-0">
                <label>New Password</label>
                <input type="password" name = "New_password" placeholder = "Your account email!" class="form-control" required="">
                <div class="invalid-feedback">
                    Set your new password!
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Confirm Password</label>
                <input type="password" name = "Confirm_password" placeholder = "Your account email!" class="form-control" required="">
                <div class="invalid-feedback">
                    Confirm your new password
                </div>
            </div>
        </div>
        <div class="card-footer ">
            <button name= "Change_Password" class="btn btn-primary">Change password</button>
        </div>
    </form>
</div>


<?php include('includes/footer.php'); ?>