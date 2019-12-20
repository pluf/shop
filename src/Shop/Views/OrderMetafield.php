<?php

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_OrderMetafield extends Pluf_Views
{

    public function createOrUpdate($request, $match)
    {
        // Extract order id
        $orderId = self::extractOrderId($match);
        $match['parentId'] = $orderId;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        // Check if metafield exist
        $metafield = self::getMetafieldByKey($request->REQUEST['key'], $orderId);
        if (! isset($metafield)) { // Should be created
            return $this->createManyToOne($request, $match, $p);
        } else { // Should be updated
            $match['modelId'] = $metafield->id;
            return $this->updateManyToOne($request, $match, $p);
        }
    }

    /**
     * Returns the metafield of given order determined by $orderId and given key by $key.
     * Returns null if such metafield does not exist.
     *
     * @param string $key
     * @param integer $orderId
     *            id of the order
     * @return Shop_OrderMetafield|NULL
     */
    public static function getMetafieldByKey($key, $orderId)
    {
        $sql = new Pluf_SQL('`key`=%s AND `order_id`=%s', array(
            $key,
            $orderId
        ));
        $str = $sql->gen();
        $metafield = Pluf::factory('Shop_OrderMetafield')->getOne($str);
        return $metafield;
    }

    private static function extractOrderId($match)
    {
        if (array_key_exists('parentId', $match)) {
            return $match['parentId'];
        }
        if (array_key_exists('secureId', $match)) {
            Pluf::loadFunction('Shop_Shortcuts_GetObjectBySecureIdOr404');
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            return $order->id;
        }
        throw new Pluf_Exception_BadRequest('Not parentId nor secureId is defined');
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
        $orderId = self::extractOrderId($match);
        $metafield = self::getMetafieldByKey($match['modelKey'], $orderId);
        if ($metafield === null) {
            throw new Pluf_HTTP_Error404('Object not found (Shop_OrderMetafield,' . $match['modelKey'] . ')');
        }
        return $metafield;
    }

    public static function updateByKey($request, $match)
    {
        $metaField = self::getByKey($request, $match);
        $match['modelId'] = $metaField->id;
        $match['parentId'] = $metaField->order_id;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        $view = new Pluf_Views();
        return $view->updateManyToOne($request, $match, $p);
    }

    public function findByOrderSecureId($request, $match)
    {
        $orderId = self::extractOrderId($match);
        $match['parentId'] = $orderId;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        return $this->findManyToOne($request, $match, $p);
    }

    public function getByOrderSecureId($request, $match)
    {
        $orderId = self::extractOrderId($match);
        $match['parentId'] = $orderId;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        return $this->getManyToOne($request, $match, $p);
    }

    public function updateByOrderSecureId($request, $match)
    {
        $orderId = self::extractOrderId($match);
        $match['parentId'] = $orderId;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        return $this->updateManyToOne($request, $match, $p);
    }
    
    public function deleteByOrderSecureId($request, $match){
        $orderId = self::extractOrderId($match);
        $match['parentId'] = $orderId;
        $p = array(
            'model' => 'Shop_OrderMetafield',
            'parent' => 'Shop_Order',
            'parentKey' => 'order_id'
        );
        return $this->deleteManyToOne($request, $match, $p);
    }
}
