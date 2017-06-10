<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');
Pluf::loadFunction('Shop_Shortcuts_GetIdColumnName');
Pluf::loadFunction('Shop_Shortcuts_GetAssociationTableName');

class Shop_Views
{
    public static function tags ($request, $match, $p)
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
        
        $paginator = new Pluf_Paginator($tag);
        $sql = new Pluf_SQL($tagIdColName . '=%s',
            array(
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
    
    public static function addTag ($request, $match, $p)
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
    
    public static function removeTag ($request, $match, $p)
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
}
