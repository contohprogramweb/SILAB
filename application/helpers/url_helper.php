<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * URL Helper
 *
 * Provides helper functions for working with URLs
 */

// ------------------------------------------------------------------------

if (!function_exists('site_url')) {
    /**
     * Site URL
     *
     * @param	string	$uri	Optional URI
     * @return	string
     */
    function site_url($uri = '')
    {
        $CI =& get_instance();
        return $CI->config->site_url($uri);
    }
}

// ------------------------------------------------------------------------

if (!function_exists('base_url')) {
    /**
     * Base URL
     *
     * @param	string	$uri	Optional URI
     * @return	string
     */
    function base_url($uri = '')
    {
        $CI =& get_instance();
        return $CI->config->base_url($uri);
    }
}

// ------------------------------------------------------------------------

if (!function_exists('current_url')) {
    /**
     * Current URL
     *
     * @return	string
     */
    function current_url()
    {
        $CI =& get_instance();
        return $CI->config->site_url($CI->uri->uri_string());
    }
}

// ------------------------------------------------------------------------

if (!function_exists('redirect')) {
    /**
     * Redirect
     *
     * @param	string	$uri	Optional URI
     * @param	string	$method	Redirect method
     * @return	void
     */
    function redirect($uri = '', $method = 'location')
    {
        if ($uri === '') {
            $uri = site_url();
        } else {
            $uri = site_url($uri);
        }
        
        header('Location: '.$uri);
        exit;
    }
}

// ------------------------------------------------------------------------

if (!function_exists('asset_url')) {
    /**
     * Asset URL
     *
     * Returns the URL to an asset file (css, js, images, etc.)
     *
     * @param	string	$uri	Optional URI
     * @return	string
     */
    function asset_url($uri = '')
    {
        $CI =& get_instance();
        $assets_dir = $CI->config->item('assets_dir');
        
        if (empty($assets_dir)) {
            $assets_dir = 'assets/';
        }
        
        return base_url($assets_dir . $uri);
    }
}

// ------------------------------------------------------------------------

if (!function_exists('anchor')) {
    /**
     * Anchor Link
     *
     * @param	string	$uri	Optional URI
     * @param	string	$title	Link title
     * @param	mixed	$attributes	Optional attributes
     * @return	string
     */
    function anchor($uri = '', $title = '', $attributes = '')
    {
        $title = (string) $title;
        
        $site_url = is_array($uri) ? site_url($uri) : site_url($uri);
        
        if ($title === '') {
            $title = $site_url;
        }
        
        $attributes = ($attributes !== '') ? _stringify_attributes($attributes) : '';
        
        return '<a href="'.$site_url.'"'.$attributes.'>'.$title.'</a>';
    }
}

// ------------------------------------------------------------------------

if (!function_exists('_stringify_attributes')) {
    /**
     * Stringify attributes
     *
     * @param	mixed	$attributes	Attributes
     * @return	string
     */
    function _stringify_attributes($attributes)
    {
        if (empty($attributes)) {
            return NULL;
        }
        
        if (is_string($attributes)) {
            return ' '.$attributes;
        }
        
        $attributes = (array) $attributes;
        
        $atts = '';
        foreach ($attributes as $key => $val) {
            $atts .= ' '.$key.'="'.$val.'"';
        }
        
        return $atts;
    }
}
