-- Make sure the table exists first
CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255),
    price INT,
    color VARCHAR(50),
    in_stock BOOLEAN
);

-- Insert sample products
INSERT INTO products (name, price, color, in_stock) VALUES 
('Red T-Shirt', 250, 'Red', 1),
('Blue T-Shirt', 300, 'Blue', 1),
('Green T-Shirt', 200, 'Green', 0),
('Black Jeans', 500, 'Black', 1),
('White Shirt', 400, 'White', 1),
('Blue Jeans', 600, 'Blue', 0),
('Green Hoodie', 550, 'Green', 1),
('Red Hoodie', 450, 'Red', 0),
('Yellow Jacket', 750, 'Yellow', 1),
('Gray Sweater', 350, 'Gray', 1),
('Purple Dress', 800, 'Purple', 0),
('Blue Cap', 150, 'Blue', 1);
