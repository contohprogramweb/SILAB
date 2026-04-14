<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * CodeIgniter Application Core
 *
 * This file is the main entry point that bootstraps the application
 */

// Set error reporting based on environment
if (ENVIRONMENT === 'development') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
} else {
    error_reporting(0);
    ini_set('display_errors', 0);
}

// Check if system directory exists
if (!is_dir(BASEPATH.'core')) {
    exit('Your system folder path does not appear to be set correctly.');
}

// Load common functions
require_once BASEPATH.'core/Common.php';

// Load config class
class CI_Config {
    
    protected $config = array();
    
    public function __construct()
    {
        // Load main config
        $this->load_config('config');
        log_message('info', 'Config Class Initialized');
    }
    
    public function load_config($file)
    {
        $file_path = APPPATH.'config/'.$file.'.php';
        
        if (file_exists($file_path)) {
            include $file_path;
            
            if (isset($config)) {
                $this->config = array_merge($this->config, $config);
            }
        }
    }
    
    public function item($key, $default = NULL)
    {
        return isset($this->config[$key]) ? $this->config[$key] : $default;
    }
    
    public function site_url($uri = '')
    {
        $base = $this->item('base_url');
        $index = $this->item('index_page');
        
        return $base.$index.'/'.$uri;
    }
    
    public function base_url($uri = '')
    {
        return $this->item('base_url').$uri;
    }
}

// Load database class
class CI_DB {
    
    protected $db_config = array();
    public $conn_id = NULL;
    
    public function __construct()
    {
        $this->load_db_config();
        log_message('info', 'Database Class Initialized');
    }
    
    protected function load_db_config()
    {
        $file_path = APPPATH.'config/database.php';
        
        if (file_exists($file_path)) {
            include $file_path;
            
            if (isset($db) && isset($db['default'])) {
                $this->db_config = $db['default'];
            }
        }
    }
    
    public function connect()
    {
        if ($this->conn_id) {
            return $this->conn_id;
        }
        
        $this->conn_id = mysqli_connect(
            $this->db_config['hostname'],
            $this->db_config['username'],
            $this->db_config['password'],
            $this->db_config['database']
        );
        
        if (!$this->conn_id) {
            log_message('error', 'Unable to connect to the database');
            return FALSE;
        }
        
        mysqli_set_charset($this->conn_id, $this->db_config['char_set']);
        
        return $this->conn_id;
    }
    
    public function query($sql)
    {
        $this->connect();
        
        $result = mysqli_query($this->conn_id, $sql);
        
        if ($result === FALSE) {
            log_message('error', 'Query failed: '.mysqli_error($this->conn_id));
            return FALSE;
        }
        
        return $result;
    }
    
    public function get($table)
    {
        $sql = "SELECT * FROM ".$table;
        $result = $this->query($sql);
        
        if ($result === FALSE) {
            return array();
        }
        
        $data = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $data[] = $row;
        }
        
        mysqli_free_result($result);
        
        return $data;
    }
}

// Load log class
class CI_Log {
    
    protected $log_path = '';
    
    public function __construct()
    {
        $this->log_path = APPPATH.'logs/';
        
        if (!is_writable($this->log_path)) {
            mkdir($this->log_path, 0755, TRUE);
        }
        
        log_message('info', 'Log Class Initialized');
    }
    
    public function write_log($level, $msg)
    {
        $filepath = $this->log_path.'log-'.date('Y-m-d').'.php';
        
        $message = strtoupper($level).' --> '.date('Y-m-d H:i:s').' --> '.$msg."\n";
        
        file_put_contents($filepath, $message, FILE_APPEND);
    }
}

// Load session class
class CI_Session {
    
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        log_message('info', 'Session Class Initialized');
    }
    
    public function userdata($key = NULL)
    {
        if ($key === NULL) {
            return $_SESSION;
        }
        
        return isset($_SESSION[$key]) ? $_SESSION[$key] : NULL;
    }
    
    public function set_userdata($data)
    {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $_SESSION[$key] = $value;
            }
        }
    }
    
    public function unset_userdata($key)
    {
        unset($_SESSION[$key]);
    }
    
    public function sess_destroy()
    {
        session_destroy();
    }
}

// Load URI class
class CI_URI {
    
    public $segments = array();
    
