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
SET AUTOCOMMIT = 0;
SET TRANSACTION ISOLATION LEVEL REPEATABLE READ;

BEGIN;
SELECT @a := `id` AS `id`, `depart`, `head` FROM `departments` WHERE `head` IS NULL
GROUP BY `id` LIMIT 1;
UPDATE `depart` SET `head` = 'Джони Айв' WHERE `head` = @a;
COMMIT;


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




