ALTER TABLE `transaction`
	CHANGE COLUMN `fees` `fees` DOUBLE(10,4) NOT NULL DEFAULT '0' AFTER `user_id`,
	CHANGE COLUMN `total` `total` DOUBLE(10,4) NOT NULL DEFAULT '0' AFTER `fees`;

ALTER TABLE `payment_history`
	ADD COLUMN `confirm_date` DATETIME NOT NULL AFTER `created`;