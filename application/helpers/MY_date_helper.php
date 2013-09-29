<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('prettyDate'))
{   
    function prettyDate(array $dates)
    {
        foreach ($dates as &$date) {
            if (date('Y-m-d', strtotime($date)) == date('Y-m-d')) {
                $date = 'Today';
            } elseif (date('Y-m-d', strtotime($date)) == date('Y-m-d', time()-86400)) {
                $date = 'Yesterday';
            } else {
                $days = floor((time() - strtotime($date))/(60*60*24));
                $date = $days . ' days ago';
            }
        }
        return $dates;
    }
}
