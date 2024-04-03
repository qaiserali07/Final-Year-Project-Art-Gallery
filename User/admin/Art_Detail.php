<?php 
    include('includes/header.php');    
    include('includes/config.php');
    
    $show = FALSE;

    $AID = $_GET['ID'];

    $getArt = $conn->query("SELECT * FROM `tbl_paintings` WHERE `ID` = $AID");
    $Art = $getArt->fetch_assoc();

    if($_SESSION['ID'] == $Art['UID']) $show = TRUE;

    $getComments = $conn->query("SELECT * FROM `tbl_comments` WHERE `PID` = $AID ORDER By DateTime DESC");

    $getCount = $conn->query("SELECT COUNT(*) as `Total` FROM `tbl_comments` WHERE `PID` = $AID");
    $count = $getCount->fetch_assoc();


    $UID = $Art['UID'];
    $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();
?>
<div class="col-12 col-sm-12 col-lg-12">
  <div class="card">
                    <div class="card-header">
                      <h4><?php echo $Art['PaintName'] ?></h4>
                      <?php if($show){ ?>
                        <div class="card-header-action">
                        <div class="dropdown">
                          <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                          <div class="dropdown-menu">
                            <a href="edit_art.php?edit=<?php echo $Art['ID'] ?>" class="dropdown-item has-icon"><i class="far fa-edit"></i> Edit</a>
                            <div class="dropdown-divider"></div>
                            <a href="#" data-toggle="modal" data-target="#deleteModel" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                              Delete</a>
                          </div>
                        </div>
                      </div>
                      <?php } else { ?>
                        <div class="card-header-action">
                        <div class="dropdown">
                          <a href="#" data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Options</a>
                          <div class="dropdown-menu">
                            <a href="#" data-toggle="modal" data-target="#deleteModel" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>
                              Delete</a>
                          </div>
                        </div>
                      </div>
                        <?php }?>
                    </div>
                    <div class="card-body">
                      <div class="mb-2 text-muted"><?php echo $Art['Description'] ?></div>
                      <div class="chocolat-parent">
                        <a href="..\Content/Upload/<?php echo $Art['UID'] ?>/Art/<?php echo $Art['Image'] ?>" class="chocolat-image" title="<?php echo $Art['PaintName'].":  ".$Art['Description'] ?>">
                          <div data-crop-image="285">
                            <img alt="image" src="..\Content/Upload/<?php echo $Art['UID'] ?>/Art/<?php echo $Art['Image'] ?>" height = 200px class="img-fluid">
                          </div>
                        </a>
                      </div>
                      <div class="mb-2 text-muted float-right"><?php echo $Art['DateTime'] ?></div>
                    </div>
                  </div>
<div class="row clearfix">
<div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 col-4">
<?php if (!$show) {?>

  <div class="card">
                  <div class="card-header">
                    <h4>User Details</h4>
                  </div>
                  <div class="card-body">
                    <div class="py-4">
                    <p class="clearfix">
                        <span class="float-left">
                          Name
                        </span>
                        <span class="float-right text-muted">
                        <?php echo $getUser["FirstName"]." ".$getUser["LastName"] ?>
                        </span>
                      </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Role
                        </span>
                        <span class="float-right text-muted">
                        <?php 
                          if($getUser["Role"]=="B")
                          {
                            echo "Beginner";
                          }
                          else if($getUser["Role"]=="P"){
                            echo "Professional";
                          }
                          else{
                            echo "Other";
                          }
                        ?>
                        </span>
                      </p>
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
                        <a href = "mailto:<?php echo $getUser["Email"] ?>"><?php echo $getUser["Email"] ?></a>
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

                      <div class="text-center">
                      <a href="compose_mesg.php?ID=<?php echo $getUser["ID"] ?>" class="btn btn-social-">
                        <i data-feather="mail"></i>
                        Message him
                      </a>
                      <div class="w-100 d-sm-none"></div>

                      <a href="user_info.php?ID=<?php echo $getUser["ID"] ?>" class="btn btn-social-">
                        <i data-feather="user"></i>
                        View profile
                      </a>
                    </div>
                    </div>
                  </div>
                </div>

<?php } ?>

</div>
<div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 col-8">
  <div class="card">
    <div class="card-header">
      <h4>Comments (<?php echo $count['Total'] ?>)</h4>
    </div>
        <div class="card-body">
        <div class="container" >
        <div class="row">
            <div class="col-sm-5 col-md-6 col-12 pb-4">
               <?php if($count['Total']>0) {?>
                    <?php while($comments = $getComments->fetch_assoc()): 
                        $CID = $comments['CID'];
                        $CUser = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $CID");
                        $CgetUser = $CUser->fetch_assoc();
                        ?>
                        <div class="comment mt-4 text-justify float-left"> <img src="images/User.png" alt="" class="rounded-circle" width="20" height="20">
                            <h4 style= "font-size: 10px;"><?php echo $CgetUser['FirstName']." ".$CgetUser['LastName'] ?></h4> <span style= "text-align: right;font-size: 10px; font-style: italic;">- <?php echo $comments['DateTime'] ?></span> <br>
                            <p><?php echo $comments['Comment'] ?></p>
                        </div>
                <?php endwhile; ?>
               <?php } else { ?>
                    <p class="mt-4 text-justify float-right">No Comments!</p>
               <?php } ?>
            </div>
           
        </div>
    </div>
        </div>
    </div>
  </div>
</div>

</div>
<?php if (!$show) {?>
<div class = "col-lg-12 col-md-12 col-sm-12 col-xs-12 col-12">
<div class="card">
                  <div class="card-header">
                    <h4>Leave a comment</h4>
                  </div>
    <div class="card-body">

    <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form  method = "post" action = "includes/controller.php">
                    <div class="form-group">
                        <h4 class="latestitems"></h4>  
                        <textarea id="" name = "text_comment" msg cols="30" rows="5" class="form-control" placeholder = "Enter a message!"></textarea>
                        <input type = "text" name = "PID" value = "<?php echo $AID ?>" hidden>
                        <input type = "text" name = "PNAME" value = "<?php echo $Art["PaintName"] ?>" hidden>
                    </div>
                    <input type="submit" name = "comment" class="btn btn-primary" value = "Post Comment">
                </form>
            </div>
</div>

</div>

<?php }?>

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
          <?php if($show){ ?>
            <a class="btn btn-danger" href="includes/controller.php?delete_art=<?php echo $AID ?>">Yes sure!</a>
          <?php } else { ?>
            <a class="btn btn-danger" href="includes/controller.php?delete_art=<?php echo $AID ?>&masg=<?php echo $Art['UID'] ?>&title=<?php echo $Art['PaintName'] ?>">Yes sure!</a>
          <?php } ?>
        </div>
      </div>
</div>

<?php include('includes/footer.php'); ?>