ALTER TABLE `president_log_comment` ADD FOREIGN KEY ( `president_log_id` ) REFERENCES `svenskbrf`.`president_log` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;

ALTER TABLE `president_log_comment` ADD FOREIGN KEY ( `by_user_id` ) REFERENCES `svenskbrf`.`user` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;
ALTER TABLE `president_log` ADD FOREIGN KEY ( `president_log_category_id` ) REFERENCES `svenskbrf`.`president_log_category` (
`id`
) ON DELETE CASCADE ON UPDATE CASCADE ;


/*UPDATE `svenskbrf4`.`realtor_information_type` SET `realtor_information_category_id` = '4' WHERE `realtor_information_type`.`id` =61;
UPDATE `svenskbrf4`.`realtor_information_category` SET `category_key` = 'renoveringar' WHERE `realtor_information_category`.`id` =5;
delete from realtor_information where realtor_information_type_id between 33 and 42;
delete from realtor_information_history where realtor_information_type_id between 33 and 42;
delete from realtor_information where realtor_information_type_id between 43 and 45;
delete from realtor_information_history where realtor_information_type_id between 43 and 45;
delete from realtor_information where realtor_information_type_id between 46 and 49;
delete from realtor_information_history where realtor_information_type_id between 46 and 49;*/