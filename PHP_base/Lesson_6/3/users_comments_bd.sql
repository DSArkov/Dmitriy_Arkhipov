-- Дамп структуры базы данных users_comments
CREATE DATABASE IF NOT EXISTS `users_comments` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `users_comments`;

-- Дамп структуры для таблица users_comments.comments
CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `text` varchar(256) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы users_comments.comments: ~2 rows (приблизительно)
INSERT IGNORE INTO `comments` (`id`, `name`, `text`) VALUES
	(1, 'Сергей', 'Здесь находится текст первого отзыва...'),
	(2, 'Наталья', 'Здесь находится текст второго отзыва...');