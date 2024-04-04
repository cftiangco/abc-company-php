CREATE DATABASE abc_php;

use abc_php;

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100) NOT NULL
);


CREATE TABLE materials (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    barcode VARCHAR(30) NOT NULL UNIQUE,
    description VARCHAR(100) NOT NULL,
    category_id INT NOT NULL,
    FOREIGN KEY (category_id) REFERENCES categories(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);