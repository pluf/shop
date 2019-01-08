<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_Contact
{

    public static function find($request, $match)
    {
        $contact = new Shop_Contact();
        $pag = new Pluf_Paginator($contact);
        if (User_Precondition::ownerRequired($request)) {
            $pag->forced_where = new Pluf_SQL();
        } else {
            $pag->forced_where = new Pluf_SQL('user=' . $request->user->id);
        }
        $pag->list_filters = array(
            'id',
            'contact',
            'type',
            'user'
        );
        $search_fields = array(
            'contact',
            'type'
        );
        $sort_fields = array(
            'id',
            'contact',
            'type',
            'user'
        );
        $pag->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $pag->configure(array(), $search_fields, $sort_fields);
        $pag->setFromRequest($request);
        return $pag;
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @throws Pluf_Exception
     * @return Pluf_HTTP_Response_Json
     */
    public static function create($request, $match)
    {
        $request->REQUEST['user'] = $request->user->id;
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_Contact'), $request->REQUEST);
        $contact = $form->save();
        $contact->__set('user', $request->user);
        $contact->update();
        return new Pluf_HTTP_Response_Json($contact);
    }

    public static function get($request, $match)
    {
        $contact = Pluf_Shortcuts_GetObjectOr404('Shop_Contact', $match['contactId']);
        if (self::canAccess($request, $contact))
            return new Pluf_HTTP_Response_Json($contact);
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @throws Pluf_Exception_PermissionDenied
     * @return Pluf_HTTP_Response_Json
     */
    public static function update($request, $match)
    {
        $contact = Pluf_Shortcuts_GetObjectOr404('Shop_Contact', $match['contactId']);
        if (self::canAccess($request, $contact)) {
            $form = Pluf_Shortcuts_GetFormForUpdateModel($contact, $request->REQUEST);
            $updatedContact = $form->save();
            return new Pluf_HTTP_Response_Json($updatedContact);
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    public static function delete($request, $match)
    {
        $contact = Pluf_Shortcuts_GetObjectOr404('Shop_Contact', $match['contactId']);
        if (self::canAccess($request, $contact)) {
            $contact->delete();
            return new Pluf_HTTP_Response_Json($contact);
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     * Checks if user sending request has access to given Shop_Contact object
     *
     * @param Pluf_HTTP_Request $request            
     * @param Shop_Contact $contact            
     * @return boolean
     */
    private static function canAccess($request, $contact)
    {
        $currentUser_Account = $request->user;
        $user = $contact->get_user();
        return ($user != null && $currentUser_Account->getId() === $user->getId()) || User_Precondition::ownerRequired($request);
    }
}