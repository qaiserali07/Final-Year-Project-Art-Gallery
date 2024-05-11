<?php 
    
    include('includes/header.php');    
    include('includes/config.php'); 

    $getAllArt = $conn->query("SELECT * FROM `tbl_user` WHERE `Role` != 'A'");
?>

<div class="card">
                  <div class="card-header">
                    <h4>User on this gallary</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>
                          <tr>
                            <th class="text-center">
                              #
                            </th>
                            <th>Artist Name</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>Role</th>
                            <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while($art = $getAllArt->fetch_assoc()): ?>
                                <tr>
                                    <td><?php echo $i ?></td>
                                    <td><?php echo $art['FirstName']." ".$art['LastName'] ?></td>
                                    <td><a href="mailto:<?php echo $art['Email']; ?>"><?php echo $art['Email'] ?></a></td>
                                    <td><?php if( $art['Gender']=="M" ) echo "Male"; else if($art['Gender']=="F") echo "Female"; else echo "Other"; ?></td>
                                    <td><?php if( $art['Role']=="B" ) echo "Beginner"; else if($art['Role']=="P") echo "Professional"; else echo "un recogonized ";?></td>
                                    <td><a href="user_info.php?ID=<?php echo $art['ID'] ?>" class="btn btn-primary">Detail</a></td>
                                </tr>
                            <?php $i++; endwhile; ?>
                        </tbody>
                      </table>
                    </div>
    </div>
</div>


<?php include('includes/footer.php'); ?>