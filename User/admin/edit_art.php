<?php 
    include('includes/header.php');
    include('includes/config.php');

    $ID = $_GET['edit'];
    $GetArt = $conn->query("SELECT * FROM `tbl_paintings` WHERE `ID` = $ID");
    $Art = $GetArt->fetch_assoc();
?>

<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>Edit your vision!</h4>
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
                <input type="text" name = "Title" value="<?php echo $Art['PaintName'] ?>" class="form-control" required="">
                <input type="text" name = "PID" value="<?php echo $Art['ID'] ?>" class="form-control" hidden="">
                <div class="invalid-feedback">
                    What's your name?
                </div>
            </div>
            <div class="form-group mb-0">
                <label>Description</label>
                <textarea class="form-control summernote-simple" name = "Dis" value="" placeholder = "What do you wanna say? your memory about this or something importent about it"><?php echo $Art['Description'] ?></textarea>
            </div>
            
        </div>
        <div class="card-footer ">
            <button name= "edit_art" class="btn btn-primary">Save!</button>
        </div>
    </form>
</div>





<?php include('includes/footer.php'); ?>