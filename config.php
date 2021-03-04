<?php 
    define('DB_SERVER','dbpryvate.c8yniitkbcyt.us-east-2.rds.amazonaws.com');
    define('DB_USERNAME', 'admin');
    define('DB_PASSWORD', 'wentworth123');
    define('DB_NAME', 'mydb');

    $conn = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>