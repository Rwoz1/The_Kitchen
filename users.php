<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli("localhost", "root", "root", "fridge_manager");
if ($conn->connect_error) {
    die("فشل الاتصال: " . $conn->connect_error);
}

// جلب المنتجات من قاعدة البيانات
$sql = "SELECT * FROM products ORDER BY expiry_date ASC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>نظام إدارة الثلاجة</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- الهيدر -->
    <header>
        <img src="logo.png" alt="شعار الموقع" class="logo">
        <nav>
            <ul>
                <li><a href="#">الرئيسية</a></li>
                <li><a href="#">عن الموقع</a></li>
                <li><a href="#">اتصل بنا</a></li>
                <li><a href="login/login.php" style="color: green; font-weight: bold;">تسجيل الدخول</a></li></ul>
            </ul>
        </nav>
    </header>

    <!-- البحث -->
    <section class="search-section">
        <img src="bg.jpg" alt="خلفية" class="background">
        <div class="search-box">
            <input type="text" placeholder="ابحث عن منتج..." id="searchInput">
            <button onclick="searchProduct()">بحث</button>
        </div>
    </section>

    <!-- التصنيفات -->
    <!-- التصنيفات -->
<section class="categories">
    <div class="category">
        <img src="uploads/dairy.jpg" alt="ألبان">
        <h3>ألبان</h3>
    </div>
    <div class="category">
        <img src="uploads/food.jpg" alt="مأكولات">
        <h3>مأكولات</h3>
    </div>
    <div class="category">
        <img src="uploads/drinks.jpg" alt="مشروبات">
        <h3>مشروبات</h3>
    </div>
</section>

    <!-- المنتجات -->
    <section class="products">
        <h2>المنتجات</h2>
        <div class="product-list" id="productList">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $expiry_date = strtotime($row['expiry_date']);
                    $today = time();
                    $days_remaining = ceil(($expiry_date - $today) / (60 * 60 * 24));
                    $color = ($days_remaining <= 30) ? "red" : "black";

                    echo "<div class='product'>";
                    echo "<img src='uploads/" . $row['image'] . "' alt='" . $row['name'] . "'>";                 
                    echo "<h3 style='color: $color'>" . $row['name'] . "</h3>";
                    echo "<p><strong>الكمية:</strong> " . $row['quantity'] . "</p>";
                    echo "<p><strong>تاريخ الانتهاء:</strong> " . $row['expiry_date'] . "</p>";
                    echo "<p><strong>ملاحظات:</strong> " . $row['notes'] . "</p>";
                    echo "</div>";
                }
            } else {
                echo "<p>لا توجد منتجات متاحة</p>";
            }
            ?>
        </div>
    </section>

    <!-- الفوتر -->
    <footer>
        <p>جميع الحقوق محفوظة &copy; 2025</p>
        <div class="social-media">
            <a href="#">فيسبوك</a>
            <a href="#">تويتر</a>
            <a href="#">إنستجرام</a>
        </div>
    </footer>

    <script>
        function searchProduct() {
            var input, filter, products, product, name, i;
            input = document.getElementById("searchInput");
            filter = input.value.toLowerCase();
            products = document.getElementsByClassName("product");

            for (i = 0; i < products.length; i++) {
                name = products[i].getElementsByTagName("h3")[0].innerText.toLowerCase();
                if (name.includes(filter)) {
                    products[i].style.display = "";
                } else {
                    products[i].style.display = "none";
                }
            }
        }
    </script>

</body>
</html>

