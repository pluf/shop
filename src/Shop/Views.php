<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
Pluf::loadFunction('Shop_Shortcuts_GetAssociationTableName');

class Shop_Views
{

    // *******************************************************************
    // Tags of an item
    // *******************************************************************
    public static function tags($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        $tag = new Shop_Tag();

        $engine = $tag->getEngine();
        $schema = $engine->getSchema();

        $tagTable = $schema->getTableName($tag);
        // Shop_Shortcuts_GetTableName($tag);
        $tagIdColName = $schema->getAssocField($tag);
        // Shop_Shortcuts_GetIdColumnName($tag);
        $assocTable = $schema->getRelationTable($tag, $item);
        // Shop_Shortcuts_GetAssociationTableName($item, $tag);
        $itemIdColName = $schema->getAssocField($item);
        // Shop_Shortcuts_GetIdColumnName($item);

        $tag->setView('myView', array(
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $tagTable . '.id=' . $assocTable . '.' . $tagIdColName
        ));

        $paginator = new Pluf_Paginator($tag);
        $sql = new Pluf_SQL($itemIdColName . '=%s', array(
            $item->id
        ));
        $paginator->forced_where = $sql;
        $paginator->model_view = 'myView';
        $paginator->list_filters = array(
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
            'creation_dtime',
            'modif_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return $paginator;
    }

    public static function addTag($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['id'])) {
            $tagId = $match['id'];
        } else {
            $tagId = $request->REQUEST['id'];
        }
        $tag = Pluf_Shortcuts_GetObjectOr404('Shop_Tag', $tagId);
        $item->setAssoc($tag);
        return $tag;
    }

    public static function removeTag($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['id'])) {
            $tagId = $match['id'];
        } else {
            $tagId = $request->REQUEST['id'];
        }
        $tag = Pluf_Shortcuts_GetObjectOr404('Shop_Tag', $tagId);
        $item->delAssoc($tag);
        return $tag;
    }

    // *******************************************************************
    // Categories of an item
    // *******************************************************************
    public static function categories($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        $category = new Shop_Category();
        
        $engine = $category->getEngine();
        $schema = $engine->getSchema();
        
        $categoryTable = $schema->getTableName($category);
        $catIdColName = $schema->getAssocField($category);
        $assocTable = $schema->getRelationTable($item, $category);
        $category->setView('myView', array(
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $categoryTable . '.id=' . $assocTable . '.' . $catIdColName
        ));

        $itemIdColName = $schema->getAssocField($item);
        $paginator = new Pluf_Paginator($category);
        $sql = new Pluf_SQL($itemIdColName . '=%s', array(
            $item->id
        ));
        $paginator->forced_where = $sql;
        $paginator->model_view = 'myView';
        $paginator->list_filters = array(
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
            'creation_dtime',
            'modif_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return $paginator;
    }

    public static function addCategory($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['id'])) {
            $categoryId = $match['id'];
        } else {
            $categoryId = $request->REQUEST['id'];
        }
        $category = Pluf_Shortcuts_GetObjectOr404('Shop_Category', $categoryId);
        $item->setAssoc($category);
        return $category;
    }

    public static function removeCategory($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['id'])) {
            $categoryId = $match['id'];
        } else {
            $categoryId = $request->REQUEST['id'];
        }
        $category = Pluf_Shortcuts_GetObjectOr404('Shop_Category', $categoryId);
        $item->delAssoc($category);
        return $category;
    }
}
