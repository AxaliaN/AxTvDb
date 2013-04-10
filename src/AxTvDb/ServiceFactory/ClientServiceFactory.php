<?php

namespace AxTvDb\ServiceFactory;

use AxTvDb\Client\Client;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Service factory to instantiate the AxTvDb Client
 *
 * @category AxTvDb
 * @package  AxTvDb\ServiceFactory
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class ClientServiceFactory implements FactoryInterface
{

    /**
     * Creates the service using a service locator
     *
     * @param ServiceLocatorInterface $serviceLocator Service locator interface
     *
     * @return Client
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        return new Client($config['axalian']['tvdb']);
    }

}