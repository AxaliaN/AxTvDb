<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 10-4-13
 * Time: 13:47
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Banner;


use AxTvDb\Banner\Banner;
use PHPUnit_Framework_TestCase;
use SimpleXMLElement;

class BannerTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var Banner
     */
    protected $banner;

    public function setUp()
    {
        $xmlData =  "<Banner>" .
                        "<id>876076</id>".
                        "<BannerPath>fanart/original/80348-49.jpg</BannerPath>".
                        "<BannerType>fanart</BannerType>".
                        "<BannerType2>1920x1080</BannerType2>".
                        "<Colors>|81,81,81|15,15,15|201,226,246|</Colors>".
                        "<Language>de</Language>".
                        "<Rating>6.6667</Rating>".
                        "<RatingCount>6</RatingCount>".
                        "<SeriesName>false</SeriesName>".
                        "<ThumbnailPath>_cache/fanart/original/80348-49.jpg</ThumbnailPath>".
                        "<VignettePath>fanart/vignette/80348-49.jpg</VignettePath>".
                    "</Banner>";

        $data = new SimpleXMLElement($xmlData);

        $this->banner = new Banner($data);
    }

    public function testIfBannerSetupCorrectly()
    {
        $this->assertEquals(876076, $this->banner->getId());
        $this->assertEquals('fanart/original/80348-49.jpg', $this->banner->getPath());
        $this->assertEquals('fanart/original/80348-49.jpg', $this->banner->getPath());
        $this->assertEquals('fanart', $this->banner->getType());
        $this->assertEquals('1920x1080', $this->banner->getType2());
        $this->assertEquals(array('|81,81,81|15,15,15|201,226,246|'), $this->banner->getColors());
        $this->assertEquals('de', $this->banner->getLanguage());
        $this->assertEquals('6.6667', $this->banner->getRating());
        $this->assertEquals('6', $this->banner->getRatingCount());
        $this->assertEquals('false', $this->banner->getSeriesName());
        $this->assertEquals('_cache/fanart/original/80348-49.jpg', $this->banner->getThumbnailPath());
        $this->assertEquals('fanart/vignette/80348-49.jpg', $this->banner->getVignettePath());
    }

    public function testIfBannerSetDataCorrectly()
    {
        $this->banner->setId(1);
        $this->banner->setPath('poster/original/1-49.jpg');
        $this->banner->setType('poster');
        $this->banner->setType2('800x600');
        $this->banner->setColors(array('|0,0,0|1,1,1|'));
        $this->banner->setLanguage('en');
        $this->banner->setRating('3.14');
        $this->banner->setRatingCount('20');
        $this->banner->setSeriesName('Test: The Series');
        $this->banner->setThumbnailPath('_cache/poster/original/1-49.jpg');
        $this->banner->setVignettePath('poster/vignette/1-49.jpg');

        $this->assertEquals(1, $this->banner->getId());
        $this->assertEquals('poster/original/1-49.jpg', $this->banner->getPath());
        $this->assertEquals('poster', $this->banner->getType());
        $this->assertEquals('800x600', $this->banner->getType2());
        $this->assertEquals(array('|0,0,0|1,1,1|'), $this->banner->getColors());
        $this->assertEquals('en', $this->banner->getLanguage());
        $this->assertEquals('3.14', $this->banner->getRating());
        $this->assertEquals('20', $this->banner->getRatingCount());
        $this->assertEquals('Test: The Series', $this->banner->getSeriesName());
        $this->assertEquals('_cache/poster/original/1-49.jpg', $this->banner->getThumbnailPath());
        $this->assertEquals('poster/vignette/1-49.jpg', $this->banner->getVignettePath());
    }
}