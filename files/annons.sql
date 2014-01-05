ALTER TABLE `brf_realtor_ad` ADD `has_picture` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0',
ADD `image_type` CHAR( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL;
ALTER TABLE `brf_realtor_ad` CHANGE `stairs` `stairs` CHAR( 3 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ;
ALTER TABLE `brf_realtor_ad` CHANGE `rooms` `rooms` FLOAT( 5 ) UNSIGNED NOT NULL ;
ALTER TABLE `brf_realtor_ad` ADD `alternate_time` VARCHAR( 255 ) CHARACTER SET utf8 COLLATE utf8_general_ci NULL ;
ALTER TABLE `brf_realtor_ad` ADD `sold` TINYINT( 1 ) UNSIGNED NOT NULL DEFAULT '0';

INSERT INTO `setting_type` (
`id` ,
`setting_type_key` ,
`setting_type_name`
)
VALUES (
NULL , 'hide_resource_message', 'Dolj meddelande om saknade resurser'
), (
NULL , 'hide_document_message', 'Dolj meddelande om dokument'
);

INSERT INTO `setting_type` (
`id` ,
`setting_type_key` ,
`setting_type_name`
)
VALUES (
NULL , 'hide_presentation_message', 'Dolj meddelande om presentationstext'
);
