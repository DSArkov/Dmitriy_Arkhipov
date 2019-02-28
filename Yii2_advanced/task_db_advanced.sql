-- --------------------------------------------------------
-- Хост:                         localhost
-- Версия сервера:               5.7.20 - MySQL Community Server (GPL)
-- Операционная система:         Win64
-- HeidiSQL Версия:              9.5.0.5196
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Дамп структуры базы данных task_db_advanced
CREATE DATABASE IF NOT EXISTS `task_db_advanced` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `task_db_advanced`;

-- Дамп структуры для таблица task_db_advanced.auth_assignment
CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`),
  KEY `idx-auth_assignment-user_id` (`user_id`),
  CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.auth_assignment: ~2 rows (приблизительно)
/*!40000 ALTER TABLE `auth_assignment` DISABLE KEYS */;
INSERT IGNORE INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
	('admin', '1', 1550043387),
	('user', '2', 1550043402),
	('user', '3', 1551290774);
/*!40000 ALTER TABLE `auth_assignment` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.auth_item
CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `type` smallint(6) NOT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `rule_name` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `idx-auth_item-type` (`type`),
  CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.auth_item: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item` DISABLE KEYS */;
INSERT IGNORE INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
	('admin', 1, '', NULL, NULL, 1549376305, 1550226809),
	('Administrate', 2, NULL, NULL, NULL, 1549376305, 1549376305),
	('guest', 1, NULL, NULL, NULL, 1549376305, 1549376305),
	('ProjectCreate', 2, '', NULL, NULL, 1550226796, 1550226796),
	('TaskAddComment', 2, NULL, NULL, NULL, 1549376305, 1549376305),
	('TaskAddFile', 2, NULL, NULL, NULL, 1549376305, 1549376305),
	('TaskCreate', 2, '', NULL, NULL, 1550041106, 1550041120),
	('TaskEdit', 2, '', NULL, NULL, 1550043555, 1550043555),
	('user', 1, '', NULL, NULL, 1549376305, 1551288366);
/*!40000 ALTER TABLE `auth_item` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.auth_item_child
CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `child` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`),
  CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.auth_item_child: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `auth_item_child` DISABLE KEYS */;
INSERT IGNORE INTO `auth_item_child` (`parent`, `child`) VALUES
	('admin', 'Administrate'),
	('admin', 'ProjectCreate'),
	('admin', 'TaskAddComment'),
	('user', 'TaskAddComment'),
	('admin', 'TaskAddFile'),
	('user', 'TaskAddFile'),
	('admin', 'TaskCreate'),
	('admin', 'TaskEdit'),
	('user', 'TaskEdit');
/*!40000 ALTER TABLE `auth_item_child` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.auth_rule
CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `data` blob,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.auth_rule: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `auth_rule` DISABLE KEYS */;
/*!40000 ALTER TABLE `auth_rule` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.chat
CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel` varchar(255) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_chat_user` (`user_id`),
  CONSTRAINT `fk_chat_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.chat: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `chat` DISABLE KEYS */;
