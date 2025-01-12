<?php
$host = "localhost";
$dbUsername = "root";
$dbPassword = "";
$dbname = "user_app";

$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}else{
    //echo "Connection successful";
}