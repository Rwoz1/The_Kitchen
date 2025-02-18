<?php
function getProducts() {
    global $conn;
    $sql = "SELECT * FROM products ORDER BY expiry_date ASC";
    $result = $conn->query($sql);
    $products = [];
    while ($row = $result->fetch_assoc()) {
        $products[] = $row;
    }
    return $products;
}
?>