/*!40000 ALTER TABLE `chat` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.migration: ~24 rows (приблизительно)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT IGNORE INTO `migration` (`version`, `apply_time`) VALUES
	('m000000_000000_base', 1549121993),
	('m130524_201442_init', 1549121996),
	('m140209_132017_init', 1549451426),
	('m140403_174025_create_account_table', 1549451427),
	('m140504_113157_update_tables', 1549451427),
	('m140504_130429_create_token_table', 1549451427),
	('m140506_102106_rbac_init', 1549375783),
	('m140830_171933_fix_ip_field', 1549451427),
	('m140830_172703_change_account_table_name', 1549451427),
	('m141222_110026_update_ip_field', 1549451427),
	('m141222_135246_alter_username_length', 1549451427),
	('m150614_103145_update_social_account_table', 1549451427),
	('m150623_212711_fix_username_notnull', 1549451427),
	('m151218_234654_add_timezone_to_profile', 1549451427),
	('m160929_103127_add_last_login_at_to_user_table', 1549451427),
	('m170907_052038_rbac_add_index_on_auth_assignment_user_id', 1549375783),
	('m180523_151638_rbac_updates_indexes_without_prefix', 1549375784),
	('m190202_144609_create_tasks_table', 1549122615),
	('m190202_154158_create_task_statuses_table', 1549122615),
	('m190202_154823_create_attachments_and_comments_tables', 1549122615),
	('m190212_134951_create_chat_table', 1549979806),
	('m190215_083838_create_projects_table', 1550221728),
	('m190218_075813_create_telegram_offset_table', 1550486201),
	('m190218_112602_create_telegram_subscribe_table', 1550498265);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.profile
CREATE TABLE IF NOT EXISTS `profile` (
  `user_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `public_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gravatar_id` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bio` text COLLATE utf8_unicode_ci,
  `timezone` varchar(40) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `fk_user_profile` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.profile: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT IGNORE INTO `profile` (`user_id`, `name`, `public_email`, `gravatar_email`, `gravatar_id`, `location`, `website`, `bio`, `timezone`) VALUES
	(1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(2, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
	(3, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.projects
CREATE TABLE IF NOT EXISTS `projects` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.projects: ~8 rows (приблизительно)
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT IGNORE INTO `projects` (`id`, `title`, `description`, `created_at`) VALUES
	(1, 'Lesson 1', 'Homework for first lesson.', '2019-02-15 13:38:44'),
	(2, 'Lesson 2', 'Homework for second lesson.', '2019-02-15 14:44:36'),
	(3, 'Lesson 3', 'Homework for third lesson.', '2019-02-15 14:45:14'),
	(4, 'Lesson 4', 'Homework for forth lesson.', '2019-02-15 14:48:19'),
	(5, 'Lesson 5', 'Homework for fifth lesson.', '2019-02-15 17:37:22'),
	(6, 'Lesson 6', 'Homework for sixth lesson.', '2019-02-18 18:57:08'),
	(7, 'Lesson 7', 'Homework for seventh lesson.', '2019-02-26 23:04:04');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.social_account
CREATE TABLE IF NOT EXISTS `social_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `provider` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `client_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` text COLLATE utf8_unicode_ci,
  `code` varchar(32) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `account_unique` (`provider`,`client_id`),
  UNIQUE KEY `account_unique_code` (`code`),
  KEY `fk_user_account` (`user_id`),
  CONSTRAINT `fk_user_account` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.social_account: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `social_account` DISABLE KEYS */;
