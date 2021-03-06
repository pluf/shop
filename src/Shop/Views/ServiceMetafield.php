<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_ServiceMetafield
{
    public static function find($request, $match)
    {
        $item = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['modelId']);
        $paginator = new Pluf_Paginator(Pluf::factory('Shop_ServiceMetafield'));
        $sql = new Pluf_SQL('service_id=%s', array(
            $item->id
        ));
        $paginator->forced_where = $sql;
        $paginator->list_filters = array(
            'id',
            'key',
            'value',
            'namespace',
            'unit'
        );
        $search_fields = array(
            'key',
            'value',
            'namespace'
        );
        $sort_fields = array(
            'id',
            'key',
            'value',
            'namespace',
            'unit'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return $paginator;
    }

//     public static function create($request, $match)
//     {
//         $item = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['modelId']);
//         $request->REQUEST['service_id'] = $item->id;
//         $form = Pluf_Shortcuts_GetFormForModel(Pluf::factory('Shop_ServiceMetafield'), $request->REQUEST);
//         $mf = $form->save();
//         $mf->service_id = $item;
//         $mf->update();
//         return $mf;
//     }

    public static function get($request, $match)
    {
        // Check if service exsit
        $item = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['modelId']);
        // Extract metafield id or metafield key if id is not provided
        $mfId = null;
        $mfKey = null;
        if (isset($match['id'])) {
            $mfId = $match['id'];
        } else if(isset($request->REQUEST['metafield'])){
            $mfId = $request->REQUEST['metafield'];
        } else if(isset($match['mfKey'])){
            $mfKey = $match['mfKey'];            
        } else if(isset($request->REQUEST['key'])){
            $mfKey = $request->REQUEST['key'];
        }
        // Extract metafield key (if id is not provided)
        if(!isset($mfId) && !isset($mfKey)){
            throw new Pluf_Exception_BadRequest('Neither Id nor key of metafield is provided.');
        }
        // Extract Metafield
        $metafield = null;
        if(isset($mfId)){
            $metafield = Pluf_Shortcuts_GetObjectOr404('Shop_ServiceMetafield', $mfId);
            if ($metafield->service_id != $item->id) {
                throw new Pluf_Exception_DoesNotExist('Metafield with id (' . $metafield->id . ') is not blong to the Service with id (' . $item->id . ')');
            }
        }else if(isset($mfKey)){
            $sql = new Pluf_SQL('`key`=%s AND `service_id`=%d', array($mfKey, $item->id));
            $metafield = Pluf::factory('Shop_ServiceMetafield')->getOne($sql->gen());
        }
        if(!isset($metafield)){
            throw new Pluf_Exception_DoesNotExist('There is no such Metafield');
        }
        return $metafield;
    }
    
    public static function remove($request, $match)
    {
        if (isset($match['id'])) {
            $mfId = $match['id'];
        } else {
            $mfId = $request->REQUEST['id'];
        }
        $mf = Pluf_Shortcuts_GetObjectOr404('Shop_ServiceMetafield', $mfId);
        $mf = $mf->delete();
        return $mf;
    }

    
    public static function createOrUpdate($request, $match)
    {
        $item = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['modelId']);
        $metafield = Shop_Views_ServiceMetafield::getMetafieldByIdOrKey($request, $match);
        if(!isset($metafield)){ // Should be created
            $metafield = Pluf::factory('Shop_ServiceMetafield');
            $metafield->service_id = $item;
        }
        // Create/Update metafield
        $form = Pluf_Shortcuts_GetFormForModel($metafield, $request->REQUEST);
        $metafield = $form->save();
        return $metafield;
    }
    
    /**
     * Extract Id or Key of metafield from given request and returns related Metafield
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @throws Pluf_Exception_DoesNotExist if Id is given and Metafield with given id does not exist or is not blong to given Service 
     * @return NULL|Shop_ServiceMetafield
     */
    private static function getMetafieldByIdOrKey($request, $match){
        $mfId = null;
        // Extract metafield id (if exist)
        if (isset($match['id'])) {
            $mfId = $match['id'];
        } else if(isset($request->REQUEST['metafield'])){
            $mfId = $request->REQUEST['metafield'];
        }
        // Extract or create Metafield
        $metafield = null;
        if(isset($mfId)){
            $metafield = Pluf_Shortcuts_GetObjectOr404('Shop_ServiceMetafield', $mfId);
            if ($metafield->service_id != $match['modelId']) {
                throw new Pluf_Exception_DoesNotExist('Metafield with id (' . $metafield->id . ') is not blong to the Service with id (' . $match['modelId'] . ')');
            }
        }else{
            $sql = new Pluf_SQL('`key`=%s AND `service_id`=%s', array($request->REQUEST['key'], $match['modelId']));
            $str = $sql->gen();
            $metafield = Pluf::factory('Shop_ServiceMetafield')->getOne($str);
        }
        return $metafield;
    }
    
}
