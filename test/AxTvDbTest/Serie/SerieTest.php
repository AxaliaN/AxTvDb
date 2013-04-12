<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 11-4-13
 * Time: 8:37
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Serie;

use AxTvDb\Serie\Serie;
use AxTvDb\Utility\XmlParser;
use PHPUnit_Framework_TestCase;

class SerieTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Serie
     */
    protected $serie;

    public function testIfEpisodeSetupCorrectly()
    {
        $xmlData = '<?xml version="1.0" encoding="UTF-8" ?>
                    <Series>
                       <id>80348</id>
                       <Actors>|Zachary Levi|Adam Baldwin|Yvonne Strzechowski|</Actors>
                       <Airs_DayOfWeek>Monday</Airs_DayOfWeek>
                       <Airs_Time>8:00 PM</Airs_Time>
                       <FirstAired>2007-09-24</FirstAired>
                       <Genre>|Comedy|</Genre>
                       <IMDB_ID>tt0934814</IMDB_ID>
                       <Language>English</Language>
                       <Network>NBC</Network>
                       <Overview>Zachary Levi (Less Than Perfect) plays Chuck...</Overview>
                       <Rating>9.0</Rating>
                       <RatingCount>10</RatingCount>
                       <Runtime>30 mins</Runtime>
                       <SeriesID>68724</SeriesID>
                       <SeriesName>Chuck</SeriesName>
                       <Status>Continuing</Status>
                       <lastupdated>1200785226</lastupdated>
                     </Series>';

        $data = XmlParser::getXml($xmlData);

        $this->serie = new Serie($data);

        $this->assertEquals(80348, $this->serie->getId());
        $this->assertEquals('Monday', $this->serie->getAirsDayOfWeek());
        $this->assertEquals('8:00 PM', $this->serie->getAirsTime());
        $this->assertEquals('tt0934814', $this->serie->getImdbId());
        $this->assertEquals('English', $this->serie->getLanguage());
        $this->assertEquals('NBC', $this->serie->getNetwork());
        $this->assertEquals('9.0', $this->serie->getRating());
        $this->assertEquals('10', $this->serie->getRatingCount());
        $this->assertEquals('30', $this->serie->getRuntime());
        $this->assertEquals('Chuck', $this->serie->getName());
        $this->assertEquals('Continuing', $this->serie->getStatus());
        $this->assertEquals('Zachary Levi (Less Than Perfect) plays Chuck...', $this->serie->getOverview());
        $this->assertEquals('', $this->serie->getBanner());
        $this->assertEquals('', $this->serie->getFanart());
        $this->assertEquals('', $this->serie->getPoster());
        $this->assertEquals(new \DateTime(''), $this->serie->getAdded());
        $this->assertEquals(0, $this->serie->getAddedBy());
        $this->assertEquals(array('Comedy'), $this->serie->getGenres());
        $this->assertEquals('', $this->serie->getZap2ItId());
        $this->assertEquals('', $this->serie->getContentRating());
        $this->assertEquals(new \DateTime('2007-09-24'), $this->serie->getFirstAired());
        $this->assertEquals(\DateTime::createFromFormat('U', 1200785226), $this->serie->getLastUpdated());
        $this->assertEquals(array('Adam Baldwin','Yvonne Strzechowski','Zachary Levi'), $this->serie->getActors());
    }
}