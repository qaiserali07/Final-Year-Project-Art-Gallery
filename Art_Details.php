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
    $rs = $conn->query("SELECT * FROM `tbl_paintings` WHERE `ID` = $ID") or die ($mysqli->error);
    $data = $rs->fetch_assoc();

    $UID = $data['UID'];
    $User = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();

    $getComments = $conn->query("SELECT * FROM `tbl_comments` WHERE `PID` = $ID ORDER By DateTime DESC");

?>


<div class="container toparea">
	<div class="underlined-title">
		<div class="editContent">
			<h1 class="text-center latestitems"><?php echo $data["PaintName"] ?></h1>
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
				<img src="User/Content/Upload/<?php echo $data['UID'] ?>/Art/<?php echo $data['Image'] ?>" alt="<?php echo $data['PaintName'] ?>" alt="">
				<div class="clearfix">
				</div>
				<br/>
				<div class="product-details text-left">
					<p>
                    <?php echo $data["Description"] ?>
					</p>
				</div>
			</div>
		</div>
		<div class="col-md-4">
			<div class="properties-box">
				<ul class="unstyle">
					<li><b class="propertyname">Title:</b> <?php echo $data["PaintName"] ?></li>
					<li><b class="propertyname">Upload Date Time:</b> <?php echo $data["DateTime"] ?></li>
					<?php if($getUser["Role"]=="B"){ ?>
                        <li><b class="propertyname">User:</b> <a href = "User/user_beginnerr/user_info.php?ID=<?php echo $getUser["ID"] ?>"><?php echo $getUser["FirstName"]." ".$getUser["LastName"] ?></a></li>
                    <?php } else { ?>
                        <li><b class="propertyname">Artist:</b> <a href = "User/user_beginnerr/user_info.php?ID=<?php echo $getUser["ID"] ?>"><?php echo $getUser["FirstName"]." ".$getUser["LastName"] ?></a></li>
                    <?php } ?>    
				</ul>
			</div>
		</div>
	</div>
</div>
<?php 
    $getCount = $conn->query("SELECT COUNT(*) as `Total` FROM `tbl_comments` WHERE `PID` = $ID");
    $count = $getCount->fetch_assoc();
?>
<section>
    <div class="container" style = "padding: 10px">
        <div class="row">
        <h4 class="text-Left latestitems">Comments (<?php echo $count['Total'] ?>)</h4>
            <div class="col-sm-5 col-md-6 col-12 pb-4">
               <?php if($count['Total']>0) {?>
                    <?php while($comments = $getComments->fetch_assoc()): 
                        $CID = $comments['CID'];
                        $CUser = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = $CID");
                        $CgetUser = $CUser->fetch_assoc();
                        ?>
                        <div class="comment mt-4 text-justify float-left"> <img src="images/User.png" alt="" class="rounded-circle" width="20" height="20">
                            <h4><?php echo $CgetUser['FirstName']." ".$CgetUser['LastName'] ?></h4> <span style= "text-align: right;font-size: 10px; font-style: italic;">- <?php echo $comments['DateTime'] ?></span> <br>
                            <p><?php echo $comments['Comment'] ?></p>
                        </div>
                <?php endwhile; ?>
               <?php } else { ?>
                    <p class="mt-4 text-justify float-right">No Comments!</p>
               <?php } ?>
            </div>
            <div class="col-lg-4 col-md-5 col-sm-4 offset-md-1 offset-sm-1 col-12 mt-4">
                <form  method = "post" action = "includes/controller.php">
                    <div class="form-group">
                        <h4 class="latestitems">Leave a comment</h4>  
                        <textarea id="" name = "text_comment" msg cols="30" rows="5" class="form-control" placeholder = "Enter a message!"></textarea>
                        <input type = "text" name = "PID" value = "<?php echo $ID ?>" hidden>
                        <input type = "text" name = "PNAME" value = "<?php echo $data["PaintName"] ?>" hidden>
                        <input type = "text" name = "LINK" value = "<?php echo "Art_Detail.php?ID=".$ID ?>" hidden>
                        <input type = "text" name = "NID" value = "<?php echo $getUser["ID"] ?>" hidden>
                        <input type = "text" name = "STATUS" value = "<?php echo "C" ?>" hidden>
                    </div>
                    <input type="submit" name = "comment" class="btn btn-primary" value = "Post Comment">
                </form>
            </div>
        </div>
    </div>
</section>
<?php include('includes/footer.php'); ?>