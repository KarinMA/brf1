CREATE TABLE `svenskbrf_se`.`user_setting` (
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`user_id` MEDIUMINT UNSIGNED NOT NULL ,
`setting_type_id` TINYINT UNSIGNED NOT NULL ,
`value` VARCHAR( 64 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`setting_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;
ALTER TABLE `user_setting` CHANGE `setting_type_id` `setting_type_id` SMALLINT( 5 ) UNSIGNED NOT NULL ;
ALTER TABLE `user_setting` ADD INDEX ( `user_id` ) ;
ALTER TABLE `user_setting` ADD INDEX ( `setting_type_id` );

ALTER TABLE `user_setting` ADD FOREIGN KEY ( `user_id` ) REFERENCES `svenskbrf_se`.`user` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE `user_setting` ADD FOREIGN KEY ( `setting_type_id` ) REFERENCES `svenskbrf_se`.`setting_type` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

INSERT INTO `svenskbrf_se`.`setting_type` (`id`, `setting_type_key`, `setting_type_name`) VALUES (NULL, 'block_realtor_message_setting', 'Blockera meddelanden');

