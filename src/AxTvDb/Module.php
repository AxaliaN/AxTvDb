<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michel
 * Date: 5-4-13
 * Time: 20:46
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDb;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

class Module implements ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}