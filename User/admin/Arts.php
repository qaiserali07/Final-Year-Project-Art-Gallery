<?php 
    
    include('includes/header.php');    
    include('includes/config.php'); 

    $getAllArt = $conn->query("SELECT * FROM `tbl_paintings` order by DateTime DESC");
?>

<div class="card">
                  <div class="card-header">
                    <h4>Gallary art Posts</h4>
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
                            <th>Uploaded Date</th>
                            <th>Description</th>
                            <th>No Comments</th>
                            <th >Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while($art = $getAllArt->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td>
                                        <div class="chocolat-parent">
                                            <a href="..\Content/Upload/<?php echo $art['UID'] ?>/Art/<?php echo $art['Image'] ?>" class="chocolat-image" title="<?php echo $art['PaintName'].": ".$art['Description'] ?>">
                                                <div>
                                                <img alt="image" src="..\Content/Upload/<?php echo $art['UID'] ?>/Art/<?php echo $art['Image'] ?>" width = "100px" height = "100px" class="img-fluid">
                                                </div>
                                            </a>
                                        </div>
                                    </td>
                                    <td><?php echo $art['PaintName'] ?></td>
                                    <td><?php echo $art['DateTime'] ?></td>
                                    <td><?php echo $art['Description'] ?></td>
                                    <td><?php 
                                        $PID = $art['ID'];
                                        $getCount = $conn->query("SELECT COUNT(*) as `Total` FROM `tbl_comments` WHERE `PID` = $PID");
                                        $count = $getCount->fetch_assoc();
                                        echo $count['Total'];
                                    ?></td>
                                    <td><a href="Art_Detail.php?ID=<?php echo $art['ID'] ?>&read" class="btn btn-primary">Detail</a></td>
                                </tr>
                            <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>