<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michel
 * Date: 9-4-13
 * Time: 19:29
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDb\Utility;

use AxTvDb\Exception\XmlException;

class XmlParser {
    /**
     * Convert xml string to SimpleXMLElement
     *
     * @param string $data String of retrieved data
     *
     * @return \SimpleXMLElement
     * @throws XmlException
     */
    public function getXml($data)
    {
        if (extension_loaded('libxml')) {
            libxml_use_internal_errors(true);
        }

        $simpleXml = simplexml_load_string($data);

        if (!$simpleXml) {
            if (extension_loaded('libxml')) {
                $xmlErrors = libxml_get_errors();
                $errors = array();
                foreach ($xmlErrors as $error) {
                    $errors[] = sprintf('Error in file %s on line %d with message : %s', $error->file, $error->line, $error->message);
                }
                if (count($errors) > 0) {

                    throw new XmlException(implode("\n", $errors));
                }
            }
            throw new XmlException('Xml file cound not be loaded');
        }

        return $simpleXml;
    }
}