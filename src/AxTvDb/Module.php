<?php

namespace AxTvDb;

use Zend\ModuleManager\Feature\ConfigProviderInterface;

/**
 * Service factory to instantiate the AxTvDb Client
 *
 * @category AxTvDb
 * @package  AxTvDb\Module
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://www.gnu.org/licenses/gpl.txt GNU GPLv3
 * @link     https://github.com/AxaliaN/TvDb
 */
class Module implements ConfigProviderInterface
{

    /**
     * Gets the module's config
     *
     * @return array|mixed|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../config/module.config.php';
    }
}