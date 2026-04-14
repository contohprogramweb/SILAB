<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Application Environment
|--------------------------------------------------------------------------
*/

define('ENVIRONMENT', isset($_SERVER['CI_ENV']) ? $_SERVER['CI_ENV'] : 'development');

/*
|--------------------------------------------------------------------------
| Error Reporting
|--------------------------------------------------------------------------
*/

switch (ENVIRONMENT)
{
	case 'development':
		error_reporting(-1);
		ini_set('display_errors', 1);
	break;

	case 'testing':
	case 'production':
		ini_set('display_errors', 0);
		if (version_compare(PHP_VERSION, '5.3', '>='))
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_STRICT & ~E_USER_NOTICE & ~E_USER_DEPRECATED);
		}
		else
		{
			error_reporting(E_ALL & ~E_NOTICE & ~E_STRICT & ~E_USER_NOTICE);
		}
	break;

	default:
		header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
		echo 'The application environment is not set correctly.';
		exit(1); // EXIT_ERROR
}

/*
|--------------------------------------------------------------------------
| System Directory Name
|--------------------------------------------------------------------------
*/
$system_path = 'system';

/*
|--------------------------------------------------------------------------
| Application Directory Name
|--------------------------------------------------------------------------
*/
$application_folder = 'application';

/*
|--------------------------------------------------------------------------
| View Directory Name
|--------------------------------------------------------------------------
*/
$view_folder = '';

/*
|--------------------------------------------------------------------------
| Full Path Is Absolute
|--------------------------------------------------------------------------
*/
if (realpath($system_path) !== FALSE)
{
	$system_path = realpath($system_path).'/';
}

$system_path = rtrim($system_path, '/').'/';

if ($application_folder[0] != '/' && realpath($application_folder) !== FALSE)
{
	$application_folder = realpath($application_folder).'/';
}
elseif ($application_folder[0] == '/')
{
	$application_folder = realpath($application_folder).'/';
}

$application_folder = rtrim($application_folder, '/').'/';

if ($view_folder != '' && $view_folder[0] != '/' && realpath($view_folder) !== FALSE)
{
	$view_folder = realpath($view_folder).'/';
}
elseif ($view_folder != '' && $view_folder[0] == '/')
{
	$view_folder = realpath($view_folder).'/';
}
else
{
	$view_folder = $application_folder.'views/';
}

/*
|--------------------------------------------------------------------------
| Now that we know the path, set the main constants
|--------------------------------------------------------------------------
*/
if ( ! defined('BASEPATH'))
{
	define('BASEPATH', $system_path);
}

if ( ! defined('APPPATH'))
{
	define('APPPATH', $application_folder);
}

if ( ! defined('VIEWPATH'))
{
	define('VIEWPATH', $view_folder);
}

/*
|--------------------------------------------------------------------------
| Path to the front controller (this file)
|--------------------------------------------------------------------------
*/
define('FCPATH', dirname(__FILE__).DIRECTORY_SEPARATOR);

/*
|--------------------------------------------------------------------------
| Name of the "system" directory
|--------------------------------------------------------------------------
*/
define('SYSDIR', basename(BASEPATH));

/*
|--------------------------------------------------------------------------
| The name of the APPLICATION directory
|--------------------------------------------------------------------------
*/
define('APPNAME', basename(APPPATH));

/*
|--------------------------------------------------------------------------
| CodeIgniter Version
|--------------------------------------------------------------------------
*/
define('CI_VERSION', '3.1.11');

/*
|--------------------------------------------------------------------------
| Load the starter file
|--------------------------------------------------------------------------
*/
require_once BASEPATH.'core/CodeIgniter.php';
