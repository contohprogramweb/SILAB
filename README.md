# CodeIgniter 3.11 dengan AdminLTE 3

Sistem ini menggunakan CodeIgniter 3.11 dengan tema AdminLTE 3 untuk dashboard admin.

## Struktur File

```
application/
├── assets/
│   ├── css/
│   │   └── custom.css
│   ├── js/
│   │   └── custom.js
│   └── img/
├── config/
│   ├── routes.php (sudah dikonfigurasi)
│   ├── database.php (konfigurasi database)
│   └── config.php (konfigurasi base_url)
├── controllers/
│   ├── admin/
│   │   └── Dashboard.php
│   └── Auth.php
├── core/
│   └── Admin_Controller.php (base controller untuk admin)
├── models/
│   └── (buat model di sini)
├── views/
│   ├── templates/
│   │   └── adminlte.php (template utama)
│   ├── admin/
│   │   └── dashboard_view.php
│   └── auth/
│       └── login_view.php
└── helpers/
```

## Konfigurasi

### 1. Database Configuration
Edit file `application/config/database.php`:

```php
$db['default'] = array(
    'dsn'   => '',
    'hostname' => 'localhost',
    'username' => 'root',
    'password' => '',
    'database' => 'nama_database_anda',
    'dbdriver' => 'mysqli',
    // ... konfigurasi lainnya
);
```

### 2. Base URL Configuration
Edit file `application/config/config.php`:

```php
$config['base_url'] = 'http://localhost/nama_project_anda/';
```

## Login Credentials (Demo)

- **Username**: admin
- **Password**: admin123

⚠️ **PENTING**: Ganti kredensial demo ini dengan sistem autentikasi database yang sebenarnya sebelum production!

## Fitur yang Tersedia

1. ✅ Template AdminLTE 3 (CDN)
2. ✅ Login/Logout System
3. ✅ Session Management
4. ✅ Base Controller untuk Admin (Admin_Controller)
5. ✅ Dashboard dengan statistik
6. ✅ Responsive Design
7. ✅ Font Awesome Icons
8. ✅ Custom CSS & JS support

## Cara Menambahkan Halaman Baru

### 1. Buat Controller
```php
// application/controllers/admin/Users.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends Admin_Controller {
    public function index() {
        $data['page_title'] = 'User Management';
        $this->render('admin/users_view', $data);
    }
}
```

### 2. Buat View
```php
// application/views/admin/users_view.php
<div class="card">
    <div class="card-header">
        <h3>User Management</h3>
    </div>
    <div class="card-body">
        <!-- Konten Anda -->
    </div>
</div>
```

### 3. Tambahkan Route
Edit `application/config/routes.php`:
```php
$route['admin/users'] = 'admin/users';
```

## Cara Menambahkan Model

```php
// application/models/User_model.php
<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_model extends CI_Model {
    
    public function __construct() {
        parent::__construct();
        $this->load->database();
    }
    
    public function get_all_users() {
        return $this->db->get('users')->result();
    }
    
    public function count_all() {
        return $this->db->count_all('users');
    }
}
```

## Dependencies (CDN)

- AdminLTE 3.2: https://cdn.jsdelivr.net/npm/admin-lte@3.2
- Bootstrap 4.6: https://cdn.jsdelivr.net/npm/bootstrap@4.6.1
- jQuery 3.6: https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0
- Font Awesome 5.15: https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4

## Development Tips

1. Selalu extend `Admin_Controller` untuk halaman admin yang memerlukan autentikasi
2. Gunakan method `$this->render()` untuk menampilkan view dengan template
3. Simpan file CSS custom di `assets/css/custom.css`
4. Simpan file JS custom di `assets/js/custom.js`
5. Untuk production, download AdminLTE dan simpan lokal di folder assets

## Keamanan

- Pastikan untuk mengimplementasikan password hashing (password_hash/password_verify)
- Validasi semua input user
- Implementasikan CSRF protection
- Gunakan prepared statements untuk query database
- Batasi akses berdasarkan role/user level
