<?php
$servername = "localhost";
$dbname = "psms";
$username = "root";
$password = "";
date_default_timezone_set("Asia/Dhaka");

try {
    $conn = new PDO("mysql:host=$servername; dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Success";
} catch (PDOException $e) {
    echo "Connection Fail" . $e->getMessage();
}
