<?php 
	$AID = $AuctionData['ID'];
	$Auction = $conn->query("SELECT * FROM `tbl_auction` WHERE `ID` = $AID") or die ($mysqli->error);
	$getAuctionData = $Auction->fetch_assoc();
?>

<section class="item content">
	<div class="container toparea">
		<div class = "alert alert-info text-center">
			<?php 
				echo "Auction of world best art will be started at: ".$getAuctionData['StartAt']." please stay tuned!";
			?>
		</div>
	</div>
</section>