/*!40000 ALTER TABLE `social_account` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.tasks
CREATE TABLE IF NOT EXISTS `tasks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `owner_id` int(11) NOT NULL,
  `responsible_id` int(11) DEFAULT NULL,
  `status_id` int(11) NOT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL,
  `description` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `project_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tasks_statuses` (`status_id`),
  KEY `fk_tasks_owner_user` (`owner_id`),
  KEY `fk_tasks_responsible_user` (`responsible_id`),
  KEY `fk_tasks_projects` (`project_id`),
  CONSTRAINT `fk_tasks_owner_user` FOREIGN KEY (`owner_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_tasks_projects` FOREIGN KEY (`project_id`) REFERENCES `projects` (`id`),
  CONSTRAINT `fk_tasks_responsible_user` FOREIGN KEY (`responsible_id`) REFERENCES `user` (`id`),
  CONSTRAINT `fk_tasks_statuses` FOREIGN KEY (`status_id`) REFERENCES `task_statuses` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.tasks: ~20 rows (приблизительно)
/*!40000 ALTER TABLE `tasks` DISABLE KEYS */;
INSERT IGNORE INTO `tasks` (`id`, `title`, `owner_id`, `responsible_id`, `status_id`, `date_start`, `date_end`, `description`, `created_at`, `updated_at`, `project_id`) VALUES
	(1, 'Развернуть приложение на базе Advanced Template', 1, 2, 7, '2019-02-02', '2019-02-02', 'Развернуть чистый проект на базе шаблона Yii2 Advanced.', '2019-02-07 15:05:46', '2019-02-15 11:51:36', 1),
	(2, 'Настроить общую авторизацию', 1, 2, 7, '2019-02-02', '2019-02-02', 'Настроить общую авторизацию для frontend\'a и backend\'a.', '2019-02-07 15:07:15', '2019-02-07 15:07:15', 1),
	(3, 'Установить AdminLTE', 1, 2, 7, '2019-02-02', '2019-02-02', 'Применить к backend части тему Admin LTE.', '2019-02-07 15:08:22', '2019-02-07 15:08:22', 1),
	(4, 'Перенести Task Tracker в новый шаблон', 1, 2, 7, '2019-02-02', '2019-02-07', 'Перенести разрабатываемый Task Tracker с basic шаблона в новый advanced проект.', '2019-02-07 15:10:59', '2019-02-19 12:47:23', 1),
	(5, 'Сделать тест', 1, 1, 7, '2019-02-07', '2019-02-07', 'Написать и запустить приемочные тесты на одну из страниц task tracker\'a.', '2019-02-07 15:11:54', '2019-02-19 12:47:34', 2),
	(8, 'Повторить чат из урока', 1, 2, 7, '2019-02-08', '2019-02-10', 'Повторить чат из урока на базе своего трекера задач.', '2019-02-12 16:14:36', '2019-02-12 16:16:28', 3),
	(9, 'Научить чат запоминать сообщения в БД', 2, 1, 7, '2019-02-12', '2019-02-13', 'Сделать так, чтобы история сообщений хранилась в базе данных.', '2019-02-12 16:15:54', '2019-02-14 16:25:43', 3),
	(10, 'Встроить чат на страницы трекера', 1, 2, 7, '2019-02-12', '2019-02-13', 'Встроить чат на страницы трекера. Пользователи должны быть авторизованы и иметь возможность смотреть историю чата.', '2019-02-12 16:18:03', '2019-02-14 16:25:56', 3),
	(11, 'Сделать обновление задачи через Pjax', 1, 1, 7, '2019-02-14', '2019-02-14', 'Сделать обновление задачи и добавление комментариев через Pjax.', '2019-02-14 16:22:52', '2019-02-14 16:22:52', 4),
	(12, 'Обернуть GridView в Pjax', 1, 2, 7, '2019-02-14', '2019-02-14', 'Обернуть виджет GridView в админке задач Pjax\'ом.', '2019-02-14 16:25:24', '2019-02-15 14:49:03', 4),
	(13, 'Создать бота в Telegram', 1, 2, 7, '2019-02-16', '2019-02-16', 'Создать своего бота, воспроизвести примеры с занятия.', '2019-02-19 12:40:43', '2019-02-19 12:40:43', 5),
	(14, 'Реализовать функционал подписки', 1, 1, 7, '2019-02-16', '2019-02-17', 'Реализовать функционал подписки на создание новых проектов через Telegram.', '2019-02-19 12:44:12', '2019-02-19 12:44:12', 5),
	(15, 'Добавить функционал создания нового проекта через Telegram', 1, 2, 6, '2019-02-16', '2019-02-17', '', '2019-02-19 12:46:26', '2019-02-21 18:57:29', 5),
	(16, 'Развернуть свой RESTful API', 1, 2, 7, '2019-02-19', '2019-02-19', '', '2019-02-19 12:47:05', '2019-02-21 18:39:32', 6),
	(17, 'Реализовать функционал API для task\'ов', 1, 1, 7, '2019-02-19', '2019-02-19', 'Представьте, что с Вашим проектом будет интегрироваться сторонняя система. Интегрироваться она будет по REST API. Вам нужно продумать и реализовать функционал API для получения информации и управления задачами (сущность task).', '2019-02-19 12:49:03', '2019-02-21 18:39:45', 6),
	(18, 'Добавить фильтры в API', 1, 2, 6, '2019-02-19', '2019-02-21', 'Добавить возможность в API фильтровать выборку по месяцу, по создателю и по ответственному.', '2019-02-19 12:49:47', '2019-02-26 23:34:06', 6),
	(19, 'Добавить авторизацию в API', 1, 2, 7, '2019-02-19', '2019-02-20', 'Добавить к функционалу REST API авторизацию для контроля доступа.', '2019-02-19 12:50:34', '2019-02-21 18:39:19', 6),
	(20, 'Модифицировать авторизацию', 1, 2, 6, '2019-02-19', '2019-02-20', 'Сделать авторизацию по токену.', '2019-02-19 12:51:58', '2019-02-26 22:46:47', 6),
	(21, 'Установить Vagrant', 1, 2, 7, '2019-02-23', '2019-02-23', 'Установить Vagrant и наш проект Yii2 через него.', '2019-02-26 23:10:40', '2019-02-27 22:40:45', 7),
	(22, 'Установить Docker', 1, 3, 7, '2019-02-23', '2019-02-23', 'Установить Docker и развернуть наш проект Yii2 через него.', '2019-02-26 23:11:37', '2019-02-27 21:59:45', 7);
