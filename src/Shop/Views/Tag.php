<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
Pluf::loadFunction('Shop_Shortcuts_GetIdColumnName');
Pluf::loadFunction('Shop_Shortcuts_GetAssociationTableName');
Pluf::loadFunction('Shop_Shortcuts_GetTagByNameOr404');

class Shop_Views_Tag
{

    /**
     * Extracts item model from $match and retruns related Pluf_Model for item model.
     *
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist
     * @return string
     */
    private static function itemModel($request, $match){
        // Find model of item
        switch ($match['item']){
            case 'product':
            case 'products':
                $model = 'Shop_Product';
                break;
            case 'service':
            case 'services':
                $model = 'Shop_Service';
                break;
            case 'delivers':
            case 'deliveries':
                $model = 'Shop_Delivery';
                break;
            default:
                throw new Pluf_Exception_DoesNotExist('Unkown item model. Valid item models are: product, service and delivery. ');
        }
        return $model;
    }
    
    public static function getByName($request, $match)
    {
        $tag = Shop_Shortcuts_GetTagByNameOr404($match['name']);
        return $tag;
    }

    public static function items($request, $match)
    {
        $tag = Pluf_Shortcuts_GetObjectOr404('Shop_Tag', $match['tagId']);
        $model = Shop_Views_Tag::itemModel($request, $match);
        $item = Pluf::factory($model);
        $itemTable = $item->_a['table'];
        $itemIdColName = Shop_Shortcuts_GetIdColumnName($item);
        $assocTable = Shop_Shortcuts_GetAssociationTableName($item, $tag);
        $item->_a['views']['myView'] = array(
            'select' => $item->getSelect(),
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $itemTable . '.id=' . $assocTable . '.' . $itemIdColName
        );
        
        $tagIdColName = Shop_Shortcuts_GetIdColumnName($tag);
        $page = new Pluf_Paginator($item);
        $sql = new Pluf_SQL($tagIdColName . '=%s', array(
            $tag->id
        ));
        $page->forced_where = $sql;
        $page->model_view = 'myView';
        $page->list_filters = array(
            'id',
            'name'
        );
        $search_fields = array(
            'name',
            'description'
        );
        $sort_fields = array(
            'id',
            'name',
            'creation_date',
            'modif_dtime'
        );
        $page->configure(array(), $search_fields, $sort_fields);
        $page->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $page->setFromRequest($request);
        return $page;
    }

    public static function addItem($request, $match)
    {
        $tag = Pluf_Shortcuts_GetObjectOr404('Shop_Tag', $match['tagId']);
        if (isset($match['id'])) {
            $itemId = $match['id'];
        } else {
            $itemId = $request->REQUEST['id'];
        }
        $model = Shop_Views_Tag::itemModel($request, $match);
        $item = Pluf_Shortcuts_GetObjectOr404($model, $itemId);
        $tag->setAssoc($item);
        return $item;
    }

    public static function removeItem($request, $match)
    {
        $tag = Pluf_Shortcuts_GetObjectOr404('Shop_Tag', $match['tagId']);
        if (isset($match['id'])) {
            $itemId = $match['id'];
        } else {
            $itemId = $request->REQUEST['id'];
        }
        $model = Shop_Views_Tag::itemModel($request, $match);
        $item = Pluf_Shortcuts_GetObjectOr404($model, $itemId);
        $tag->delAssoc($item);
        return $item;
    }

}