<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $title; ?></title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        
        .container {
            background: white;
            border-radius: 10px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.3);
            max-width: 800px;
            width: 100%;
            overflow: hidden;
        }
        
        .header {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
            color: white;
            padding: 40px;
            text-align: center;
        }
        
        .header h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            font-weight: 700;
        }
        
        .header p {
            font-size: 1.1em;
            opacity: 0.9;
        }
        
        .content {
            padding: 40px;
        }
        
        .welcome-box {
            background: #f8f9fa;
            border-left: 4px solid #667eea;
            padding: 20px;
            margin-bottom: 30px;
            border-radius: 5px;
        }
        
        .welcome-box h2 {
            color: #333;
            margin-bottom: 15px;
            font-size: 1.5em;
        }
        
        .welcome-box p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 10px;
        }
        
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 20px;
            margin-top: 30px;
        }
        
        .feature-item {
            background: white;
            border: 1px solid #e0e0e0;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .feature-item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }
        
        .feature-icon {
            font-size: 2.5em;
            margin-bottom: 10px;
        }
        
        .feature-title {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
        }
        
        .feature-desc {
            font-size: 0.9em;
            color: #666;
        }
        
        .footer {
            background: #f8f9fa;
            padding: 20px 40px;
            text-align: center;
            border-top: 1px solid #e0e0e0;
        }
        
        .footer p {
            color: #666;
            font-size: 0.9em;
        }
        
        .version-badge {
            display: inline-block;
            background: #667eea;
            color: white;
            padding: 5px 15px;
            border-radius: 20px;
            font-size: 0.85em;
            margin-top: 10px;
        }
        
        a {
            color: #667eea;
            text-decoration: none;
        }
        
        a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>🎉 <?php echo $title; ?></h1>
            <p><?php echo $message; ?></p>
            <span class="version-badge">Version 3.1.11</span>
        </div>
        
        <div class="content">
            <div class="welcome-box">
                <h2>Selamat Datang!</h2>
                <p>Aplikasi CodeIgniter 3.11 Anda telah berhasil diinstal dan siap digunakan.</p>
                <p>Framework ini menyediakan struktur yang ringan dan cepat untuk membangun aplikasi web PHP Anda.</p>
            </div>
            
            <div class="features">
                <div class="feature-item">
                    <div class="feature-icon">🚀</div>
                    <div class="feature-title">Fast Performance</div>
                    <div class="feature-desc">Ringan dan cepat untuk aplikasi Anda</div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">🔒</div>
                    <div class="feature-title">Secure</div>
                    <div class="feature-desc">Fitur keamanan built-in</div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">📦</div>
                    <div class="feature-title">MVC Pattern</div>
                    <div class="feature-desc">Struktur kode yang terorganisir</div>
                </div>
                
                <div class="feature-item">
                    <div class="feature-icon">🛠️</div>
                    <div class="feature-title">Easy to Use</div>
                    <div class="feature-desc">Dokumentasi lengkap & mudah</div>
                </div>
            </div>
        </div>
        
        <div class="footer">
            <p>CodeIgniter 3.1.11 - A framework for people who prefer simplicity</p>
            <p style="margin-top: 10px;">
                <a href="https://codeigniter.com/userguide3/" target="_blank">Documentation</a> • 
                <a href="https://forum.codeigniter.com/" target="_blank">Forum</a> • 
                <a href="https://github.com/bcit-ci/CodeIgniter" target="_blank">GitHub</a>
            </p>
        </div>
    </div>
</body>
</html>
