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
class Shop_Order_Manager_Default extends Shop_Order_Manager_Abstract
{

    /**
     * State machine of the manager
     */
    public function getStates()
    {
        return array(
            Workflow\Machine::STATE_UNDEFINED => array(
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
                    'next' => 'Live',
                    'visible' => false,
                    'title' => 'Update',
                    'description' => 'The order is updated',
                    'action' => Shop_Order_Event::UPDATE_ACTION,
                    'properties' => Shop_Order_Event::UPDATE_PROPERTIES
                )
            ),
            'Deleted' => array()
        );
    }

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
        if (User_Precondition::isOwner($request)) {
            return $sql;
        }
        return new Pluf_SQL('false');
    }
}
