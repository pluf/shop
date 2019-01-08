
ALTER TABLE `shop_order` CHANGE `customer` `customer_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `assignee` `assignee_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `payment` `payment_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `zone` `zone_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` CHANGE `agency` `agency_id` mediumint(9) unsigned DEFAULT 0;
ALTER TABLE `shop_order` DROP COLUMN `deliver_type`;
