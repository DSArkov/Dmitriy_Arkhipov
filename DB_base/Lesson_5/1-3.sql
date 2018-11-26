#ЗАДАНИЕ 1. "LOCK TABLE".
#Клиент №1---->>>>
USE `employees`;

SHOW TABLES;

LOCK TABLE `employees` READ;

#Клиент №2---->>>>
USE `employees`;

SHOW TABLES;

SELECT * FROM `employees`; #Все ОК!

INSERT INTO `employees`(`firstname`, `lastname`, `depart_id`, `salary`) 
VALUES('Всеволод', 'Мстиславский', 4, 4444); #ОЖИДАНИЕ!

#Клиент №1---->>>>
UNLOCK TABLES;
#Запрос на вставку выполнился...

#Клиент №2---->>>>
SELECT * FROM `employees`;

SELECT * FROM `salaries`;

DELETE FROM `employees` WHERE `id` = 9;

DELETE FROM `salaries` WHERE `id` = 3;


#ЗАДАНИЕ 2. Транзакции.
#1.
SET AUTOCOMMIT = 0;

BEGIN;
SELECT @a := `id` AS `id` FROM `departments` WHERE `head` IS NULL
GROUP BY `id` LIMIT 1;
UPDATE `departments` SET `head` = 'Джони Айв' WHERE `id` = @a;
COMMIT;

SET AUTOCOMMIT = 1;

SELECT * FROM `departments`;

#2.
SET SQL_SAFE_UPDATES = 0;
SET AUTOCOMMIT = 0;

BEGIN;
SELECT @b := MIN(`salary`) AS `min_salary` FROM `employees`;
UPDATE `employees` SET `salary` = @b + 5000 WHERE `salary` = @b; 
COMMIT;

SET SQL_SAFE_UPDATES = 1;
SET AUTOCOMMIT = 1;

SELECT * FROM `employees` ORDER BY `salary`;


#ЗАДАНИЕ 3. "EXPLAIN".
#Запрос 1.
EXPLAIN
SELECT * FROM `departments` WHERE `head` IS NOT NULL;

#Запрос 2.
EXPLAIN 
SELECT `employees`.`id`, CONCAT(`firstname`, ' ', `lastname`) AS `name`, `departments`.`depart`, `salary` 
FROM `employees`
LEFT JOIN `departments` 
ON `departments`.`id` = `employees`.`depart_id`
WHERE `salary` > 40000
ORDER BY `salary` DESC;




