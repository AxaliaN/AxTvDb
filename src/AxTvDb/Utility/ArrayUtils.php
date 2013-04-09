<?php
/**
 * Created by JetBrains PhpStorm.
 * User: Michel
 * Date: 9-4-13
 * Time: 19:33
 * To change this template use File | Settings | File Templates.
 */

namespace AxTvDb\Utility;


use Zend\Stdlib\ArrayUtils as ArrUtils;

class ArrayUtils extends ArrUtils
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