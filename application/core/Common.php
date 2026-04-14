<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Common Functions
 */

// ------------------------------------------------------------------------

/**
 * Get CI Instance
 *
 * Returns the singleton instance of CI_Controller
 *
 * @return	CI_Controller
 */
function &get_instance()
{
	return CI_Controller::get_instance();
}

// ------------------------------------------------------------------------

/**
 * Log Message
 *
 * Writes a log message to the log file
 *
 * @param	string	$level	Log level (error, debug, info, etc.)
 * @param	string	$msg	Message to log
 * @return	void
 */
function log_message($level, $msg)
{
	$CI =& get_instance();
	
	if (isset($CI->log))
	{
		$CI->log->write_log($level, $msg);
	}
	else
	{
		// Fallback: write to error log
		error_log("[$level] $msg");
	}
}

// ------------------------------------------------------------------------

/**
 * Show Error
 *
 * Displays an error message
 *
 * @param	string	$message	Error message
 * @param	int	$status_code	HTTP status code
 * @return	void
 */
function show_error($message, $status_code = 500)
{
	$_error =& load_class('Exceptions', 'core');
	echo $_error->show_error('Error', $message, 'error_general', $status_code);
	exit;
}

// ------------------------------------------------------------------------

/**
 * Load Class
 *
 * Loads a core class
 *
 * @param	string	$class	Class name
 * @param	string	$path	Path type (core, libraries, etc.)
 * @param	string	$prefix	Class prefix
 * @return	object
 */
function &load_class($class, $path = 'libraries', $prefix = 'CI_')
{
	static $_classes = array();

	if (isset($_classes[$class]))
	{
		return $_classes[$class];
	}

	$file = BASEPATH.$path.'/'.$class.'.php';

	if (file_exists($file))
	{
		require_once $file;
		$_classes[$class] = new $class();
		return $_classes[$class];
	}

	throw new Exception('Unable to load class: '.$class);
}

// ------------------------------------------------------------------------

/**
 * Get Config
 *
 * Returns config item(s)
 *
 * @param	string	$item	Config item name
 * @param	bool	$index	Whether to return index
 * @return	mixed
 */
function config_item($item, $index = FALSE)
{
	static $_config_items = array();

	if (isset($_config_items[$item]))
	{
		return $_config_items[$item];
	}

	$CI =& get_instance();
	
	if (isset($CI->config))
	{
		$value = $CI->config->item($item);
		$_config_items[$item] = $value;
		return $value;
	}

	return NULL;
}

// ------------------------------------------------------------------------

/**
 * Site URL
 *
 * Returns the site URL
 *
 * @param	string	$uri	Optional URI
 * @return	string
 */
function site_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->site_url($uri);
}

// ------------------------------------------------------------------------

/**
 * Base URL
 *
 * Returns the base URL
 *
 * @param	string	$uri	Optional URI
 * @return	string
 */
function base_url($uri = '')
{
	$CI =& get_instance();
	return $CI->config->base_url($uri);
}
