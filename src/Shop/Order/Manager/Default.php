<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * Default Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
class Shop_Order_Manager_Default implements Shop_Order_Manager
{

    /**
     * State machine of the manager
     */
    public static $STATE_MACHINE = array(
        Workflow_Machine::STATE_UNDEFINED => array(
            'next' => 'Live'
        ),
        // State
        'Live' => array(
            // Transaction or event
            'addItem' => array(
                'next' => 'Live',
                'visible' => true
            ),
            'update' => array(
                'next' => 'Live',
                'visible' => false,
                'action' => array(
                    'Shop_Order_Manager_Default',
                    'update'
                ),
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'read' => array(
                'next' => 'Live',
                'visible' => false
            ),
            'delete' => array(
                'next' => 'Deleted',
                'visible' => false,
                'action' => array(
                    'Shop_Order_Manager_Default',
                    'update'
                ),
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            )
        ),
        'Deleted' => array()
    );

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::createOrderFilter()
     */
    public function createOrderFilter($request)
    {
        $sql = new Pluf_SQL('deleted=false');
        if (User_Precondition::isOwner($request)) {
            return $sql;
        }
        return new Pluf_SQL('false');
    }

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::apply()
     */
    public function apply($object, $action)
    {
        $machine = new Workflow_Machine();
        $machine->setStates(self::$STATE_MACHINE)
            ->setSignals(array(
            'Shot_Order::stateChange'
        ))
            ->setProperty('state')
            ->apply($object, $action);
        return true;
    }

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::nextStates()
     */
    public function nextStates($order)
    {
        $states = array();
        foreach (self::$STATE_MACHINE[$order->state] as $id => $state) {
            $state['id'] = $id;
            $states[] = $state;
        }
        return $states;
    }

    /**
     * Update an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function update($request, $object)
    {
        Pluf_Shortcuts_GetFormForUpdateModel($object, $request->REQUEST)->save();
    }

    /**
     * Deletes an order
     *
     * @param Pluf_HTTP_Request $request
     * @param Shop_Order $object
     */
    public static function delete($request, $object)
    {
        $object->deleted = true;
        $object->update();
    }
}