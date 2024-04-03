<?php 
    include('includes/header.php'); 
?>

<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>Upload your vision!</h4>
        </div>
        <div class="card-body">
            <?php if(isset($_GET['error'])) { ?>
                <div class="alert alert-danger">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_GET['error'] ?>
				</div>        
            <?php } ?>
            <?php if(isset($_GET['hurry'])) { ?>
                <div class="alert alert-success">
					<button type="button" class="close" data-dismiss="alert">×</button>
					<?php echo $_GET['hurry'] ?>
				</div>        
            <?php } ?>
            <div class="form-group">
                <label>Paint Title</label>
                <input type="text" name = "Title" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your name?
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Description (What do you wanna say? your memory about this or something importent about it) Optional</label>
                <textarea class="form-control summernote-simple" name = "Dis" placeholder = "What do you wanna say? your memory about this or something importent about it"></textarea>
            </div>
            <div class="form-group mb-0">
                <label>Upload</label>
                <div class="custom-file">
                      <div class="col-sm-12 col-md-7">
                        <div id="image-preview" class="image-preview">
                          <label for="image-upload" id="image-label">Choose File</label>
                          <input type="file" name = "Art"  required = "" id="image-upload" />
                        </div>
                      </div>
                </div>
            </div>
            
        </div>
        <div class="card-footer ">
            <button name= "upload_art" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>





<?php include('includes/footer.php'); ?>