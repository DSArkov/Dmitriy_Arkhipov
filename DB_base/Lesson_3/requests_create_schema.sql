#Создаём БД "Сотрудники".
CREATE SCHEMA `employeesss` DEFAULT COLLATE utf8mb4_unicode_ci;
USE `employees`;

#Создаём таблицу "Отделы".
CREATE TABLE IF NOT EXISTS `departments`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`depart` VARCHAR(25) NOT NULL,
`head` VARCHAR(25) DEFAULT NULL
);

#Создаём таблицу "Сотрудники".
CREATE TABLE IF NOT EXISTS `employees`(
`id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
`firstname` VARCHAR(25) NOT NULL,
`lastname` VARCHAR(25) NOT NULL,
`depart_id` INT NOT NULL,
`salary` INT NOT NULL
);
#Индексируем столбец "Идентифокатор департамента".
CREATE INDEX `depart_index` ON `employees`(`depart_id`);
#Создаём внешний ключ.
ALTER TABLE `employees`
ADD CONSTRAINT `fk_employee_depart` FOREIGN KEY (`depart_id`)
REFERENCES `departments`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE;

#Заполняем таблицы данными.
#Отделы.
INSERT INTO `departments`(`depart`, `head`) VALUES
 ('Разработки', 'Макр Цукерберг'),
 ('Администрирования', 'Билл Гейтс'),
 ('Продаж', NULL),
 ('Бухгалтерия', NULL),
 ('Аналитики', NULL)
 ;
 #Сотрудники.
INSERT INTO `employees`(`firstname`, `lastname`, `depart_id`, `salary`) VALUES
('Билл', 'Гейтс', 2, 99999),
('Марк', 'Цукерберг', 1, 62800),
('Всеволод', 'Стабильнов', 2, 13000),
('Евгения', 'Всепродаванова', 3, 18600),
('Людмила', 'Анакондовна', 4, 15400),
('Сергей', 'Многокодов', 1, 21500)
;

