
ALTER TABLE `shop_category` DROP INDEX `thumbnail_id_foreignkey_idx`;
ALTER TABLE `shop_category` CHANGE `thumbnail_id` `thumbnail` varchar(300) DEFAULT '';

UPDATE `shop_category` 
	SET `thumbnail`=CONCAT('/api/v2/cms/contents/', `thumbnail`, '/content') 
	WHERE `thumbnail` IS NOT NULL AND `thumbnail` != '';