<?php
session_start();
include('config.php');
if(isset($_POST['upload_art']))
{
    $Title = $_POST['Title'];
    $Dis = $_POST['Dis'];

    if(!isset($_FILES["Art"]) && ($_FILES["Art"]["error"] == 0)){
        $mesg = "Error: File error ". $_FILES["Art"]["error"];
        header("location: ..\upload_art?error=".$mesg);
    }

    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["Art"]["name"];
    $filetype = $_FILES["Art"]["type"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        $mesg = "Error: Please select a valid file format.";            
        header("location: ..\upload_art?error=".$mesg);
    }

    $UID = $_SESSION['ID'];
    $filename = "ART_" . $UID . "_" . time() . "_" . date('Y_m_d') . "." . $ext;
    
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

    $Link = $_POST["LINK"];
        $NID = $_POST["NID"];
        $Status = $_POST["STATUS"];
    $Link = urlencode($Link);

    if($conn->query("INSERT INTO `tbl_comments` (`CID`, `PID`, `Comment`) VALUES ('$UID','$PID','$comment')"))
    {
        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$NID','Someone just comment on your Art!','$Status','$Link')");
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
        $location = "..\notification.php";
        header("location:".$location);
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

if(isset($_POST['apply_exibition']))
{
    $Title = $_POST['Title'];
    $Dis = $_POST['Dis'];
    $Price = $_POST['Price'];
    $ABY = $_SESSION['ID'];

    if(!isset($_FILES["Art"]) && $_FILES["Art"]["error"] == 0){
        $mesg = "Error: File error ". $_FILES["Art"]["error"];
        die($mesg);
    }

    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["Art"]["name"];
    $filetype = $_FILES["Art"]["type"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        $mesg = "Error: Please select a valid file format.";            
        die($mesg);
    }

    $UID = $_SESSION['ID'];
    $filename = "ART_".$ID."_".time()."_".date().".".$ext;
    
    
    $query = "INSERT INTO `tbl_auction_date`(`ArtName`, `Discription`, `DemandPrice`, `ArtBy`) VALUES ('$Title','Dis','$Price','$ABY')";

    if($conn->query($query))
    {
        $UploadID = $conn->insert_id;
        if(in_array($filetype, $allowed)){ 
            $location = "..\..\Content/Auction/".$UploadID."/";
            if(!file_exists($location)) {mkdir($location,0777,true);}
            move_uploaded_file($_FILES["Art"]["tmp_name"], $location.$filename);
            echo "Your file was uploaded successfully.";
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
        
        $conn->query("UPDATE `tbl_auction_date` SET `Image`='$filename' WHERE `ID` = $UploadID");

        $mesg =  "Someone just apply for exhibition! lets check this out";
        $link = "exibition_data.php";
        $link = urlencode($link);
        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('1','$mesg','D','$link')");
        
        header("location: ..\index.php");
    }
    else
    {
        die($conn->error);
    }
}

if(isset($_POST['pay']))
{
    $ID = $_POST['AID'];

    if(!isset($_FILES["Art"]) && $_FILES["Art"]["error"] == 0){
        $mesg = "Error: File error ". $_FILES["Art"]["error"];
        die($mesg);
    }

    $allowed = array("jpg" => "image/jpg", "jpeg" => "image/jpeg", "gif" => "image/gif", "png" => "image/png");
    $filename = $_FILES["Art"]["name"];
    $filetype = $_FILES["Art"]["type"];

    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if(!array_key_exists($ext, $allowed)){
        $mesg = "Error: Please select a valid file format.";            
        die($mesg);
    }

    $UID = $_SESSION['ID'];
    $filename = "ART_".$ID."_".time()."_".date().".".$ext;
    
    
    $query = "INSERT INTO `tbl_pay`(`AID`, `Image`) VALUE ('$ID','$filename')";

    if($conn->query($query) or die($conn->error))
    {
        if(in_array($filetype, $allowed)){ 
            $location = "..\..\Content/Pay/".$ID."/";
            if(!file_exists($location)) {mkdir($location,0777,true);}
            move_uploaded_file($_FILES["Art"]["tmp_name"], $location.$filename);
            echo "Your file was uploaded successfully.";
            $mesg =  "Someone just upload payslip....";
        $link = "exhibiition.php";
        $link = urlencode($link);
        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('1','$mesg','D','$link')");
        } else{
            echo "Error: There was a problem uploading your file. Please try again."; 
        }
        
        header("location: ..\index.php");
    }
    else
    {
        die($conn->error);
    }
}
?>