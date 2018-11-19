USE `employees`;

#Выбрать среднюю зарплату по отделам.
SELECT `departments`.`depart` AS `department`, AVG(`salary`) AS `average_salary` FROM `employees`
INNER JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `department`;

#Выбрать максимальную зарплату у сотрудника.
SELECT CONCAT(`firstname`, ' ', `lastname`) AS `name`, `salary` FROM `employees` 
ORDER BY `salary` DESC LIMIT 1;
 
#Удалить одного сотрудника, у которого максимальная зарплата.
#1-й способ:
DELETE FROM `employees` WHERE `salary` = (SELECT * FROM (SELECT MAX(`salary`) FROM `employees`) AS `tmp`);
#2-й способ:
DELETE FROM `employees`
ORDER BY `salary` DESC LIMIT 1;

#Посчитать количество сотрудников во всех отделах.
SELECT `departments`.`depart` AS `department`, COUNT(`employees`.`id`) AS `count` FROM `employees`
LEFT JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `employees`.`depart_id`;

#Найти количество сотрудников в отделах и посмотреть, сколько всего денег получает отдел.
SELECT `departments`.`depart` AS `department`,
COUNT(`employees`.`id`) AS `count`,
SUM(`employees`.`salary`) AS `salary` FROM `employees`
LEFT JOIN `departments` ON `employees`.`depart_id` = `departments`.`id`
GROUP BY `employees`.`depart_id`;
