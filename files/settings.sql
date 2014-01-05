INSERT INTO `setting_type` (
    `id` ,
    `setting_type_key` ,
    `setting_type_name`
)
VALUES (
    NULL , 'sms_felanmalan', 'SMS till styrelsen vid felanmälan'
);

CREATE TABLE `brf_felanmalan` (
    `id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `brf_id` MEDIUMINT UNSIGNED NOT NULL ,
    `by_user_id` MEDIUMINT UNSIGNED NOT NULL ,
    `header` VARCHAR( 128 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `message` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
    `sent_on` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB CHARACTER SET utf8 COLLATE utf8_general_ci;

ALTER TABLE `brf_felanmalan` ADD INDEX ( `brf_id` ) ;

ALTER TABLE `brf_felanmalan` ADD INDEX ( `by_user_id` ) ;

ALTER TABLE `brf_felanmalan` ADD FOREIGN KEY ( `by_user_id` ) REFERENCES `user` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE `brf_felanmalan` ADD FOREIGN KEY ( `brf_id` ) REFERENCES `brf` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;