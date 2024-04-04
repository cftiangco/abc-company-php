CREATE DATABASE abc_php;

use abc_php;

CREATE TABLE categories (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100) NOT NULL
);

CREATE TABLE locations (
    id TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100) NOT NULL
);

CREATE TABLE availability (
    id TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    description VARCHAR(100) NOT NULL
);

CREATE TABLE material_location_status (
    id TINYINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
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

CREATE TABLE material_location (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    material_id INT NOT NULL,
    location_id TINYINT NOT NULL,
    availability_id TINYINT NOT NULL,
    material_location_status_id TINYINT NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (location_id) REFERENCES locations(id),
    FOREIGN KEY (material_id) REFERENCES materials(id),
    FOREIGN KEY (availability_id) REFERENCES availability(id),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP()
);