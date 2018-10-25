-- --------------------------------------------------------
-- Хост:                         127.0.0.1
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных little_shop
CREATE DATABASE IF NOT EXISTS `little_shop` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `little_shop`;

-- Дамп структуры для таблица little_shop.catalogue
CREATE TABLE IF NOT EXISTS `catalogue` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `title` varchar(64) NOT NULL,
  `description` varchar(512) NOT NULL,
  `brand` varchar(16) DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `url` varchar(64) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы little_shop.catalogue: ~10 rows (приблизительно)
/*!40000 ALTER TABLE `catalogue` DISABLE KEYS */;
INSERT IGNORE INTO `catalogue` (`id`, `title`, `description`, `brand`, `price`, `url`) VALUES
	(1, 'Термокружка Mi Fiu', 'Изящная кружка, которую невозможно опрокинуть.', 'Xiaomi', 2100.00, 'cup.jpg'),
	(2, 'IP камера Dafang 1080', 'Отличное соотношение цены и качества, а также весьма демократичный ценник.', 'Xiaomi', 2600.00, 'dafang_cam.jpg'),
	(3, 'Видеорегистратор YI Dash', 'Умный производительный видеорегистратор с оптимальным функционалом и доступной ценой', 'Xiaomi', 3500.00, 'dash_cam.jpg'),
	(4, 'Электросамокат Mijia Scooter', 'Отличная идея для тех кто оставляет машину на неудобных парковках или не хочет стоять в пробках.', 'Xiaomi', 35000.00, 'electric_scooter.jpg'),
	(5, 'Лампа-ночник Yeelight', 'С лампой Yeelight Bedside Lamp можно создавать совершенно различную атмосферу, подходящую под настроение.', 'Xiaomi', 3600.00, 'night_lamp.jpg'),
	(6, 'Робот-пылесос Mi Cleaner', 'Xiaomi теперь поможет провести интеллектуальную уборку вашего дома с последней разработкой эко-бренда MiJia.', 'Xiaomi', 21600.00, 'cleaner.jpg'),
	(7, 'Умные часы Amazfit Bip', 'Часы из серии smart watch во влагозащитном корпусе с экраном из сверхпрочного стекла Corning Gorilla Glass.', 'Xiaomi', 4600.00, 'smart_watch.jpg'),
	(8, 'Умная лампа CooWoo U1', 'Разработчики лампы подумали: зачем же пропадать такой емкости аккумулятора в пустую? В итоге встроили в нее функцию power bank, выведя 2 порта USB в основание лампы, так что теперь можно помимо того, что лампой пользоваться в любом месте, да еще и 2 устройства подзаряжать.', 'Xiaomi', 2000.00, 'smart_lamp.jpg'),
	(9, 'Умные весы Mi', 'Xiaomi Smart Weight Scale позволяют измерить Ваш вес, а так же несколько других параметров вашего тела.', 'Xiaomi', 2100.00, 'smart_scale.jpg');
/*!40000 ALTER TABLE `catalogue` ENABLE KEYS */;

-- Дамп структуры для таблица little_shop.orders
CREATE TABLE IF NOT EXISTS `orders` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_user` tinyint(4) NOT NULL,
  `date` int(11) NOT NULL,
  `status` enum('Новый','Отменен') NOT NULL DEFAULT 'Новый',
  `total_cost` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `orders_fk` (`id_user`),
  CONSTRAINT `orders_fk` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы little_shop.orders: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;

-- Дамп структуры для таблица little_shop.order_items
CREATE TABLE IF NOT EXISTS `order_items` (
  `id_order` tinyint(4) NOT NULL,
  `id_prod` tinyint(4) DEFAULT NULL,
  `item_price` int(11) NOT NULL,
  `quantity` tinyint(4) DEFAULT NULL,
  `login` varchar(32) NOT NULL,
  KEY `order_items_fk` (`id_prod`),
  KEY `order_items__fk` (`id_order`),
  CONSTRAINT `order_items__fk` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  CONSTRAINT `order_items_fk` FOREIGN KEY (`id_prod`) REFERENCES `catalogue` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы little_shop.order_items: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `order_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `order_items` ENABLE KEYS */;

-- Дамп структуры для таблица little_shop.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `login` varchar(32) NOT NULL,
  `password` varchar(16) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы little_shop.users: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT IGNORE INTO `users` (`id`, `name`, `login`, `password`) VALUES
	(1, 'admin_name', 'admin', 'admin'),
	(2, 'user_name', 'user', 'user');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
