<?php
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Shop_Shortcuts_NormalizeItemPerPage');

class Shop_Views_Tax
{

    // *******************************************************************
    // Taxes of Product
    // *******************************************************************
    public static function productTaxes ($request, $match)
    {
        $product = Pluf_Shortcuts_GetObjectOr404('Shop_Product', $match['productId']);
        $tax = new Shop_TaxClass();
        $taxTable = $tax->_a['table'];
        $assocTable = 'shop_product_shop_taxclass_assoc';
        $tax->_a['views']['myView'] = array(
                'select' => $tax->getSelect(),
                'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $taxTable .
                         '.id=' . $assocTable . '.shop_taxclass_id'
        );
        
        $paginator = new Pluf_Paginator($tax);
        $sql = new Pluf_SQL('shop_product_id=%s', 
                array(
                        $product->id
                ));
        $paginator->forced_where = $sql;
        $paginator->model_view = 'myView';
        $paginator->list_filters = array(
                'id',
                'title'
        );
        $search_fields = array(
                'title',
                'rate'
        );
        $sort_fields = array(
                'id',
                'creation_dtime',
                'rate',
                'modif_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return $paginator;
    }

    public static function addProductTax ($request, $match)
    {
        $product = Pluf_Shortcuts_GetObjectOr404('Shop_Product', $match['productId']);
        if (isset($match['id'])) {
            $taxId = $match['id'];
        } else {
            $taxId = $request->REQUEST['id'];
        }
        $tax = Pluf_Shortcuts_GetObjectOr404('Shop_TaxClass', $taxId);
        $product->setAssoc($tax);
        return new Pluf_HTTP_Response_Json($tax);
    }

    public static function removeProductTax ($request, $match)
    {
        $product = Pluf_Shortcuts_GetObjectOr404('Shop_Product', $match['productId']);
        if (isset($match['id'])) {
            $taxId = $match['id'];
        } else {
            $taxId = $request->REQUEST['id'];
        }
        $tax = Pluf_Shortcuts_GetObjectOr404('Shop_TaxClass', $taxId);
        $product->delAssoc($tax);
        return new Pluf_HTTP_Response_Json($tax);
    }
  
    // *******************************************************************
    // Taxes of Service
    // *******************************************************************
    public static function serviceTaxes ($request, $match)
    {
        $service = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['serviceId']);
        $tax = new Shop_TaxClass();
        $taxTable = $tax->_a['table'];
        $assocTable = 'shop_service_shop_taxclass_assoc';
        $tax->_a['views']['myView'] = array(
            'select' => $tax->getSelect(),
            'join' => 'LEFT JOIN ' . $assocTable . ' ON ' . $taxTable .
            '.id=' . $assocTable . '.shop_taxclass_id'
        );
        
        $paginator = new Pluf_Paginator($tax);
        $sql = new Pluf_SQL('shop_service_id=%s',
            array(
                $service->id
            ));
        $paginator->forced_where = $sql;
        $paginator->model_view = 'myView';
        $paginator->list_filters = array(
            'id',
            'title'
        );
        $search_fields = array(
            'title',
            'rate'
        );
        $sort_fields = array(
            'id',
            'creation_dtime',
            'rate',
            'modif_dtime'
        );
        $paginator->configure(array(), $search_fields, $sort_fields);
        $paginator->items_per_page = Shop_Shortcuts_NormalizeItemPerPage($request);
        $paginator->setFromRequest($request);
        return $paginator;
    }

    public static function addServiceTax ($request, $match)
    {
        $service = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['serviceId']);
        if (isset($match['id'])) {
            $taxId = $match['id'];
        } else {
            $taxId = $request->REQUEST['id'];
        }
        $tax = Pluf_Shortcuts_GetObjectOr404('Shop_TaxClass', $taxId);
        $service->setAssoc($tax);
        return new Pluf_HTTP_Response_Json($tax);
    }
    
    public static function removeServiceTax ($request, $match)
    {
        $service = Pluf_Shortcuts_GetObjectOr404('Shop_Service', $match['serviceId']);
        if (isset($match['id'])) {
            $taxId = $match['id'];
        } else {
            $taxId = $request->REQUEST['id'];
        }
        $tax = Pluf_Shortcuts_GetObjectOr404('Shop_TaxClass', $taxId);
        $service->delAssoc($tax);
        return new Pluf_HTTP_Response_Json($tax);
    }
    
}