<?php

namespace AxTvDb\Episode;

use AxTvDb\Client\Client;
use AxTvDb\Utility\ArrayUtils;
use SimpleXMLElement;

/**
 * Episode class. Class for single tv episode for a TV serie.
 *
 * @category AxTvDb
 * @package  AxTvDb\Episode
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class Episode
{

    /**
     * @var int
     */
    protected $id = 0;

    /**
     * @var int
     */
    protected $number = 0;

    /**
     * @var int
     */
    protected $season = 0;

    /**
     * @var array
     */
    protected $directors = array();

    /**
     * @var array
     */
    protected $guestStars = array();

    /**
     * @var array
     */
    protected $writers = array();

    /**
     * @var string
     */
    protected $name = '';

    /**
     * @var \DateTime
     */
    protected $firstAired;

    /**
     * @var string
     */
    protected $imdbId = '';

    /**
     * @var string
     */
    protected $language = Client::DEFAULT_LANGUAGE;

    /**
     * @var string
     */
    protected $overview = '';

    /**
     * @var string
     */
    protected $rating = '';

    /**
     * @var int
     */
    protected $ratingCount = 0;

    /**
     * @var \DateTime
     */
    protected $lastUpdated;

    /**
     * @var int
     */
    protected $seasonId = 0;

    /**
     * @var int
     */
    protected $serieId = 0;

    /**
     * @var string
     */
    protected $thumbnail = '';

    /**
     * Constructor
     *
     * @param SimpleXMLElement $data Retrieved SimpleXMLElement
     *
     * @return Episode
     */
    public function __construct(SimpleXMLElement $data)
    {
        $this->id = (int)$data->id;

        if (isset($data->Combined_episodenumber)) {
            $this->number = (int)$data->Combined_episodenumber;
        } else {
            $this->number = (int)$data->EpisodeNumber;
        }

        if (isset($data->Comined_season)) {
            $this->season = (int)$data->Combined_season;
        } else {
            $this->season = (int)$data->SeasonNumber;
        }

        $this->directors = (array)ArrayUtils::removeEmptyIndexes(explode('|', (string)$data->Director));
        $this->name = (string)$data->EpisodeName;
        $this->firstAired = (string)$data->FirstAired !== '' ? new \DateTime((string)$data->FirstAired) : null;
        $this->guestStars = ArrayUtils::removeEmptyIndexes(explode('|', (string)$data->GuestStars));
        $this->imdbId = (string)$data->IMDB_ID;
        $this->language = (string)$data->Language;
        $this->overview = (string)$data->Overview;
        $this->rating = (string)$data->Rating;
        $this->ratingCount = (int)$data->RatingCount;
        $this->lastUpdated = \DateTime::createFromFormat('U', (int)$data->lastupdated);
        $this->writers = (array)ArrayUtility::removeEmptyIndexes(explode('|', (string)$data->Writer));
        $this->thumbnail = (string)$data->filename;
        $this->seasonId = (int)$data->seasonid;
        $this->serieId = (int)$data->seriesid;
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
     * @return int
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * @param int $number
     */
    public function setNumber($number)
    {
        $this->number = $number;
    }

    /**
     * @return int
     */
    public function getSeason()
    {
        return $this->season;
    }

    /**
     * @param int $season
     */
    public function setSeason($season)
    {
        $this->season = $season;
    }

    /**
     * @return array
     */
    public function getDirectors()
    {
        return $this->directors;
    }

    /**
     * @param array $directors
     */
    public function setDirectors($directors)
    {
        $this->directors = $directors;
    }

    /**
     * @return array
     */
    public function getGuestStars()
    {
        return $this->guestStars;
    }

    /**
     * @param array $guestStars
     */
    public function setGuestStars($guestStars)
    {
        $this->guestStars = $guestStars;
    }

    /**
     * @return array
     */
    public function getWriters()
    {
        return $this->writers;
    }

    /**
     * @param array $writers
     */
    public function setWriters($writers)
    {
        $this->writers = $writers;
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
     * @return int
     */
    public function getSerieId()
    {
        return $this->serieId;
    }

    /**
     * @param int $serieId
     */
    public function setSerieId($serieId)
    {
        $this->serieId = $serieId;
    }

    /**
     * @return string
     */
    public function getThumbnail()
    {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     */
    public function setThumbnail($thumbnail)
    {
        $this->thumbnail = $thumbnail;
    }
}