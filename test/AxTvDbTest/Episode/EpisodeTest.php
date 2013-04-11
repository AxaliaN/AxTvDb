<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 10-4-13
 * Time: 15:42
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Episode;

use AxTvDb\Episode\Episode;
use AxTvDb\Utility\XmlParser;
use DateTime;
use PHPUnit_Framework_TestCase;
use SimpleXMLElement;

/**
 * Test case for class AxTvDb\Episode\Episode
 *
 * @category AxTvDb
 * @package  AxTvDb\Episode
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class EpisodeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Episode
     */
    protected $episode;

    /**
     * Tests if an Episode gets instantiated correctly using XML data
     *
     * @return void
     */
    public function testIfEpisodeSetupCorrectly()
    {
        $xmlData =  '<?xml version="1.0" encoding="UTF-8" ?>
                     <Episode>
                        <id>332179</id>
                        <DVD_chapter>2</DVD_chapter>
                        <DVD_discid>1</DVD_discid>
                        <DVD_episodenumber>2</DVD_episodenumber>
                        <DVD_season>3</DVD_season>
                        <Director>|Joseph McGinty Nichol|</Director>
                        <EpisodeName>Chuck Versus the World</EpisodeName>
                        <EpisodeNumber>1</EpisodeNumber>
                        <FirstAired>2007-09-24</FirstAired>
                        <GuestStars>|Julia Ling|Vik Sahay|Mieko Hillman|</GuestStars>
                        <IMDB_ID>123</IMDB_ID>
                        <Language>English</Language>
                        <Overview>Chuck Bartowski is an average computer geek...</Overview>
                        <ProductionCode>12</ProductionCode>
                        <Rating>9.0</Rating>
                        <RatingCount>10</RatingCount>
                        <SeasonNumber>1</SeasonNumber>
                        <Writer>|Josh Schwartz|Chris Fedak|</Writer>
                        <absolute_number>1</absolute_number>
                        <airsafter_season>1</airsafter_season>
                        <airsbefore_episode>2</airsbefore_episode>
                        <airsbefore_season>3</airsbefore_season>
                        <filename>episodes/80348-332179.jpg</filename>
                        <lastupdated>1201292806</lastupdated>
                        <seasonid>27985</seasonid>
                        <seriesid>80348</seriesid>
                    </Episode>';

        $data = XmlParser::getXml($xmlData);

        $this->episode = new Episode($data);

        $this->assertEquals(332179, $this->episode->getId());
        $this->assertEquals(2, $this->episode->getDvdChapter());
        $this->assertEquals(2, $this->episode->getDvdEpisodeNumber());
        $this->assertEquals(3, $this->episode->getDvdSeason());
        $this->assertEquals(1, $this->episode->getDvdDiscId());
        $this->assertEquals(array('Joseph McGinty Nichol'), $this->episode->getDirectors());
        $this->assertEquals('Chuck Versus the World', $this->episode->getName());
        $this->assertEquals(1, $this->episode->getNumber());
        $this->assertEquals(new DateTime('2007-09-24'), $this->episode->getFirstAired());
        $this->assertEquals(array('Julia Ling','Mieko Hillman','Vik Sahay'), $this->episode->getGuestStars());
        $this->assertEquals(123, $this->episode->getImdbId());
        $this->assertEquals('English', $this->episode->getLanguage());
        $this->assertEquals('Chuck Bartowski is an average computer geek...', $this->episode->getOverview());
        $this->assertEquals(12, $this->episode->getProductionCode());
        $this->assertEquals('9.0', $this->episode->getRating());
        $this->assertEquals('10', $this->episode->getRatingCount());
        $this->assertEquals(1, $this->episode->getSeason());
        $this->assertEquals(array('Chris Fedak','Josh Schwartz'), $this->episode->getWriters());
        $this->assertEquals(1, $this->episode->getAbsoluteNumber());
        $this->assertEquals(1, $this->episode->getAirsAfterSeason());
        $this->assertEquals(2, $this->episode->getAirsBeforeEpisode());
        $this->assertEquals(3, $this->episode->getAirsBeforeSeason());
        $this->assertEquals('episodes/80348-332179.jpg', $this->episode->getThumbnail());
        $this->assertEquals(27985, $this->episode->getSeasonId());
        $this->assertEquals(80348, $this->episode->getSerieId());
        $this->assertEquals(\DateTime::createFromFormat('U',1201292806), $this->episode->getLastUpdated());
    }

    /**
     * Tests if the correct Number and Season get set
     *
     * @return void
     */
    public function testIfCombinedNumbersGetSet()
    {
        $xmlData =  '<?xml version="1.0" encoding="UTF-8" ?>
                     <Episode>
                        <id>332179</id>
                        <DVD_chapter>2</DVD_chapter>
                        <DVD_discid>1</DVD_discid>
                        <DVD_episodenumber>2</DVD_episodenumber>
                        <DVD_season>3</DVD_season>
                        <Director>|Joseph McGinty Nichol|</Director>
                        <EpisodeName>Chuck Versus the World</EpisodeName>
                        <EpisodeNumber>1</EpisodeNumber>
                        <FirstAired>2007-09-24</FirstAired>
                        <GuestStars>|Julia Ling|Vik Sahay|Mieko Hillman|</GuestStars>
                        <IMDB_ID>123</IMDB_ID>
                        <Language>English</Language>
                        <Overview>Chuck Bartowski is an average computer geek...</Overview>
                        <ProductionCode>12</ProductionCode>
                        <Rating>9.0</Rating>
                        <RatingCount>10</RatingCount>
                        <SeasonNumber>1</SeasonNumber>
                        <Writer>|Josh Schwartz|Chris Fedak|</Writer>
                        <absolute_number>1</absolute_number>
                        <airsafter_season>1</airsafter_season>
                        <airsbefore_episode>2</airsbefore_episode>
                        <airsbefore_season>3</airsbefore_season>
                        <filename>episodes/80348-332179.jpg</filename>
                        <lastupdated>1201292806</lastupdated>
                        <seasonid>27985</seasonid>
                        <seriesid>80348</seriesid>
                        <Combined_episodenumber>101</Combined_episodenumber>
                        <Combined_season>202</Combined_season>
                    </Episode>';

        $data = new SimpleXMLElement($xmlData);

        $this->episode = new Episode($data);

        $this->assertEquals(101, $this->episode->getNumber());
        $this->assertEquals(202, $this->episode->getSeason());
    }

    /**
     * Tests if an Episode gets set when tags are missing from the XML,
     * and if it uses default values
     *
     * @return void;
     */
    public function testIfEpisodeSetWhenMissingTags()
    {
        $xmlData =  '<?xml version="1.0" encoding="UTF-8" ?>
                     <Episode>
                        <id>332179</id>
                        <Director>|Joseph McGinty Nichol|</Director>
                        <EpisodeName>Chuck Versus the World</EpisodeName>
                        <EpisodeNumber>1</EpisodeNumber>
                    </Episode>';

        $data = new SimpleXMLElement($xmlData);

        $this->episode = new Episode($data);

        $this->assertEquals(332179, $this->episode->getId());
        $this->assertEquals(null, $this->episode->getDvdChapter());
        $this->assertEquals(null, $this->episode->getDvdEpisodeNumber());
        $this->assertEquals(null, $this->episode->getDvdSeason());
        $this->assertEquals(null, $this->episode->getDvdDiscId());
        $this->assertEquals(array('Joseph McGinty Nichol'), $this->episode->getDirectors());
        $this->assertEquals('Chuck Versus the World', $this->episode->getName());
        $this->assertEquals(1, $this->episode->getNumber());
        $this->assertEquals(null, $this->episode->getFirstAired());
        $this->assertEquals(array(), $this->episode->getGuestStars());
        $this->assertEquals('', $this->episode->getImdbId());
        $this->assertEquals('', $this->episode->getLanguage());
        $this->assertEquals('', $this->episode->getOverview());
        $this->assertEquals(null, $this->episode->getProductionCode());
        $this->assertEquals('', $this->episode->getRating());
        $this->assertEquals(0, $this->episode->getRatingCount());
        $this->assertEquals(0, $this->episode->getSeason());
        $this->assertEquals(array(), $this->episode->getWriters());
        $this->assertEquals(null, $this->episode->getAbsoluteNumber());
        $this->assertEquals(null, $this->episode->getAirsAfterSeason());
        $this->assertEquals(null, $this->episode->getAirsBeforeEpisode());
        $this->assertEquals(null, $this->episode->getAirsBeforeSeason());
        $this->assertEquals('', $this->episode->getThumbnail());
        $this->assertEquals(null, $this->episode->getSeasonId());
        $this->assertEquals(null, $this->episode->getSerieId());
        $this->assertEquals(\DateTime::createFromFormat('U', 0), $this->episode->getLastUpdated());
    }
}
