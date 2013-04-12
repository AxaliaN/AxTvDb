<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 12-4-13
 * Time: 16:29
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\ServiceFactory;


use AxTvDb\Client\Client;
use AxTvDb\ServiceFactory\ClientServiceFactory;

class ClientServiceFactoryTest extends \PHPUnit_Framework_TestCase {
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
