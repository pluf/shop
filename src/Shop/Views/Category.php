<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
Pluf::loadFunction('Shop_Shortcuts_GetAssociationTableName');

class Shop_Views_Category
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

    public static function items($request, $match)
    {
        $category = Pluf_Shortcuts_GetObjectOr404('Shop_Category', $match['categoryId']);
        $model = Shop_Views_Category::itemModel($request, $match);
        $item = Pluf::factory($model);
        
        $engine = $item->getEngine();
        $schema = $engine->getSchema();
        
        $itemTable = $schema->getTableName($item);
        // Find association table
        $assocTable = $schema->getRelationTable($item, $category);
        
        $itemIdColName = $schema->getAssocField($item);
        $item->setView('myView', array(            
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $itemTable . '.id=' . $assocTable . '.' . $itemIdColName
        ));
        $catIdColName = $schema->getAssocField($category);
        $page = new Pluf_Paginator($item);
        $sql = new Pluf_SQL($catIdColName . '=%s', array(
            $category->id
        ));
        $page->forced_where = $sql;
        $page->model_view = 'myView';
        $page->list_filters = array(
            'id',
            'name',
            'parent'
        );
        $search_fields = array(
            'name',
            'description'
        );
        $sort_fields = array(
            'id',
            'name',
            'parent',
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
        $category = Pluf_Shortcuts_GetObjectOr404('Shop_Category', $match['categoryId']);
        if (isset($match['id'])) {
            $itemId = $match['id'];
        } else {
            $itemId = $request->REQUEST['id'];
        }
        $model = Shop_Views_Category::itemModel($request, $match);
        $item = Pluf_Shortcuts_GetObjectOr404($model, $itemId);
        $category->setAssoc($item);
        return $item;
    }

    public static function removeItem($request, $match)
    {
        $category = Pluf_Shortcuts_GetObjectOr404('Shop_Category', $match['categoryId']);
        if (isset($match['id'])) {
            $itemId = $match['id'];
        } else {
            $itemId = $request->REQUEST['id'];
        }
        $model = Shop_Views_Category::itemModel($request, $match);
        $item = Pluf_Shortcuts_GetObjectOr404($model, $itemId);
        $category->delAssoc($item);
        return $item;
    }
}
