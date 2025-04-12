<?php
// الاتصال بقاعدة البيانات
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "fridge_manager";

$conn = new mysqli($host, $user, $password, $dbname);
if ($conn->connect_error) {
    die("فشل الاتصال بقاعدة البيانات: " . $conn->connect_error);
}
    
// التحقق من وجود معرف المنتج للحذف
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // جلب بيانات المنتج للتحقق من وجوده وحذف الصورة المرتبطة به
    $sql = "SELECT image FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if ($product) {
        // حذف الصورة من المجلد إذا كانت موجودة
        $image_path = "uploads/" . $product['image'];
        if (file_exists($image_path)) {
            unlink($image_path);
        }

        // حذف المنتج من قاعدة البيانات
        $sql = "DELETE FROM products WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);

        if ($stmt->execute()) {
            echo "<p style='color: green;'>تم حذف المنتج بنجاح!</p>";
        } else {
            echo "<p style='color: red;'>خطأ في الحذف: " . $stmt->error . "</p>";
        }

        $stmt->close();
    } else {
        echo "<p style='color: red;'>المنتج غير موجود!</p>";
    }
} else {
    echo "<p style='color: red;'>لم يتم تحديد منتج للحذف!</p>";
}

// إغلاق الاتصال بقاعدة البيانات
$conn->close();

// إعادة توجيه المستخدم إلى صفحة الأدمن بعد الحذف
header("Location: admin.php");
exit;
?>