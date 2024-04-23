-- Insert data into the 'metier' table
INSERT INTO metier (id, libelle) VALUES 
(1, 'Étudiant(e)'),
(2, 'Enseignant(e)'),
(3, 'Ingénieur(e)'),
(4, 'Autre');

-- Insert data into the 'categorie' table
INSERT INTO categorie (id, libelle, icon) VALUES 
(1, 'Téléphones', 'fa-solid fa-mobile-screen-button'),
(2, 'Ordinateurs', 'fa-solid fa-laptop'),
(3, 'Montres connectées', 'fa-solid fa-clock'),
(18, 'Claviers', 'fa-solid fa-tags');

-- Insert data into the 'users' table
INSERT INTO users (id, nom, prenom, email, mdp, genre, date_naissance, metier_id, role) VALUES 
(111, 'Koné', 'Mohamed Lamine', 'mohamed@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2003-01-01', 1, 'user'),
(15, 'EL-MAHDAOUI', 'Abdellatif', 'abde@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2000-01-27', 1, 'user'),
(139, 'Zhang', 'Clement', 'clement@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 'M', '2003-01-06', 1, 'user');

-- Insert data into the 'produits' table
INSERT INTO produits (id, reference, description, prix, stock, categorie_id) VALUES 
(46, 'T01_I15P', 'iPhone 15 Pro Max', 1184.99, 5, 1),
(47, 'T02_SGS24', 'Samsung Galaxy S24 Ultra', 1084.99, 8, 1),
(48, 'T03_X13T', 'Xiaomi 13T', 649.99, 6, 1),
(49, 'T04_HP60P', 'Huawei P60 Pro', 999.00, 0, 1),
(50, 'T05_SGZF4', 'Samsung Galaxy Z Flip 5', 1049.99, 1, 1),
(51, 'O01_MBP16', 'MacBook Pro 16', 2399.99, 1, 2),
(52, 'O02_MBA13', 'MacBook Air 13', 1799.99, 3, 2),
(53, 'O03_SURFPRO8', 'Microsoft Surface Pro 8', 1299.99, 7, 2),
(54, 'O04_DELLXPS', 'Dell XPS 15', 1799.99, 0, 2),
(55, 'O05_HPOMEN', 'HP Omen 15', 1099.99, 2, 2),
(56, 'M01_APSE6', 'Apple Watch SE 6', 349.99, 11, 3),
(57, 'M02_SWGA2', 'Samsung Galaxy Active 2', 100.99, 3, 3),
(58, 'M03_FITV4', 'Fitbit Versa 4', 199.99, 5, 3),
(59, 'M04_GARMINVIVO', 'Garmin Vivoactive 4', 249.99, 5, 3),
(60, 'M05_HUAWEIGT', 'Huawei GT 2', 179.99, 6, 3);
