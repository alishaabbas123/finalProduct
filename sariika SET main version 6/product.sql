CREATE TABLE products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255),
    price DECIMAL(10,2),
    image VARCHAR(255)
);


INSERT INTO products (title, price, image) VALUES
('Timer', 19.99, 'images/timer.jpg'),
('Stationary Set', 24.99, 'images/stationary.jpg'),
('Mug', 10.00, 'images/mug.webp'),
('Smart Watch', 50.99, 'images/watch.jpg');
