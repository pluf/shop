<?php
use Pluf\Workflow;

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
    private static $STATE_MACHINE = array(
        Workflow\Machine::STATE_UNDEFINED => array(
            'next' => 'new'
        ),
        // States
        'new' => array(
            'pay' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Pay',
                'description' => 'The order is payed',
                'properties' => Shop_Order_Event_Simple::PAY_PROPERTIES,
                'action' => Shop_Order_Event_Simple::PAY_ACTION
            ),
            'accept' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Accept',
                'description' => 'Accept the order',
                'properties' => Shop_Order_Event_Simple::ACCEPT_PROPERTIES,
                'action' => Shop_Order_Event_Simple::ACCEPT_ACTION
            ),
            'reject' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Reject',
                'description' => 'The order is not acceptable',
                'properties' => Shop_Order_Event_Simple::REJECT_PROPERTIES,
                'action' => Shop_Order_Event_Simple::REJECT_ACTION
            ),
            'update' => array(
                'next' => 'new',
                'visible' => false,
                'title' => 'Update',
                'description' => 'The order is updated',
                'properties' => Shop_Order_Event_Simple::UPDATE_PROPERTIES,
                'action' => Shop_Order_Event_Simple::UPDATE_ACTION,
                'preconditions' => array(
                    'Shop_Order_Manager_SimplePreconditions::catUpdateOrder'
                )
            )
        ),
        'processing' => array(
            'done' => array(
                'next' => 'complete',
                'visible' => true,
                'title' => 'Done',
                'description' => 'The order is completed',
                'properties' => Shop_Order_Event_Simple::DONE_PROPERTIES,
                'action' => Shop_Order_Event_Simple::DONE_ACTION
            ),
            'reject' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Reject',
                'description' => 'Reject the order',
                'properties' => Shop_Order_Event_Simple::REJECT_PROPERTIES,
                'action' => Shop_Order_Event_Simple::REJECT_ACTION
            ),
            'set_zone' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Set zone',
                'description' => 'Set a zone to the order',
                'properties' => Shop_Order_Event_Simple::SET_ZONE_PROPERTIES,
                'action' => Shop_Order_Event_Simple::SET_ZONE_ACTION
            ),
            'set_assignee' => array(
                'next' => 'processing',
                'visible' => true,
                'title' => 'Set assignee',
                'description' => 'Set assignee to the order',
                'properties' => Shop_Order_Event_Simple::SET_ASSIGNEE_PROPERTIES,
                'action' => Shop_Order_Event_Simple::SET_ASSIGNEE_ACTION
            )
        ),
        'complete' => array(
            'archive' => array(
                'next' => 'archived',
                'visible' => true,
                'title' => 'Archive',
                'description' => 'Archive the order',
                'properties' => Shop_Order_Event_Simple::ARCHIVE_PROPERTIES,
                'action' => Shop_Order_Event_Simple::ARCHIVE_ACTION
            )
        ),
        'archived' => array(
            // This is final state
            'delete' => array(
                'next' => 'deleted',
                'title' => 'Delete',
                'visible' => true,
                'action' => Shop_Order_Event_Simple::DELETE_ACTION,
                'properties' => Shop_Order_Event_Simple::DELETE_PROPERTIES,
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            )
        )
    );

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::createOrderFilter()
     */
    public function createOrderFilter($request)
    {
        $sql = new Pluf_SQL('deleted=%d', array(
            FALSE
        ));
        // Owner
        if (User_Precondition::isOwner($request)) {
            return $sql;
        }
        if (User_Precondition::isLogedIn($request)) {
            // Customer or Assignee
            $sql = $sql->Q('(customer_id=%s OR assignee_id=%s)', array(
                $request->user->id,
                $request->user->id
            ));
            // Agency Owner
            $agencies = $request->user->get_agencies_list();
            if ($agencies->count() > 0) {
                $agIds = array();
                foreach ($agencies as $ag) {
                    array_push($agIds, $ag->id);
                }
                $sql2 = new Pluf_SQL('agency_id IN (' . implode(',', $agIds) . ')');
                $sql = $sql->SOr($sql2);
            }
            // Zone Owner
            $zones = $request->user->get_owned_zones_list();
            if ($zones->count() > 0) {
                $zoneIds = array();
                foreach ($zones as $zone) {
                    array_push($zoneIds, $zone->id);
                }
                $sql2 = new Pluf_SQL('zone_id IN (' . implode(',', $zoneIds) . ')');
                $sql = $sql->SOr($sql2);
            }
            return $sql;
        }
        return new Pluf_SQL('false');
    }

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::getStates()
     */
    public function getStates()
    {
        return self::$STATE_MACHINE;
    }
}
