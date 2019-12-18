<?php

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_CategoryMetafield extends Pluf_Views
{

    public function createOrUpdate($request, $match)
    {
        // Extract category id
        $categoryId = $match['parentId'];
        $p = array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        );
        // Check if metafield exist
        $metafield = self::getMetafieldByKey($request->REQUEST['key'], $categoryId);
        if (! isset($metafield)) { // Should be created
            return $this->createManyToOne($request, $match, $p);
        } else { // Should be updated
            $match['modelId'] = $metafield->id;
            return $this->updateManyToOne($request, $match, $p);
        }
    }

    /**
     * Returns the metafield of given category determined by $categoryId and given key by $key.
     * Returns null if such metafield does not exist.
     *
     * @param string $key
     * @param integer $categoryId
     *            id of the category
     * @return Shop_CategoryMetafield|NULL
     */
    public static function getMetafieldByKey($key, $categoryId)
    {
        $sql = new Pluf_SQL('`key`=%s AND `category_id`=%s', array(
            $key,
            $categoryId
        ));
        $str = $sql->gen();
        $metafield = Pluf::factory('Shop_CategoryMetafield')->getOne($str);
        return $metafield;
    }

    /**
     * Extract Key of metafield from $match and returns related Metafield
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist if Id is given and Metafield with given id does not exist or is not blong to given Category
     * @return NULL|Shop_CategoryMetafield
     */
    public static function getByKey($request, $match)
    {
        if (! isset($match['modelKey'])) {
            throw new Pluf_Exception_BadRequest('The modelKey is not set');
        }
        $categoryId = $match['parentId'];
        $metafield = self::getMetafieldByKey($match['modelKey'], $categoryId);
        if ($metafield === null) {
            throw new Pluf_HTTP_Error404('Object not found (Shop_CategoryMetafield,' . $match['modelKey'] . ')');
        }
        return $metafield;
    }

    public static function updateByKey($request, $match)
    {
        $metaField = self::getByKey($request, $match);
        $match['modelId'] = $metaField->id;
        $match['parentId'] = $metaField->category_id;
        $p = array(
            'model' => 'Shop_CategoryMetafield',
            'parent' => 'Shop_Category',
            'parentKey' => 'category_id'
        );
        $view = new Pluf_Views();
        return $view->updateManyToOne($request, $match, $p);
    }

}
