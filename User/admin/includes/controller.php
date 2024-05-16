<?php
session_start();
include('config.php');
if(isset($_POST['upload_art']))
{
    $Title = $_POST['Title'];
    $Dis = $_POST['Dis'];

    if(!isset($_FILES["Art"]) && $_FILES["Art"]["error"] == 0){
        $mesg = "Error: File error ". $_FILES["Art"]["error"];
        header("location: ..\upload_art.php?error=".$mesg);
    }

    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["Art"]["name"];
    $filetype = $_FILES["Art"]["type"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        $mesg = "Error: Please select a valid file format.";            
        header("location: ..\upload_art.php?error=".$mesg);
    }

    $UID = $_SESSION['ID'];
    $filename = "ART_".$UID."_".time()."_".date('Y-m-d').".".$ext;
    if(in_array($filetype, $allowed)){ 
        $location = "..\..\Content/Upload/".$UID."/Art/";
        if(!file_exists($location)) {mkdir($location,0777,true);}
        move_uploaded_file($_FILES["Art"]["tmp_name"], $location.$filename);
        echo "Your file was uploaded successfully.";
    } else{
        echo "Error: There was a problem uploading your file. Please try again."; 
    }
    
    $query = "INSERT INTO `tbl_paintings`(`PaintName`, `UID`, `Description`, `Type`, `Image`) VALUES ('$Title','$UID','$Dis','NAN','$filename')";

    if($conn->query($query))
    {
        $mesg = "Hurry! you are ready to go";            
        header("location: ..\upload_art.php?hurry=".$mesg);
    }
    else
    {
        $mesg = "Error: Something wents wrong!";            
        header("location: ..\upload_art.php?error=".$mesg);
    }
}

if(isset($_POST['Update_Profile']))
{
    $FirstName = $_POST['FirstName'];
    $LastName = $_POST['LastName'];
    $Contact = $_POST['Contact'];
    $Email = $_POST['Email'];
    $Address = $_POST['Address'];

    $UID = $_SESSION['ID'];

    if($conn->query("UPDATE `tbl_user` SET `FirstName`='$FirstName',`LastName`='$LastName',`Email`='$Email',`Contact`='$Contact',`Address`='$Address' WHERE `ID` = $UID"))
    {
        $location = "..\profile.php?done";
        header('location:'.$location);
    }
    else
    {
        $location = "..\profile.php?error404";
        header('location:'.$location);
    }
}

if(isset($_POST['Change_Password']))
{
    $Email = $_POST['Email'];
    $Old_password = $_POST['Old_password'];
    $New_password = $_POST['New_password'];
    $Confirm_password = $_POST['Confirm_password'];

    $UID = $_SESSION['ID'];
    $User = $conn->query("SELECT * FROM `tbl_security` WHERE `ID` = $UID");
    $getUser = $User->fetch_assoc();


    if($getUser['UserName'] != $Email)
    {
        $error = "Email is not vaild!";
        $location = "..\change_password.php?error=".$error;
        header('location:'.$location);
        return;
    }
    if($getUser['Password'] != $Old_password)
    {
        $error = "Old password is not vaild!";
        $location = "..\change_password.php?error=".$error;
        header('location:'.$location);
        return;
    }
    if($New_password != $Confirm_password)
    {
        $error = "New password does not match!";
        $location = "..\change_password.php?error=".$error;
        header('location:'.$location);
        return;
    }

    if($conn->query("UPDATE `tbl_security` SET `Password`='$New_password' WHERE `ID` = $UID"))
    {
        $location = "logout.php?mesg=Password has reset! Login again";
        header('location:'.$location);
        return;
    }
    else
    {
        $error = "Something wents wrong!";
        $location = "..\change_password.php?error=".$error;
        header('location:'.$location);
        return;
    }
}

