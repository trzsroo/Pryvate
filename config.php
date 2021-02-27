<?php 
    $servername = "localhost";
    $username = "root";
    $password = "wit123";
    $dbname = "mydb";

    $conn = mysqli_connect($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>