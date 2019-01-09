
ALTER TABLE `shop_order` CHANGE `customer` `customer_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `assignee` `assignee_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `payment` `payment_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `zone` `zone_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `agency` `agency_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` DROP COLUMN `deliver_type`;

ALTER TABLE `shop_agency` CHANGE `owner` `owner_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_agency` CHANGE `content` `content_id` mediumint(9) unsigned DEFAULT 0;

ALTER TABLE `shop_zone` CHANGE `owner` `owner_id` mediumint(9) unsigned DEFAULT 0;

CREATE TABLE `shop_orderhistory` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `object_type` varchar(100) NOT NULL DEFAULT '',
  `object_id` int(11) NOT NULL DEFAULT 0,
  `subject_type` varchar(100) DEFAULT '',
  `subject_id` int(11) DEFAULT 0,
  `action` varchar(100) NOT NULL DEFAULT '',
  `workflow` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(50) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `order_history_idx` (`tenant`,`order_id`),
  KEY `order_id_foreignkey_idx` (`order_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

