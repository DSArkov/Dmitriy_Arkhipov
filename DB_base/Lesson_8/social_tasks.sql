#Создаём новую БД.
CREATE SCHEMA IF NOT EXISTS `social`;

USE `social`;

#Создаём таблицу "user".
CREATE TABLE IF NOT EXISTS `user`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`name` VARCHAR(25) NOT NULL
);

#Создаём таблицу "like".
CREATE TABLE IF NOT EXISTS `like`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`from_user` INT NOT NULL,
`to_user` INT NOT NULL
);

#Определяем внешний ключ для столбца "from_user".
ALTER TABLE `like`
ADD CONSTRAINT `fk_like_user_from` FOREIGN KEY (`from_user`)
REFERENCES `user`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE; 

#Определяем внешний ключ для столбца "to_user".
ALTER TABLE `like`
ADD CONSTRAINT `fk_like_user_to` FOREIGN KEY (`to_user`)
REFERENCES `user`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE; 

#Заполняем таблицы данными.
INSERT INTO `user`(`name`) VALUES
('Вася'),
('Сергей'),
('Павел'),
('Алёна'),
('Ирина')
;

INSERT INTO `like`(`from_user`, `to_user`) VALUES
(1, 4), #Вася - Алёна
(1, 5), #Вася - Ирина
(4, 1), #Алёна - Вася
(2, 3), #Сергей - Павел
(4, 3), #Алёна - Павел
(2, 1), #Cергей - Вася
(3, 5)  #Павел - Ирина
;

#Запрос на выборку всех данных.
SELECT * FROM `user`;
SELECT * FROM `like`;

#Сводим 2 таблицы и смотрим, что получилось.
SELECT `l`.`id`, `u1`.`name`, `u2`.`name` FROM `like` AS `l` 
LEFT JOIN `user` AS `u1` ON `u1`.`id` = `l`.`from_user`
LEFT JOIN `user` AS `u2` ON `u2`.`id` = `l`.`to_user` 
GROUP BY `l`.`id`;

#Задача 1.
SELECT `u`.`id`, `u`.`name`, `l1`.`count` AS `to_user`, `l2`.`count` AS `from_user` 
FROM `user` AS `u`
LEFT JOIN (
SELECT COUNT(*) AS `count`, `l`.`to_user` FROM `like` AS `l`
GROUP BY `l`.`to_user`) AS `l1`
ON `l1`.`to_user` = `u`.`id`
LEFT JOIN (
SELECT COUNT(*) AS `count`, `l`.`from_user` FROM `like` AS `l`
GROUP BY `l`.`from_user`) AS `l2`
ON `l2`.`from_user` = `u`.`id`;

#Задача 2. В процессе...
SELECT `l`.`from_user`, `l`.`to_user` FROM (SELECT `from_user`, `to_user` FROM `like` WHERE `to_user` <> 2) AS `l`
WHERE (`to_user` = 4) OR (`to_user` = 5);

SELECT * FROM `like` WHERE (`to_user` = 4) OR (`to_user` = 5) OR (`to_user` <> 2);

SELECT * FROM `like` WHERE `to_user` <> 2;


