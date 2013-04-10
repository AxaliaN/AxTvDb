<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michel
 * Date: 9-4-13
 * Time: 20:01
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Client;

use AxTvDb\Client\Client as TvDbClient;
use PHPUnit_Framework_TestCase;

class ClientTest extends PHPUnit_Framework_TestCase
{
    protected $client;

    public function setUp()
    {
        $config = array(
            'client' => array(
                'baseUrl' => 'http://thetvdb.com',
                'apiKey' => '1'
            )
        );

        $this->client = new TvDbClient($config);
    }

    public function testIfClientCanBeConstructed()
    {

        $this->assertEquals('http://thetvdb.com',$this->client->getBaseUrl());
        $this->assertEquals('1',$this->client->getApiKey());
    }

}