<?php 
    include('includes/header.php');
    $UID = $_SESSION['ID']; 
?>

<div class="row ">
<div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="card">
        <div class="card-statistic-4">
            <div class="align-items-center justify-content-between">
                <div class="row ">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Art</h5>
                          <h2 class="mb-3 font-18">
                            <?php
                                $getAllArt = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_paintings` WHERE `UID` = $UID");
                                $Art =  $getAllArt->fetch_assoc();
                                echo  $Art['Total'];
                            ?>
                          </h2>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="..\assets/img/banner/1.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-xs-12">
              <div class="card">
                <div class="card-statistic-4">
                  <div class="align-items-center justify-content-between">
                    <div class="row ">
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pr-0 pt-3">
                        <div class="card-content">
                          <h5 class="font-15">Total Comments</h5>
                          <h2 class="mb-3 font-18">
                            <?php
                                $getAllCom = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_comments` WHERE `CID` = $UID");
                                $Com =  $getAllCom->fetch_assoc();
                                echo  $Com['Total'];
                            ?>
                          </h2>
                        </div>
                      </div>
                      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 pl-0">
                        <div class="banner-img">
                          <img src="..\assets/img/banner/3.png" alt="">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            </div>

<?php include('includes/footer.php'); ?>