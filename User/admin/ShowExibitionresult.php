<?php 
    
    include('includes/header.php');    
    include('includes/config.php'); 

    $ID = $_GET['ID'];
    $getAllArt = $conn->query("SELECT * FROM `tbl_auction_date` WHERE `Status` = $ID");

    
?>

<div class="card">
                  <div class="card-header">
                    <h4>Auction Results</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th></th>
                            <th>Art Name</th>
                            <th>Artist</th>
                            <th>Sold price</th>
                            <th>Sold to</th>
                            <th>Pay slip</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while($art = $getAllArt->fetch_assoc()): 
                                $UID = $art['ArtBy'];
                                $AID = $art['ID'];
                                $SID = $art['SoldTO'];
                                $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
                                $getUser = $User->fetch_assoc();

                                $BUYERE = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $SID");
                                $Buyyed = $BUYERE->fetch_assoc();


                                $getAllBitting = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $AID ORDER BY `ID` DESC");
	                              $BittingDetails = $getAllBitting->fetch_assoc();

                                $getpay = $conn->query("SELECT * FROM `tbl_pay` WHERE `AID` = $AID");
	                              $getPaySlip = $getpay->fetch_assoc();
                                
                                ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>
                                        <div class="chocolat-parent">
                                            <a href="..\Content/Auction/<?php echo $art['ID'] ?>/<?php echo $art['Image'] ?>" class="chocolat-image" title="<?php echo $art['ArtName'].": ".$art['Discription'] ?>">
                                                <div>
                                                <img alt="image" src="..\Content/Auction/<?php echo $art['ID'] ?>/<?php echo $art['Image'] ?>" width = "100px" height = "100px" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $art['ArtName'] ?></td>
                                    <td><?php echo "<a href='user_info.php?ID=".$getUser['ID']."' target='_blank'>".$getUser['FirstName']." ".$getUser['LastName']."</a>" ?></td>
                                    <td><?php if($BittingDetails != null && $BittingDetails['Price']!='') echo $BittingDetails['Price']; else echo "<p class='alert alert-warning text-center'>Not yet!</p>";  ?></td>
                                    <td><?php echo "<a href='user_info.php?ID=".$Buyyed['ID']."' target='_blank'>".$Buyyed['FirstName']." ".$Buyyed['LastName']."</a>" ?></td>
                                    <td>
                                      <?php if($getPaySlip != null ){ ?>
                                      <div class="chocolat-parent">
                                            <a href="..\Content/Pay/<?php echo $getPaySlip['AID'] ?>/<?php echo $getPaySlip['Image'] ?>" class="chocolat-image" title="Pay slip">
                                                <div>
                                                <img class="img-fluid" width = "100px" height = "100px" src = "..\Content/Pay/<?php echo $getPaySlip['AID'] ?>/<?php echo $getPaySlip['Image'] ?>">
                                                </div>
                                            </a>
                                        </div>
                                        <?php } else { echo "-"; } ?>
                                    </td>
                                    <td><a href = "exhibit_art_detail.php?ID=<?php echo $art['ID'] ?>" class = "btn btn-primary">View Details</a> </td>
                                </tr>
                            <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>