/*!40000 ALTER TABLE `tasks` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.task_attachments
CREATE TABLE IF NOT EXISTS `task_attachments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_attachments_tasks` (`task_id`),
  CONSTRAINT `fk_attachments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.task_attachments: ~1 rows (приблизительно)
/*!40000 ALTER TABLE `task_attachments` DISABLE KEYS */;
INSERT IGNORE INTO `task_attachments` (`id`, `task_id`, `path`) VALUES
	(8, 20, 'yzhjtmXf5MBS.png');
/*!40000 ALTER TABLE `task_attachments` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.task_comments
CREATE TABLE IF NOT EXISTS `task_comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(255) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_comments_tasks` (`task_id`),
  KEY `fk_comments_user` (`user_id`),
  CONSTRAINT `fk_comments_tasks` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`),
  CONSTRAINT `fk_comments_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.task_comments: ~9 rows (приблизительно)
/*!40000 ALTER TABLE `task_comments` DISABLE KEYS */;
INSERT IGNORE INTO `task_comments` (`id`, `content`, `task_id`, `user_id`) VALUES
	(1, 'Можно закрывать.', 1, 1),
	(2, 'Почему так долго?', 5, 1),
	(3, 'Закрыто.', 1, 1),
	(4, 'Взята в работу.', 22, 3),
	(5, 'Какая оценка по времени?', 21, 1),
	(6, '5 часов.', 21, 3),
	(7, 'Требуется уточнение.', 21, 3),
	(8, 'Продолжаю работать над задачей...', 21, 3);
/*!40000 ALTER TABLE `task_comments` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.task_statuses
CREATE TABLE IF NOT EXISTS `task_statuses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.task_statuses: ~7 rows (приблизительно)
/*!40000 ALTER TABLE `task_statuses` DISABLE KEYS */;
INSERT IGNORE INTO `task_statuses` (`id`, `title`) VALUES
	(1, 'Новая'),
	(2, 'Аналитика'),
	(3, 'В работе'),
	(4, 'Выполнена'),
	(5, 'Тестирование'),
	(6, 'Доработка'),
	(7, 'Закрыта');
/*!40000 ALTER TABLE `task_statuses` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.telegram_offset
CREATE TABLE IF NOT EXISTS `telegram_offset` (
  `id` int(11) DEFAULT NULL,
  `timestamp_offset` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.telegram_offset: ~24 rows (приблизительно)
/*!40000 ALTER TABLE `telegram_offset` DISABLE KEYS */;
INSERT IGNORE INTO `telegram_offset` (`id`, `timestamp_offset`) VALUES
	(317953179, '2019-02-18 14:15:29'),
	(317953180, '2019-02-18 14:15:29'),
	(317953181, '2019-02-18 14:15:29'),
	(317953182, '2019-02-18 14:19:02'),
	(317953183, '2019-02-18 14:54:21'),
	(317953184, '2019-02-18 15:42:50'),
	(317953185, '2019-02-18 15:44:09'),
	(317953186, '2019-02-18 15:46:25'),
	(317953187, '2019-02-18 15:48:07'),
	(317953188, '2019-02-18 15:48:35'),
	(317953189, '2019-02-18 15:49:19'),
	(317953190, '2019-02-18 17:15:37'),
	(317953191, '2019-02-18 17:16:19'),
	(317953192, '2019-02-18 17:17:50'),
	(317953193, '2019-02-18 17:18:55'),
	(317953194, '2019-02-18 17:22:29'),
	(317953195, '2019-02-18 17:23:40'),
	(317953196, '2019-02-18 17:24:18'),
	(317953197, '2019-02-18 17:25:34'),
	(317953198, '2019-02-18 17:26:47'),
	(317953199, '2019-02-18 17:27:14'),
	(317953200, '2019-02-18 18:04:50'),
	(317953201, '2019-02-18 18:06:10'),
	(317953202, '2019-02-18 18:07:23');
