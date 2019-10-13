<?php

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_OrderMetafield extends Pluf_Views
{

    public static function createOrUpdate($request, $match)
    {
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        // Check if metafield exist
        $metafield = self::getMetafieldByKey($match['parentId'], $request->REQUEST['key']);
        $view = new Pluf_Views();
        if (!isset($metafield)) { // Should be created
            return $view->createManyToOne($request, $match, $p);
        }else{ // Should be updated
            $match['modelId'] = $metafield->id;
            return $view->updateManyToOne($request, $match, $p);
        }
    }
    
    /**
     * Returns the metafield of given order by $orderId and given key by $key. Returns null if such metafield does not exist.
     * @param integer $orderId
     * @param string $key
     * @return Shop_OrderMetafield|NULL
     */
    public static function getMetafieldByKey($orderId, $key){
        $sql = new Pluf_SQL('`key`=%s AND `order_id`=%s', array(
            $key,
            $orderId
        ));
        $str = $sql->gen();
        $metafield = Pluf::factory('Shop_OrderMetafield')->getOne($str);
        return $metafield;
    }
    
    /**
     * Extract Key of metafield from $match and returns related Metafield
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist if Id is given and Metafield with given id does not exist or is not blong to given Product
     * @return NULL|Shop_ProductMetafield
     */
    public static function getByKey($request, $match)
    {
        if (! isset($match['modelKey'])) {
            throw new Pluf_Exception_BadRequest('The modelKey is not set');
        }
        $metafield = self::getMetafieldByKey($match['parentId'], $match['modelKey']);
        if($metafield === null){
            throw new Pluf_HTTP_Error404('Object not found (Shop_OrderMetafield,' . $match['modelKey'] . ')');
        }
        return $metafield;
    }
    
    public static function updateByKey($request, $match){
        $metaField = self::getByKey($request, $match);
        $match['modelId'] = $metaField->id;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        $view = new Pluf_Views();
        return $view->updateManyToOne($request, $match, $p);
    }
}
