<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * Shopinak Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
class Shop_Order_Manager_Shopinak implements Shop_Order_Manager
{

    /**
     * State machine of the manager
     */
    public static $STATE_MACHINE = array(
        Workflow_Machine::STATE_UNDEFINED => array(
            'next' => 'new'
        ),
        // State
        'new' => array(
            // Transaction or event
            'accept' => array(
                'next' => 'accepted',
                'visible' => true,
                'title' => 'Accept',
                'description' => 'Accept order',
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'reject' => array(
                'next' => 'rejected',
                'visible' => true,
                'title' => 'Reject',
                'description' => 'Reject order',
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'update' => array(
                'next' => 'new',
                'visible' => false,
                'title' => 'Update',
                'action' => array(
                    'Shop_Order_Manager_Shopinak',
                    'update'
                ),
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'read' => array(
                'next' => 'new',
                'title' => 'Get Information',
                'visible' => false
            ),
            'delete' => array(
                'next' => 'deleted',
                'title' => 'Delete',
                'visible' => false,
                'action' => array(
                    'Shop_Order_Manager_Shopinak',
                    'delete'
                ),
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            )
        ),
        'accepted' => array(
            // Transaction or event
            'send' => array(
                'next' => 'sent',
                'visible' => true,
                'title' => 'Send',
                'description' => 'Send order to customer',
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'read' => array(
                'next' => 'accepted',
                'title' => 'Get Information',
                'visible' => false
            )
        ),
        'sent' => array(
            // Transaction or event
            'deliver' => array(
                'next' => 'delivered',
                'visible' => true,
                'title' => 'Deliver',
                'description' => 'Order is delivered by customer',
            ),
            'read' => array(
                'next' => 'sent',
                'title' => 'Get Information',
                'visible' => false
            )
        ),
        'delivered' => array(
            // Transaction or event
            'clear' => array(
                'next' => 'cleared',
                'visible' => true,
                'title' => 'Clear',
                'description' => 'Clear order as payed to cloud',
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            ),
            'read' => array(
                'next' => 'delivered',
                'title' => 'Get Information',
                'visible' => false
            )
        ),
        'rejected' => array(
            // Transaction or event
            'read' => array(
                'next' => 'rejected',
                'title' => 'Get Information',
                'visible' => false
            ),
            'delete' => array(
                'next' => 'deleted',
                'title' => 'Delete',
                'visible' => false,
                'action' => array(
                    'Shop_Order_Manager_Shopinak',
                    'delete'
                ),
                'preconditions' => array(
                    'User_Precondition::isOwner'
                )
            )
        ),
        'cleared' => array(
            // Transaction or event
            'read' => array(
                'next' => 'cleared',
                'title' => 'Get Information',
                'visible' => false
            )
        ),
        'deleted' => array()
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
        // TODO: check if given state is defined in state machine
        foreach (self::$STATE_MACHINE[$order->state] as $id => $trans) {
            $trans['id'] = $id;
            // TODO: chech preconditions and return only verified transitions
            unset($trans['preconditions']);
            unset($trans['action']);
            $transtions[] = $trans;
        }
        return $transtions;
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
