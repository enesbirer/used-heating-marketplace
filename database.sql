CREATE DATABASE IF NOT EXISTS birer_db;
USE birer_db;

CREATE TABLE IF NOT EXISTS products (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    category ENUM('kombi', 'petek') NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    is_new TINYINT(1) DEFAULT 0,
    images LONGTEXT NOT NULL, -- JSON formatında Base64 resim dizisi
    description TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Örnek veriler
INSERT INTO products (name, category, price, is_new, image, description) VALUES 
('Hermetik Kombi 24 kW', 'kombi', 12500.00, 0, 'https://images.unsplash.com/photo-1585130401366-fe05a8d813c4?auto=format&fit=crop&q=80', 'Dijital göstergeli, az kullanılmış.'),
('Panel Petek 600x1200', 'petek', 2200.00, 1, 'https://images.unsplash.com/photo-1517646281691-2ca61286a090?auto=format&fit=crop&q=80', 'Geniş yüzeyli beyaz panel petek.');