<?php

return array(
    'axalian' => array(
        'tvdb' => array(
            'client' => array(
                'baseUrl' => 'http://thetvdb.com',
                'apiKey' => '490450651F3A7C38'
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AxTvDb\Client\Client' => 'AxTvDb\ServiceFactory\ClientServiceFactory',
        )
    ),
);