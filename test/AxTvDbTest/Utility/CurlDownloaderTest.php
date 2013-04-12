<?php

namespace AxTvDbTest\Utility;

use AxTvDb\Exception\CurlException as CurlException;
use AxTvDb\Utility\CurlDownloader;
use PHPUnit_Framework_TestCase;

/**
 * Test case for class AxTvDb\Utility\CurlDownloader
 *
 * @category AxTvDbTest
 * @package  AxTvDbTest\Utility
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class CurlDownloaderTest extends PHPUnit_Framework_TestCase
{
    public function testIfCurlDownloadsCorrectly()
    {
        $data = '<?xml version="1.0" encoding="UTF-8" ?>
<Mirrors>
  <Mirror>
    <id>1</id>
    <mirrorpath>http://thetvdb.com</mirrorpath>
    <typemask>7</typemask>
  </Mirror>
</Mirrors>
';

        $downloadedData = CurlDownloader::fetch('http://thetvdb.com/api/' . APIKEY . '/mirrors.xml');

        $this->assertEquals($data, $downloadedData);
    }

    /**
     * @expectedException \AxTvDb\Exception\CurlException
     */
    public function testIfErrorReturnedOnInvalidUrl()
    {
        $downloadedData = CurlDownloader::fetch('http://thetvdb.com/api/' . APIKEY . '/test.xml');
    }

    /**
     * @expectedException \AxTvDb\Exception\CurlException
     */
    public function testIfPostCallGetsHandled()
    {
        $downloadedData = CurlDownloader::fetch(
            'http://thetvdb.com/api/' . APIKEY . '/mirrors.xml',
            array('test'=>'value'),
            CurlDownloader::POST
        );
    }
}
