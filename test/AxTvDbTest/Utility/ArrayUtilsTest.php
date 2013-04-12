<?php

namespace AxTvDbTest\Utility;

use AxTvDb\Utility\ArrayUtils;

/**
 * Test case for class AxTvDb\Utility\ArrayUtils
 *
 * @category AxTvDbTest
 * @package  AxTvDbTest\Utility
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class ArrayUtilsTest extends \PHPUnit_Framework_TestCase
{
        public function testIfArrayProcessedCorrectly()
        {
            $arrayString = "|D|A|C|B|";

            $arraySortedNoEmpty   = ArrayUtils::extractValues($arrayString, true, true);
            $arrayNotSortedNoEmpty   = ArrayUtils::extractValues($arrayString, true, false);
            $arrayWithEmpty = ArrayUtils::extractValues($arrayString, false, false);

            $this->assertEquals(array('A','B','C','D'), $arraySortedNoEmpty);
            $this->assertEquals(array(1=>'D',2=>'A',3=>'C',4=>'B'), $arrayNotSortedNoEmpty);
            $this->assertEquals(array('','D','A','C','B', ''), $arrayWithEmpty);
        }
}
