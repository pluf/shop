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

/**
 * Returns name of field for id of given model in a association table.
 * Returned name is base of rule which Pluf is used to define columns in a association table
 * for two model in a many-to-many relation.
 *
 * @param Pluf_Model $model            
 * @return string
 */
function Shop_Shortcuts_GetIdColumnName($model)
{
    return strtolower($model->_a['model']) . '_id';
}

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
 *
 * @param string $itemType            
 * @throws Pluf_Exception
 * @return string
 */
function Shop_Shortcuts_GetItemClass($itemType)
{
    $mapper = array(
        'product' => 'Shop_Product',
        'service' => 'Shop_Service'
    );
    if (isset($mapper[$itemType]))
        return $mapper[$itemType];
    throw new Pluf_Exception('Unknown order item: ' . $itemType);
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
    if ($obj != null && $obj->id > 0 && $obj->secureId === $secureId) {
        return $obj;
    }
    throw new Pluf_HTTP_Error404("Object whit given secure id not found (" . $model . ", " . $secureId . ")");
}