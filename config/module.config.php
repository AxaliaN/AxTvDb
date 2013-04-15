<?php

return array(
    'service_manager' => array(
        'factories' => array(
            'AxTvDb\Client\Client' => 'AxTvDb\ServiceFactory\ClientServiceFactory',
        )
    ),
);