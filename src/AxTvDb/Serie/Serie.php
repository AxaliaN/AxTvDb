<?php

namespace AxTvDb\Serie;

use AxTvDb\Client\Client;

/**
 * Serie object
 *
 * @category AxTvDb
 * @package  AxTvDb\Serie
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://www.gnu.org/licenses/gpl.txt GNU GPLv3
 * @link     https://github.com/AxaliaN/TvDb
 */
class Serie
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $language;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $banner;

    /**
     * @var string
     */
    protected $overview;

    /**
     * @var \DateTime
     */
    protected $firstAired;

    /**
     * @var string
     */
    protected $imdbId;

    /**
     * @var array
     */
    protected $actors = array();

    /**
     * @var string
     */
    protected $airsDayOfWeek = '';

    /**
     * @var string
     */
    protected $airsTime = '';

    /**
     * @var string
     */
    protected $contentRating = '';

    /**
     * @var array
     */
    protected $genres = array();

    /**
     * @var string
     */
    protected $network = '';

    /**
     * @var string
     */
    protected $rating = '';

    /**
     * @var int
     */
    protected $ratingCount = 0;

    /**
     * @var int
     */
    protected $runtime = 0;

    /**
     * @var string
     */
    protected $status = '';

    /**
     * @var \DateTime
     */
    protected $added;

    /**
     * @var int
     */
    protected $addedBy;

    /**
     * @var string
     */
    protected $fanArt = '';

    /**
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * @var string
     */
    protected $poster = '';

    /**
     * @var string
     */
    protected $zap2ItId = '';

    /**
     * Constructor
     *
     * @param $data \SimpleXMLElement $data A simplexmlobject created from thetvdb.com's xml data for the tv show
     *
     * @return Serie
     */
    public function __construct(\SimpleXMLElement $data)
    {
        $this->id = (int)$data->id;
        $this->language = (string)$data->Language;
        $this->name = (string)$data->SeriesName;
        $this->banner = (string)$data->banner;
        $this->overview = (string)$data->Overview;
        $this->firstAired = new \DateTime((string)$data->FirstAired);
        $this->imdbId = (string)$data->IMDB_ID;
        $this->actors = (array)ArrayUtility::removeEmptyIndexes(explode('|', (string)$data->Actors));
        $this->airsDayOfWeek = (string)$data->Airs_DayOfWeek;
        $this->airsTime = (string)$data->Airs_Time;
        $this->contentRating = (string)$data->ContentRating;
        $this->genres = (array)ArrayUtility::removeEmptyIndexes(explode('|', (string)$data->Genre));
        $this->network = (string)$data->Network;
        $this->rating = (string)$data->Rating;
        $this->runtime = (int)$data->Runtime;
        $this->status = (string)$data->Status;
        $this->added = new \DateTime((string)$data->added);
        $this->addedBy = (int)$data->addedBy;
        $this->fanArt = (string)$data->fanart;
        $this->lastUpdated = \DateTime::createFromFormat('U', (int)$data->lastupdated);
        $this->poster = (string)$data->poster;
        $this->zap2ItId = (string)$data->zap2it_id;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getLanguage()
    {
        return $this->language;
    }

    /**
     * @param string $language
     */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getBanner()
    {
        return $this->banner;
    }

    /**
     * @param string $banner
     */
    public function setBanner($banner)
    {
        $this->banner = $banner;
    }

    /**
     * @return string
     */
    public function getOverview()
    {
        return $this->overview;
    }

    /**
     * @param string $overview
     */
    public function setOverview($overview)
    {
        $this->overview = $overview;
    }

    /**
     * @return \DateTime
     */
    public function getFirstAired()
    {
        return $this->firstAired;
    }

    /**
     * @param \DateTime $firstAired
     */
    public function setFirstAired($firstAired)
    {
        $this->firstAired = $firstAired;
    }

    /**
     * @return string
     */
    public function getImdbId()
    {
        return $this->imdbId;
    }

    /**
     * @param string $imdbId
     */
    public function setImdbId($imdbId)
    {
        $this->imdbId = $imdbId;
    }

    /**
     * @return array
     */
    public function getActors()
    {
        return $this->actors;
    }

    /**
     * @param array $actors
     */
    public function setActors($actors)
    {
        $this->actors = $actors;
    }

    /**
     * @return string
     */
    public function getAirsDayOfWeek()
    {
        return $this->airsDayOfWeek;
    }

    /**
     * @param string $airsDayOfWeek
     */
    public function setAirsDayOfWeek($airsDayOfWeek)
    {
        $this->airsDayOfWeek = $airsDayOfWeek;
    }

    /**
     * @return string
     */
    public function getAirsTime()
    {
        return $this->airsTime;
    }

    /**
     * @param string $airsTime
     */
    public function setAirsTime($airsTime)
    {
        $this->airsTime = $airsTime;
    }

    /**
     * @return string
     */
    public function getContentRating()
    {
        return $this->contentRating;
    }

    /**
     * @param string $contentRating
     */
    public function setContentRating($contentRating)
    {
        $this->contentRating = $contentRating;
    }

    /**
     * @return array
     */
    public function getGenres()
    {
        return $this->genres;
    }

    /**
     * @param array $genres
     */
    public function setGenres($genres)
    {
        $this->genres = $genres;
    }

    /**
     * @return string
     */
    public function getNetwork()
    {
        return $this->network;
    }

    /**
     * @param string $network
     */
    public function setNetwork($network)
    {
        $this->network = $network;
    }

    /**
     * @return string
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param string $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return int
     */
    public function getRatingCount()
    {
        return $this->ratingCount;
    }

    /**
     * @param int $ratingCount
     */
    public function setRatingCount($ratingCount)
    {
        $this->ratingCount = $ratingCount;
    }

    /**
     * @return int
     */
    public function getRuntime()
    {
        return $this->runtime;
    }

    /**
     * @param int $runtime
     */
    public function setRuntime($runtime)
    {
        $this->runtime = $runtime;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return \DateTime
     */
    public function getAdded()
    {
        return $this->added;
    }

    /**
     * @param \DateTime $added
     */
    public function setAdded($added)
    {
        $this->added = $added;
    }

    /**
     * @return int
     */
    public function getAddedBy()
    {
        return $this->addedBy;
    }

    /**
     * @param int $addedBy
     */
    public function setAddedBy($addedBy)
    {
        $this->addedBy = $addedBy;
    }

    /**
     * @return string
     */
    public function getFanArt()
    {
        return $this->fanArt;
    }

    /**
     * @param string $fanArt
     */
    public function setFanArt($fanArt)
    {
        $this->fanArt = $fanArt;
    }

    /**
     * @return \DateTime
     */
    public function getLastUpdated()
    {
        return $this->lastUpdated;
    }

    /**
     * @param \DateTime $lastUpdated
     */
    public function setLastUpdated($lastUpdated)
    {
        $this->lastUpdated = $lastUpdated;
    }

    /**
     * @return string
     */
    public function getPoster()
    {
        return $this->poster;
    }

    /**
     * @param string $poster
     */
    public function setPoster($poster)
    {
        $this->poster = $poster;
    }

    /**
     * @return string
     */
    public function getZap2ItId()
    {
        return $this->zap2ItId;
    }

    /**
     * @param string $zap2ItId
     */
    public function setZap2ItId($zap2ItId)
    {
        $this->zap2ItId = $zap2ItId;
    }
}