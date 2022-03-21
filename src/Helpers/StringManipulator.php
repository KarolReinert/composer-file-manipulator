<?php


namespace Reinert\ComposerFileManipulator\Helpers;


/**
 * Class StringManipulator
 * @package Reinert\ComposerFileManipulator\Services
 */
class StringManipulator
{
    /**
     * If string contains given expression.
     * @param string $string
     * @param string $pattern
     * @return bool
     */
    public static function contains(string $string, string $pattern): bool
    {
        return strpos($string, $pattern) !== false;
    }

    /**
     * Get string between start and end string
     *
     * @param string $string
     * @param string $start
     * @param string $end
     * @return string
     */
    public static function getBetween(string $string, string $start = "", string $end = ""): string
    {
        if (strpos($string, $start)) {
            $startCharCount = strpos($string, $start) + strlen($start);
            $firstSubStr = substr($string, $startCharCount, strlen($string));
            $endCharCount = strpos($firstSubStr, $end);
            if ($endCharCount === 0) {
                $endCharCount = strlen($firstSubStr);
            }
            return substr($firstSubStr, 0, $endCharCount);
        }

        return '';
    }

    /**
     * Wraps string in given text
     *
     * @param string $text
     * @param string $in
     * @return string
     */
    public static function wrapIn(string $text = "", string $in = ""): string
    {
        return $in . $text . $in;
    }

}