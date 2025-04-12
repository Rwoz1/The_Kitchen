<?php
require 'db_connection.php'; // ملف اتصال قاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    // جلب المستخدم من قاعدة البيانات
    $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? AND email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // هنا يمكن إضافة الكود لإرسال بريد إلكتروني للمستخدم مع رابط استعادة كلمة المرور
        echo "تم إرسال تعليمات استعادة كلمة المرور إلى بريدك الإلكتروني";
    } else {
        echo "اسم المستخدم أو البريد الإلكتروني غير صحيح";
    }
}
?>

