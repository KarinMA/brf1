CREATE TABLE IF NOT EXISTS `president_log_category` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `brf_id` mediumint(9) NOT NULL,
  `category_name` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `brf_id` (`brf_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
ALTER TABLE `president_log_category` CHANGE `id` `id` SMALLINT( 5 ) UNSIGNED NOT NULL AUTO_INCREMENT ;
ALTER TABLE `president_log_category` CHANGE `brf_id` `brf_id` MEDIUMINT( 9 ) UNSIGNED NOT NULL ;
ALTER TABLE `president_log_category` CHANGE `brf_id` `brf_id` MEDIUMINT( 8 ) UNSIGNED NOT NULL ;
ALTER TABLE `president_log_category` ADD FOREIGN KEY ( `brf_id` ) REFERENCES `svenskbrf4`.`brf` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

INSERT INTO `svenskbrf4`.`president_log_category` (
`id` ,
`brf_id` ,
`category_name`
)
VALUES (
NULL , '6', 'Test'
);

ALTER TABLE `president_log` DROP FOREIGN KEY `president_log_ibfk_4` ;
ALTER TABLE `president_log` DROP INDEX `president_log_type_id` ;
ALTER TABLE `president_log` DROP `president_log_type_id` ;
ALTER TABLE `president_log` ADD `president_log_category_id` SMALLINT UNSIGNED NOT NULL AFTER `date` ,
ADD INDEX ( `president_log_category_id` ) ;
/*ALTER TABLE `president_log` ADD FOREIGN KEY ( `president_log_category_id` ) REFERENCES `svenskbrf4`.`president_log_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE;*/
ALTER TABLE `president_log` ADD `header` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
update president_log set president_log_category_id = 1;

CREATE TABLE `svenskbrf4`.`president_log_comment` (
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`president_log_id` MEDIUMINT UNSIGNED NOT NULL ,
`by_user_id` MEDIUMINT UNSIGNED NOT NULL ,
`timestamp` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ,
INDEX ( `president_log_id` , `by_user_id` )
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `president_log_comment` DROP INDEX `president_log_id`;
ALTER TABLE `president_log_comment` ADD INDEX ( `president_log_id` ) ;
ALTER TABLE `president_log_comment` ADD INDEX ( `by_user_id` ) ;
/*ALTER TABLE `president_log_comment` ADD FOREIGN KEY ( `president_log_id` ) REFERENCES `svenskbrf4`.`president_log` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE `president_log_comment` ADD FOREIGN KEY ( `by_user_id` ) REFERENCES `svenskbrf4`.`user` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;*/
ALTER TABLE `president_log_comment` ADD `comment` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
DROP TABLE `president_log_type` ;

ALTER TABLE `president_log` CHANGE `log_name` `log_name` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;
ALTER TABLE `president_log` CHANGE `header` `header` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;