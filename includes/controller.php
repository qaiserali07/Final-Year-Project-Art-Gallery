<?php
    session_start(); 
    include('config.php');

    if(isset($_POST['login']))
    {
        $UserName = $_POST['Username'];
        $pass = $_POST['Password'];

        $rs = $conn->query("SELECT `ID` FROM `tbl_security` WHERE `UserName` = '$UserName' AND `Password` = '$pass'") or die($conn->error);

        $data = $rs->fetch_assoc();

        if(empty($data['ID']))
        {
            $url = "..\login.php?page=Login&username=".$UserName."&error404";
            header('location:'.$url);
            return;
        }

        $ID = $data['ID'];

        $getUser_query = $conn->query("SELECT * FROM `tbl_user` WHERE `ID` = '$ID'") or die($conn->error);

        $getUser = $getUser_query->fetch_assoc();

        $_SESSION['Name'] = $getUser['FirstName']." ".$getUser['LastName'];
        $_SESSION['auth'] = "True";
        $_SESSION['ID'] = $getUser['ID'];

        if($getUser['Role'] == 'A')
        {
            $_SESSION['Role'] = "A";
            $url = "..\User/admin/index.php";
            header('location:'.$url);
            return;
        }
        else if($getUser['Role'] == 'B')
        {
            $_SESSION['Role'] = "B";
            $url = "..\index.php";
            header('location:'.$url);
            return;
        }
        else if($getUser['Role'] == 'P')
        {
            $_SESSION['Role'] = "P";
            $url = "..\index.php";
            header('location:'.$url);
            return;
        }
        else
        {
            $url = "..\login.php?page=Login&username=".$UserName."&done&role=inValid";
            header('location:'.$url);
            return;
        }
    }

    if(isset($_POST['register']))
    {
        $firstName = $_POST['FName'];
		$lastName = $_POST['LName'];
		$contact = $_POST['Contact'];
		$email = $_POST['Email'];
		$gender = $_POST['Gender'];
		$role = $_POST['Role'];
		$password = $_POST['Password'];
		$BD = $_POST['DOB'];
		$Profession = $_POST['Profession'];
		$address = $_POST['Address'];

        $sql = "INSERT INTO `tbl_security`(`UserName`, `Password`) VALUES ('$email','$password')";

        if($conn->query($sql))
        {
            $ID = $conn->insert_id;

            if($gender === "Male")
            {
                $gender = "M";
            }
            else if( $gender === "Female")
            {
                $gender = "F";
            }
            else
            {
                $gender = "O";
            }
            if($role === "Beginner")
            {
                $role = "B";
            }
            else if( $role === "Professional")
            {
                $role = "P";
            }
            $insert = "INSERT INTO `tbl_user`(`ID`, `FirstName`, `LastName`, `Email`, `Gender`, `Contact`, `Role`, `DOB`, `Address`, `Profession`) VALUES ('$ID','$firstName','$lastName','$email','$gender','$contact','$role','$BD','$address','$Profession')";
            if($conn->query($insert))
            {
                $url = "..\login.php?page=Login&done";
                header('location:'.$url);
                return;
            }
            else
            {
                die($conn->error);
            }
        }
        else
        {
            $mesg = "Something wents wrong!";
            $url = "..\register.php?page=Register&done=".$mesg;
            header('location:'.$url);
            return;
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

        if($conn->query("INSERT INTO `tbl_comments`(`CID`, `PID`, `Comment`) VALUES ('$UID','$PID','$comment')"))
        {
            $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$NID','Someone just comment on your Art!','$Status','$Link')");
            $location = "..\Art_Details.php?page=".$page."&ID=".$PID;
            header('location:'.$location);
        }
        else
        {
            die($conn->error);
        }
    }

    if(isset($_POST['BIT']))
    {
        $msg = $_POST['msg'];
        $Price = $_POST['Price'];
        $AID = $_POST['AID'];
        $UID = $_POST['UID'];
        $page = $_POST['Page'];

        if($conn->query("INSERT INTO `tbl_bit`(`AID`, `UID`, `Price`) VALUES ('$AID','$UID','$Price')"))
        {
            $link = "..\\..\\Exibition_Art_Detail.php?page=".$page."&ID=".$AID;
            $link = urlencode($link);
            if($msg != 0)
            {
                $getAllBitting = $conn->query("SELECT * FROM `tbl_bit` WHERE `AID` = $AID ORDER BY `UID` DESC");

                while($BittingDetails = $getAllBitting->fetch_assoc()):
                    $NID = $_SESSION['ID'];
                    if($NID != $BittingDetails['UID']){

                        $NID = $BittingDetails['UID'];
                        $mesg = "Someone just updated bit! In order to keep you up do you wanna update your bit? click here for details";
                        

                        $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('$NID','$mesg','C','$link')");
                    }
                endwhile;
            }

            $conn->query("INSERT INTO `tbl_notifications`(`NID`, `Noti`, `Status`, `link`) VALUES ('1','Someone just bit on art! Congo','D','$link')");

            $location = "..\Exibition_Art_Detail.php?page=".$page."&ID=".$AID;
            header('location:'.$location);
        }
        else
        {
            die($conn->error);
        }
    }
?>