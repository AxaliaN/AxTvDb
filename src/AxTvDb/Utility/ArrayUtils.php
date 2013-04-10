<?php

namespace AxTvDb\Utility;

/**
 * Utility class with functions for manipulating arrays
 *
 * @category AxTvDb
 * @package  AxTvDb\Utility
 * @author   Jérôme Poskin <moinax@gmail.com>
 * @author   Michel Maas <michel@michelmaas.com>
 * @license  http://opensource.org/licenses/GPL-3.0 GPL-3.0
 * @link     https://github.com/AxaliaN/AxTvDb
 */
class ArrayUtils
{
    /**
     * Removes indexes from an array if they are zero length after trimming
     *
     * @param array $array Array to process
     *
     * @return array An array with all empty indexes removed
     */
    public static function removeEmptyIndexes($array)
    {
        $length = count($array);

        for ($i = $length - 1; $i >= 0; $i--) {
            if (trim($array[$i]) == '') {
                unset($array[$i]);
            }
        }

        sort($array);
        return $array;
    }
}