
ALTER TABLE `shop_product` CHANGE `price` `price` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_product` CHANGE `off` `off` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_service` CHANGE `price` `price` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_service` CHANGE `off` `off` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_delivery` CHANGE `price` `price` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_delivery` CHANGE `off` `off` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_order_item` CHANGE `price` `price` decimal(32,8) NOT NULL DEFAULT '0.00000000';
ALTER TABLE `shop_order_item` CHANGE `off` `off` decimal(32,8) NOT NULL DEFAULT '0.00000000';
