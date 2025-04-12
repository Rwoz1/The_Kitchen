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

// جلب بيانات المنتج المحدد للتعديل
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM products WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();
    $product = $result->fetch_assoc();
    $stmt->close();

    if (!$product) {
        die("المنتج غير موجود!");
    }
} else {
    die("لم يتم تحديد منتج للتعديل!");
}

// تحديث بيانات المنتج عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_product'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];

    // تحديث الصورة إذا تم تحميل صورة جديدة
    if ($_FILES['image']['size'] > 0) {
        $image = $_FILES['image']['name'];
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($image);
        move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

        // حذف الصورة القديمة إذا كانت موجودة
        if (file_exists($target_dir . $product['image'])) {
            unlink($target_dir . $product['image']);
        }
    } else {
        $image = $product['image']; // الاحتفاظ بالصورة القديمة إذا لم يتم تحميل صورة جديدة
    }

    // تحديث البيانات في قاعدة البيانات
    $sql = "UPDATE products SET name = ?, expiry_date = ?, quantity = ?, image = ?, notes = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssissi", $name, $expiry_date, $quantity, $image, $notes, $id);

    if ($stmt->execute()) {
        echo "<p style='color: green;'>تم تحديث المنتج بنجاح!</p>";
        // تحديث بيانات المنتج بعد التحديث
        $product['name'] = $name;
        $product['expiry_date'] = $expiry_date;
        $product['quantity'] = $quantity;
        $product['image'] = $image;
        $product['notes'] = $notes;
    } else {
        echo "<p style='color: red;'>خطأ في التحديث: " . $stmt->error . "</p>";
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تعديل المنتج</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 500px;
            margin: auto;
        }
        label {
            display: block;
            margin-top: 10px;
        }
        input, textarea {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
        }
        button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h2>تعديل المنتج</h2>

    <!-- نموذج تعديل المنتج -->
    <form method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?php echo $product['id']; ?>">

        <label>اسم المنتج:</label>
        <input type="text" name="name" value="<?php echo $product['name']; ?>" required><br><br>

        <label>تاريخ الانتهاء:</label>
        <input type="date" name="expiry_date" value="<?php echo $product['expiry_date']; ?>" required><br><br>

        <label>الكمية المتوفرة:</label>
        <input type="number" name="quantity" min="1" value="<?php echo $product['quantity']; ?>" required><br><br>

        <label>ملاحظات:</label>
        <textarea name="notes"><?php echo $product['notes']; ?></textarea><br><br>

        <label>صورة المنتج الحالية:</label>
        <img src="uploads/<?php echo $product['image']; ?>" width="100"><br><br>

        <label>تغيير الصورة (اختياري):</label>
        <input type="file" name="image"><br><br>

        <button type="submit" name="update_product">تحديث المنتج</button>
        <a href="admin.php"><button type="submit">العوده للصفه الرئيسية«</button></a>
    </form>

</body>
</html>

<?php

// إغلاق الاتصال بقاعدة البيانات
$conn->close();

// // إعادة توجيه المستخدم إلى صفحة الأدمن بعد التعديل
// header("Location: admin.php");
// exit;
?>