    public function __construct()
    {
        $this->_fetch_uri_string();
        $this->_explode_segments();
        
        log_message('info', 'URI Class Initialized');
    }
    
    protected function _fetch_uri_string()
    {
        $uri_string = '';
        
        if (isset($_SERVER['REQUEST_URI'])) {
            $uri_string = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        }
        
        // Remove base URL and index.php
        $base_url = config_item('base_url');
        $index_page = config_item('index_page');
        
        $uri_string = str_replace(parse_url($base_url, PHP_URL_PATH), '', $uri_string);
        $uri_string = str_replace('/'.$index_page, '', $uri_string);
        $uri_string = trim($uri_string, '/');
        
        $this->uri_string = $uri_string;
    }
    
    protected function _explode_segments()
    {
        if (!empty($this->uri_string)) {
            $this->segments = explode('/', $this->uri_string);
        }
    }
    
    public function segment($n, $default = NULL)
    {
        return isset($this->segments[$n - 1]) ? $this->segments[$n - 1] : $default;
    }
    
    public function rsegment($n, $default = NULL)
    {
        // Reserved for future use
        return $this->segment($n, $default);
    }
}

// Load router class
class CI_Router {
    
    public $class = '';
    public $method = 'index';
    public $directory = '';
    
    protected $routes = array();
    
    public function __construct()
    {
        $this->_load_routes();
        $this->_set_routing();
        
        log_message('info', 'Router Class Initialized');
    }
    
    protected function _load_routes()
    {
        $file_path = APPPATH.'config/routes.php';
        
        if (file_exists($file_path)) {
            include $file_path;
            
            if (isset($route)) {
                $this->routes = $route;
            }
        }
    }
    
    protected function _set_routing()
    {
        $uri =& load_class('URI', 'core');
        
        // Get default controller
        $this->class = $this->routes['default_controller'] ?? 'welcome';
        
        // Check if we have segments
        if ($uri->segment(1)) {
            $this->class = $uri->segment(1);
        }
        
        if ($uri->segment(2)) {
            $this->method = $uri->segment(2);
        }
    }
    
    public function fetch_class()
    {
        return $this->class;
    }
    
    public function fetch_method()
    {
        return $this->method;
    }
}

// Load exceptions class
class CI_Exceptions {
    
    public function show_error($heading, $message, $template = 'error_general', $status_code = 500)
    {
        http_response_code($status_code);
        
        $output = '<!DOCTYPE html>
<html>
<head>
    <title>'.$heading.'</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background: #f5f5f5; }
        .error-container { background: white; padding: 30px; border-radius: 8px; box-shadow: 0 2px 4px rgba(0,0,0,0.1); }
        h1 { color: #dc3545; }
        p { color: #666; }
    </style>
</head>
<body>
    <div class="error-container">
        <h1>'.$heading.'</h1>
        <p>'.$message.'</p>
    </div>
</body>
</html>';
        
        return $output;
    }
}

// Initialize the application
class CodeIgniter {
    
    public function __construct()
    {
        // Initialize config
        $this->config = new CI_Config();
        
        // Initialize log
        $this->log = new CI_Log();
        
        log_message('info', 'CodeIgniter Version: '.CI_VERSION);
        
        // Initialize session
        $this->session = new CI_Session();
        
        // Initialize URI
        $this->uri = new CI_URI();
        
        // Initialize Router
        $this->router = new CI_Router();
        
        // Initialize Database
        $this->db = new CI_DB();
        
        // Load the controller
        $this->_load_controller();
    }
    
    protected function _load_controller()
    {
        $class = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        
        $file_path = APPPATH.'controllers/'.$class.'.php';
        
        if (file_exists($file_path)) {
            require_once $file_path;
            
            if (class_exists($class)) {
                $controller = new $class();
                
                if (method_exists($controller, $method)) {
                    call_user_func_array(array($controller, $method), array_slice($this->uri->segments, 2));
                } else {
                    show_error('Method '.$method.' not found in controller '.$class);
                }
            } else {
                show_error('Class '.$class.' not found');
            }
        } else {
            show_error('Controller '.$class.' not found');
        }
    }
}

// Fix get_instance for CI_Controller
class CI_Controller {
    
    static $instance;
    
    public function __construct()
    {
        self::$instance =& $this;
    }
    
    public static function &get_instance()
    {
        return self::$instance;
    }
}

// Run the application
$app = new CodeIgniter();
