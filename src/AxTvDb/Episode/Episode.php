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
     * @var int
     */
    protected $dvdChapter;

    /**
     * @var int
     */
    protected $dvdDiscId;

    /**
     * @var int
     */
    protected $dvdEpisodeNumber;

    /**
     * @var int
     */
    protected $dvdSeason;

    /**
     * @var string
     */
    protected $productionCode;

    /**
     * @var int
     */
    protected $absoluteNumber;

    /**
     * @var int
     */
    protected $airsAfterSeason = '';

    /**
     * @var int
     */
    protected $airsBeforeEpisode = '';

    /**
     * @var int
     */
    protected $airsBeforeSeason = '';

    /**
     * Constructor
     *
     * @param SimpleXMLElement $data Retrieved SimpleXMLElement
     *
     * @return Episode
     */
    public function __construct(SimpleXMLElement $data)
    {
        $this->setId((int)$data->id);

        if (isset($data->Combined_episodenumber)) {
            $this->setNumber((int)$data->Combined_episodenumber);
        } else {
            $this->setNumber((int)$data->EpisodeNumber);
        }

        if (isset($data->Combined_season)) {
            $this->setSeason((int)$data->Combined_season);
        } else {
            $this->setSeason((int)$data->SeasonNumber);
        }

        $this->setDirectors((array)ArrayUtils::removeEmptyIndexes(explode('|', (string)$data->Director)));
        $this->setName((string)$data->EpisodeName);
        $this->setFirstAired((string)$data->FirstAired !== '' ? new \DateTime((string)$data->FirstAired) : null);
        $this->setGuestStars((array)ArrayUtils::removeEmptyIndexes(explode('|', (string)$data->GuestStars)));
        $this->setImdbId((string)$data->IMDB_ID);
        $this->setLanguage((string)$data->Language);
        $this->setOverview((string)$data->Overview);
        $this->setRating((string)$data->Rating);
        $this->setRatingCount((int)$data->RatingCount);
        $this->setLastUpdated(\DateTime::createFromFormat('U', (int)$data->lastupdated));
        $this->setWriters((array)ArrayUtils::removeEmptyIndexes(explode('|', (string)$data->Writer)));
        $this->setThumbnail((string)$data->filename);
        $this->setSeasonId((int)$data->seasonid);
        $this->setSerieId((int)$data->seriesid);
        $this->setDvdChapter((int)$data->DVD_chapter);
        $this->setDvdDiscId((int)$data->DVD_discid);
        $this->setDvdEpisodeNumber((int)$data->DVD_episodenumber);
        $this->setDvdSeason((int)$data->DVD_season);
        $this->setProductionCode((int)$data->ProductionCode);
        $this->setAbsoluteNumber((int)$data->absolute_number);
        $this->setAirsAfterSeason((int)$data->airsafter_season);
        $this->setAirsBeforeEpisode((int)$data->airsbefore_episode);
        $this->setAirsBeforeSeason((int)$data->airsbefore_season);
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

    /**
     * @return int
     */
    public function getDvdChapter()
    {
        return $this->dvdChapter;
    }

    /**
     * @param int $dvdChapter
     */
    public function setDvdChapter($dvdChapter)
    {
        $this->dvdChapter = $dvdChapter;
    }

    /**
     * @return int
     */
    public function getDvdDiscId()
    {
        return $this->dvdDiscId;
    }

    /**
     * @param int $dvdDiscId
     */
    public function setDvdDiscId($dvdDiscId)
    {
        $this->dvdDiscId = $dvdDiscId;
    }

    /**
     * @return int
     */
    public function getDvdEpisodeNumber()
    {
        return $this->dvdEpisodeNumber;
    }

    /**
     * @param int $dvdEpisodeNumber
     */
    public function setDvdEpisodeNumber($dvdEpisodeNumber)
    {
        $this->dvdEpisodeNumber = $dvdEpisodeNumber;
    }

    /**
     * @return int
     */
    public function getDvdSeason()
    {
        return $this->dvdSeason;
    }

    /**
     * @param int $dvdSeason
     */
    public function setDvdSeason($dvdSeason)
    {
        $this->dvdSeason = $dvdSeason;
    }

    /**
     * @return string
     */
    public function getProductionCode()
    {
        return $this->productionCode;
    }

    /**
     * @param string $productionCode
     */
    public function setProductionCode($productionCode)
    {
        $this->productionCode = $productionCode;
    }

    /**
     * @return int
     */
    public function getAbsoluteNumber()
    {
        return $this->absoluteNumber;
    }

    /**
     * @param int $absoluteNumber
     */
    public function setAbsoluteNumber($absoluteNumber)
    {
        $this->absoluteNumber = $absoluteNumber;
    }

    /**
     * @return int
     */
    public function getAirsAfterSeason()
    {
        return $this->airsAfterSeason;
    }

    /**
     * @param int $airsAfterSeason
     */
    public function setAirsAfterSeason($airsAfterSeason)
    {
        $this->airsAfterSeason = $airsAfterSeason;
    }

    /**
     * @return int
     */
    public function getAirsBeforeEpisode()
    {
        return $this->airsBeforeEpisode;
    }

    /**
     * @param int $airsBeforeEpisode
     */
    public function setAirsBeforeEpisode($airsBeforeEpisode)
    {
        $this->airsBeforeEpisode = $airsBeforeEpisode;
    }

    /**
     * @return int
     */
    public function getAirsBeforeSeason()
    {
        return $this->airsBeforeSeason;
    }

    /**
     * @param int $airsBeforeSeason
     */
    public function setAirsBeforeSeason($airsBeforeSeason)
    {
        $this->airsBeforeSeason = $airsBeforeSeason;
    }

    /**
     * @return int
     */
    public function getSeasonId()
    {
        return $this->seasonId;
    }

    /**
     * @param int $seasonId
     */
    public function setSeasonId($seasonId)
    {
        $this->seasonId = $seasonId;
    }
}