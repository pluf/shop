<?php 
$var = include 'mysql.config.php';

// NOTE: sqlit dose not support Geometry
// $cfg = include 'sqlite.config.php';


$cfg['test'] = false;
$cfg['timezone'] = 'Europe/Berlin';
// Set the debug variable to true to force the recompilation of all
// the templates each time during development
$cfg['debug'] = true;
$cfg['installed_apps'] = array(
    'Pluf',
    'User',
    'Group',
    'Role',
    'Assort',
    'Shop',
    'Monitor'
);


/*
 * Middlewares
 */
$cfg['middleware_classes'] = array(
    'Pluf_Middleware_Session',
    'User_Middleware_Session'
);

$cfg['secret_key'] = '5a8d7e0f2aad8bdab8f6eef725412850';

// Temporary folder where the script is writing the compiled templates,
// cached data and other temporary resources.
// It must be writeable by your webserver instance.
// It is mandatory if you are using the template system.
$cfg['tmp_folder'] = __DIR__ . '/../tmp';

// The folder in which the templates of the application are located.
$cfg['template_folders'] = array(
    __DIR__ . '/../templates'
);

// Default mimetype of the document your application is sending.
// It can be overwritten for a given response if needed.
$cfg['mimetype'] = 'text/html';

// Default user avatar
$cfg['user_avatar_default'] = __DIR__ . '/avatar.svg';


$cfg['app_base'] = '/testapp';
$cfg['url_format'] = 'simple';
$cfg['template_tags'] = array();

// Must be shared by all the installed_apps and the core framework.
// That way you can have several installations of the core framework.
$cfg['db_table_prefix'] = 'shop_unit_tests_';

return $cfg;
