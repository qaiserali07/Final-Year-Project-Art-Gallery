<?php

    session_start(); 
    $_SESSION = array();
    session_unset();
    session_destroy();

    if(isset($_GET['mesg']))
    {
        header('location:..\..\..\login.php?mesg='.$_GET['mesg']);
    }
    header('location: ..\..\..\index.php');
?>