-- Дамп структуры базы данных big_small_img
CREATE DATABASE IF NOT EXISTS `big_small_img`
USE `big_small_img`;

-- Дамп структуры для таблица big_small_img.images
CREATE TABLE IF NOT EXISTS `images` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `url` varchar(128) NOT NULL,
  `size` int(11) NOT NULL,
  `title` varchar(32) NOT NULL,
  `count` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы big_small_img.images: ~5 rows (приблизительно)
INSERT IGNORE INTO `images` (`id`, `url`, `size`, `title`, `count`) VALUES
	(1, 'http://lesson5/public/img/max/1.jpg', 77283, '1.jpg', 0),
	(2, 'http://lesson5/public/img/max/2.jpg', 117746, '2.jpg', 0),
	(3, 'http://lesson5/public/img/max/3.jpg', 82611, '3.jpg', 0),
	(4, 'http://lesson5/public/img/max/4.jpg', 84588, '4.jpg', 0),
	(5, 'http://lesson5/public/img/max/5.jpg', 285395, '5.jpg', 0);
