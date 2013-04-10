<?php

namespace AxTvDb\Banner;

use SimpleXMLElement;

/**
 * Simple banner object
 *
 * @category AxTvDb
 * @package  AxTvDb\Banner
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class Banner
{

    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $path = '';

    /**
     * @var string
     */
    protected $type = '';

    /**
     * @var string
     */
    protected $type2 = '';

    /**
     * @var array
     */
    protected $colors = array();

    /**
     * @var string
     */
    protected $language = '';

    /**
     * @var string
     */
    protected $rating = '';

    /**
     * @var int
     */
    protected $ratingCount = 0;

    /**
     * @var string
     */
    protected $seriesName = '';

    /**
     * @var string
     */
    protected $thumbnailPath = '';

    /**
     * @var string
     */
    protected $vignettePath = '';

    /**
     * Constructor
     *
     * @access public
     * @param SimpleXMLElement $data A simplexmlobject created from thetvdb.com's xml data for the tv serie banner
     * 
     * @return Banner
     */
    public function __construct(SimpleXMLElement $data)
    {
        $this->id = (int)$data->id;
        $this->path = (string)$data->BannerPath;
        $this->type = (string)$data->BannerType;
        $this->type2 = (string)$data->BannerType2;
        $this->colors = (array)$data->Colors;
        $this->language = (string)$data->Language;
        $this->rating = (string)$data->Rating;
        $this->ratingCount = (int)$data->RatingCount;
        $this->seriesName = (string)$data->SeriesName;
        $this->thumbnailPath = (string)$data->ThumbnailPath;
        $this->vignettePath = (string)$data->VignettePath;
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
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return string
     */
    public function getType2()
    {
        return $this->type2;
    }

    /**
     * @param string $type2
     */
    public function setType2($type2)
    {
        $this->type2 = $type2;
    }

    /**
     * @return array
     */
    public function getColors()
    {
        return $this->colors;
    }

    /**
     * @param array $colors
     */
    public function setColors($colors)
    {
        $this->colors = $colors;
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
     * @return string
     */
    public function getSeriesName()
    {
        return $this->seriesName;
    }

    /**
     * @param string $seriesName
     */
    public function setSeriesName($seriesName)
    {
        $this->seriesName = $seriesName;
    }

    /**
     * @return string
     */
    public function getThumbnailPath()
    {
        return $this->thumbnailPath;
    }

    /**
     * @param string $thumbnailPath
     */
    public function setThumbnailPath($thumbnailPath)
    {
        $this->thumbnailPath = $thumbnailPath;
    }

    /**
     * @return string
     */
    public function getVignettePath()
    {
        return $this->vignettePath;
    }

    /**
     * @param string $vignettePath
     */
    public function setVignettePath($vignettePath)
    {
        $this->vignettePath = $vignettePath;
    }
}