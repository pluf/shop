<?php
$paths = array(
    'urls/address.php',
    'urls/agency.php',
    'urls/contact.php',
    'urls/delivery.php',
    'urls/order_history.php',
    'urls/order_item.php',
    'urls/order.php',
    'urls/order_attachment.php',
    'urls/product.php',
    'urls/service.php',
    'urls/category.php',
    'urls/tag.php',
    'urls/tax.php',
    'urls/zone.php'
);

$shopApi = array();

foreach ($paths as $path){
    $myApi = include $path;
    $shopApi = array_merge($shopApi, $myApi);
}

return $shopApi;
