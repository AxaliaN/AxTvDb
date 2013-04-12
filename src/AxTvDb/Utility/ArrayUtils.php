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

        return $array;
    }

    /**
     * Converts a pipe-separated string to an array
     *
     * @param string $string             Array to convert
     * @param bool   $removeEmptyIndexes Whether to automatically remove empty indexes
     * @param bool   $sort               Whether to sort the resulting array
     *
     * @return array
     */
    public static function extractValues($string, $removeEmptyIndexes = true, $sort = true)
    {
        $array = explode('|', (string)$string);

        if ($removeEmptyIndexes) {
            $array = self::removeEmptyIndexes($array, $sort);
        }

        if ($sort) {
            sort($array);
        }

        return $array;
    }
}