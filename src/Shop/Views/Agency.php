<?php

class Shop_Views_Agency
{

    public static function owners($request, $match)
    {
        $agency = Pluf_Shortcuts_GetObjectOr404('Shop_Agency', $match['agencyId']);
        $user = new User_Account();
        $associationTable = Shop_Shortcuts_GetAssociationTableName($agency, $user);
        $user->_a['views']['myView'] = array(
            'select' => $user->getSecureSelect(),
            'join' => 'LEFT JOIN ' . $associationTable . ' ON users.id=' . $associationTable . '.pluf_user_id'
        );
        $page = new Pluf_Paginator($user);
        $sql = new Pluf_SQL('shop_agency_id=%s', array(
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
        return new Pluf_HTTP_Response_Json($user);
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
        return new Pluf_HTTP_Response_Json($user);
    }
}