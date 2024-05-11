<?php 
  
  include('includes/header.php'); 
  include('includes/config.php'); 

  $UID = $_GET['ID'];
  $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
  $getUser = $User->fetch_assoc();


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
                        <p><?php echo $getUser["FirstName"].$getUser['LastName'] ?></p>
                      </div>  
                      <div class="author-box-job"><?php echo $getUser["Profession"] ?></div>
                    </div>
                    <div class="text-center">
                      <a href="compose_mesg.php?ID=<?php echo $getUser["ID"] ?>" class="btn btn-social-">
                        <i data-feather="mail"></i>
                        Message him
                      </a>
                      <div class="w-100 d-sm-none"></div>

                      <a href="#" data-toggle="modal" data-target="#deleteModel" class="btn btn-danger">
                        <i  class="far fa-trash-alt"></i>
                        Delete this user
                      </a>
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
                          aria-selected="true">Posts</a>
                      </li>
                    </ul>
                    <div class="tab-content tab-bordered" id="myTab3Content">
                      <div class="tab-pane fade show active" id="posts" role="tabpanel" aria-labelledby="post-tab">
                        <div class="row">
                          <?php while($art = $getUserArt->fetch_assoc()): ?>
                            <div class="card" style = "margin:10px">
                              <div class="card-header">
                                <h4><?php echo $art['PaintName'] ?></h4>
                                <div class="card-header-action">
                                  <a href="Art_Detail.php?ID=<?php echo $art['ID'] ?>" class="btn btn-primary">View</a>
                                </div>
                              </div>
                              <div class="card-body">
                                <div class="chocolat-parent">
                                  <a href="..\Content/Upload/<?php echo $UID ?>/Art/<?php echo $art['Image'] ?>" class="chocolat-image" title="<?php echo $art['PaintName'].": ".$art['Description'] ?>">
                                    <div data-crop-image="285">
                                      <img alt="image" src="..\Content/Upload/<?php echo $UID ?>/Art/<?php echo $art['Image'] ?>" height = "10px" width = "200px" class="img-fluid">
                                    </div>
                                  </a>
                                </div>
                              </div>
                            </div>
                          <?php endwhile; ?>
                        </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
  </div>
</section>



<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Delete?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you really want to delete this post?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="includes/controller.php?delete_user=<?php echo $UID ?>">Yes sure!</a>
        </div>
      </div>
</div>


<?php include('includes/footer.php'); ?>