<?php 
    include('includes/header.php');
    include('includes/config.php');

	
?>

<?php
    $q = "SELECT * FROM `tbl_paintings` WHERE 1 ORDER BY `DateTime` DESC";
    $rs = $conn->query($q) or die ($mysqli->error);
?>

<section class="item content">
	<div class="container">
		<div class="underlined-title">
			<div class="editContent">
				<h1 class="text-center latestitems">LATEST UPLOADS</h1>
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
			<?php
				$i = 0;
                while($data = $rs->fetch_assoc()):
				$i++;	
                if($i==4) break;
            ?>
             <div class="col-md-4">
				<div class="productbox">
					<div class="fadeshop">
						<div class="captionshop text-center" style="display: none;">
							<h3><?php echo $data['PaintName'] ?></h3>
								<a href="Art_Details.php?page=<?php echo $data['PaintName'] ?>&ID=<?php echo $data['ID'] ?>" class="learn-more detailslearn"><i class="fa fa-link"></i> Details</a>
						</div>
						<span class="maxproduct"><img src="User/Content/Upload/<?php echo $data['UID'] ?>/Art/<?php echo $data['Image'] ?>" alt="<?php echo $data['PaintName'] ?>"></span>
					</div>
					<div class="product-details">
						<a href="Art_Details.php?page=<?php echo $data['PaintName'] ?>&ID=<?php echo $data['ID'] ?>">
						<h1><?php echo $data['PaintName'] ?></h1>
						</a>
					</div>
				</div>
			</div>
            <?php endwhile; ?>
		</div>
	</div>
</div>
</section>
<div class="item content">
	<div class="container text-center">
		<a href="Gallary.php?page=Gallary" class="homebrowseitems">Browse All Gallary
		<div class="homebrowseitemsicon">
			<i class="fa fa-star fa-spin"></i>
		</div>
		</a>
	</div>
</div>
<br/>


<?php include('includes/footer.php'); ?>