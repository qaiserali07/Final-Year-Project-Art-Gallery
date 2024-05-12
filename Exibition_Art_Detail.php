<?php 
    include('includes/header.php');
    include('includes/config.php');
    
    if(!isset($_SESSION['auth'])){
        $mesg = "Please login first!";
        header('location: login.php?page=Login&mesg='.$mesg);
        return;
    }

    if(!isset($_GET['ID']) || strlen($_GET['ID'])==0)
        header('location: index.php');

    $ID = $_GET['ID'];
    $rs = $conn->query("SELECT * FROM `tbl_auction_date` WHERE `ID` = $ID") or die ($mysqli->error);
    $data = $rs->fetch_assoc();

    $UID = $data['ArtBy'];
    $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();

	$getBittingCount = $conn->query("SELECT COUNT(*) AS `Total` FROM `tbl_bit` WHERE `AID` = $ID");
	$getCount = $getBittingCount->fetch_assoc();

	$getAllBitting = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $ID ORDER BY `ID` DESC");
	$BittingDetails = $getAllBitting->fetch_assoc();

	$getAnOther = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $ID ORDER BY `ID` DESC");
?>


<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems"><?php echo $data["ArtName"] ?></h1>
		</div>
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
	<div class="row">
		<div class="col-md-8">
			<div class="productbox">
				<img src="User/Content/Auction/<?php echo $data['ID'] ?>/<?php echo $data['Image'] ?>" alt="<?php echo $data['ArtName'] ?>" alt="">
				<div class="clearfix">
				</div>
				<br/>
				<div class="product-details text-left">
					<p>
                    <?php echo $data["Discription"] ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
		<a href="#" class="btn btn-buynow"><?php if($getCount['Total']>0 && $BittingDetails != null ) echo $BittingDetails['Price']." £ " ; else echo "No bid yet!" ?></a>
			<div class="properties-box">
				<ul class="unstyle">
					<li><b class="propertyname">Title:</b> <?php echo $data["ArtName"] ?></li>
                    <li><b class="propertyname">Artist:</b> <a href = "User/user_beginnerr/user_info.php?ID=<?php echo $getUser["ID"] ?>"><?php echo $getUser["FirstName"]." ".$getUser["LastName"] ?></a></li>
					<li><b class="propertyname">Demand price:</b> <?php echo $data["DemandPrice"] ?> £</li>
				</ul>
			</div>
		</div>

		<div class="col-md-4">
			<div class="properties-box">
				<ul class="unstyle">
					<?php if(isset($getCount) && is_array($getCount) && isset($getCount['Total']) && $getCount['Total'] > 0  ) echo '<li><b class="propertyname">Lastest bid price:</b> '. $BittingDetails['Price'] .'£</li>'; else echo "" ?>
					<li>
						<table class ="table" border=1>
							<tr>
								<th>#</th>
								<th>Bid price</th>
								<th>User</th>
							</tr>
							<tr>
							<?php if(isset($getCount) && is_array($getCount) && isset($getCount['Total']) && $getCount['Total'] > 0){ ?>
 
								<?php $i = $getCount['Total']; while ($getPaintRecord = $getAnOther->fetch_assoc()): ?>
									<tr>
										<td><?php echo $i ?></td>
										<td><?php echo $getPaintRecord['Price'] ?></td>
										<td><a href = "User/user_beginnerr/user_info.php?ID=<?php echo $getPaintRecord['UID'] ?>">View User</a></td>
									</tr>
								<?php --$i; endwhile; } else { ?>
									<td colspan = 3 class="alert alert-info text-center">No body has bid on this yet!</td>
								<?php } ?>
							</tr>
						</table>
					</li>    
				</ul>
			</div>
		</div>
		<?php if( $BittingDetails == null || $BittingDetails['UID']!=$_SESSION['ID']) {?>
			<div class="col-md-4">
				<div class="properties-box">
					<ul class="unstyle">
						<li><b class="propertyname">Add your bid here!</b></li>
						<li>
							<form method="post" action="includes/controller.php" id="contactform">
								<?php if($getCount['Total']>0){ ?>
									<input type="number" name="Price" min = "<?php echo $BittingDetails['Price']+1 ?>" value = "<?php echo $BittingDetails['Price']+1 ?>" required placeholder="Enter your amount!" >
									<input type="text" hidden name="msg" value = "1" required >
								<?php } else { ?>
									<input type="number" name="Price" min = "<?php echo $data["DemandPrice"]+1 ?>" value = "<?php echo $data["DemandPrice"]+1 ?>" required placeholder="Enter your amount!" >
									<input type="text" hidden name="msg" value = "0" required >
								<?php } ?>
								<input type="text" name="AID" hidden value = "<?php echo $ID ?>" required >
								<input type="text" name="UID" hidden value = "<?php echo $_SESSION['ID'] ?>" required >
								<input type="text" name="Page" hidden value = "<?php echo $data["ArtName"] ?>" required >
								<input type="submit" id="BIT" name = "BIT" class="clearfix btn" value="BID">
							</form>
						</li>    
					</ul>
				</div>
			</div>
		<?php } ?>
	</div>
</div>
<?php include('includes/footer.php'); ?>