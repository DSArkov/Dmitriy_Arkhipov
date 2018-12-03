/*1. Создать нового пользователя и задать ему права доступа на базу данных «Страны и города мира».*/
#Создаём  пользователя.
CREATE USER IF NOT EXISTS 'root2'@'localhost' IDENTIFIED BY 'password';
#Даём права.
GRANT ALL PRIVILEGES ON * . * TO 'root2'@'localhost';
#Обновляем права.
FLUSH PRIVILEGES;

/*2. Сделать резервную копию базы, удалить базу и пересоздать из бекапа.*/
#Делаем резервную копию.
mysqldump -u root2 -p cities > C:\OSPanel\userdata\MySQL-5.8-x64\dump\cities_dump_03.12.18.sql
#Логинимся.
mysql -u root -p
#Удаляем текущую БД.
DROP SCHEMA `cities`;
#Создаём пустую с таким же именем.
CREATE SCHEMA IF NOT EXISTS `cities`;
#Восстанавливаем.
mysql -u root2 -p cities < C:\OSPanel\userdata\MySQL-5.8-x64\dump\cities_dump_03.12.18.sql