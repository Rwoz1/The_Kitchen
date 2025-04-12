

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

// إضافة منتج جديد عند إرسال النموذج
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_product'])) {
    $name = $_POST['name'];
    $expiry_date = $_POST['expiry_date'];
    $quantity = $_POST['quantity'];
    $notes = $_POST['notes'];

    // رفع الصورة
    $image = $_FILES['image']['name'];
    $target_dir = "uploads/";
    $target_file = $target_dir . basename($image);
    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);

    // إدخال البيانات إلى قاعدة البيانات
    $sql = "INSERT INTO products (name, expiry_date, quantity, image, notes) 
            VALUES ('$name', '$expiry_date', '$quantity', '$image', '$notes')";

    if ($conn->query($sql) === TRUE) {
        echo "<p style='color: green;'>تمت إضافة المنتج بنجاح!</p>";
    } else {
        echo "<p style='color: red;'>خطأ في الإضافة: " . $conn->error . "</p>";
    }
}

// حذف المنتج
if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $conn->query("DELETE FROM products WHERE id=$id");
    echo "<p style='color: green;'>تم حذف المنتج بنجاح!</p>";
}

// جلب جميع المنتجات
$result = $conn->query("SELECT * FROM products ORDER BY expiry_date ASC");
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>صفحة الأدمن - إدارة المنتجات</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }
        th {
            background-color: #f4f4f4;
        }
        .expired {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>

    <h2>إدارة المنتجات</h2>

    <!-- نموذج إضافة منتج جديد -->
    <form method="POST" enctype="multipart/form-data">

        <label>اسم المنتج:</label>
        <input type="text" name="name" required><br><br>

        <label>تاريخ الانتهاء:</label>
        <input type="date" name="expiry_date" required><br><br>

        <label>الكمية المتوفرة:</label>
        <input type="number" name="quantity" min="1" required><br><br>

        <label>ملاحظات:</label>
        <textarea name="notes"></textarea><br><br>

        <label>صورة المنتج:</label>
        <input type="file" name="image" required><br><br>

        <button type="submit" name="add_product">إضافة المنتج</button>
    </form>
       <a href="login/register.php"><button>اضافة مشرف جديد</button></a> 
       <a href="users.php"><button>الرجوع الى صفحه المستخدمين</button></a> 
    <!-- عرض جميع المنتجات -->
    <h3>المنتجات المضافة</h3>
    <table>
        <tr>
            <th>الصورة</th>
            <th>الاسم</th>
            <th>تاريخ الانتهاء</th>
            <th>الكمية</th>
            <th>ملاحظات</th>
            <th>الإجراءات</th>
        </tr>
        admin.php
        <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
            <td><img src="uploads/<?php echo $row['image']; ?>" width="50"></td>
            <td><?php echo $row['name']; ?></td>
            <td class="<?php echo (strtotime($row['expiry_date']) < strtotime('+1 month')) ? 'expired' : ''; ?>">
                <?php echo $row['expiry_date']; ?>
            </td>
            <td><?php echo $row['quantity']; ?></td>
            <td><?php echo $row['notes']; ?></td>
            <td>
                <a href="edit_product.php?id=<?php echo $row['id']; ?>">تعديل</a> | 
                <a href="delete_product.php?id=<?php echo $row['id']; ?>" onclick="return confirm('هل أنت متأكد من الحذف؟');">حذف</a>            </td>
        </tr>
        <?php endwhile; ?>

    </table>

</body>
</html>

<?php
$conn->close();
?>