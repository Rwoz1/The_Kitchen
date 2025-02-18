CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    expiry_date DATE NOT NULL,
    image VARCHAR(255) NOT NULL,
    notes TEXT,
    quantity INT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO products (name, expiry_date, image, notes, quantity) VALUES
('حليب المراعي', '2025-03-01', 'milk.jpg', 'حليب طازج', 10),
('جبن كرافت', '2025-02-20', 'cheese.jpg', 'جبن شيدر', 5);