<?php

class Shop_Views_Agency
{

    public static function owners($request, $match)
    {
        $agency = Pluf_Shortcuts_GetObjectOr404('Shop_Agency', $match['agencyId']);
        $user = new User_Account();
        $userTable = Shop_Shortcuts_GetTableName($user);
        $associationTable = Shop_Shortcuts_GetAssociationTableName($agency, $user);
        $userIdName = Shop_Shortcuts_GetIdColumnName($user);
        $user->_a['views']['myView'] = array(
            'select' => $user->getSecureSelect(),
            'join' => 'LEFT JOIN ' . $associationTable . ' ON '.$userTable.'.id=' . $associationTable . '.' . $userIdName
        );
        $agencyIdName = Shop_Shortcuts_GetIdColumnName($agency);
        $page = new Pluf_Paginator($user);
        $sql = new Pluf_SQL($agencyIdName . '=%s', array(
            $agency->id
        ));
        $page->forced_where = $sql;
        $page->model_view = 'myView';
        $page->list_filters = array(
            'id',
            'login',
            'email',
            'administrator',
            'staff',
            'active'
        );
        $search_fields = array(
            'login',
            'first_name',
            'last_name',
            'email',
            'description'
        );
        $sort_fields = array(
            'id',
            'login',
            'first_name',
            'last_name',
            'administrator',
            'staff',
            'active',
            'date_joined',
            'last_login'
        );
        $page->configure(array(), $search_fields, $sort_fields);
        $page->setFromRequest($request);
        return $page;
    }

    public static function addOwner($request, $match)
    {
        $agency = Pluf_Shortcuts_GetObjectOr404('Shop_Agency', $match['agencyId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('User_Account', $userId);
        $agency->setAssoc($user);
        return $user;
    }

    public static function removeOwner($request, $match)
    {
        $agency = Pluf_Shortcuts_GetObjectOr404('Shop_Agency', $match['agencyId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('User_Account', $userId);
        $agency->delAssoc($user);
        return $user;
    }
}