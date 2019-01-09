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
            'delete' => array(
                'next' => 'Deleted',
                'title' => 'Delete',
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
     * @see Shop_Order_Manager::transitions()
     */
    public function transitions($order)
    {
        $transtions = array();
        foreach (self::$STATE_MACHINE[$order->state] as $id => $trans) {
            $trans['id'] = $id;
            // TODO: chech preconditions and return only verified transitions
            unset($trans['preconditions']);
            unset($trans['action']);
            $transtions[] = $trans;
        }
        return $transtions;
    }
}
