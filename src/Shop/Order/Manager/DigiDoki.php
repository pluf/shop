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
    private static $STATE_MACHINE = array(
        // Handle other states
        // Workflow_Machine::STATE_OTHERS => array(
        // 'action' => array(),
        // 'next' => 'error',
        // 'preconditions' => array()
        // ),
        // Empty state (start state machine
        Workflow\Machine::STATE_UNDEFINED => array(
            'next' => 'new',
            'action' => Shop_Order_Event_DigiDoki::SEND_NOTIFICATION_ACTION
        ),
        // State
        'new' => array(
            // Transaction or event
            'setZone' => array(
                'next' => 'check',
                'visible' => true,
                'title' => 'Set Zone',
                'description' => 'Set a zone to the order',
                'properties' => Shop_Order_Event_DigiDoki::SET_ZONE_PROPERTIES,
                'action' => Shop_Order_Event_DigiDoki::SET_ZONE_ACTION,
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
        'check' => array(
            'setFixer' => array(
                'next' => 'waiting',
                'visible' => true,
                'title' => 'Set Fixer',
                'description' => 'Set fixer for the order',
                'properties' => Shop_Order_Event_DigiDoki::SET_FIXER_PROPERTIES,
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
                'properties' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_PROPERTIES,
                'action' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_ACTION,
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
                'properties' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_PROPERTIES,
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
                'properties' => Shop_Order_Event_DigiDoki::SET_WORKSHOP_PROPERTIES,
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
                'properties' => array(),
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
                'title' => 'Workshop Delivered',
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
                'title' => 'Close',
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
                'title' => 'Workshop Fix',
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
            'workshopFailFix' => array(
                'next' => 'giving-back',
                'visible' => true,
                'title' => 'Close',
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
                'title' => 'Workshop Fix',
                'description' => '',
                'action' => Shop_Order_Event_DigiDoki::WORKSHOP_FIX_ACTION,
                'preconditions' => array(
                    'Shop_Order_Event_DigiDoki::isWorkshopOwner'
                )
            ),
            'workshopNeedTime' => array(
                'next' => 'in-queue',
                'visible' => true,
                'title' => 'Need More Time',
                'description' => '',
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
