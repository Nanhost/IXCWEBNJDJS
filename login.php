<?php
session_start();
require_once 'config/database.php';

$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // In a real application, you would query the database
    // This is a simplified example
    if ($username === 'anggota' && $password === 'password123') {
        $_SESSION['user_id'] = 1;
        $_SESSION['username'] = 'Anggota Kelas';
        $_SESSION['role'] = 'anggota';
        header('Location: dashboard.php');
        exit();
    } elseif ($username === 'inti' && $password === 'admin123') {
        $_SESSION['user_id'] = 2;
        $_SESSION['username'] = 'Anggota Inti';
        $_SESSION['role'] = 'inti';
        header('Location: dashboard.php');
        exit();
    } else {
        $error = 'Username atau password salah!';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Kelas IXC</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="light-mode">
    <div class="container">
        <div class="login-container">
            <div class="login-form">
                <div class="login-header">
                    <div class="logo">
                        <i class="fas fa-graduation-cap"></i>
                    </div>
                    <h2>Login Anggota Kelas</h2>
                    <p>Masuk untuk mengakses dashboard</p>
                </div>
                
                <?php if ($error): ?>
                    <div class="alert alert-error">
                        <i class="fas fa-exclamation-circle"></i> <?php echo $error; ?>
                    </div>
                <?php endif; ?>
                
                <form method="POST" action="">
                    <div class="form-group">
                        <label for="username">
                            <i class="fas fa-user"></i> Username
                        </label>
                        <input type="text" id="username" name="username" required placeholder="Masukkan username">
                    </div>
                    
                    <div class="form-group">
                        <label for="password">
                            <i class="fas fa-lock"></i> Password
                        </label>
                        <input type="password" id="password" name="password" required placeholder="Masukkan password">
                    </div>
                    
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>
                
                <div class="login-info">
                    <h4>Demo Accounts:</h4>
                    <p><strong>Anggota Kelas:</strong> username: anggota, password: password123</p>
                    <p><strong>Anggota Inti:</strong> username: inti, password: admin123</p>
                </div>
                
                <div class="login-footer">
                    <a href="index.php" class="btn btn-outline">
                        <i class="fas fa-arrow-left"></i> Kembali ke Beranda
                    </a>
                </div>
            </div>
            
            <div class="login-image">
                <div class="floating-elements">
                    <div class="floating-element el1"><i class="fas fa-users"></i></div>
                    <div class="floating-element el2"><i class="fas fa-book"></i></div>
                    <div class="floating-element el3"><i class="fas fa-lock"></i></div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Theme persistence for login page
        document.addEventListener('DOMContentLoaded', function() {
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.replace('light-mode', 'dark-mode');
            }
        });
    </script>
</body>
</html>
