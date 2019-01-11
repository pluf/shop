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
class Shop_Order_Manager_Simple extends Shop_Order_Manager_Abstract
{

    /**
     * State machine of the manager
     */
    public static $STATE_MACHINE = array(
        Workflow_Machine::STATE_UNDEFINED => array(
            'next' => 'new'
        ),
        // States
        'new' => array(
            'pay' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Pay',
                'description' => 'The order is payed',
                'properties' => Shop_Order_Event::PAY_PROPERTIES,
                'action' => Shop_Order_Event::PAY_ACTION
            ),
            'accept' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Accept',
                'description' => 'Accept the order',
                'properties' => Shop_Order_Event::ACCEPT_PROPERTIES,
                'action' => Shop_Order_Event::ACCEPT_ACTION
            ),
            'reject' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Reject',
                'description' => 'The order is not acceptable',
                'properties' => Shop_Order_Event::REJECT_PROPERTIES,
                'action' => Shop_Order_Event::REJECT_ACTION
            ),
            'update' => array(
                'next' => 'archived',
                'visible' => false,
                'title' => 'Update',
                'description' => 'The order is updated',
                'properties' => Shop_Order_Event::UPDATE_PROPERTIES,
                'action' => Shop_Order_Event::UPDATE_ACTION
            )
        ),
        'processing' => array(
            'done' => array(
                'next' => 'complete',
                'visible' => true,
                'title' => 'Done',
                'description' => 'The order is completed',
                'properties' => Shop_Order_Event::DONE_PROPERTIES,
                'action' => Shop_Order_Event::DONE_ACTION
            ),
            'reject' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Reject',
                'description' => 'Reject the order',
                'properties' => Shop_Order_Event::REJECT_PROPERTIES,
                'action' => Shop_Order_Event::REJECT_ACTION
            ),
            'set_zone' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Set zone',
                'description' => 'Set a zone to the order',
                'properties' => Shop_Order_Event::SET_ZONE_PROPERTIES,
                'action' => Shop_Order_Event::SET_ZONE_ACTION
            ),
            'set_assignee' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Set assignee',
                'description' => 'Set assignee to the order',
                'properties' => Shop_Order_Event::SET_ASSIGNEE_PROPERTIES,
                'action' => Shop_Order_Event::SET_ASSIGNEE_ACTION
            )
        ),
        'complete' => array(
            'archive' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Archive',
                'description' => 'Archive the order',
                'properties' => Shop_Order_Event::ARCHIVE_PROPERTIES,
                'action' => Shop_Order_Event::ARCHIVE_ACTION
            )
        ),
        'archived' => array(
            // This is final state
        )
    );

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::createOrderFilter()
     */
    public function createOrderFilter($request)
    {
        $sql = new Pluf_SQL();
        // Create filter
        return $sql;
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
