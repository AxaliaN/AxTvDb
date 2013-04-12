<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 12-4-13
 * Time: 8:58
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest;


use AxTvDb\Module;

class ModuleTest extends \PHPUnit_Framework_TestCase {

    public function testIfConfigCanBeGet()
    {
        $defaultConfig = array(
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

        $module = new Module();

        $config = $module->getConfig();

        $this->assertEquals($config, $defaultConfig);
    }
}
