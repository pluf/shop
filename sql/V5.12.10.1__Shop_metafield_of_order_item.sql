
CREATE TABLE `shop_order_item_metafields` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `order_item_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metafield_idx` (`tenant`,`key`,`order_item_id`),
  KEY `order_item_id_foreignkey_idx` (`order_item_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `shop_order_item_metafields` 
   ADD CONSTRAINT `fk__order_item_of_metafield` 
   FOREIGN KEY (`order_item_id`) 
   REFERENCES `shop_order_item` (`id`);