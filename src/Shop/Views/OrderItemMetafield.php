<?php
use phpDocumentor\Reflection\Types\This;

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_OrderItemMetafield extends Pluf_Views
{

    public function createOrUpdate($request, $match)
    {
        // Extract order id
        $itemId = self::extractOrderItemId($match);
        $match['parentId'] = $itemId;
        $param = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        // Check if metafield exist
        $metafield = self::getMetafieldByKey($request->REQUEST['key'], $itemId);
        if (! isset($metafield)) { // Should be created
            return $this->createManyToOne($request, $match, $param);
        } else { // Should be updated
            $match['modelId'] = $metafield->id;
            return $this->updateManyToOne($request, $match, $param);
        }
    }

    /**
     * Returns the metafield of given order item determined by $itemId and given key by $key.
     * Returns null if such metafield does not exist.
     *
     * @param string $key
     * @param integer $itemId
     *            id of the order item
     * @return Shop_OrderItemMetafield|NULL
     */
    public static function getMetafieldByKey($key, $itemId)
    {
        $sql = new Pluf_SQL('`key`=%s AND `order_item_id`=%s', array(
            $key,
            $itemId
        ));
        $str = $sql->gen();
        $metafield = Pluf::factory('Shop_OrderItemMetafield')->getOne($str);
        return $metafield;
    }

    private static function extractOrderItemId($match)
    {
        if (array_key_exists('parentId', $match)) {
            return $match['parentId'];
        }
        if (array_key_exists('secureId', $match)) {
            Pluf::loadFunction('Shop_Shortcuts_GetObjectBySecureIdOr404');
            $order = Shop_Shortcuts_GetObjectBySecureIdOr404('Shop_Order', $match['secureId']);
            $item = Pluf_Shortcuts_GetObjectOr404('Shop_OrderItem', $match['itemId']);
            // Check if item blongs to the order deined by secure id
            if($order->id !== $item->order_id){
                throw new Pluf_Exception_DoesNotExist('Order has not item with given id');
            }
            return $item->id;
        }
        throw new Pluf_Exception_BadRequest('Not parentId nor secureId is defined');
    }

    /**
     * Extract Key of metafield from $match and returns related Metafield
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist if Id is given and Metafield with given id does not exist or is not blong to given OrderItem
     * @return NULL|Shop_OrderItemMetafield
     */
    public static function getByKey($request, $match)
    {
        if (! isset($match['modelKey'])) {
            throw new Pluf_Exception_BadRequest('The modelKey is not set');
        }
        $itemId = self::extractOrderItemId($match);
        $metafield = self::getMetafieldByKey($match['modelKey'], $itemId);
        if ($metafield === null) {
            throw new Pluf_HTTP_Error404('Object not found (Shop_OrderItemMetafield,' . $match['modelKey'] . ')');
        }
        return $metafield;
    }

    public static function updateByKey($request, $match)
    {
        $metaField = self::getByKey($request, $match);
        $match['modelId'] = $metaField->id;
        $match['parentId'] = $metaField->order_id;
        $p = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        $view = new Pluf_Views();
        return $view->updateManyToOne($request, $match, $p);
    }

    public function findByOrderSecureId($request, $match)
    {
        $itemId = self::extractOrderItemId($match);
        $match['parentId'] = $itemId;
        $p = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        return $this->findManyToOne($request, $match, $p);
    }

    public function getByOrderSecureId($request, $match)
    {
        $itemId = self::extractOrderItemId($match);
        $match['parentId'] = $itemId;
        $p = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        return $this->getManyToOne($request, $match, $p);
    }

    public function updateByOrderSecureId($request, $match)
    {
        $itemId = self::extractOrderItemId($match);
        $match['parentId'] = $itemId;
        $p = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        return $this->updateManyToOne($request, $match, $p);
    }
    
    public function deleteByOrderSecureId($request, $match){
        $itemId = self::extractOrderItemId($match);
        $match['parentId'] = $itemId;
        $p = array(
            'model' => 'Shop_OrderItemMetafield',
            'parent' => 'Shop_OrderItem',
            'parentKey' => 'order_item_id'
        );
        return $this->deleteManyToOne($request, $match, $p);
    }
}
