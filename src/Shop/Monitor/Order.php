<?php 

/**
 * Monitor orders of the system
 * 
 * @author DPQ
 *
 */
class Shop_Monitor_Order {
    
    /**
     * Returns total number of orders
     * 
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function count($request, $match){
        $model = new Shop_Order();
        $params = array(
            'count' => true
        );
        $result = $model->getList($params);
        // convert to numeric value and return
        return $result[0]['nb_items'] + 0;
    }
    
    /**
     * Total amount of all orders
     * 
     * @param Pluf_HTTP_Request $request
     * @param array $match
     * @return number
     */
    public static function amount($request, $match){
        $model = new Shop_OrderItem();
        $params = array(
            'select' => 'SUM(price * count) AS price'
        );
        $result = $model->getList($params);
        return $result[0]->price;
    }
    
}