if(isset($_GET['delete_art']))
{
    $PID = $_GET['delete_art'];
    if($conn->query("DELETE FROM `tbl_paintings` WHERE `ID` = $PID"))
    {
        $conn->query("DELETE FROM `tbl_comments` WHERE `PID` = $PID");
        if(isset($_GET['masg'])){
            $UID = $_GET['masg'];
            $SID = $_SESSION['ID'];
            $title = $_GET['title'];
            $masg = '<div style="text-align: left; line-height: 19px;"><b>Hey!</b>&nbsp;</div><div style="text-align: left; line-height: 19px;">&nbsp; &nbsp; With all respect and our humble submission, we are very sorry to you, your painting title: " '. $title .' " is violating our term and policies. It seems that it is hurting a specific side of users. For exact issue you can contact our admin by just replying this message. we are removing this art from our site. Thanks!<br></div><div style="line-height: 19px;"><b>Yours sincerely</b></div><div style="line-height: 19px;"><i><b>Admin</b></i></div><div style="line-height: 19px;"><b>Art Gallary</b></div><div style="line-height: 19px;"><br></div>';
            $conn->query("INSERT INTO `tbl_messages`(`SID`, `RID`, `Mesg`, `subject`) VALUES ('$SID','$UID','$masg','Hey! we are sorry')");
        }
        $location="..\all_collection.php";
        header("location:".$location);
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_POST['comment']))
{
    $PID = $_POST['PID'];
    $comment = $_POST['text_comment'];
    $UID = $_SESSION['ID'];
    $page = $_POST["PNAME"];

    if($conn->query("INSERT INTO `tbl_comments` (`CID`, `PID`, `Comment`) VALUES ('$UID','$PID','$comment')"))
    {
        $location = "..\Art_Detail.php?page=".$page."&ID=".$PID;
        header('location:'.$location);
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_POST['edit_art']))
{
    $Title = $_POST['Title'];
    $Dis = $_POST['Dis'];
    $ID = $_POST['PID'];

    $query = "UPDATE `tbl_paintings` SET `PaintName`='$Title',`Description`='$Dis' WHERE `ID` = $ID";

    if($conn->query($query))
    {
        $mesg = "Hurry! you just edit it!";            
        header("location: ..\Art_Detail.php?hurry=".$mesg."&ID=".$ID);
    }
    else
    {
        $mesg = "Error: Something wents wrong!";            
        header("location: ..\Art_Detail.php?error=".$mesg."&ID=".$ID);
    }
}

if(isset($_POST['send_mesg']))
{
    $To=$_POST['TO'];
    $SID=$_SESSION['ID'];
    $mesg = $_POST['mesg'];
    $subject = $_POST['sub'];

    if($conn->query("INSERT INTO `tbl_messages`(`SID`, `RID`, `Mesg`, `subject`) VALUES ('$SID','$To','$mesg','$subject')"))
    {
        $location = "..\sent.php";
        header("location:".$location);
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_GET['delete_noti']))
{
    $NID = $_GET['delete_noti'];
    if($conn->query("DELETE FROM `tbl_notifications` WHERE `ID` = $NID"))
    {
        header("location:..\notification.php");
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_GET['delete_mesg']))
{
    $MID = $_GET['delete_mesg'];
    $page = $_GET['page'];
    if($conn->query("DELETE FROM `tbl_messages` WHERE `ID` = $MID"))
    {
        header("location:..\\".$page);
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_POST['Update_Gallary']))
{
    $Contact = $_POST['Contact'];
    $Facebook = $_POST['Facebook'];
    $Twitter = $_POST['Twitter'];
    $Buy = $_POST['Buy'];
    $Gift = $_POST['Gift'];
    $Downlaod = $_POST['Downlaod'];
    $Title = $_POST['Title'];
    $Subtitle = $_POST['Subtitle'];

    if($conn->query("UPDATE `tbl_description` SET `Contact`='$Contact',`Facebook`='$Facebook',`Twitter`='$Twitter',`Buy`='$Buy',`Gift`='$Gift',`Download`='$Downlaod',`Title`='$Title',`Subtitle`='$Subtitle' WHERE `ID`= 1"))
    {
        $location = "..\profile.php?done";
        header('location:'.$location);
    }
    else
    {
        die($conn->error);
        $location = "..\profile.php?error404";
        header('location:'.$location);
    }
}

