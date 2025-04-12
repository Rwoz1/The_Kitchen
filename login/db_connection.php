<?php
$servername = "localhost";
$username = "root";
$password = "root";
$dbname = "admin_login"; // <-- اسم قاعدة البيانات الجديد

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}
?>
