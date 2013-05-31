<?php

namespace AxTvDb\Utility;

/**
 * Utility class for downloading banner images
 *
 * @category Mediacollie
 * @package  AxTvDb\Utility
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 * @date     30-4-13 15:52
 */
class BannerDownloader 
{
    /**
     * Download a file and save it
     *
     * @param string $url          URL to download
     * @param string $saveLocation Path to save to
     *
     * @return bool True on success
     */
    public static function downloadBanner($url, $saveLocation)
    {
        $data = CurlDownloader::fetch($url);

        if ($data) {
            try {
                file_put_contents($saveLocation, $data);

                return true;
            } catch(\Exception $e) {
                return false;
            }
        } else {
            return false;
        }
    }
}