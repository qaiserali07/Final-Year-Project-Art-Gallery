<?php

    $server = "localhost";
    $pass = "";
    $username = "root";
    $db = "agdb";

    $conn = new mysqli($server,$username,$pass,$db) or die(mysqli_error($conn));

?>