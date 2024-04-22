<?php 
    include('includes/header.php');    
    include('includes/config.php');
    
    $MID = $_GET['ID'];
    $getMsg = $conn->query("SELECT * FROM `tbl_messages` WHERE `ID` = $MID");
    $mesg = $getMsg->fetch_assoc();

    $SID = -1;
    if(isset($_GET['sent']))
    {
      $SID = $mesg['RID'];
    }
    else
    {
      $SID = $mesg['SID'];
    }
    $UserInfo = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $SID");
    $User = $UserInfo->fetch_assoc();
?>

<div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-body no-pad">
                      <section class="mail-list">
                        <div class="mail-sender">
                          <div class="mail-heading">
                            <h4 class="vew-mail-header">
                              <b>
                                  <?php 
                                    if(strlen($mesg['subject'])!=0)
                                    {
                                      echo $mesg['subject'];
                                    }
                                    else
                                    {
                                      echo "No Subject";
                                    }
                                  ?>
                              </b>
                            </h4>
                          </div>
                          <hr>
                          <div class="media">
                            <a href="#" class="table-img m-r-15">
                              <img alt="image" src="images/User.png" class="rounded-circle" width="35"
                                data-toggle="tooltip" title="<?php echo $User['FirstName']." ".$User['LastName'] ?>">
                            </a>
                            <div class="media-body">
                              <span class="date pull-right"><?php echo $mesg['DateTime'] ?></span>
                              <h5 class="text"><?php echo $User['FirstName']." ".$User['LastName'] ?></h5>
                              <small class="text-muted"><?php
                              
                              if(isset($_GET['sent']))
                              {
                                echo "To: ".$User['Email'];
                              }
                              else
                              {
                                echo "From: ".$User['Email'];
                              }
                               ?></small>
                            </div>
                          </div>
                        </div>
                        <div class="view-mail p-t-20">
                          <p><?php echo $mesg['Mesg'] ?></p>
                        </div>
                        <?php if(!isset($_GET['readonly'])){ ?>
                        <form action = "includes/controller.php" method = "post" class="composeForm needs-validation" novalidate="">
                            <textarea class="replyBox m-t-20 form-control" name="mesg" placeholder="Type your replay"></textarea>
                            <input type = "text" hidden value="<?php echo $mesg['subject'] ?>" name = "sub">
                            <input type = "text" hidden value="<?php echo $mesg['SID'] ?>" name = "TO">
                            <br>
                            <input type = "submit" name = "send_mesg" class="btn btn-info btn-border-radius waves-effect" VALUE = "REPLAY" >
                        </form>
                        <?php } ?>
                      </section>
                    </div>
                  </div>
                </div>

<?php include('includes/footer.php'); ?>
 