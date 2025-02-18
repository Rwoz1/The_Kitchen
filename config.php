<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "fridge_manager";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
?>