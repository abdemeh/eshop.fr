-- Insert data into the 'metier' table
INSERT INTO metier (libelle) VALUES 
('Étudiant(e)'),
('Enseignant(e)'),
('Ingénieur(e)'),
('Autre');

-- Insert data into the 'categorie' table
INSERT INTO categorie (libelle) VALUES 
('Téléphones'),
('Ordinateurs'),
('Montres connectées');

-- Insert data into the 'users' table
INSERT INTO users (nom, prenom, email, mdp, genre, date_naissance, metier_id, role) VALUES 
('Koné', 'Mohamed Lamine', 'mohamed@gmail.com', '123', 'M', '2003-01-01', 1, 'user'),
('EL-MAHDAOUI', 'Abdellatif', 'abde@gmail.com', '0000', 'M', '2000-01-27', 1, 'user'),
('Jean', 'Louise', 'louise@gmail.com', 'aaaa', 'F', '2001-04-30', 3, 'user');

-- Insert data into the 'produits' table
INSERT INTO produits (photo, reference, description, prix, stock, categorie_id) VALUES 
('img/produits/1.jpg', 'T01_I15P', 'iPhone 15 Pro Max', 1184.99, 5, 1),
('img/produits/2.jpg', 'T02_SGS24', 'Samsung Galaxy S24 Ultra', 1084.99, 3, 1),
('img/produits/3.jpg', 'T03_X13T', 'Xiaomi 13T', 649.99, 7, 1),
('img/produits/4.jpg', 'T04_HP60P', 'Huawei P60 Pro', 999.99, 7, 1),
('img/produits/5.jpg', 'T05_SGZF4', 'Samsung Galaxy Z Flip 5', 1049.99, 7, 1),
('img/produits/6.jpg', 'O01_MBP16', 'MacBook Pro 16', 2399.99, 5, 2),
('img/produits/7.jpg', 'O02_MBA13', 'MacBook Air 13', 1799.99, 3, 2),
('img/produits/8.jpg', 'O03_SURFPRO8', 'Microsoft Surface Pro 8', 1299.99, 7, 2),
('img/produits/9.jpg', 'O04_DELLXPS', 'Dell XPS 15', 1799.99, 5, 2),
('img/produits/10.jpg', 'O05_HPOMEN', 'HP Omen 15', 1099.99, 7, 2),
('img/produits/11.jpg', 'M01_APSE6', 'Apple Watch SE 6', 349.99, 5, 3),
('img/produits/12.jpg', 'M02_SWGA2', 'Samsung Galaxy Active 2', 100.99, 3, 3),
('img/produits/13.jpg', 'M03_FITV4', 'Fitbit Versa 4', 199.99, 7, 3),
('img/produits/14.jpg', 'M04_GARMINVIVO', 'Garmin Vivoactive 4', 249.99, 5, 3),
('img/produits/15.jpg', 'M05_HUAWEIGT', 'Huawei GT 2', 179.99, 7, 3);
