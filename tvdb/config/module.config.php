<?php

return array(
    'axalian' => array(
        'tvdb' => array(
            'client' => array(
                'class' => 'AxTvDb\Client\Client',
            ),
        ),
    ),
    'service_manager' => array(
        'factories' => array(
            'AxTvDb\Client\Client' => 'AxTvDb\ServiceFactory\ClientServiceFactory',
        )
    ),
);