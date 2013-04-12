<?php
/**
 * Created by JetBrains PhpStorm.
 * User: michelm
 * Date: 12-4-13
 * Time: 7:59
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDbTest\Utility;

use AxTvDb\Utility\ArrayUtils;

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
