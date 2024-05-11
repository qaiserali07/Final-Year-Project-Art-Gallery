  <?php 
    
    include('includes/header.php');    
    include('includes/config.php');
    
    $rs = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_auction` WHERE `Status` = 'B' OR `Status` = 'P'") or die ($mysqli->error);
	$AuctionData = $rs->fetch_assoc();

    $getAllArt = $conn->query("SELECT * FROM `tbl_auction`ORDER BY `DateTime` DESC");

    if(!$AuctionData['Total']>0) include('startExibition.php');
?>

<div class="card">
                  <div class="card-header">
                    <h4>Exhibitions</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped table-hover" id="tableExport">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Exhibition Title</th>
                            <th>Started at</th>
                            <th>Ended at</th>
                            <th>Total Painting</th>
                            <th>Total Sales</th>
                            <th></th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while($art = $getAllArt->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $art['AName'] ?></td>
                                    <td><?php echo $art['StartAt'] ?></td>
                                    <td><?php echo $art['EndAt'] ?></td>
                                    <td><?php echo $art['TotalPainting'] ?></td>
                                    <td><?php echo $art['TotalSales'] ?></td>
                                    <td><?php 
                                    
                                        if($art['Status'] == "B")
                                        {

                                            echo '<a  href="includes/controller.php?start_exhibition='.$art['ID'].'"  class=" btn btn-primary"><i class="far fa-check-alt"></i>Start</a> <a href="exibition_data.php" > Data</a>';
                                        }
                                        else if($art['Status'] == "P")
                                        {
                                            echo '<a  href="#" data-toggle="modal" data-target="#heltModel" class="dropdown-item has-icon text-danger"><i class="far fa-trash-alt"></i>Helt</a> <a href="gallary_data.php" > Data</a>';
                                        }
                                        else{
                                            echo '<a  href="ShowExibitionresult.php?ID='.$art["ID"].'"  class=" btn btn-primary"><i class="far fa-check-alt"></i>View info</a>';
                                        }
                                    
                                    ?></td>
                                </tr>
                            <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
    </div>
</div>


<div class="modal fade" id="heltModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to helt?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you really want to helt this exhibition?</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-danger" href="includes/controller.php?helt_exhibition">Yes sure!</a>
        </div>
      </div>
</div>


<?php include('includes/footer.php'); ?>