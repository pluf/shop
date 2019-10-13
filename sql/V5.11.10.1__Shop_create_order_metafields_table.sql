
CREATE TABLE `shop_order_metafields` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `namespace` varchar(128) DEFAULT '',
  `order_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metafield_idx` (`tenant`,`key`,`order_id`),
  FOREIGN KEY `order_id_foreignkey_idx` (`order_id`) REFERENCES `shop_order`(`id`) ON DELETE CASCADE,
  FOREIGN KEY `tenant_foreignkey_idx` (`tenant`) REFERENCES `tenants`(`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

