ALTER TABLE `document_type` ADD `is_archive` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';
INSERT INTO `svenskbrf`.`document_type` (`id`, `document_type_name`, `directory_name`, `has_year`, `is_archive`) VALUES (NULL, 'Arkiv', 'arkiv', '0', '1');
UPDATE `svenskbrf`.`document_type` SET `document_type_name` = 'Dokumentarkiv' WHERE `document_type`.`id` = 9;