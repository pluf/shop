<?php
Pluf::loadFunction('Pluf_Shortcuts_GetFormForModel');
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
        $machine = new Workflow_Machine();
        $machine->setStates($this->getStates())
            ->setSignals(array('Shop_Order::stateChange'))
            ->setProperty('state')
            ->apply($order, $action);
        if($save){
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
}
