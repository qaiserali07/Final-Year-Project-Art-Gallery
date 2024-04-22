<?php 
    include('includes/header.php'); 
?>

<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>share your vision!</h4>
        </div>
        <div class="card-body">
            <div class="form-group">
                <label>Paint Title</label>
                <input type="text" name = "Title" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your name?
                </div>
            </div>
            <div class="form-group">
                <label>Demand price</label>
                <input type="text" name = "Price" class="form-control" required="">
                <div class="invalid-feedback">
                    What's your name?
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Description (What do you wanna say? your memory about this or something importent about it) Optional</label>
                <textarea class="form-control summernote-simple" name = "Dis" placeholder = ""></textarea>
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
            <button name= "apply_exibition" class="btn btn-primary">Submit</button>
        </div>
    </form>
</div>





<?php include('includes/footer.php'); ?>