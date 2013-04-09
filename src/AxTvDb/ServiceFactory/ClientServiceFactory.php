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
 * @license  http://www.gnu.org/licenses/gpl.txt GNU GPLv3
 * @link     https://github.com/AxaliaN/TvDb
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