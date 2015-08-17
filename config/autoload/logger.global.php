<?php

return array(
    'log' => array(
        'Log\App' => array(
            'writers' => array(
                array(
                    'syslog' => [
                        'name' => 'Zend\Log\Writer\Syslog',
                        'options' => [
                            'priority' => \Zend\Log\Logger::WARN,
                            'writer' => [
                                'name' => 'stream',
                                'options' => [
                                    'facility' => LOG_LOCAL4,
                                ],
                            ],
                        ],
                    ],
                ),
            ),
        ),
    ),
);