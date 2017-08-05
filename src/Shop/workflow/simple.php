<?php
return array(
        Workflow_Machine::STATE_UNDEFINED => array(
                'next' => 'Locked'
        ),
        // State
        'Locked' => array(
                // Transaction or event
                'coin' => array(
                        'next' => 'Unlocked'
                ),
                'push' => array(
                        'next' => 'Locked'
                )
        ),
        'Unlocked' => array(
                // Transaction or event
                'coin' => array(
                        'next' => 'Unlocked'
                ),
                'push' => array(
                        'next' => 'Locked'
                )
        )
);