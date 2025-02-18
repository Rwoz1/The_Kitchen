<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>قائمة الطعام</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 10px 0;
            text-align: center;
        }
        nav {
            display: flex;
            justify-content: center;
            background-color: #444;
            padding: 10px;
        }
        nav a {
            color: #fff;
            margin: 0 15px;
            text-decoration: none;
            font-weight: bold;
        }
        .container {
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .search-bar {
            text-align: center;
            margin-bottom: 20px;
        }
        .search-bar input {
            padding: 10px;
            width: 300px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .search-bar button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        .food-menu {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }
        .food-item {
            flex: 1 1 calc(33.333% - 40px);
            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 5px;
            overflow: hidden;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .food-item img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .food-item h3 {
            margin: 10px;
            font-size: 18px;
        }
        .food-item p {
            margin: 10px;
            color: #555;
        }
        .food-item .price {
            margin: 10px;
            font-size: 20px;
            color: #4CAF50;
            font-weight: bold;
        }
        footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: #fff;
            margin-top: 20px;
        }
    </style>
</head>
<body>

    <header>
        <h1>wowFood</h1>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Foods</a>
        <a href="#">Contact</a>
    </nav>

    <div class="container">
        <div class="search-bar">
            <input type="text" placeholder="Search for Food...">
            <button>Search</button>
        </div>

        <div class="food-menu">
            <div class="food-item">
                <img src="images/burger.jpg" alt="Burger">
                <h3>Sandy Burger</h3>
                <p>مصنوع مع الصلصة الإيطالية، الدجاج والخضروات العضوية.</p>
                <div class="price">$2.3</div>
            </div>
            <div class="food-item">
                <img src="images/pizza.jpg" alt="Pizza">
                <h3>Pizza</h3>
                <p>مصنوع مع الصلصة الإيطالية، الدجاج والخضروات العضوية.</p>
                <div class="price">$2.3</div>
            </div>
            <div class="food-item">
                <img src="images/momo.jpg" alt="Momo">
                <h3>Chicken Steam Momo</h3>
                <p>مصنوع مع الصلصة الإيطالية، الدجاج والخضروات العضوية.</p>
                <div class="price">$2.3</div>
            </div>
        </div>
    </div>

    <footer>
        <p>All rights reserved. Designed By Ylrey Thapa</p>
    </footer>

</body>
</html>