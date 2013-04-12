<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 12-4-13
 * Time: 8:12
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Utility;

use AxTvDb\Exception\CurlException as CurlException;
use AxTvDb\Utility\CurlDownloader;

class CurlDownloaderTest extends \PHPUnit_Framework_TestCase
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
