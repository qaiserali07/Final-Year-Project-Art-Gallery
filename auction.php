<?php 
    include('includes/header.php');
    include('includes/config.php');

    if($AuctionData['Total']==0) include('MesgNoAuction.php');

    else if($AuctionData['Total']>0 && $AuctionData['Status'] != "P") include('AuctionStartedMesg.php');
?>



<?php
    $q = "SELECT * FROM `tbl_auction_date` WHERE `Status` <> -1";
    $rs = $conn->query($q) or die ($mysqli->error);
?>

<section class="item content">
<div class="container toparea">
	<div class="underlined-title">
		<div class="wow-hr type_short">
			<span class="wow-hr-h">
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			<i class="fa fa-star"></i>
			</span>
		</div>
	</div>
    <div class="row">
		<?php
           while ($data = $rs->fetch_assoc()):
        ?>
         <div class="col-md-4">
			<div class="productbox">
				<div class="fadeshop">
					<div class="captionshop text-center" style="display: none;">
						<h3><?php echo $data['ArtName'] ?></h3>
							<a href="Exibition_Art_Detail.php?page=<?php echo $data['ArtName'] ?>&ID=<?php echo $data['ID'] ?>" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
						</div>
						<span class="maxproduct"><img src="User/Content/Auction/<?php echo $data['ID'] ?>/<?php echo $data['Image'] ?>" alt="<?php echo $data['ArtName'] ?>"></span>
					</div>
					<div class="product-details">
						<a href="Exibition_Art_Detail.php?page=<?php echo $data['ArtName'] ?>&ID=<?php echo $data['ID'] ?>">
						<h1><?php echo $data['ArtName'] ?></h1>
						</a>
						<span class="price">
							<span class="edd_price"><?php echo $data['DemandPrice'] ?> Rs</span>
						</span>
					</div>
				</div>
			</div>
            <?php endwhile; ?>
		</div>
</div>
</section>

<?php include('includes/footer.php');?>