/*!40000 ALTER TABLE `telegram_offset` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.telegram_subscribe
CREATE TABLE IF NOT EXISTS `telegram_subscribe` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `chat_id` int(11) DEFAULT NULL,
  `channel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_id_channel_index` (`chat_id`,`channel`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Дамп данных таблицы task_db_advanced.telegram_subscribe: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `telegram_subscribe` DISABLE KEYS */;
INSERT IGNORE INTO `telegram_subscribe` (`id`, `chat_id`, `channel`) VALUES
	(2, 222145921, 'projects_create');
/*!40000 ALTER TABLE `telegram_subscribe` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.token
CREATE TABLE IF NOT EXISTS `token` (
  `user_id` int(11) NOT NULL,
  `code` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` int(11) NOT NULL,
  `type` smallint(6) NOT NULL,
  UNIQUE KEY `token_unique` (`user_id`,`code`,`type`),
  CONSTRAINT `fk_user_token` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.token: ~0 rows (приблизительно)
/*!40000 ALTER TABLE `token` DISABLE KEYS */;
INSERT IGNORE INTO `token` (`user_id`, `code`, `created_at`, `type`) VALUES
	(1, 'W-bDOJKcDy4Bg6TDW14Xm0HKUBWrwzyJ', 1549453796, 0);
/*!40000 ALTER TABLE `token` ENABLE KEYS */;

-- Дамп структуры для таблица task_db_advanced.user
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `confirmed_at` int(11) DEFAULT NULL,
  `unconfirmed_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `blocked_at` int(11) DEFAULT NULL,
  `registration_ip` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  `flags` int(11) NOT NULL DEFAULT '0',
  `last_login_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_unique_username` (`username`),
  UNIQUE KEY `user_unique_email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- Дамп данных таблицы task_db_advanced.user: ~3 rows (приблизительно)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT IGNORE INTO `user` (`id`, `username`, `email`, `password_hash`, `auth_key`, `confirmed_at`, `unconfirmed_email`, `blocked_at`, `registration_ip`, `created_at`, `updated_at`, `flags`, `last_login_at`) VALUES
	(1, 'admin', 'admin@mail.ru', '$2y$10$UNSrDAwiZ6JAZQsrmaMQ4.Aqp5IcqIpMXQSFgB1ifhwnQmWbyBKn6', 'qzh66-SXCIyYrBVgh_Gi5Jkf8al_gk1x', 1549455002, NULL, NULL, '127.0.0.1', 1549453796, 1549453796, 0, 1551388682),
	(2, 'user', 'user@mail.ru', '$2y$10$SbDonkeh27C06wAa1x5Tj.7ck4vi0sg9RFUhC4XknCuGw2x3BC5I6', 'YjuBq8-8CuaVesW4LjMXDUMSjD7MSx47', 1549459846, NULL, NULL, '127.0.0.1', 1549459846, 1549459846, 0, 1551388668),
	(3, 'student', 'student@mail.ru', '$2y$10$KCEqI/jZ8l6I7BD9wuRRRuPExPz9GJ9V6.11tcYUWQDcD7mrjHLnu', 'Qkx20b4pJPK2eGTFxgdLSFIA8znZ2KQh', 1550667552, NULL, NULL, '127.0.0.1', 1550667441, 1550667441, 0, 1551292860);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
