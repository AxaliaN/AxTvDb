<?php

namespace AxTvDbTest\ServiceFactory;

use AxTvDb\Client\Client;
use AxTvDb\ServiceFactory\ClientServiceFactory;
use PHPUnit_Framework_TestCase;

/**
 * Test case for class AxTvDb\ServiceFactory\ClientServiceFactory
 *
 * @category AxTvDbTest
 * @package  AxTvDbTest\ClientFactory
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class ClientServiceFactoryTest extends PHPUnit_Framework_TestCase
{
    public function testIfFactoryCanBeCreated()
    {
        $config = array(
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

        $slMock = \Mockery::mock('Zend\ServiceManager\ServiceLocatorInterface')
            ->shouldReceive('get')
            ->with('Config')
            ->andReturn($config)
            ->getMock();

        $clientServiceFactory = new ClientServiceFactory();

        $clientServiceFactory->createService($slMock);
    }
}
