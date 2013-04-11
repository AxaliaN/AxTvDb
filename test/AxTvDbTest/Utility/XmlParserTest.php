<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 11-4-13
 * Time: 8:42
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Utility\XmlParser;

use AxTvDb\Utility\XmlParser;
use PHPUnit_Framework_TestCase;


class XmlParserTest extends PHPUnit_Framework_TestCase {

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
        if (extension_loaded('libxml')) {
            $this->markTestSkipped(
                'libxml loaded, test will not return required exception.'
            );
        }

        $xmlData = 'test';

        XmlParser::getXml($xmlData);
    }
}