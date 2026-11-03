-- Jeu d'essai
USE touche_pas_au_klaxon;
INSERT IGNORE INTO agencies (city) VALUES
('Paris'),('Lyon'),('Marseille'),('Toulouse'),
('Nice'),('Nantes'),('Strasbourg'),('Montpellier'),
('Bordeaux'),('Lille'),('Rennes'),('Reims');
INSERT INTO users (lastname,firstname,phone,email,password,role) VALUES
('Martin','Alexandre','0612345678','alexandre.martin@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Dubois','Sophie','0698765432','sophie.dubois@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Bernard','Julien','0622446688','julien.bernard@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Moreau','Camille','0611223344','camille.moreau@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Lefèvre','Lucie','0777889900','lucie.lefevre@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Leroy','Thomas','0655443322','thomas.leroy@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Roux','Chloé','0633221199','chloe.roux@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Petit','Maxime','0766778899','maxime.petit@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Garnier','Laura','0688776655','laura.garnier@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Dupuis','Antoine','0744556677','antoine.dupuis@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Lefebvre','Emma','0699887766','emma.lefebvre@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Fontaine','Louis','0655667788','louis.fontaine@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Chevalier','Clara','0788990011','clara.chevalier@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Robin','Nicolas','0644332211','nicolas.robin@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Gauthier','Marine','0677889922','marine.gauthier@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Fournier','Pierre','0722334455','pierre.fournier@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Girard','Sarah','0688665544','sarah.girard@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Lambert','Hugo','0611223366','hugo.lambert@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Masson','Julie','0733445566','julie.masson@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Henry','Arthur','0666554433','arthur.henry@email.fr','$2y$12$C1Xo.xw9N77NxI1zoyKkL.ApdBss/cujTyT8sdGNnzJee6DxbDsQO','user'),
('Administrateur','Admin','0600000000','admin@cenef.local','$2y$12$xJif3y22uytkmhviFKBlE.JSlkVJv.xUuW.Ga91iZ1ANTqpi9dgLe','admin');
INSERT INTO trips (departure_agency_id,arrival_agency_id,departure_datetime,arrival_datetime,total_seats,available_seats,contact_user_id) VALUES
(1,2,DATE_ADD(NOW(), INTERVAL 2 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 2 DAY), INTERVAL 5 HOUR),4,4,1),
(3,4,DATE_ADD(NOW(), INTERVAL 3 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 3 DAY), INTERVAL 4 HOUR),3,2,2),
(5,6,DATE_ADD(NOW(), INTERVAL 5 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 5 DAY), INTERVAL 6 HOUR),5,1,3),
(7,8,DATE_ADD(NOW(), INTERVAL 7 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 7 DAY), INTERVAL 3 HOUR),4,3,4),
(9,10,DATE_ADD(NOW(), INTERVAL 10 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 10 DAY), INTERVAL 5 HOUR),4,4,5),
(11,12,DATE_ADD(NOW(), INTERVAL 12 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 12 DAY), INTERVAL 4 HOUR),2,1,6),
(1,3,DATE_ADD(NOW(), INTERVAL 15 DAY),DATE_ADD(DATE_ADD(NOW(), INTERVAL 15 DAY), INTERVAL 7 HOUR),4,2,7);
