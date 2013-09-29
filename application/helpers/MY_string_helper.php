<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('string_summary')) {

    function string_summary($string, $width, $id) {

        if ((strlen($string) > $width)) {

            $parts = preg_split('/([\s\n\r]+)/', $string, null, PREG_SPLIT_DELIM_CAPTURE);
            $parts_count = count($parts);

            $length = 0;
            $last_part = 0;
            for (; $last_part < $parts_count; ++$last_part) {
                $length += strlen($parts[$last_part]);
                if ($length > $width) break;
            }

            $string = implode(array_slice($parts, 0, $last_part));
            $string .= '... <a href="#" class="show-more" data="' . $id . '">Show more</a>';

            return $string;

        } else {

            return $string;
        }
    }
}