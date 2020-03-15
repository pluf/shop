<?php
/*
 * This file is part of Pluf Framework, a simple PHP Application Framework.
 * Copyright (C) 2010-2020 Phoinex Scholars Co. (http://dpq.co.ir)
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

// $cfg = include 'mysql.config.php';
$cfg = include 'sqlite.config.php';

$cfg['installed_apps'] = array(
    'Pluf',
    'User',
    'Tenant',
    'Shop',
    'Monitor'
);

$cfg['test'] = false;
$cfg['timezone'] = 'Europe/Berlin';

// Set the debug variable to true to force the recompilation of all
// the templates each time during development
$cfg['debug'] = true;
$cfg['multitenant'] = false;

/*
 * Middlewares
 */
$cfg['middleware_classes'] = array(
    // find tenant
    'Pluf_Middleware_TenantEmpty',
    // Sessions
    'Pluf_Middleware_Session',
    'User_Middleware_Session'
);

$cfg['secret_key'] = '5a8d7e0f2aad8bdab8f6eef725412850';

// Temporary folder where the script is writing the compiled templates,
// cached data and other temporary resources.
// It must be writeable by your webserver instance.
// It is mandatory if you are using the template system.
$cfg['tmp_folder'] = '/tmp';

// The folder in which the templates of the application are located.
$cfg['templates_folder'] = array(
    __DIR__ . '/../templates'
);

/*
 * Template tags
 */
$cfg['template_tags'] = array();

// Default mimetype of the document your application is sending.
// It can be overwritten for a given response if needed.
$cfg['mimetype'] = 'text/html';

return $cfg;

