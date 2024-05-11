<?php 
    include('includes/header.php');    
    include('includes/config.php');
    
    $show = FALSE;

    $AID = $_GET['ID'];

    $getArt = $conn->query("SELECT * FROM `tbl_auction_date` WHERE `ID` = $AID");
    $Art = $getArt->fetch_assoc();

    $UID = $Art['ArtBy'];
    $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();

    $getBittingCount = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_bit` WHERE `AID` = $AID");
	  $getCount = $getBittingCount->fetch_assoc();

    $getAllBitting = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $AID ORDER BY `ID` DESC");
	  $BittingDetails = $getAllBitting->fetch_assoc();

    $anOther = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $AID ORDER BY `ID` DESC");
?>
<div class="col-12 col-sm-12 col-lg-12">
  <div class="card">
                    <div class="card-header">
                      <h4><?php echo $Art['ArtName'] ?></h4>
                    </div>
                    <div class="card-body">
                      <div class="mb-2 text-muted"><?php echo $Art['Discription'] ?></div>
                      <div class="chocolat-parent">
                        <a href="..\Content/Auction/<?php echo $Art['ID'] ?>/<?php echo $Art['Image'] ?>" class="chocolat-image" title="<?php echo $Art['ArtName'].":  ".$Art['Discription'] ?>">
                          <div data-crop-image="285">
                            <img alt="image" src="..\Content/Auction/<?php echo $Art['ID'] ?>/<?php echo $Art['Image'] ?>" height = 200px class="img-fluid">
                          </div>
                        </a>
                      </div>
                      <div class="mb-2 text-muted float-right"><?php echo "Something will be " ?></div>
                    </div>
                  </div>
<div class="row clearfix">
    <div class = "col-lg-4 col-md-4 col-sm-12 col-xs-12 col-4">
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
    </div>

    <div class = "col-lg-8 col-md-8 col-sm-12 col-xs-12 col-8">
        <div class="card">
            <div class="card-header">
                <h4>Bitting Details</h4>
            </div>
            <div class="card-body">
                <div class="py-4">
                    <p class="clearfix">
                        <span class="float-left">
                          Latest bit
                        </span>
                        <span class="float-right text-muted">
                        <?php if($getCount['Total']>0) { ?>
                        <?php echo $BittingDetails['Price'] ?>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                        Biter Details
                        </span>
                        <span class="float-right text-muted">
                        <?php  echo "<a href = 'user_info.php?ID=".$BittingDetails['UID']."' class = 'btn btn-primary'>View Details</a>"  ?>
                        <?php } else echo "No bitting yet!"; ?>
                        </span>
                    </p>
                    <p class="clearfix">
                        <span class="float-left">
                          Bitting history
                        </span>
                        <span class="float-right text-muted">
                        <table class ="table" border=1>
							<tr>
								<th>#</th>
								<th>Bit price</th>
								<th>User</th>
							</tr>
							<tr>
              <?php if(isset($getCount) && is_array($getCount) && isset($getCount['Total']) && $getCount['Total'] > 0){?>
              <?php $i = $getCount['Total']; while ($getPaintRecord = $anOther->fetch_assoc()): ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $getPaintRecord['Price'] ?></td>
										<td><a href = "user_info.php?ID=<?php echo $getPaintRecord['UID'] ?>">View User</a></td>
									</tr>
								<?php --$i; endwhile; } else { ?>
									<td colspan = 3 class="alert alert-info text-center">No body has bit on this yet!</td>
								<?php } ?>
							</tr>
						</table>
                        </span>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

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
            <a class="btn btn-danger" href="includes/controller.php?delete_art=<?php echo $AID ?>&masg=<?php echo $Art['UID'] ?>&title=<?php echo $Art['ArtName'] ?>">Yes sure!</a>
          <?php } ?>
        </div>
      </div>
</div>

<?php include('includes/footer.php'); ?>