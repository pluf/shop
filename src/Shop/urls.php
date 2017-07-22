<?php
$paths = array(
    'urls/agency.php',
    'urls/product.php',
    'urls/service.php',
    'urls/tag_category.php',
    'urls/tax.php'
);

$shopApi = array();

foreach ($paths as $path){
    $myApi = include $path;
    $shopApi = array_merge($shopApi, $myApi);
}

return $shopApi;
