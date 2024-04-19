-- Create the database if it does not exist
CREATE DATABASE IF NOT EXISTS eshop_fr;

-- Switch to the newly created database
USE eshop_fr;

-- Create the table for users
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(255) NOT NULL,
    prenom VARCHAR(255) NOT NULL,
    email VARCHAR(191) UNIQUE NOT NULL,
    mdp VARCHAR(255) NOT NULL,
    genre CHAR(1) NOT NULL,
    date_naissance DATE NOT NULL,
    metier_id INT,
    verification_token VARCHAR(255),
    verification_date DATETIME,
    role ENUM('admin', 'user') NOT NULL,
    FOREIGN KEY (metier_id) REFERENCES metier(id)
);

-- Create the table for metier
CREATE TABLE IF NOT EXISTS metier (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

-- Create the table for categorie
CREATE TABLE IF NOT EXISTS categorie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    libelle VARCHAR(255) NOT NULL
);

-- Create the table for produits
CREATE TABLE IF NOT EXISTS produits (
    id INT AUTO_INCREMENT PRIMARY KEY,
    photo VARCHAR(255),
    reference VARCHAR(255) NOT NULL,
    description TEXT,
    prix DECIMAL(10, 2) NOT NULL,
    stock INT NOT NULL,
    categorie_id INT,
    FOREIGN KEY (categorie_id) REFERENCES categorie(id)
);

CREATE TABLE IF NOT EXISTS commande (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    product_id INT,
    quantity INT,
    order_date DATETIME,
    order_state VARCHAR(25),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (product_id) REFERENCES products(id)
);

ALTER TABLE users CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE commande CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE metier CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE produits CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
ALTER TABLE categorie CONVERT TO CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;