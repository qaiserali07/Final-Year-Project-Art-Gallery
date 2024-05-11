<?php 
    
    include('includes/header.php');    
    include('includes/config.php'); 

    $UID = $_SESSION['ID'];
    $getAllArt = $conn->query("SELECT * FROM `tbl_auction_date` WHERE `Status` = -1");

?>

<div class="card">
                  <div class="card-header">
                    <h4>Auction Data</h4>
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
                            <th>Demand price</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while($art = $getAllArt->fetch_assoc()): 
                                $UID = $art['ArtBy'];
                                $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
                                $getUser = $User->fetch_assoc();

                                
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
                                    <td><?php echo $getUser['FirstName']." ".$getUser['LastName'] ?></td>
                                    <td><?php echo $art['DemandPrice'] ?></td>
                                    <td><a href = "includes/controller.php?select_art=<?php echo $art['ID']."&user=".$art['ArtBy'] ?>" class = "btn btn-primary">Accept</a> <a href = "includes/controller.php?reject_art=<?php echo $art['ID']."&user=".$art['ArtBy'] ?>">Reject</a></td>
                                </tr>
                            <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>