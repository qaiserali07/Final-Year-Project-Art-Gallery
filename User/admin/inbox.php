<?php 
    include('includes/header.php');    
    include('includes/config.php');
    
    $UID = $_SESSION['ID'];
    $getAllMsgs = $conn->query("SELECT * FROM `tbl_messages` WHERE `RID` = $UID ORDER BY DateTime DESC;");
    $conn->query("UPDATE `tbl_messages` SET `_read` = 0 WHERE `RID`= '$UID'");
?>

<div class="card">
<div class="card-header">
                      <h4>Inbox</h4>
                    </div>
                  <div class="boxs mail_listing">
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover"> 
                      <thead>
                            <th>#</th>
                            <th></th>
                            <th>From</th>
                            <th>subject</th>
                            <th></th>
                            <th></th>
                            <th></th> 
                        </thead> 
                        <tbody>
                          <?php 
                            $i = 1;
                            while($mesgs = $getAllMsgs->fetch_assoc()):
                              
                              $SID = $mesgs['SID'];
                              $UserInfo = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $SID");
                              $User = $UserInfo->fetch_assoc(); 
                            ?>
                            <tr class="unread">
                              <td><?php echo $i ?></td>
                              <td></td>
                              <td class="hidden-xs">
                                <?php echo $User['FirstName']." ".$User['LastName']  ?>
                              </td>
                              <td class="max-texts">
                                <a href="read_msg.php?ID=<?php echo $mesgs['ID'] ?>">
                                  <?php 
                                    if($mesgs['_read'] == -1)
                                    {
                                      echo "<span class='badge badge-primary'>New</span>";
                                    }
                                  ?>
                                  <?php 
                                    if(strlen($mesgs['subject'])!=0)
                                    {
                                      echo $mesgs['subject'];
                                    }
                                    else
                                    {
                                      echo "No Subject";
                                    }
                                  ?></a>
                              </td>
                              <td class="hidden-xs">
                                
                              </td>
                              <td class="text-right"> <?php echo $mesgs['DateTime'] ?> </td>
                              <td><a href="includes/controller.php?delete_mesg=<?php echo $mesgs['ID']."&page=inbox" ?>" class="btn btn-danger">Delete</a></td>
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
 