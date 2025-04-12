<?php
session_start(); // بدء الجلسة

require 'db_connection.php'; // ملف الاتصال بقاعدة البيانات

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // التحقق من صحة اسم المستخدم وكلمة المرور
    $stmt = $conn->prepare("SELECT * FROM admins WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        // التحقق من كلمة المرور باستخدام password_verify
        if (password_verify($password, $user['password'])) {
            // تخزين بيانات المستخدم في الجلسة
            $_SESSION['admin_id'] = $user['id'];
            $_SESSION['username'] = $user['username'];
            
            // إعادة التوجيه إلى الصفحة admin.php في المجلد الرئيسي للمشروع
            header("Location: ../admin.php");  // لاحظ المسار النسبي هنا
            exit(); // إنهاء السكربت بعد التوجيه
        } else {
            echo "كلمة المرور غير صحيحة";
        }
    } else {
        echo "اسم المستخدم غير موجود";
    }
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تسجيل الدخول</title>
    <link rel="stylesheet" href="styles.css"> <!-- تأكد من المسار الصحيح للملف -->
</head>
<body>
    <div class="background">
        <div class="overlay"></div>
        <div class="login-box">
            <h2>تسجيل الدخول</h2>
            <form method="post" action="">
                <div class="textbox">
                    <input type="text" placeholder="اسم المستخدم" name="username" required>
                </div>
                <div class="textbox">
                    <input type="password" placeholder="كلمة المرور" name="password" required>
                </div>
                <div class="options">
                    <label><input type="checkbox" name="remember"> تذكرني</label>
                    <a href="forgot-password.html">نسيت كلمة المرور؟</a>
                </div>
                <button type="submit" class="btn">تسجيل الدخول</button>
                <!-- <p>ليس لديك حساب؟ <a href="register.php">إنشاء حساب جديد</a></p> -->
            </form>
        </div>
    </div>
</body>
</html>
