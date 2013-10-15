<?php
namespace Microsite;

class Util
{
    /**
     * Replace breaks
     *
     * @param string $text
     * @return string
     */
    public static function clean($text)
    {
        $text = str_replace('<br />', ' ', $text);
        $text = str_replace('<br/>', ' ', $text);
        $text = str_replace('<br>', ' ', $text);
        $text = str_replace('  ', ' ', $text);
        return $text;
    }
}