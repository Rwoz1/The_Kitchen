<?php
require 'db_connection.php'; // ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $first_name = $_POST['first-name'];
    $last_name = $_POST['last-name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // تشفير كلمة المرور

    // التحقق من وجود اسم المستخدم أو البريد الإلكتروني مسبقًا
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ? OR email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "اسم المستخدم أو البريد الإلكتروني موجود مسبقًا";
    } else {
        // إدخال المستخدم الجديد في قاعدة البيانات
        $stmt = $conn->prepare("INSERT INTO admins (first_name, last_name, username, email, phone, password) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssss", $first_name, $last_name, $username, $email, $phone, $password);

        if ($stmt->execute()) {
            echo "تم إنشاء الحساب بنجاح";
        } else {
            echo "حدث خطأ أثناء إنشاء الحساب";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>إنشاء حساب مشرف</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="login-box">
            <h2>إنشاء حساب مشرف</h2>
            <form id="register-form" method="post" action="">
                <div class="textbox">
                    <input type="text" placeholder="الاسم الأول" name="first-name" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="الاسم الأخير" name="last-name" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="اسم المستخدم" name="username" required>
                </div>
                <div class="textbox">
                    <input type="email" placeholder="البريد الإلكتروني" name="email" required>
                </div>
                <div class="textbox">
                    <input type="text" placeholder="رقم الهاتف" name="phone" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="كلمة المرور" name="password" required>
                </div>
                <button type="submit" class="btn">إنشاء الحساب</button>
                <p>هل لديك حساب؟ <a href="login.php">تسجيل الدخول</a></p>
            </form>
        </div>
    </div>
</body>
</html>
