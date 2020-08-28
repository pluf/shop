<?php

class Shop_Views_Zone
{

    public static function members($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        $user = new User_Account();

        $engine = $user->getEngine();
        $schema = $engine->getSchema();

        $userTable = $schema->getTableName($user);
        $assocTable = $schema->getRelationTable($user, $zone);
        $user_fk = $schema->getAssocField($user);

        $user->setView('myView', array(
            // 'select' => $owner->getSelect(),
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $userTable . '.id=' . $assocTable . '.' . $user_fk
        ));

        $builder = new Pluf_Paginator_Builder($user);
        return $builder->setWhereClause(new Pluf_SQL(Pluf_ModelUtils::getAssocField($zone) . '=%s', array(
            $zone->id
        )))
            ->setView('myView')
            ->setRequest($request)
            ->build();
    }

    public static function addMember($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('User_Account', $userId);
        $zone->setAssoc($user);
        return $user;
    }

    public static function removeMember($request, $match)
    {
        $zone = Pluf_Shortcuts_GetObjectOr404('Shop_Zone', $match['zoneId']);
        if (isset($match['userId'])) {
            $userId = $match['userId'];
        } else {
            $userId = $request->REQUEST['userId'];
        }
        $user = Pluf_Shortcuts_GetObjectOr404('User_Account', $userId);
        $zone->delAssoc($user);
        return $user;
    }
}