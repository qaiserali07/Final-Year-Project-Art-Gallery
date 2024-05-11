<?php
	session_start();
	include('includes/config.php');

    $rs = $conn->query("SELECT COUNT(*) AS `Total`,`ID`,`Status` FROM `tbl_auction` WHERE `Status` = 'B' OR `Status` = 'P'") or die ($mysqli->error);
	$AuctionData = $rs->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="generator" content="">
<title>Art Gallary</title>
<link rel="icon" href="images/icon.png">
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/all.css" rel="stylesheet">
<link href="css/style.css" rel="stylesheet">
<link href="css/brands.css" rel="stylesheet">
<link href="css/fontfamilyv2.css" rel="stylesheet">
<link href="css/fontFamilyv3.css" rel="stylesheet">

<style>


@media(min-width:568px) {
    .end {
        margin-left: auto
    }
}

@media(max-width:768px) {
    #post {
        width: 100%
    }
}







.comment {
    border: 1px solid rgba(16, 46, 46, 1);
    float: left;
    border-radius: 5px;
    padding-left: 20px;
    padding-right: 40px;
    padding-top: 20px;
	margin-left:60px;
	margin-bottom:10px;
}

.comment h4,
.comment span,
.darker h4,
.darker span {
    display: inline
}

h1,
h4 {
    font-weight: bold
}


</style>
</head>
<body>
<header class="item header margin-top-0">
<div class="wrapper">
	<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
			<i class="fa fa-bars"></i>
			<span class="sr-only">Toggle navigation</span>
			</button>
			<a href="index.php" class="navbar-brand brand"> 
				<ul class = "nav navbar-nav navbar-right">
					<li ><img alt="image" src="images/icon.png" width = "30px" height = "30px" /></li>	
					<li style = "padding-left:5px">Art Gallary</li>
				</ul> 
			</a>
		</div>
		<div id="navbar-collapse-02" class="collapse navbar-collapse">
			<ul class="nav navbar-nav navbar-right">
				<li class="propClone"><a href="index.php">Home</a></li>
				<li class="propClone"><a href="Gallary.php?page=Gallary">Gallary</a></li>
				<li class="propClone"><a href="Auction.php?page=Exhibition">Exhibition</a></li>
				<?php if(isset($_SESSION['auth'])){  ?>
					<li class="nav-item dropdown no-arrow">
						<a href="#" id="userDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
							<span  style = "color: blue; font-family:Arial; font-weight: 100"><?php echo $_SESSION['Name'] ?></span>
							<i style = "color: blue; font-family:Arial; font-weight: 100" class="fas fa-sort-down"></i>
						</a>
						<div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
						<?php if($_SESSION['Role'] == 'P' || $_SESSION['Role'] == 'B'){  ?>
							<a class="dropdown-item" href="User/user_beginnerr/index.php">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Go to dashboard
							</a>
						<?php } else if($_SESSION['Role'] == 'A'){ ?>
							<a class="dropdown-item" href="User/admin/index.php">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Go to dashboard
							</a>
						<?php } else { ?>
							<a class="dropdown-item" href="User/user_beginnerr/index.php">
								<i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
								Go to dashboard
							</a>
						<?php } ?>
							<hr>
							<a class="dropdown-item align-center" href="#" data-toggle="modal" data-target="#logoutModal">
								<i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
								Logout
							</a>
						</div>
					</li>
				<?php } else { ?>
					<li class="propClone active"><a href="register.php?page=Register">Register</a></li>
					<li class="propClone"><a href="login.php?page=Login">Login</a></li>
				<?php } ?>
			</ul>
		</div>
	</div>
	</nav>
	<div class="container">
		<div class="row">
        <?php if(!isset($_GET['page'])) { ?>
			<div class="col-md-12 text-center">
				<div class="text-homeimage">
					<div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
					ART MADE ARTIST
					</div>
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
					Art belongs to everyone
					</div>
				</div>
			</div>
        <?php } else { ?>
            <div class="col-md-12 text-center">
				<div class="text-pageheader">
					<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.0s">
					Art belongs to everyone
					</div>
				</div>
			</div>
        <?php } ?>
		</div>
	</div>
</div>
</header>