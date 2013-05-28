ALTER TABLE `user`
	CHANGE COLUMN `referring` `referring` VARCHAR(200) NULL DEFAULT '0' AFTER `email`;

ALTER TABLE `multilevel_sessions`
	ADD COLUMN `created` DATETIME NOT NULL AFTER `user_data`;