<?php

namespace AxTvDb\Utility;

use AxTvDb\Exception\XmlException;

/**
 * XmlParser parses XML strings into SimpleXMLElements
 *
 * @category AxTvDb
 * @package  AxTvDb\Utility
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class XmlParser
{
    public static $libXmlLoaded = null;

    /**
     * Convert xml string to SimpleXMLElement
     *
     * @param string $data String of retrieved data
     *
     * @return \SimpleXMLElement
     * @throws XmlException
     */
    public static function getXml($data)
    {
        if (self::$libXmlLoaded === null) {
            self::$libXmlLoaded = extension_loaded('libxml');
        }

        if (self::$libXmlLoaded) {
            libxml_use_internal_errors(true);
        }

        $simpleXml = simplexml_load_string($data);

        if (!$simpleXml) {
            if (self::$libXmlLoaded) {
                $xmlErrors = libxml_get_errors();

                $errors = array();

                foreach ($xmlErrors as $error) {
                    $errors[] = sprintf('Error in file %s on line %d with message : %s', $error->file, $error->line, $error->message);
                }

                if (count($errors) > 0) {
                    throw new XmlException(implode("\n", $errors));
                }
            } // @codeCoverageIgnore

            throw new XmlException('Xml file cound not be loaded.');
        }

        return $simpleXml;
    }
}