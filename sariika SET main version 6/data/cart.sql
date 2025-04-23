

USE checkout.products;

INSERT INTO products (title, price, image) VALUES
('Timer', 19.99, 'images/timer.jpg'),
('Stationary Set', 24.99, 'images/stationary.jpg'),
('Mug', 10.00, 'images/mug.webp'),
('Smart Watch', 50.99, 'images/watch.jpg');

SELECT * FROM products;

ALTER TABLE products
ADD COLUMN id INT AUTO_INCREMENT PRIMARY KEY;

