<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
Pluf::loadFunction('Shop_Shortcuts_GetIdColumnName');
Pluf::loadFunction('Shop_Shortcuts_GetAssociationTableName');

class Shop_Views
{

    // *******************************************************************
    // Profile of shop
    // *******************************************************************
    /**
     * Updates or creates profile for shop by using given data.
     *
     */
    public static function updateProfile($request, $match)
    {
        $profile = Pluf::factory('Shop_Profile')->getList(array(
            'order' => 'id ASC'
        ));
        if ($profile == null || empty($profile) || $profile->count() == 0) {
            $form = new Shop_Form_Profile(array_merge($request->REQUEST, $request->FILES), array());
            $profile = $form->save();
        } else {
            $profile = $profile[0];
            $form = Pluf_Shortcuts_GetFormForUpdateModel($profile, $request->REQUEST, array());
            $profile = $form->save();
        }
        return new Pluf_HTTP_Response_Json($profile);
    }

    /**
     * Returns information of profile of shop
     *
     */
    public static function getProfile($request, $match)
    {
        $profile = Pluf::factory('Shop_Profile')->getList(array(
            'order' => 'id ASC'
        ));
        if ($profile == null || empty($profile) || $profile->count() == 0) {
            $profile = Pluf::factory('Shop_Profile');
        } else {
            $profile = $profile[0];
        }
        // TODO: hadi, 1395: we should hide secure information of profile.
        return new Pluf_HTTP_Response_Json($profile);
    }

    // *******************************************************************
    // Tags of an item
    // *******************************************************************
    public static function tags($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        $tag = new Assort_Tag();
        $tagTable = $tag->_a['table'];
        $tagIdColName = Shop_Shortcuts_GetIdColumnName($tag);
        $assocTable = Shop_Shortcuts_GetAssociationTableName($item, $tag);
        $tag->_a['views']['myView'] = array(
            'select' => $tag->getSelect(),
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $tagTable . '.id=' . $assocTable . '.' . $tagIdColName
        );
        
        $itemIdColName = Shop_Shortcuts_GetIdColumnName($item);
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
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function addTag($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['tagId'])) {
            $tagId = $match['tagId'];
        } else {
            $tagId = $request->REQUEST['tagId'];
        }
        $tag = Pluf_Shortcuts_GetObjectOr404('Assort_Tag', $tagId);
        $item->setAssoc($tag);
        return new Pluf_HTTP_Response_Json($tag);
    }

    public static function removeTag($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['tagId'])) {
            $tagId = $match['tagId'];
        } else {
            $tagId = $request->REQUEST['tagId'];
        }
        $tag = Pluf_Shortcuts_GetObjectOr404('Assort_Tag', $tagId);
        $item->delAssoc($tag);
        return new Pluf_HTTP_Response_Json($tag);
    }

    // *******************************************************************
    // Categories of an item
    // *******************************************************************
    public static function categories($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        $category = new Assort_Category();
        $categoryTable = $category->_a['table'];
        $catIdColName = Shop_Shortcuts_GetIdColumnName($category);
        $assocTable = Shop_Shortcuts_GetAssociationTableName($item, $category);
        $category->_a['views']['myView'] = array(
            'select' => $category->getSelect(),
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $categoryTable . '.id=' . $assocTable . '.' . $catIdColName
        );
        
        $itemIdColName = Shop_Shortcuts_GetIdColumnName($item);
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
        return new Pluf_HTTP_Response_Json($paginator->render_object());
    }

    public static function addCategory($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['categoryId'])) {
            $categoryId = $match['categoryId'];
        } else {
            $categoryId = $request->REQUEST['categoryId'];
        }
        $category = Pluf_Shortcuts_GetObjectOr404('Assort_Category', $categoryId);
        $item->setAssoc($category);
        return new Pluf_HTTP_Response_Json($category);
    }

    public static function removeCategory($request, $match, $p)
    {
        $model = $p['model'];
        $item = Pluf_Shortcuts_GetObjectOr404($model, $match['modelId']);
        if (isset($match['categoryId'])) {
            $categoryId = $match['categoryId'];
        } else {
            $categoryId = $request->REQUEST['categoryId'];
        }
        $category = Pluf_Shortcuts_GetObjectOr404('Assort_Category', $categoryId);
        $item->delAssoc($category);
        return new Pluf_HTTP_Response_Json($category);
    }
}
