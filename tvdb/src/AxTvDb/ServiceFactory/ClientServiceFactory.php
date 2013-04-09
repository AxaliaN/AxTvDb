<?php

namespace AxTvDb\ServiceFactory;

use AxTvDb\Client\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class ClientServiceFactory implements FactoryInterface {

    public function createService(ServiceLocatorInterface $serviceLocator) {
        $config = $serviceLocator->get('Config');

        return new Client($config['axtvdb']);
    }

}