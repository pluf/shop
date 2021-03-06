<?php
use Pluf\Workflow;

Pluf::loadFunction('Pluf_Shortcuts_GetObjectOr404');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParamOr403');
Pluf::loadFunction('Pluf_Shortcuts_GetRequestParam');

/**
 * Abstract Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
abstract class Shop_Order_Manager_Abstract implements Shop_Order_Manager
{

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::apply()
     */
    public function apply($order, $action, $save = false)
    {
        $machine = new Workflow\Machine();
        $machine->setStates($this->getStates())
            ->setSignals(array(
            'Shop_Order::stateChange'
        ))
            ->setProperty('state')
            ->apply($order, $action);
        if ($save) {
            return $order->update();
        }
        return true;
    }

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::transitions()
     */
    public function transitions($order)
    {
        $states = $this->getStates();
        $transtions = array();
        if (! array_key_exists($order->state, $states) || (! is_array($states[$order->state]) && ! is_object($states[$order->state]))) {
            return $transtions;
        }
        foreach ($states[$order->state] as $id => $trans) {
            $trans['id'] = $id;
            // TODO: chech preconditions and return only verified transitions
            unset($trans['preconditions']);
            unset($trans['action']);
            $transtions[] = $trans;
        }
        return $transtions;
    }

    /**
     * Gets list of states
     */
    abstract function getStates();

    /**
     *
     * @param string $signal
     * @param
     *            $event
     */
    public static function addOrderHistory($signal, $event)
    {
        switch ($event->event) {
            case 'set_zone':
                $object = $event->object->get_zone();
                break;
            case 'pay':
                $object = $event->object->get_payment();
                break;
            case 'set_assignee':
                $object = $event->object->get_assignee();
                break;
            case 'accept':
            case 'reject':
            case 'update':
            case 'done':
            case 'archive':
            default:
                $object = $event->object;
                break;
        }

        // Converts event name from camel case to underscored
        $underscored = ltrim(strtolower(preg_replace('/[A-Z]([A-Z](?![a-z]))*/', '_$0', $event->event)), '_');

        $history = new Shop_OrderHistory();
        $history->order_id = $event->object;
        if (isset($event->request->user)) {
            $history->subject_type = $event->request->user->_model;
            $history->subject_id = $event->request->user->id;
        }
        $history->action = $underscored;
        $history->object_type = $object->_model;
        $history->object_id = $object->id;
        $history->description = '' . Pluf_Shortcuts_GetRequestParam($event->request, 'description');
        $history->create();
    }
}