if(isset($_GET['delete_user']))
{
    $PID = $_GET['delete_user'];
    if($conn->query("DELETE FROM `tbl_user` WHERE `ID` = $PID"))
    {
        $location="..\Users.php";
        header("location:".$location);
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_POST['start_exhibition']))
{
    $Start = $_POST['Start'];
    $End = $_POST['End'];
    $Title = $_POST['Title'];

    if($conn->query("INSERT INTO `tbl_auction`(`AName`, `StartAt`, `EndAt`,`Status`) VALUES ('$Title','$Start','$End','B')"))
    {
        $getAllUsers = $conn->query("SELECT * FROM `tbl_user` WHERE `Role` = 'P'");

        while($User = $getAllUsers->fetch_assoc()):
            $NID = $User['ID'];
            $mesg = "Hey! ".$User['FirstName']." we are exited to tell you exibition is just started. To apply click on this alert thanks";
            $link = "apply_exibition.php";
            $link = urlencode($link);
            $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$NID','$mesg','I','$link')");
        endwhile;

        $location="..\index.php";
        header("location:".$location);
        return;
    }
}

if(isset($_GET['start_exhibition']))
{
    $ID = $_GET['start_exhibition'];
    if($conn->query("UPDATE `tbl_auction` SET `Status`='P' WHERE `ID` = $ID"))
    {
        header("location:..\index.php");
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_GET['helt_exhibition']))
{
    $Total = 0;
    $SOLDTO = -1;
    $getAllAutionData = $conn->query("SELECT * FROM `tbl_auction_date` WHERE `Status` = 0");
    

    $getAutionDetail = $conn->query("SELECT * FROM `tbl_auction` WHERE `Status` = 'P'");
    $Auction=$getAutionDetail->fetch_assoc();
    $AUID = $Auction['ID'];

    while($AutionData = $getAllAutionData->fetch_assoc()):
        $AID = $AutionData['ID'];
        $getAllBitting = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $AID ORDER BY `ID` DESC");
        $BittingDetails = $getAllBitting->fetch_assoc();
        if($BittingDetails != null){
            $Total = $Total + $BittingDetails['Price'];
            $SOLDTO = $BittingDetails['UID'];
            $masg = "Congo! you have brought this art at: ".$BittingDetails['Price']." £ Be ready we will deleiver this shortly.. Please pay this amount online and send a slip";
            $link = "pay.php?ID=".$AID;
            $link = urlencode($link);
            $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$SOLDTO','$masg','D','$link')");   
        }

        $conn->query("UPDATE `tbl_auction_date` SET `SoldTO` = $SOLDTO, `Status` = $AUID where `ID`=$AID");
    endwhile;
    
    if($conn->query("UPDATE `tbl_auction` SET `Status`='E', `TotalSales`=$Total"))
    {
        header("location:..\index.php");
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_GET['select_art']))
{
    $PID = $_GET['select_art'];
    $UID = $_GET['user'];
    if($conn->query("UPDATE `tbl_auction_date` SET `Status`='0' WHERE `ID` = $PID"))
    {
        $conn->query("UPDATE `tbl_auction` SET `TotalPainting` = (`TotalPainting`+1) WHERE `Status` = 'B' ORDER  BY ID  DESC");
        $mesg =  "Congo! your painting has been selected for this exibition. please stay tuned";
        $link = "#";
        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$UID','$mesg','D','$link')");
        $location="..\index.php";
        header("location:".$location);
        return;
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_GET['reject_art']))
{
    $PID = $_GET['reject_art'];
    $UID = $_GET['user'];
    if($conn->query("DELETE FROM `tbl_auction_date` WHERE `ID` = $PID" ))
    {
        $mesg =  "Hey! we are sorry. We are not selected this time for exibition please try again thanks";
        $link = "#";
        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$UID','$mesg','I','$link')");
        $location="..\index.php";
        header("location:".$location);
        return;
    }
    else
    {
        die($conn->error);
    }
}
?>