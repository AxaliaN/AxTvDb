<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michel
 * Date: 9-4-13
 * Time: 19:57
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDb\Utility;


use AxTvDb\Exception\CurlException;

class CurlDownloader
{
    const POST = 'post';
    const GET = 'get';

    /**
     * Fetch data using curl
     *
     * @param string $url    URL to use while fetching
     * @param array  $params Array of params to send along the request
     * @param string $method Method to use
     *
     * @return bool|string
     *
     * @throws \AxTvDb\Exception\CurlException
     */
    public static function fetch($url, array $params = array(), $method = self::GET)
    {
        $ch = curl_init($url);

        curl_setopt($ch, CURLOPT_HEADER, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

        if ($method == self::POST) {
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
        }

        $response = curl_exec($ch);

        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $headerSize = curl_getinfo($ch, CURLINFO_HEADER_SIZE);
        $data = substr($response, $headerSize);

        curl_close($ch);

        if ($httpCode != 200) {
            throw new CurlException(sprintf('Cannot fetch %s', $url), $httpCode);
        }

        return $data;
    }
}