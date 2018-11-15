USE `cities_les1`;

# Таблица "countries".
ALTER TABLE `countries`
CHANGE COLUMN `id_country` `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT;

ALTER TABLE `countries`
CHANGE COLUMN `country_name` `title` VARCHAR(150) NOT NULL;

CREATE INDEX `title_index` ON `countries`(`title`);

#Таблица "regions".
ALTER TABLE `regions`
CHANGE COLUMN `id_region` `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT;

ALTER TABLE `regions`
CHANGE COLUMN `country_id` `country_id` INT NOT NULL,
ADD CONSTRAINT `fk_region_country` FOREIGN KEY (`country_id`) 
REFERENCES `countries`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE;

ALTER TABLE `regions`
CHANGE COLUMN `region_name` `title` VARCHAR(150) NOT NULL;

CREATE INDEX `ind_title_region` ON `regions`(`title`);

#Таблица "cities".alter
ALTER TABLE `cities`
CHANGE COLUMN `id_city` `id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT;

ALTER TABLE `cities`
CHANGE COLUMN `country_id` `country_id` INT NOT NULL,
ADD CONSTRAINT `fk_cities_country` FOREIGN KEY (`country_id`)
REFERENCES `countries`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE;

ALTER TABLE `cities`
ADD COLUMN `important` TINYINT(1) NOT NULL AFTER `country_id`;

ALTER TABLE `cities`
CHANGE COLUMN `region_id` `region_id` INT NOT NULL,
ADD CONSTRAINT `fk_city_region` FOREIGN KEY (`region_id`)
REFERENCES `regions`(`id`)
ON DELETE RESTRICT
ON UPDATE CASCADE;

ALTER TABLE `cities`
CHANGE COLUMN `city_name` `title` VARCHAR(150) NOT NULL;

CREATE INDEX `ind_title_city` ON `cities`(`title`);





	




