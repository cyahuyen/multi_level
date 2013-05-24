ALTER TABLE `user`
	ADD COLUMN `firstname` VARCHAR(200) NOT NULL AFTER `fullname`,
	ADD COLUMN `lastname` VARCHAR(200) NOT NULL AFTER `firstname`;

ALTER TABLE `user`
	ALTER `fullname` DROP DEFAULT;
ALTER TABLE `user`
	ADD COLUMN `username` VARCHAR(200) NOT NULL AFTER `user_id`,
	CHANGE COLUMN `fullname` `fullname` VARCHAR(200) NULL COLLATE 'utf16_bin' AFTER `username`;