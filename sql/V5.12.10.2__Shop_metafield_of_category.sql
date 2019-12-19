
CREATE TABLE `shop_category_metafields` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `category_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metafield_idx` (`tenant`,`key`,`category_id`),
  KEY `category_id_foreignkey_idx` (`category_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


ALTER TABLE `shop_category_metafields` 
   ADD CONSTRAINT `fk__category_of_metafield` 
   FOREIGN KEY (`category_id`) 
   REFERENCES `shop_category` (`id`);
