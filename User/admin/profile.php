<?php 
  
  include('includes/header.php'); 
  include('includes/config.php'); 

  $UID = $_SESSION['ID'];
  $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
  $getUser = $User->fetch_assoc();

  $Gallary = $conn->query("SELECT * FROM `tbl_description` WHERE `ID` = 1");
  $getGallary = $Gallary->fetch_assoc();

  $getUserArt = $conn->query("SELECT * FROM `tbl_paintings` WHERE `UID`  = $UID");
?>

<section class="section">
          <div class="section-body">
            <div class="row mt-sm-4">
              <div class="col-12 col-md-12 col-lg-4">
                <div class="card author-box">
                  <div class="card-body">
                    <div class="author-box-center">
                      <img alt="image" src="images/User.png" class="rounded-circle author-box-picture">
                      <div class="clearfix"></div>
                      <div class="author-box-name">
                        <p><?php echo $getUser["FirstName"]." ".$getUser['LastName'] ?></p>
                      </div>  
                      <div class="author-box-job"><?php echo $getUser["Profession"] ?></div>
                    </div>
                  </div>
                </div>
                <div class="card">
                  <div class="card-header">
                    <h4>Personal Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                      <p class="clearfix">
                        <span class="float-left">
                          Birthday
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $getUser["DOB"] ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Gender
                        </span>
                        <span class="float-right text-muted">
                        <?php 
                          if($getUser["Gender"]=="M")
                          {
                            echo "Male";
                          }
                          else if($getUser["Gender"]=="F"){
                            echo "Female";
                          }
                          else{
                            echo "Other";
                          }
                        ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Phone
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $getUser["Contact"] ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Mail
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $getUser["Email"] ?>
                        </span>
                      </p>
                      <p class="clearfix">
                        <span class="float-left">
                          Address
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $getUser["Address"] ?>
                        </span>
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-12 col-md-12 col-lg-8">
                <div class="card">
                  <div class="padding-20">
                    <ul class="nav nav-tabs" id="myTab2" role="tablist">
                      <li class="nav-item">
                        <a class="nav-link active" id="post-tab" data-toggle="tab" href="#posts" role="tab"
                          aria-selected="true">Edit</a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#settings" role="tab"
                          aria-selected="false">Gallary</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                    <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="post-tab">
                        <form method="post" action = "includes/controller.php" class="needs-validation" novalidate="">
                          <div class="card-header">
                            <h4>Edit Profile</h4>
                          </div>
                          <div class="card-body">
                            <?php if(isset($_GET['error404'])) { ?>
                                <div class="alert alert-danger">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Something wents wrong! Error 404
                                </div>        
                            <?php } ?>
                            <?php if(isset($_GET['done'])) { ?>
                                <div class="alert alert-success">
                                    <button type="button" class="close" data-dismiss="alert">×</button>
                                    Hurry! Profile updated
                                </div>        
                            <?php } ?>
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>First Name</label>
                                <input type="text" name=  "FirstName" value = "<?php echo $getUser["FirstName"] ?>" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Please fill in the first name
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Last Name</label>
                                <input type="text" name=  "LastName" value = "<?php echo $getUser["LastName"] ?>" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Please fill in the last name
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-7 col-12">
                                <label>Email</label>
                                <input type="email" readonly class="form-control" value = "<?php echo $getUser["Email"] ?>" name = "Email" required="">
                                <div class="invalid-feedback">
                                  Please fill in the email
                                </div>
                              </div>
                              <div class="form-group col-md-5 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" value = "<?php echo $getUser["Contact"] ?>" name="Contact" required="">
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label>Address</label>
                                <textarea
                                  class="form-control summernote-simple" name="Address" required=""><?php echo $getUser["Address"] ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <input type = "submit" value = "Save Changes" class="btn btn-primary" name = "Update_Profile" >
                          </div>
                        </form>
                      </div>
                    <div class="tab-pane fade show " id="settings" role="tabpanel" aria-labelledby="profile-tab2">
                        <form method="post" action = "includes/controller.php" class="needs-validation" novalidate="">
                          <div class="card-header">
                            <h4>Edit Gallary</h4>
                          </div>
                          <div class="card-body">
                            <div class="row">
                              <div class="form-group col-md-6 col-12">
                                <label>Title</label>
                                <input type="text" name=  "Title" value = "<?php echo $getGallary["Title"] ?>" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Please fill in the Title
                                </div>
                              </div>
                              <div class="form-group col-md-6 col-12">
                                <label>Subtitle</label>
                                <input type="text" name=  "Subtitle" value = "<?php echo $getGallary["Subtitle"] ?>" class="form-control" required="">
                                <div class="invalid-feedback">
                                  Please fill in the Subtitle
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-md-4 col-12">
                                <label>Facebook</label>
                                <input type="link" class="form-control" value = "<?php echo $getGallary["Facebook"] ?>" name = "Facebook" required="">
                                <div class="invalid-feedback">
                                  Please fill in the Facebook link
                                </div>
                              </div>
                              <div class="form-group col-md-4 col-12">
                                <label>Twitter</label>
                                <input type="link" class="form-control" value = "<?php echo $getGallary["Twitter"] ?>" name = "Twitter" required="">
                                <div class="invalid-feedback">
                                  Please fill in the Twitter link
                                </div>
                              </div>
                              <div class="form-group col-md-4 col-12">
                                <label>Phone</label>
                                <input type="tel" class="form-control" value = "<?php echo $getGallary["Contact"] ?>" name="Contact" required="">
                                <div class="invalid-feedback">
                                  Provide us the contact number for art
                                </div>
                              </div>
                            </div>
                            <div class="row">
                              <div class="form-group col-12">
                                <label>Tell us about your buyying process e.g. bitting etc</label>
                                <textarea
                                  class="form-control summernote-simple"  name="Buy" required=""><?php echo $getGallary["Buy"] ?></textarea>
                              </div>

                              <div class="form-group col-12">
                                <label>Tell us about your gifts</label>
                                <textarea
                                  class="form-control summernote-simple"   name="Gift" required=""><?php echo $getGallary["Gift"] ?></textarea>
                              </div>

                              <div class="form-group col-12">
                                <label>Tell us can we download your art is it legal?</label>
                                <textarea
                                  class="form-control summernote-simple" name="Downlaod"  required=""><?php echo $getGallary["Download"] ?></textarea>
                              </div>
                            </div>
                          </div>
                          <div class="card-footer text-right">
                            <input type = "submit" value = "Save Changes" class="btn btn-primary" name = "Update_Gallary" >
                          </div>
                        </form>
                      </div>
                  </div>
                </div>
              </div>
            </div>
  </div>
</section>

<?php include('includes/footer.php'); ?>