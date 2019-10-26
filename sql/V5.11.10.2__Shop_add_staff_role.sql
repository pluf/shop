
INSERT INTO `user_roles` (`name`,`application`,`code_name`,`description`,`tenant`)
	SELECT 'Shop staff','shop','staff','Permission given to staff of the shop.',id FROM tenants;

