<?php

namespace AxTvDbTest;

use AxTvDb\Module;
use PHPUnit_Framework_TestCase;

/**
 * Test case for class AxTvDb\Module
 *
 * @category AxTvDbTest
 * @package  AxTvDbTest
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class ModuleTest extends PHPUnit_Framework_TestCase
{

    public function testIfConfigCanBeGet()
    {
        $defaultConfig = array(
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
