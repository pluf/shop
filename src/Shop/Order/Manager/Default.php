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
class Shop_Order_Manager_Default extends Shop_Order_Manager_Abstract
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
                'visible' => true,
                'action' => Shop_Order_Event::DELETE_ACTION,
                'properties' => Shop_Order_Event::DELETE_PROPERTIES,
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'update' => array(
                'next' => 'archived',
                'visible' => false,
                'title' => 'Update',
                'description' => 'The order is updated',
                'action' => Shop_Order_Event::UPDATE_ACTION,
                'properties' => Shop_Order_Event::UPDATE_PROPERTIES
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
