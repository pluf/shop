
CREATE TABLE `shop_address` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `province` varchar(100) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `address` varchar(500) DEFAULT '',
  `point` geometry DEFAULT NULL,
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` mediumint(9) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_foreignkey_idx` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_agency` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(300) DEFAULT '',
  `province` varchar(100) NOT NULL DEFAULT '',
  `city` varchar(100) NOT NULL DEFAULT '',
  `address` varchar(500) DEFAULT '',
  `phone` varchar(50) DEFAULT '',
  `point` geometry NOT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `content` mediumint(9) unsigned DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `content_foreignkey_idx` (`content`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_agency_user_account_assoc` (
  `shop_agency_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `user_account_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_agency_id`,`user_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_category` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` varchar(250) NOT NULL DEFAULT '',
  `parent_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `content_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `thumbnail_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `category_idx` (`tenant`,`parent_id`,`name`),
  KEY `parent_id_foreignkey_idx` (`parent_id`),
  KEY `content_id_foreignkey_idx` (`content_id`),
  KEY `thumbnail_id_foreignkey_idx` (`thumbnail_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_category_shop_delivertype_assoc` (
  `shop_delivertype_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_category_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_delivertype_id`,`shop_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_category_shop_product_assoc` (
  `shop_product_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_category_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_product_id`,`shop_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_category_shop_service_assoc` (
  `shop_service_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_category_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_service_id`,`shop_category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_contact` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `contact` varchar(250) NOT NULL DEFAULT '',
  `type` varchar(50) NOT NULL DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `user` mediumint(9) unsigned DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `user_foreignkey_idx` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_deliver_type` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(300) DEFAULT '',
  `price` int(11) NOT NULL DEFAULT 0,
  `off` int(11) DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_delivertype_shop_tag_assoc` (
  `shop_delivertype_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_tag_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_delivertype_id`,`shop_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_order` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `secureId` varchar(50) NOT NULL DEFAULT '',
  `title` varchar(250) NOT NULL DEFAULT '',
  `full_name` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(30) NOT NULL DEFAULT '',
  `email` varchar(150) NOT NULL DEFAULT '',
  `province` varchar(100) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `address` varchar(500) DEFAULT '',
  `point` geometry DEFAULT NULL,
  `description` varchar(250) NOT NULL DEFAULT '',
  `manager` varchar(100) NOT NULL DEFAULT '',
  `state` varchar(50) NOT NULL DEFAULT '',
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `customer` mediumint(9) unsigned DEFAULT 0,
  `assignee` mediumint(9) unsigned DEFAULT 0,
  `deliver_type` mediumint(9) unsigned DEFAULT 0,
  `payment` mediumint(9) unsigned DEFAULT 0,
  `zone` mediumint(9) unsigned DEFAULT 0,
  `agency` mediumint(9) unsigned DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `customer_foreignkey_idx` (`customer`),
  KEY `assignee_foreignkey_idx` (`assignee`),
  KEY `deliver_type_foreignkey_idx` (`deliver_type`),
  KEY `payment_foreignkey_idx` (`payment`),
  KEY `zone_foreignkey_idx` (`zone`),
  KEY `agency_foreignkey_idx` (`agency`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_order_item` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `item_id` int(11) NOT NULL DEFAULT 0,
  `item_type` varchar(50) NOT NULL DEFAULT '',
  `count` int(11) NOT NULL DEFAULT 1,
  `price` int(11) NOT NULL DEFAULT 0,
  `off` int(11) NOT NULL DEFAULT 0,
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `order_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `order_id_foreignkey_idx` (`order_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_product` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(300) DEFAULT '',
  `price` int(11) NOT NULL DEFAULT 0,
  `off` int(11) DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `manufacturer` varchar(250) DEFAULT '',
  `brand` varchar(250) DEFAULT '',
  `model` varchar(250) DEFAULT '',
  `properties` longtext DEFAULT NULL,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_product_metafield` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `unit` varchar(64) DEFAULT '',
  `namespace` varchar(128) DEFAULT '',
  `product_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metafield_idx` (`tenant`,`key`,`product_id`),
  KEY `product_id_foreignkey_idx` (`product_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_product_shop_tag_assoc` (
  `shop_product_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_tag_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_product_id`,`shop_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_product_shop_taxclass_assoc` (
  `shop_product_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_taxclass_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_product_id`,`shop_taxclass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_service` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(300) DEFAULT '',
  `price` int(11) NOT NULL DEFAULT 0,
  `off` int(11) DEFAULT 0,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `properties` longtext NOT NULL,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_service_metafield` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `key` varchar(250) NOT NULL DEFAULT '',
  `value` varchar(256) NOT NULL DEFAULT '',
  `unit` varchar(64) DEFAULT '',
  `namespace` varchar(128) DEFAULT '',
  `service_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `metafield_idx` (`tenant`,`key`,`service_id`),
  KEY `service_id_foreignkey_idx` (`service_id`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_service_shop_tag_assoc` (
  `shop_service_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_tag_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_service_id`,`shop_tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_service_shop_taxclass_assoc` (
  `shop_service_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `shop_taxclass_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_service_id`,`shop_taxclass_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_tag` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `description` varchar(250) DEFAULT '',
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_unique_idx` (`tenant`,`name`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_tax_class` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `rate` decimal(32,8) NOT NULL DEFAULT 0.00000000,
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `tax_class_idx` (`tenant`,`title`,`rate`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_zone` (
  `id` mediumint(9) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(250) NOT NULL DEFAULT '',
  `description` varchar(250) DEFAULT '',
  `creation_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `modif_dtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `avatar` varchar(300) DEFAULT '',
  `province` varchar(100) DEFAULT '',
  `city` varchar(100) DEFAULT '',
  `address` varchar(500) DEFAULT '',
  `polygon` geometry DEFAULT NULL,
  `deleted` tinyint(1) NOT NULL DEFAULT 0,
  `owner` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `tenant` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `owner_foreignkey_idx` (`owner`),
  KEY `tenant_foreignkey_idx` (`tenant`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE `shop_zone_user_account_assoc` (
  `shop_zone_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  `user_account_id` mediumint(9) unsigned NOT NULL DEFAULT 0,
  PRIMARY KEY (`shop_zone_id`,`user_account_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
