
ALTER TABLE `shop_order` CHANGE `title` `title` varchar(250) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `full_name` `full_name` varchar(50) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `phone` `phone` varchar(30) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `email` `email` varchar(150) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `description` `description` varchar(250) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `manager` `manager` varchar(100) DEFAULT '';
ALTER TABLE `shop_order` CHANGE `state` `state` varchar(50) DEFAULT '';

ALTER TABLE `shop_orderhistory` CHANGE `workflow` `workflow` varchar(100) DEFAULT '';
ALTER TABLE `shop_orderhistory` CHANGE `state` `state` varchar(50) DEFAULT '';

ALTER TABLE `shop_order_item` CHANGE `item_id` `item_id` int(11) DEFAULT '0';
ALTER TABLE `shop_order_item` CHANGE `item_type` `item_type` varchar(50) DEFAULT '';

ALTER TABLE `shop_agency`  CHANGE `description` `description` varchar(250) DEFAULT '',
ALTER TABLE `shop_agency`  CHANGE `avatar` `avatar` varchar(300) DEFAULT '';
ALTER TABLE `shop_agency`  CHANGE `province` `province` varchar(100) DEFAULT '';
ALTER TABLE `shop_agency`  CHANGE `city` `city` varchar(100) DEFAULT '';
ALTER TABLE `shop_agency`  CHANGE `address` `address` varchar(500) DEFAULT '';
ALTER TABLE `shop_agency`  CHANGE `phone` `phone` varchar(50) DEFAULT '';
ALTER TABLE `shop_agency`  CHANGE `point` `point` geometry;
ALTER TABLE `shop_agency`  CHANGE `deleted` `deleted` tinyint(1) DEFAULT '0';
ALTER TABLE `shop_agency`  CHANGE `content_id` `content_id` mediumint(9) unsigned DEFAULT '0';