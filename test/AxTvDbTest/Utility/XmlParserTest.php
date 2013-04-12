<?php

namespace AxTvDbTest\Utility;

use AxTvDb\Utility\XmlParser;
use Mockery\Mock;
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
class XmlParserTest extends PHPUnit_Framework_TestCase
{

    /**
     * Tests if the correct exception gets thrown when there's an error in the XML
     *
     * @expectedException \AxTvDb\Exception\XmlException
     */
    public function testIfExceptionThrownWhenXmlInvalid()
    {
        $xmlData = '<?xml version="1.0" encoding="UTF-8" ?>
                    <Series>
                       <id>80348</id>
                       <Actors>|Zachary Levi|Adam Baldwin|Yvonne Strzechowski|</errorClosingTag>
                     </Series>';

        XmlParser::getXml($xmlData);
    }

    /**
     * Tests if the correct exception gets thrown when there's an error in the XML
     *
     * @expectedException \AxTvDb\Exception\XmlException
     */
    public function testIfExceptionThrownWhenXmlEmpty()
    {
        XmlParser::$libXmlLoaded = false;

        $xmlData = 'test';

        XmlParser::getXml($xmlData, false);
    }
}