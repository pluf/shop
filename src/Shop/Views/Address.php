<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_Address
{

    public static function find($request, $match)
    {
        $address = new Shop_Address();
        $pag = new Pluf_Paginator($address);
        if(User_Precondition::ownerRequired($request)){            
            $pag->forced_where = new Pluf_SQL();
        }else{
            $pag->forced_where = new Pluf_SQL('user_id=' . $request->user->id);
        }
        $pag->list_filters = array(
            'id',
            'province',
            'city',
            'point',
            'user'
        );
        $search_fields = array(
            'province',
            'city',
            'address'
        );
        $sort_fields = array(
            'id',
            'province',
            'city',
            'point',
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
     * @throws \Pluf\Exception
     * @return 
     */
    public static function create($request, $match)
    {
        $data = $request->REQUEST;
        if(!isset($data['point']) && !(isset($data['province']) && isset($data['city']) && isset($data['address']))){
            throw new \Pluf\Exception('Illegal data: could not create Address without any address information');
        }
        $request->REQUEST['user'] = $request->user->id;
        $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_Address'), $request->REQUEST);
        $address = $form->save();
        $address->user_id = $request->user;
        $address->update();
        return $address;
    }

    public static function get($request, $match)
    {
        $address = Pluf_Shortcuts_GetObjectOr404('Shop_Address', $match['addressId']);
        if (self::canAccess($request, $address))
            return $address;
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     *
     * @param Pluf_HTTP_Request $request            
     * @param array $match            
     * @throws Pluf_Exception_PermissionDenied
     * @return 
     */
    public static function update($request, $match)
    {
        $address = Pluf_Shortcuts_GetObjectOr404('Shop_Address', $match['addressId']);
        if (self::canAccess($request, $address)) {
            $form = Pluf_Shortcuts_GetFormForUpdateModel($address, $request->REQUEST);
            $updatedAddress = $form->save();
            return $updatedAddress;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    public static function delete($request, $match)
    {
        $address = Pluf_Shortcuts_GetObjectOr404('Shop_Address', $match['addressId']);        
        if (self::canAccess($request, $address)) {
            $address->delete();
            return $address;
        }
        throw new Pluf_Exception_PermissionDenied("Permission is denied");
    }

    /**
     * Checks if user sending request has access to given Shop_Address object
     * 
     * @param Pluf_HTTP_Request $request
     * @param Shop_Address $address
     * @return boolean
     */
    private static function canAccess($request, $address){
        $currentUser_Account = $request->user;
        $user = $address->get_user();
        return ($user != null && $currentUser_Account->getId() === $user->getId()) || User_Precondition::ownerRequired($request);
    }
}