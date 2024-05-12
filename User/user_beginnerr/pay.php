<?php 
    include('includes/header.php'); 
    $ID = $_GET['ID'];
?>

<div class="card">
    <form class="needs-validation" novalidate="" action = "includes/controller.php" method = "POST"  enctype = "multipart/form-data">
        <div class="card-header">
            <h4>Pay for art....</h4>
        </div>
        <div class="card-body">
            <div class="form-group mb-0">
                <label>Please pay on following accounts details and upload slip....</label>

                <input name="AID" hidden value="<?php echo $ID ?>">
                <div>
                        <b>
                        Bank: Revolut
                        <br>
                        Sort Code: 04-29-09
                        <br>
                        Account#: 03189198
                        </b>
                </div>
                </textarea>
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
            <button name= "pay" class="btn btn-primary">Submit</button>
            <a class="btn btn-info" href = "../../Exibition_Art_Detail.php?ID=<?php echo $ID ?>">View art</a>
        </div>
    </form>
</div>





<?php include('includes/footer.php'); ?>