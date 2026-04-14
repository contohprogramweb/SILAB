# SILAB - Sistem Informasi Lab Komputer

Proyek CodeIgniter 3.1.11 telah disiapkan dengan struktur file yang lengkap.

## Struktur Direktori

```
/workspace/
├── index.php                 # Front controller (entry point)
├── application/              # Direktori aplikasi utama
│   ├── cache/                # Cache files
│   ├── config/               # Konfigurasi aplikasi
│   │   ├── config.php        # Konfigurasi utama
│   │   ├── database.php      # Konfigurasi database
│   │   ├── routes.php        # Routing configuration
│   │   └── autoload.php      # Autoload configuration
│   ├── controllers/          # Controller files
│   │   └── Welcome.php       # Default controller
│   ├── core/                 # Core classes
│   │   ├── CodeIgniter.php   # Main framework file
│   │   ├── Common.php        # Common functions
│   │   ├── Loader.php        # Loader class
│   │   ├── MY_Controller.php # Base controller
│   │   └── MY_Model.php      # Base model
│   ├── helpers/              # Helper files
│   │   └── url_helper.php    # URL helper
│   ├── hooks/                # Hooks files
│   ├── language/             # Language files
│   ├── libraries/            # Library files
│   ├── logs/                 # Log files
│   ├── models/               # Model files
│   │   └── Sample_model.php  # Sample model
│   ├── third_party/          # Third party libraries
│   └── views/                # View files
│       └── welcome_message.php  # Welcome view
├── assets/                   # Asset files
│   ├── css/                  # CSS files
│   ├── js/                   # JavaScript files
│   └── images/               # Image files
├── system/                   # System directory
│   └── core/                 # Core system files
└── writable/                 # Writable directories
    ├── cache/                # Cache directory
    ├── logs/                 # Logs directory
    ├── session/              # Session directory
    └── uploads/              # Uploads directory
```

## Cara Menggunakan

### 1. Konfigurasi Database

Edit file `application/config/database.php`:

```php
$db['default'] = array(
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nama_database_anda',
    'dbdriver' => 'mysqli',
);
```

### 2. Konfigurasi Base URL

Edit file `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/project_anda/';
```

### 3. Menjalankan Aplikasi

Akses melalui browser:
```
http://localhost/project_anda/
```

## Fitur yang Tersedia

- ✅ MVC Architecture
- ✅ Database Connection (MySQLi)
- ✅ Session Management
- ✅ URL Routing
- ✅ Helper Functions
- ✅ Logging System
- ✅ Error Handling
- ✅ Security Features

## Contoh Penggunaan

### Controller
```php
class Welcome extends CI_Controller {
    public function index() {
        $data['title'] = 'Hello World';
        $this->load->view('welcome_message', $data);
    }
}
```

### Model
```php
class Sample_model extends CI_Model {
    public function get_users() {
        return $this->db->get('users');
    }
}
```

### View
```php
<h1><?php echo $title; ?></h1>
<p>Selamat datang di CodeIgniter!</p>
```

## Dokumentasi

- [CodeIgniter User Guide](https://codeigniter.com/userguide3/)
- [CodeIgniter Forum](https://forum.codeigniter.com/)
- [GitHub Repository](https://github.com/bcit-ci/CodeIgniter)

## Requirements

- PHP 5.6 atau lebih tinggi
- MySQL 5.1 atau lebih tinggi
- Web Server (Apache/Nginx)

## License

CodeIgniter is open-source software licensed under the MIT License.
