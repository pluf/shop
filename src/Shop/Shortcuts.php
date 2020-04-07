<?php

function Shop_Shortcuts_NormalizeItemPerPage($request)
{
    $count = array_key_exists('_px_c', $request->REQUEST) ? intval($request->REQUEST['_px_c']) : 30;
    if ($count > 30)
        $count = 30;
    return $count;
}

/**
 * Returns association table name for given 'Pluf_Model's in many-to-many relation.
 * It does not check if given models have realy many-to-many relation. It returns table name
 * if such relation would be existed.
 *
 * Returned name is base of rule which Pluf is used to define association tables for two models
 * in a many-to-many relation.
 *
 * @param Pluf_Model $model1            
 * @param Pluf_Model $model2            
 * @return string
 */
function Shop_Shortcuts_GetAssociationTableName($model1, $model2)
{
    $hay = array(
        strtolower($model1->_a['model']),
        strtolower($model2->_a['model'])
    );
    sort($hay);
    $table = $model1->_con->pfx . $hay[0] . '_' . $hay[1] . '_assoc';
    return $table;
}

// /**
//  * Returns name of field for id of given model in a association table.
//  * Returned name is base of rule which Pluf is used to define columns in a association table
//  * for two model in a many-to-many relation.
//  *
//  * @param Pluf_Model $model            
//  * @return string
//  */
// function Shop_Shortcuts_GetIdColumnName($model)
// {
//     return strtolower($model->_a['model']) . '_id';
// }

/**
 * Returns name of table for given model.
 * Returned name is base of rule which Pluf is used to define name of tables
 * for a model.
 *
 * @param Pluf_Model $model            
 * @return string
 */
function Shop_Shortcuts_GetTableName($model)
{
    return $model->_con->pfx . $model->_a['table'];
}

/**
 * Returns name of class which is related to given item type.
 * Mapping class names are now as follow:
 *
 * service => Shop_Service
 * product => Shop_Product
 * delivery => Shop_Delivery
 *
 * @param string $itemType            
 * @return string class type of order item or null if it is unknown or not set
 */
function Shop_Shortcuts_GetItemClass($itemType)
{
    $mapper = array(
        'product' => 'Shop_Product',
        'service' => 'Shop_Service',
        'delivery' => 'Shop_Delivery'
    );
    if (isset($mapper[$itemType]))
        return $mapper[$itemType];
    return null;
}

/**
 * Get an object by secure id or raise a 404 error.
 * 
 * @param string $model
 *            class name of object
 * @param string $secureId
 *            secure id of object
 * @return object defined by $model
 */
function Shop_Shortcuts_GetObjectBySecureIdOr404($model, $secureId)
{
    $myObject = new $model();
    $obj = $myObject->getOne("secureId='" . $secureId . "'");
    if ($obj != null && $obj->id > 0) {
        return $obj;
    }
    throw new Pluf_HTTP_Error404("Object whit given secure id not found (" . $model . ", " . $secureId . ")");
}
/**
 * Returns Shop_Tag with given name.
 * Throws an exception (with http code 404) if there is no tag with given name.
 * @param string $name
 * @throws Pluf_Exception_DoesNotExist if there is no tag with given name.
 * @return Shop_Tag
 */
function Shop_Shortcuts_GetTagByNameOr404 ($name)
{
    $q = new Pluf_SQL('name=%s', array(
        $name
    ));
    $item = new Shop_Tag();
    $item = $item->getList(array(
        'filter' => $q->gen()
    ));
    if (isset($item) && $item->count() == 1) {
        return $item[0];
    }
    if ($item->count() > 1) {
        Pluf_Log::error(
            sprintf('more than one tag exist with the name $s', $name));
        return $item[0];
    }
    throw new Pluf_Exception_DoesNotExist(
        "Tag not found (Tag name:" . $name . ")");
}