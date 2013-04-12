<?php

return array(
    'axalian' => array(
        'tvdb' => array(
            'client' => array(
                'baseUrl' => 'http://thetvdb.com',
                'apiKey' => ''
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AxTvDb\Client\Client' => 'AxTvDb\ServiceFactory\ClientServiceFactory',
        )
    ),
);