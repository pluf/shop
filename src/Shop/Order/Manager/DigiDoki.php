<?php
use Pluf\Workflow;

/**
 * DigiDoki Order manager
 *
 * @author hadi<mohammad.hadi.mansouri@dpq.co.ir>
 * @author maso<mostafa.barmshory@dpq.co.ir>
 */
class Shop_Order_Manager_DigiDoki extends Shop_Order_Manager_Abstract
{

    /**
     * State machine of the manager
     */
    private static $STATE_MACHINE = null;

    private static function initStateMachine()
    {
        // TODO: replace the following role with an appropriate role
        $role = User_Role::getFromString('tenant.member');
        $url = $role ? "/api/v2/user/roles/$role->id/accounts" : '/api/v2/user/accounts';
        $setFixerProp = Shop_Order_Event_DigiDoki::SET_FIXER_PROPERTIES;
        $setFixerProp[0]['suggestions'] = array(
            array(
                'title' => 'Fixer',
                'url' => $url,
                'filter' => array(),
                'template' => '{{id}}'
            )
        );

        $setZoneProp = Shop_Order_Event_DigiDoki::SET_ZONE_PROPERTIES;
        $setZoneProp[0]['suggestions'] = array(
            array(
                'title' => 'Zone',
                'url' => '/api/v2/shop/zones',
                'filter' => array(),
                'template' => '{{id}}'
            )
        );

        $setWorkshopProp = Shop_Order_Event_DigiDoki::SET_WORKSHOP_PROPERTIES;
        $setWorkshopProp[0]['suggestions'] = array(
            array(
                'title' => 'Workshop',
                'url' => '/api/v2/shop/agencies',
                'filter' => array(),
                'template' => '{{id}}'
                )
        );

        self::$STATE_MACHINE = array(
            // Handle other states
            // Workflow_Machine::STATE_OTHERS => array(
            // 'action' => array(),
            // 'next' => 'error',
            // 'preconditions' => array()
            // ),
            // Empty state (start state machine
            Workflow\Machine::STATE_UNDEFINED => array(
                'next' => 'new',
                'action' => Shop_Order_Event_DigiDoki::SEND_NEW_ORDER_NOTIFICATION_ACTION
            ),
            // State
            'new' => array(
                // Transaction or event
                'setZone' => array(
                    'next' => 'check',
                    'visible' => true,
                    'title' => 'Set Zone',
                    'description' => 'Set a zone to the order',
                    'properties' => $setZoneProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_ZONE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'failedToConnect' => array(
                    'next' => 'notResponded',
                    'visible' => true,
                    'title' => 'Failed to Connect',
                    'description' => 'Failed to connect to the customer',
                    'properties' => Shop_Order_Event_DigiDoki::FAILED_TO_CONNECT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::FAILED_TO_CONNECT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'archive' => array(
                    'next' => 'archived',
                    'visible' => true,
                    'title' => 'Archive',
                    'description' => 'Archive the order',
                    'properties' => Shop_Order_Event_DigiDoki::ARCHIVE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::ARCHIVE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'report' => array(
                    'next' => 'new',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                )
            ),
            'notResponded' => array(
                'setZone' => array(
                    'next' => 'check',
                    'visible' => true,
                    'title' => 'Set Zone',
                    'description' => 'Set a zone to the order',
                    'properties' => $setZoneProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_ZONE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'setFixer' => array(
                    'next' => 'waiting',
                    'visible' => true,
                    'title' => 'Set Fixer',
                    'description' => 'Set fixer for the order',
                    'properties' => $setFixerProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_FIXER_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'setWorkshop' => array(
                    'next' => 'workshop-check',
                    'visible' => true,
                    'title' => 'Set Workshop',
                    'description' => '',
                    'properties' => $setWorkshopProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'close' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Close',
                    'description' => 'Close the order',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'report' => array(
                    'next' => 'check',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                )
            ),
            'check' => array(
                'setFixer' => array(
                    'next' => 'waiting',
                    'visible' => true,
                    'title' => 'Set Fixer',
                    'description' => 'Set fixer for the order',
                    'properties' => $setFixerProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_FIXER_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'remoteConsultant' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Remote Consultant',
                    'description' => 'Consultant remotely',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'incompleteInfo' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Incomplete Information',
                    'description' => 'The information ot the order is imcomplete',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'setWorkshop' => array(
                    'next' => 'workshop-check',
                    'visible' => true,
                    'title' => 'Set Workshop',
                    'description' => '',
                    'properties' => $setWorkshopProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'failedToConnect' => array(
                    'next' => 'notResponded',
                    'visible' => true,
                    'title' => 'Failed to Connect',
                    'description' => 'Failed to connect to the customer',
                    'properties' => Shop_Order_Event_DigiDoki::FAILED_TO_CONNECT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::FAILED_TO_CONNECT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'report' => array(
                    'next' => 'check',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                )
            ),
            'waiting' => array(
                'schedule' => array(
                    'next' => 'schedule',
                    'visible' => true,
                    'title' => 'Schedule',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::SCHEDULE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::SCHEDULE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'impossibleFix' => array(
                    'next' => 'fail',
                    'visible' => true,
                    'title' => 'Impossible Fix',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'setWorkshop' => array(
                    'next' => 'workshop-check',
                    'visible' => true,
                    'title' => 'Set Workshop',
                    'description' => '',
                    'properties' => $setWorkshopProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'report' => array(
                    'next' => 'waiting',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                )
            ),
            'schedule' => array(
                'addCost' => array(
                    'next' => 'schedule',
                    'visible' => true,
                    'title' => 'Add Cost',
                    'description' => 'Add cost to the order',
                    'properties' => Shop_Order_Event_DigiDoki::ADD_COST_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::ADD_COST_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'fix' => array(
                    'next' => 'fixed',
                    'visible' => true,
                    'title' => 'Fix',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::FIX_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::FIX_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'impossibleFix' => array(
                    'next' => 'fail',
                    'visible' => true,
                    'title' => 'Impossible Fix',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'setWorkshop' => array(
                    'next' => 'workshop-check',
                    'visible' => true,
                    'title' => 'Set Workshop',
                    'description' => '',
                    'properties' => $setWorkshopProp,
                    'action' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'report' => array(
                    'next' => 'schedule',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                )
            ),
            'fixed' => array(
                'close' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Close',
                    'description' => 'Close the order',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'report' => array(
                    'next' => 'fixed',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                )
            ),
            'fail' => array(
                'close' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Close',
                    'description' => 'Close the order',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                ),
                'report' => array(
                    'next' => 'fail',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isZoneOwner'
                    )
                )
            ),
            // State
            'close' => array(
                'archive' => array(
                    'next' => 'archived',
                    'visible' => true,
                    'title' => 'Archive',
                    'description' => 'Archive the order',
                    'properties' => Shop_Order_Event_DigiDoki::ARCHIVE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::ARCHIVE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'reopen' => array(
                    'next' => 'check',
                    'visible' => true,
                    'title' => 'Reopen',
                    'description' => 'Reopen the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REOPEN_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                ),
                'report' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isCrm'
                    )
                )
            ),

            // Workshope
            'workshop-check' => array(
                'workshopDelivered' => array(
                    'next' => 'in-queue',
                    'visible' => true,
                    'title' => 'Delivered in Workshop',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'close' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Not Delivered',
                    'description' => 'Close the order',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'report' => array(
                    'next' => 'workshop-check',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                )
            ),
            'in-queue' => array(
                'workshopStartFix' => array(
                    'next' => 'repairing',
                    'visible' => true,
                    'title' => 'Start Fix',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'report' => array(
                    'next' => 'in-queue',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                )
            ),
            'repairing' => array(
                'addCost' => array(
                    'next' => 'repairing',
                    'visible' => true,
                    'title' => 'Add Cost',
                    'description' => 'Add cost to the order',
                    'properties' => Shop_Order_Event_DigiDoki::ADD_COST_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::ADD_COST_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isFixer'
                    )
                ),
                'workshopFailFix' => array(
                    'next' => 'giving-back',
                    'visible' => true,
                    'title' => 'Failed',
                    'description' => 'Close the order',
                    'properties' => Shop_Order_Event_DigiDoki::CLOSE_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::CLOSE_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'workshopEndFix' => array(
                    'next' => 'giving-back',
                    'visible' => true,
                    'title' => 'End Fix',
                    'description' => '',
                    'action' => Shop_Order_Event_DigiDoki::WORKSHOP_FIX_ACTION,
                    'properties' => Shop_Order_Event_DigiDoki::FIX_PROPERTIES,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'workshopNeedTime' => array(
                    'next' => 'in-queue',
                    'visible' => true,
                    'title' => 'Need More Time',
                    'description' => 'We need more time to fix',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'workshopNeedSpare' => array(
                    'next' => 'in-queue',
                    'visible' => true,
                    'title' => 'Need to Spare',
                    'description' => 'We need spares to fix',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'report' => array(
                    'next' => 'repairing',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                )
            ),
            'giving-back' => array(
                'workshopGiveBack' => array(
                    'next' => 'close',
                    'visible' => true,
                    'title' => 'Give Back from Workshop',
                    'description' => '',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                ),
                'report' => array(
                    'next' => 'giving-back',
                    'visible' => true,
                    'title' => 'Report',
                    'description' => 'Add report to the order',
                    'properties' => Shop_Order_Event_DigiDoki::REPORT_PROPERTIES,
                    'action' => Shop_Order_Event_DigiDoki::REPORT_ACTION,
                    'preconditions' => array(
                        'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                    )
                )
            )
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
        return new Pluf_SQL('deleted=%d AND (customer_id=%d OR assignee_id=%d)', array(
            FALSE,
            $request->user->id,
            $request->user->id
        ));
    }

    /**
     *
     * {@inheritdoc}
     * @see Shop_Order_Manager::getStates()
     */
    public function getStates()
    {
        if(self::$STATE_MACHINE == null){
            self::initStateMachine();
        }
        return self::$STATE_MACHINE;
    }
}
