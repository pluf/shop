<?php

class Shop_Views_Zone
{

    public static function members($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        $user = new Pluf_User();
        $associationTable = Shop_Shortcuts_GetAssociationTableName($zone, $user);
        $user->_a['views']['myView'] = array(
            'select' => $user->getSecureSelect(),
            'join' => 'LEFT JOIN ' . $associationTable . ' ON users.id=' . $associationTable . '.pluf_user_id'
        );
        $page = new Pluf_Paginator($user);
        $sql = new Pluf_SQL('shop_zone_id=%s', array(
            $zone->id
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
        return new Pluf_HTTP_Response_Json($page->render_object());
    }

    public static function addMember($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('Pluf_User', $userId);
        $zone->setAssoc($user);
        return new Pluf_HTTP_Response_Json($user);
    }

    public static function removeMember($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('Pluf_User', $userId);
        $zone->delAssoc($user);
        return new Pluf_HTTP_Response_Json($user);
    }
}