<?php

/**
 * @file
 *
 * @package In2pire
 * @subpackage Utility
 * @author Nhat Tran <nhat.tran@inspire.vn>
 */

namespace In2pire\Component\Utility;

/**
 * Text utility.
 */
class Text
{
    /**
     * Convert a string to camel case.
     *
     * @param string $text
     *   String needs to be converted.
     * @param boolean $ucfirst
     *   Uppercase first letter or not.
     *
     * @return string
     *   Camelize string.
     */
    public static function convertToCamelCase($text, $ucfirst = true)
    {
        $text = preg_replace_callback('#[_-]([a-z])#i', function ($matches) {
            return strtoupper($matches[1]);
        }, strtolower($text));

        return $ucfirst ? ucfirst($text) : $text;
    }

    public static function namespacize($list, $namespace = null)
    {
        $return = [];

        foreach ($list as $key => $value) {
            $key = $namespace . $key;

            if (is_array($value)) {
                $return += static::namespacize($value, $key . '.');
            } else {
                $return[$key] = $value;
            }
        }

        return $return;
    }

    public static function hyphenize($text)
    {
        $text = preg_replace('#[^a-z0-9]#', '-', strtolower($text));
        $text = preg_replace('#-{2,}#', '-', $text);
        return $text;
    }
}
