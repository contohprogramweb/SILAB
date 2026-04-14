<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Loader Class
 *
 * Loads views, models, helpers, libraries, etc.
 */
class CI_Loader {

	protected $_ci_classes = array();
	protected $_ci_models = array();
	protected $_ci_helpers = array();
	protected $_ci_variants = array();
	protected $_ci_cached_vars = array();
	protected $_ci_classes_map = array();

	public function __construct()
	{
		log_message('info', 'Loader Class Initialized');
	}

	// --------------------------------------------------------------------

	/**
	 * Load View
	 *
	 * @param	string	$view	View file name
	 * @param	array	$data	Data to pass to the view
	 * @param	bool	$return	Whether to return the output or send to browser
	 * @return	string|void
	 */
	public function view($view, $data = array(), $return = FALSE)
	{
		$file = $view.'.php';
		
		if (file_exists(VIEWPATH.$file))
		{
			extract($data);
			
			if ($return === TRUE)
			{
				ob_start();
				include VIEWPATH.$file;
				return ob_get_clean();
			}
			else
			{
				include VIEWPATH.$file;
			}
		}
		else
		{
			show_error('Unable to load the requested view file: '.$file);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Load Model
	 *
	 * @param	string	$model	Model name
	 * @param	string	$name	Optional alias for the model
	 * @return	void
	 */
	public function model($model, $name = '')
	{
		if (empty($name))
		{
			$name = strtolower(pathinfo($model, PATHINFO_FILENAME));
		}

		$file = APPPATH.'models/'.$model.'.php';
		
		if (file_exists($file))
		{
			require_once $file;
			
			$class_name = ucfirst($model);
			
			$CI =& get_instance();
			$CI->$name = new $class_name();
			
			log_message('info', 'Model "'.$name.'" loaded');
		}
		else
		{
			show_error('Unable to load the requested model: '.$model);
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Load Helper
	 *
	 * @param	mixed	$helpers	Helper name(s)
	 * @return	void
	 */
	public function helper($helpers)
	{
		foreach ((array) $helpers as $helper)
		{
			$file = APPPATH.'helpers/'.$helper.'_helper.php';
			
			if (file_exists($file))
			{
				require_once $file;
				log_message('info', 'Helper "'.$helper.'" loaded');
			}
			else
			{
				show_error('Unable to load the requested helper: '.$helper);
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Load Library
	 *
	 * @param	mixed	$library	Library name(s)
	 * @param	array	$params	Optional parameters
	 * @param	string	$name	Optional alias for the library
	 * @return	void
	 */
	public function library($library, $params = NULL, $name = '')
	{
		foreach ((array) $library as $lib)
		{
			$file = APPPATH.'libraries/'.$lib.'.php';
			
			if (file_exists($file))
			{
				require_once $file;
				
				$class_name = ucfirst($lib);
				
				if (empty($name))
				{
					$name = strtolower($lib);
				}
				
				$CI =& get_instance();
				
				if ($params !== NULL)
				{
					$CI->$name = new $class_name($params);
				}
				else
				{
					$CI->$name = new $class_name();
				}
				
				log_message('info', 'Library "'.$name.'" loaded');
			}
			else
			{
				show_error('Unable to load the requested library: '.$lib);
			}
		}
	}

	// --------------------------------------------------------------------

	/**
	 * Autoloader
	 *
	 * @return	void
	 */
	public function _ci_autoloader()
	{
		// Load autoload config if exists
		$autoload_file = APPPATH.'config/autoload.php';
		
		if (file_exists($autoload_file))
		{
			include $autoload_file;
			
			if (isset($autoload['helpers']))
			{
				$this->helper($autoload['helpers']);
			}
			
			if (isset($autoload['libraries']))
			{
				$this->library($autoload['libraries']);
			}
			
			if (isset($autoload['models']))
			{
				foreach ($autoload['models'] as $model)
				{
					$this->model($model);
				}
			}
		}
	}
}
