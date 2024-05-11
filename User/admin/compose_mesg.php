<?php 
    include('includes/header.php');
    include('includes/config.php');

    $UID = $_GET['ID']; 
    $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();
?>

<div class="">
    <div class="card">
        <div class="boxs mail_listing">
            <div class="inbox-center table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th colspan="1">
                              <div class="inbox-header">
                                Compose New Message
                              </div>
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
            <div class="row">
                      <div class="col-lg-12">
                        <form action = "includes/controller.php" method = "post" class="composeForm needs-validation" novalidate="">
                          <div class="form-group">
                          <label>To</label>
                            <div class="form-line">
                              <input type="text" id="email_address" readonly class="form-control" value = "<?php echo $getUser['FirstName']." ".$getUser['LastName'] ?>" placeholder="TO">
                              <input type="text" name = "TO" value = "<?php echo $getUser['ID'] ?>" hidden>
                            </div>
                          </div>
                          <div class="form-group">
                            <div class="form-line">
                              <input type="text" name = "sub" id="subject" class="form-control" placeholder="Subject (Optional)">
                            </div>
                          </div>
                          <label>Message</label>
                          <textarea id="ckeditor" name = "mesg" required row="4 " placeholder = "Enter your message here!" class="form-control summernote-simple"></textarea>
                          <br>
                          <input type = "submit" name="send_mesg" class="btn btn-info btn-border-radius waves-effect" value ="SEND">
                        </form>
                      </div>
                      
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('includes/footer.php'); ?>