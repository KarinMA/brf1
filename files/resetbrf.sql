# hlodge1

UPDATE `brf` SET `apartments` = '0',
`presentation` = '',
`activated` = '0',
`realtor_user_id` = NULL WHERE `brf`.`id` =133589;
DELETE FROM `brf_address` WHERE brf_id =133589;
delete FROM `brf_picture` WHERE brf_id=133589;
delete FROM `brf_realtor_log` WHERE brf_id=133589;
delete FROM `brf_realtor_ad` WHERE brf_id=133589;
delete FROM `brf_realtor_code` WHERE brf_id=133589;
DELETE from brf_setting where brf_id=133589 and setting_type_id <> 2;
delete FROM `calendar` WHERE brf_id=133589;
delete FROM `president_log` WHERE brf_id=133589;
delete FROM `document` WHERE brf_id=133589;
delete FROM `notice` WHERE brf_id=133589;
delete from `message` where brf_id = 133589;
delete FROM `realtor_information` WHERE brf_id=133589;
delete FROM `realtor_information_history` WHERE brf_id=133589;
delete FROM `resource` WHERE brf_id=133589;
delete from `user` where brf_id=133589;
