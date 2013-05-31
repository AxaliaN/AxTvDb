<?php

namespace AxTvDb\Client;

use AxTvDb\Banner\Banner;
use AxTvDb\Episode\Episode;
use AxTvDb\Serie\Serie;
use AxTvDb\Utility\BannerDownloader;
use AxTvDb\Utility\CurlDownloader;
use AxTvDb\Utility\XmlParser;

/**
 * Base TVDB library class, provides universal functions and variables
 *
 * @category AxTvDb
 * @package  AxTvDb\Client
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class Client
{
    const MIRROR_TYPE_XML = 1;
    const MIRROR_TYPE_BANNER = 2;
    const MIRROR_TYPE_ZIP = 4;

    const DEFAULT_LANGUAGE = 'en';

    const FORMAT_XML = 'xml';
    const FORMAT_ZIP = 'zip';

    /**
     * Base url for TheTVDB
     *
     * @var string
     */
    protected $baseUrl = '';

    /**
     * API key for thetvdb.com
     *
     * @var string
     */
    protected $apiKey = '';

    /**
     * Array of available mirrors
     *
     * @var array
     */
    protected $mirrors = array();

    /**
     * Array of available languages
     *
     * @var array
     */
    protected $languages = array();

    /**
     * Contains module config
     *
     * @var array
     */
    protected $config = array();

    /**
     * Instatiates the client
     *
     * @param array $config Configuration to use
     *
     * @internal param string $baseUrl Domain name of the api without trailing slash
     * @internal param string $apiKey Api key provided by http://thetvdb.com
     */
    public function __construct($config)
    {
        $this->setConfig($config);
        $this->setBaseUrl($config['client']['baseUrl']);
        $this->setApiKey($config['client']['apiKey']);
    }

    /**
     * Get a language information
     *
     * @param string $abbreviation Shorthand name of the language
     *
     * @return array
     * @throws \Exception
     */
    public function getLanguage($abbreviation)
    {
        if (empty($this->languages)) {
            $this->getLanguages();
        }

        if (!isset($this->languages[$abbreviation])) {
            throw new \Exception('This language is not available');
        }

        return $this->languages[$abbreviation];
    }

    /**
     * Get the server time for further updates
     *
     * @return string
     */
    public function getServerTime()
    {
        return (string)$this->fetchXml('Updates.php?type=none')->Time;
    }

    /**
     * Searches for tv serie based on series name
     *
     * @param string $seriesName Name of the series to search for
     * @param string $language   Language to fetch the results for
     *
     * @return array
     */
    public function getSeriesByName($seriesName, $language = self::DEFAULT_LANGUAGE)
    {
        /** @var $data \SimpleXmlElement */
        $data = $this->fetchXml('GetSeries.php?seriesname=' . urlencode($seriesName) . '&language=' . $language);

        $series = array();

        foreach ($data->Series as $serie) {
            $series[] = new Serie($serie);
        }

        return $series;
    }

    /**
     * Find a tv serie by the id from thetvdb.com
     *
     * @param int    $serieId  ID of the serie
     * @param string $language Language to fetch the results for
     *
     * @return Serie|bool A serie object or false if not found
     */
    public function getSerieById($serieId, $language = self::DEFAULT_LANGUAGE)
    {
        $data = $this->fetchXml('series/' . $serieId . '/' . $language . '.xml');

        return new Serie($data->Series);
    }

    /**
     * Find all banners related to a serie
     *
     * @param int $serieId
     * @return string
     */

    /**
     * Fetches banners for a given series
     *
     * @param int $serieId ID of the serie
     *
     * @return array
     */
    public function getBannersBySeriesId($serieId)
    {
        $data = $this->fetchXml('series/' . $serieId . '/banners.xml');
        $banners = array();
        foreach ($data->Banner as $banner) {
            $banners[] = new Banner($banner);
        }

        return $banners;
    }

    /**
     * Fetches all episodes for a serie
     *
     * @param int    $serieId  ID of the serie
     * @param string $language Language to get the episodes in
     * @param string $format   Format to retrieve the episodes in
     *
     * @return array Array containing Episode objects
     * @throws \ErrorException
     */
    public function getEpisodesBySerieId($serieId, $language = self::DEFAULT_LANGUAGE, $format = self::FORMAT_XML)
    {
        switch ($format) {
            case self::FORMAT_XML:
                $data = $this->fetchXml('series/' . $serieId . '/all/' . $language . '.' . $format);
                break;
            case self::FORMAT_ZIP:
            default:
                throw new \ErrorException('Unsupported format');
                break;
        } // @codeCoverageIgnore

        $episodes = array();

        foreach ($data->Episode as $episode) {
            $episodes[(int)$episode->id] = new Episode($episode);
        }

        return array('episodes' => $episodes);
    }

    /**
     * Get a specific episode by season and episode number
     *
     * @param int    $serieId        ID of the series
     * @param int    $seasonNumber   Number of the season
     * @param int    $episodeNumber  Number of the episode
     * @param string $language       Language to get the episodes in
     *
     * @return Episode
     */
    public function getEpisode($serieId, $seasonNumber, $episodeNumber, $language = self::DEFAULT_LANGUAGE)
    {
        $data = $this->fetchXml('series/' . $serieId . '/default/' . $seasonNumber . '/' . $episodeNumber . '/' . $language . '.xml');

        return new Episode($data->Episode);
    }

    /**
     * Get a specific episode by his id
     *
     * @param int    $episodeId ID of the episode
     * @param string $language  Language to get the episodes in
     *
     * @return Episode
     */
    public function getEpisodeById($episodeId, $language = self::DEFAULT_LANGUAGE)
    {
        $data = $this->fetchXml('episodes/' . $episodeId . '/' . $language . '.xml');

        return new Episode($data->Episode);
    }

    /**
     * Get updates list based on previous time you got data
     *
     * @param int $previousTime Time of the previous update, in UNIX Timestamp format
     *
     * @return array
     */
    public function getUpdates($previousTime)
    {
        $data = $this->fetchXml('Updates.php?type=all&time=' . $previousTime);

        $series = array();

        foreach ($data->Series as $serieId) {
            $series[] = (int)$serieId;
        }

        $episodes = array();

        foreach ($data->Episode as $episodeId) {
            $episodes[] = (int)$episodeId;
        }

        return array('series' => $series, 'episodes' => $episodes);
    }

    /**
     * Download a file and save it
     *
     * @param string $url          URL to download
     * @param string $saveLocation Path to save to
     *
     * @return bool True on success
     */
    public function downloadImage($url, $path)
    {
        return BannerDownloader::downloadBanner($this->getMirror(self::MIRROR_TYPE_BANNER) . "/banners/" . $url, $path);
    }

    /**
     * Fetches XML data via curl and returns XML result
     *
     * @param string $function Name of the function to execute
     * @param array  $params   Array containing parameters
     * @param string $method   Method to use, can be GET or POST
     *
     * @return \SimpleXMLElement
     */
    protected function fetchXml($function, $params = array(), $method = CurlDownloader::GET)
    {
        if (strpos($function, '.php') > 0) { // no need of api key for php calls
            $url = $this->getMirror(self::MIRROR_TYPE_XML) . '/api/' . $function;
        } else {
            $url = $this->getMirror(self::MIRROR_TYPE_XML) . '/api/' . $this->apiKey . '/' . $function;
        }

        $data = CurlDownloader::fetch($url, $params, $method);

        $simpleXml = XmlParser::getXml($data);

        return $simpleXml;
    }


    /**
     * Get a list of mirrors available to fetch data from the api
     *
     * @return void
     */
    protected function getMirrors()
    {

        $data = CurlDownloader::fetch($this->baseUrl . '/api/' . $this->apiKey . '/mirrors.xml');

        $mirrorsXml = XmlParser::getXml($data);
        $mirrorsArray = array();

        foreach ($mirrorsXml->Mirror as $mirror) {
            $typeMask = (int)$mirror->typemask;
            $mirrorPath = (string)$mirror->mirrorpath;

            if ($typeMask & self::MIRROR_TYPE_XML) {
                $mirrorsArray[self::MIRROR_TYPE_XML][] = $mirrorPath;
            }

            if ($typeMask & self::MIRROR_TYPE_BANNER) {
                $mirrorsArray[self::MIRROR_TYPE_BANNER][] = $mirrorPath;
            }

            if ($typeMask & self::MIRROR_TYPE_ZIP) {
                $mirrorsArray[self::MIRROR_TYPE_ZIP][] = $mirrorPath;
            }
        }

        $this->setMirrors($mirrorsArray);
    }

    /**
     * Get a random mirror from the list of available mirrors
     *
     * @param int $type Type of mirror to return
     *
     * @return string
     * @access protected
     */
    protected function getMirror($type = self::MIRROR_TYPE_XML)
    {
        if (empty($this->mirrors)) {
            $this->getMirrors();
        }

        return $this->mirrors[$type][array_rand($this->mirrors[$type], 1)];
    }

    /**
     * Get a list of languages available for the content of the api
     *
     * @return void
     */
    protected function getLanguages()
    {
        if (empty($this->languages)) {
            $languageXml = $this->fetchXml('languages.xml');

            $languageArray = array();

            foreach ($languageXml->Language as $language) {
                $languageArray[(string)$language->abbreviation] = array(
                    'name' => (string)$language->name,
                    'abbreviation' => (string)$language->abbreviation,
                    'id' => (int)$language->id,
                );
            }

            $this->setLanguages($languageArray);
        }
    }

    /**
     * Sets the module config
     *
     * @param array $config Retrieved config
     *
     * @return void
     */
    public function setConfig($config)
    {
        $this->config = $config;
    }

    /**
     * @return string
     */
    public function getBaseUrl()
    {
        return $this->baseUrl;
    }

    /**
     * @param string $baseUrl
     */
    public function setBaseUrl($baseUrl)
    {
        $this->baseUrl = $baseUrl;
    }

    /**
     * @return string
     */
    public function getApiKey()
    {
        return $this->apiKey;
    }

    /**
     * @param string $apiKey
     */
    public function setApiKey($apiKey)
    {
        $this->apiKey = $apiKey;
    }

    /**
     * @param array $mirrors
     */
    public function setMirrors($mirrors)
    {
        $this->mirrors = $mirrors;
    }

    /**
     * @param array $languages
     */
    public function setLanguages($languages)
    {
        $this->languages = $languages;
    }
}
