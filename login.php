<?php
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';
    
    if ($username === 'admin' && $password === 'password') {
        $_SESSION['logged_in'] = true;
        $_SESSION['username'] = $username;
        header('Location: member.php');
        exit;
    } else {
        $error = 'ชื่อผู้ใช้หรือรหัสผ่านไม่ถูกต้อง';
    }
}
?>
<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>++สหกรณ์การเกษตรลำประทาว จำกัด++</title>
    
    <!-- PWA Meta Tags -->
    <meta name="theme-color" content="#0284c7">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="default">
    <meta name="apple-mobile-web-app-title" content="Lambratown">
    
    <!-- Manifest -->
    <link rel="manifest" href="manifest.json">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-blue: #0284c7;
            --light-blue: #0ea5e9;
            --sky-blue: #38bdf8;
            --pale-blue: #7dd3fc;
            --dark-blue: #075985;
            --gradient-blue: linear-gradient(135deg, var(--primary-blue) 0%, var(--light-blue) 100%);
        }
        
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 50%, #075985 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }
        
        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 0 0 1px rgba(255, 255, 255, 0.2);
            padding: 40px;
            width: 100%;
            max-width: 420px;
            position: relative;
            overflow: hidden;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: var(--gradient-blue);
        }
        
        .logo-section {
            text-align: center;
            margin-bottom: 35px;
        }
        
        .logo-circle {
            width: 80px;
            height: 80px;
            background: var(--gradient-blue);
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(2, 132, 199, 0.3);
        }
        
        .logo-circle i {
            font-size: 36px;
            color: white;
        }
        
        .app-title {
            font-size: 28px;
            font-weight: 700;
            color: var(--dark-blue);
            margin-bottom: 8px;
        }
        
        .app-subtitle {
            color: #64748b;
            font-size: 14px;
        }
        
        .form-floating {
            margin-bottom: 20px;
        }
        
        .form-control {
            border: 2px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 16px;
            font-size: 16px;
            transition: all 0.3s ease;
            height: 56px;
        }
        
        .form-control:focus {
            border-color: var(--light-blue);
            box-shadow: 0 0 0 4px rgba(14, 165, 233, 0.1);
        }
        
        .form-floating label {
            color: #94a3b8;
            padding: 12px 16px;
        }
        
        .form-floating .form-control:focus ~ label,
        .form-floating .form-control:not(:placeholder-shown) ~ label {
            color: var(--primary-blue);
        }
        
        .btn-login {
            background: var(--gradient-blue);
            border: none;
            border-radius: 12px;
            padding: 14px;
            font-size: 16px;
            font-weight: 600;
            color: white;
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(2, 132, 199, 0.3);
        }
        
        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(2, 132, 199, 0.4);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .alert {
            border-radius: 12px;
            border: none;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            color: #dc2626;
        }
        
        .input-group-text {
            background: transparent;
            border: 2px solid #e2e8f0;
            border-right: none;
            border-radius: 12px 0 0 12px;
            color: var(--primary-blue);
        }
        
        .input-group .form-control {
            border-left: none;
            border-radius: 0 12px 12px 0;
        }
        
        .divider {
            text-align: center;
            margin: 30px 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 0;
            right: 0;
            height: 1px;
            background: #e2e8f0;
        }
        
        .divider span {
            background: rgba(255, 255, 255, 0.95);
            padding: 0 16px;
            color: #94a3b8;
            font-size: 14px;
            position: relative;
        }
        
        .demo-info {
            background: linear-gradient(135deg, #f0f9ff, #e0f2fe);
            border-radius: 12px;
            padding: 16px;
            margin-top: 20px;
            border: 1px solid #bae6fd;
        }
        
        .demo-info h6 {
            color: var(--dark-blue);
            font-size: 14px;
            font-weight: 600;
            margin-bottom: 8px;
        }
        
        .demo-info p {
            color: #64748b;
            font-size: 13px;
            margin: 0;
        }
        
        .password-input {
            padding-right: 45px;
        }
        
        .password-toggle {
            cursor: pointer;
            transition: color 0.3s ease;
        }
        
        .password-toggle:hover .bi {
            color: var(--primary-blue) !important;
        }
        
        @media (max-width: 480px) {
            .login-container {
                padding: 30px 20px;
                margin: 20px;
            }
            
            .app-title {
                font-size: 24px;
            }
        }
        
        .loading-spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255, 255, 255, 0.3);
            border-top: 3px solid white;
            border-radius: 50%;
            animation: spin 1s linear infinite;
        }
        
        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .btn-login.loading .btn-text {
            display: none;
        }
        
        .btn-login.loading .loading-spinner {
            display: inline-block;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <div class="logo-section">
            <div class="logo-circle">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h1 class="app-title">Lambratown</h1>
            <p class="app-subtitle">ยินดีต้อนรับสู่ระบบ</p>
        </div>
        
        <?php if ($error): ?>
            <div class="alert alert-danger" role="alert">
                <i class="bi bi-exclamation-triangle me-2"></i>
                <?php echo htmlspecialchars($error); ?>
            </div>
        <?php endif; ?>
        
        <form method="POST" id="loginForm">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="username" name="username" placeholder="ชื่อผู้ใช้" required>
                <label for="username">
                    <i class="bi bi-person me-2"></i>ชื่อผู้ใช้
                </label>
            </div>
            
            <div class="form-floating mb-4">
                <input type="password" class="form-control password-input" id="password" name="password" placeholder="รหัสผ่าน" required>
                <label for="password">
                    <i class="bi bi-lock me-2"></i>รหัสผ่าน
                </label>
                <span class="password-toggle position-absolute end-0 top-50 translate-middle-y me-3" onclick="togglePassword()" style="z-index: 5;">
                    <i class="bi bi-eye text-muted" id="passwordIcon"></i>
                </span>
            </div>
            
            <button type="submit" class="btn btn-login" id="loginBtn">
                <span class="btn-text">เข้าสู่ระบบ</span>
                <div class="loading-spinner"></div>
            </button>
        </form>
        
        <div class="demo-info">
            <h6><i class="bi bi-info-circle me-2"></i>ข้อมูลการเข้าระบบ</h6>
            <p>ชื่อผู้ใช้: <strong>คือรหัสสมาชิก</strong></p>
            <p>รหัสผ่าน: <strong>คือเลขประจำตัวประชาชน 4 ตัวสุดท้าย</strong></p>
        </div>
    </div>
    
    <!-- Bootstrap 5 JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Service Worker Registration
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('/sw.js')
                    .then(registration => {
                        console.log('ServiceWorker registered: ', registration);
                    })
                    .catch(registrationError => {
                        console.log('ServiceWorker registration failed: ', registrationError);
                    });
            });
        }
        
        // Password Toggle
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const passwordIcon = document.getElementById('passwordIcon');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                passwordIcon.className = 'bi bi-eye-slash';
            } else {
                passwordInput.type = 'password';
                passwordIcon.className = 'bi bi-eye';
            }
        }
        
        // Form Loading State
        document.getElementById('loginForm').addEventListener('submit', function(e) {
            const loginBtn = document.getElementById('loginBtn');
            loginBtn.classList.add('loading');
            loginBtn.disabled = true;
        });
        
        // Input Focus Effects
        document.querySelectorAll('.form-control').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.classList.add('focused');
            });
            
            input.addEventListener('blur', function() {
                if (!this.value) {
                    this.parentElement.classList.remove('focused');
                }
            });
        });
    </script>
</body>
</html>
