<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

if (!function_exists('cache_it'))
{   
    function cache_it($duration = 60)
    {
        $CI =& get_instance();

        if (ENVIRONMENT == 'production') {
            $CI->output->cache($duration);
        }
    }
}

if (!function_exists('clear_query_cache'))
{   
    function clear_query_cache()
    {
        $CI =& get_instance();

        $CI->db->cache_delete('boils', 'index');
        $CI->db->cache_delete('default', 'index');
        $CI->db->cache_delete('admin', 'index');
        $CI->db->cache_delete('admin', 'boils');
        $CI->db->cache_delete('admin', 'prices');
        $CI->db->cache_delete('admin', 'editBoil');
        $CI->db->cache_delete('admin', 'deleteBoil');
    }
}