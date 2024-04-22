<?php 
    include('includes/header.php');    
    include('includes/config.php');
    
    $UID = $_SESSION['ID'];
    $getAllMsgs = $conn->query("SELECT * FROM `tbl_notifications` WHERE `NID` = $UID ORDER BY DateTime DESC;");
    $conn->query("UPDATE `tbl_notifications` SET `_Read` = 0 WHERE `NID` = $UID AND `_Read`=-1");
?>

<div class="card">
<div class="card-header">
                      <h4>Notifications</h4>
                    </div>
                  <div class="boxs mail_listing">
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover"> 
                      <thead>
                            <th>#</th>
                            <th></th>
                            <th>Notification</th>
                            <th></th>
                            <th>Date</th>
                            <th></th>
                        </thead> 
                        <tbody>
                          <?php 
                            $i = 1;
                            while($mesgs = $getAllMsgs->fetch_assoc()):
                            ?>
                            <tr class="unread" >
                              <td><?php echo $i ?></td>
                              <td></td>
                              <td class="hidden-xs">
                                <a href="<?php
                                $link = urldecode($mesgs['link']);
                                echo  $link;?>">
                                  <?php 
                                    echo $mesgs['Noti']
                                  ?>
                                </a>
                              </td>
                              <td class="max-texts">
                                <a href="<?php echo $mesgs['link'] ?>">
                                  <?php 
                                    if($mesgs['_Read'] == -1)
                                    {
                                      echo "<span class='badge badge-primary'>New</span>";
                                    }
                                  ?>
                                </a>
                              </td>
                              <td class="hidden-xs">
                              <?php echo $mesgs['DateTime'] ?>
                              </td>
                              <td class="text-right"> <a href="includes/controller.php?delete_noti=<?php echo $mesgs['ID'] ?>" class="btn btn-danger">Delete</a> </td>
                            </tr>
                          <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-sm-7 ">
                        <p class="p-15"></p>
                      </div>
                    </div>
                  </div>
</div>

<?php include('includes/footer.php'); ?>
 