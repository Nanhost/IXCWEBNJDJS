<?php
session_start();
require_once 'config/database.php';

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

$role = $_SESSION['role'];
$username = $_SESSION['username'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Kelas IXC</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="light-mode">
    <div class="container">
        <!-- Dashboard Header -->
        <header class="header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="school-info">
                    <h1>Dashboard Kelas IXC</h1>
                    <p>Selamat datang, <?php echo $username; ?>!</p>
                </div>
            </div>
            
            <div class="header-controls">
                <button id="themeToggle" class="theme-toggle">
                    <i class="fas fa-moon"></i> Mode Gelap
                </button>
                <a href="index.php" class="btn btn-outline">
                    <i class="fas fa-home"></i> Beranda
                </a>
                <a href="logout.php" class="btn btn-primary">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </header>

        <!-- Dashboard Content -->
        <main>
            <!-- User Role Info -->
            <div class="role-banner <?php echo $role === 'inti' ? 'role-inti-banner' : 'role-anggota-banner'; ?>">
                <div class="role-info">
                    <i class="fas <?php echo $role === 'inti' ? 'fa-star' : 'fa-user'; ?>"></i>
                    <div>
                        <h3>Anda login sebagai <?php echo $role === 'inti' ? 'Anggota Inti' : 'Anggota Kelas'; ?></h3>
                        <p><?php echo $role === 'inti' ? 'Anda memiliki akses penuh untuk mengelola data kelas' : 'Anda dapat mengisi daftar hadir, piket, dan data diri'; ?></p>
                    </div>
                </div>
            </div>

            <!-- Dashboard Grid -->
            <div class="dashboard-grid">
                <!-- For All Users -->
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-user-edit"></i>
                    </div>
                    <h3>Edit Data Diri</h3>
                    <p>Perbarui informasi pribadi Anda</p>
                    <button class="btn btn-primary btn-block" onclick="openModal('editProfile')">
                        <i class="fas fa-edit"></i> Edit Data
                    </button>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-calendar-check"></i>
                    </div>
                    <h3>Daftar Hadir</h3>
                    <p>Isi kehadiran harian Anda</p>
                    <button class="btn btn-primary btn-block" onclick="openModal('attendance')">
                        <i class="fas fa-check-circle"></i> Isi Hadir
                    </button>
                </div>
                
                <div class="dashboard-card">
                    <div class="card-icon">
                        <i class="fas fa-broom"></i>
                    </div>
                    <h3>Piket</h3>
                    <p>Lihat jadwal dan isi piket</p>
                    <button class="btn btn-primary btn-block" onclick="openModal('piket')">
                        <i class="fas fa-calendar-alt"></i> Jadwal Piket
                    </button>
                </div>
                
                <!-- For Inti Members Only -->
                <?php if ($role === 'inti'): ?>
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3>Tambah Anggota</h3>
                        <p>Tambahkan anggota baru ke kelas</p>
                        <button class="btn btn-primary btn-block" onclick="openModal('addMember')">
                            <i class="fas fa-plus"></i> Tambah Anggota
                        </button>
                    </div>
                    
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-camera"></i>
                        </div>
                        <h3>Dokumentasi</h3>
                        <p>Upload foto kegiatan kelas</p>
                        <button class="btn btn-primary btn-block" onclick="openModal('addDocumentation')">
                            <i class="fas fa-upload"></i> Upload Dokumentasi
                        </button>
                    </div>
                    
                    <div class="dashboard-card">
                        <div class="card-icon">
                            <i class="fas fa-chart-bar"></i>
                        </div>
                        <h3>Statistik</h3>
                        <p>Lihat statistik kehadiran dan aktivitas</p>
                        <button class="btn btn-primary btn-block" onclick="openModal('statistics')">
                            <i class="fas fa-chart-line"></i> Lihat Statistik
                        </button>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Recent Activity -->
            <div class="dashboard-section">
                <h2 class="section-title"><i class="fas fa-history"></i> Aktivitas Terbaru</h2>
                <div class="activity-list">
                    <div class="activity-item">
                        <i class="fas fa-user-check activity-icon success"></i>
                        <div class="activity-content">
                            <h4>Anda mengisi daftar hadir</h4>
                            <p>Hari ini, 08:00 WIB</p>
                        </div>
                    </div>
                    <div class="activity-item">
                        <i class="fas fa-broom activity-icon warning"></i>
                        <div class="activity-content">
                            <h4>Piket hari ini telah diselesaikan</h4>
                            <p>Kemarin, 14:30 WIB</p>
                        </div>
                    </div>
                    <?php if ($role === 'inti'): ?>
                        <div class="activity-item">
                            <i class="fas fa-user-plus activity-icon info"></i>
                            <div class="activity-content">
                                <h4>Menambahkan anggota baru: Rina Andriani</h4>
                                <p>2 hari yang lalu</p>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Modal for Edit Profile -->
    <div id="editProfile" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('editProfile')">&times;</span>
            <h2>Edit Data Diri</h2>
            <form id="editProfileForm">
                <div class="form-group">
                    <label>Nama Lengkap</label>
                    <input type="text" value="<?php echo $username; ?>" required>
                </div>
                <div class="form-group">
                    <label>Tanggal Lahir</label>
                    <input type="date" required>
                </div>
                <div class="form-group">
                    <label>Umur</label>
                    <input type="number" min="10" max="20" required>
                </div>
                <div class="form-group">
                    <label>Hobi</label>
                    <input type="text" placeholder="Masukkan hobi Anda" required>
                </div>
                <div class="form-group">
                    <label>Cita-cita</label>
                    <input type="text" placeholder="Masukkan cita-cita Anda" required>
                </div>
                <div class="form-group">
                    <label>Foto Profil</label>
                    <input type="file" accept="image/*">
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-save"></i> Simpan Perubahan
                </button>
            </form>
        </div>
    </div>
    
    <!-- Modal for Attendance -->
    <div id="attendance" class="modal">
        <div class="modal-content">
            <span class="close-modal" onclick="closeModal('attendance')">&times;</span>
            <h2>Isi Daftar Hadir</h2>
            <form id="attendanceForm">
                <div class="form-group">
                    <label>Tanggal</label>
                    <input type="date" value="<?php echo date('Y-m-d'); ?>" required readonly>
                </div>
                <div class="form-group">
                    <label>Status Kehadiran</label>
                    <select required>
                        <option value="hadir">Hadir</option>
                        <option value="izin">Izin</option>
                        <option value="sakit">Sakit</option>
                        <option value="alfa">Alfa</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Keterangan (jika ada)</label>
                    <textarea rows="3" placeholder="Masukkan keterangan..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary btn-block">
                    <i class="fas fa-check-circle"></i> Submit Kehadiran
                </button>
            </form>
        </div>
    </div>
    
    <script src="js/script.js"></script>
    <script>
        // Dashboard specific JavaScript
        function openModal(modalId) {
            document.getElementById(modalId).style.display = 'flex';
        }
        
        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }
        
        // Close modal when clicking outside
        window.onclick = function(event) {
            if (event.target.classList.contains('modal')) {
                event.target.style.display = 'none';
            }
        }
        
        // Form submissions
        document.getElementById('editProfileForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Data diri berhasil diperbarui!');
            closeModal('editProfile');
        });
        
        document.getElementById('attendanceForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Kehadiran berhasil dicatat!');
            closeModal('attendance');
        });
        
        // Theme toggle for dashboard
        document.addEventListener('DOMContentLoaded', function() {
            const themeToggle = document.getElementById('themeToggle');
            const themeIcon = themeToggle.querySelector('i');
            
            const savedTheme = localStorage.getItem('theme') || 'light';
            if (savedTheme === 'dark') {
                document.body.classList.replace('light-mode', 'dark-mode');
                themeIcon.className = 'fas fa-sun';
                themeToggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
            }
            
            themeToggle.addEventListener('click', function() {
                if (document.body.classList.contains('light-mode')) {
                    document.body.classList.replace('light-mode', 'dark-mode');
                    themeIcon.className = 'fas fa-sun';
                    themeToggle.innerHTML = '<i class="fas fa-sun"></i> Mode Terang';
                    localStorage.setItem('theme', 'dark');
                } else {
                    document.body.classList.replace('dark-mode', 'light-mode');
                    themeIcon.className = 'fas fa-moon';
                    themeToggle.innerHTML = '<i class="fas fa-moon"></i> Mode Gelap';
                    localStorage.setItem('theme', 'light');
                }
            });
        });
    </script>
    
    <style>
        /* Dashboard specific styles */
        .role-banner {
            padding: 20px;
            border-radius: 15px;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .role-inti-banner {
            background: linear-gradient(135deg, #ff9800 0%, #ff5722 100%);
            color: white;
        }
        
        .role-anggota-banner {
            background: linear-gradient(135deg, #2196f3 0%, #21cbf3 100%);
            color: white;
        }
        
        .role-info {
            display: flex;
            align-items: center;
            gap: 20px;
        }
        
        .role-info i {
            font-size: 40px;
        }
        
        .dashboard-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 25px;
            margin-bottom: 40px;
        }
        
        .dashboard-card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
            transition: all 0.3s;
        }
        
        body.dark-mode .dashboard-card {
            background: #1e1e1e;
        }
        
        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
        }
        
        .card-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            color: white;
            font-size: 30px;
        }
        
        .dashboard-card h3 {
            font-size: 20px;
            margin-bottom: 10px;
            color: #333;
        }
        
        body.dark-mode .dashboard-card h3 {
            color: #e0e0e0;
        }
        
        .dashboard-card p {
            color: #666;
            margin-bottom: 20px;
            font-size: 14px;
        }
        
        body.dark-mode .dashboard-card p {
            color: #aaa;
        }
        
        .btn-block {
            width: 100%;
            justify-content: center;
        }
        
        .dashboard-section {
            background: white;
            padding: 30px;
            border-radius: 15px;
            margin-bottom: 30px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        }
        
        body.dark-mode .dashboard-section {
            background: #1e1e1e;
        }
        
        .activity-list {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        .activity-item {
            display: flex;
            align-items: center;
            gap: 15px;
            padding: 15px;
            border-radius: 10px;
            background: #f8f9fa;
            transition: all 0.3s;
        }
        
        body.dark-mode .activity-item {
            background: #2d2d2d;
        }
        
        .activity-item:hover {
            transform: translateX(5px);
        }
        
        .activity-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }
        
        .activity-icon.success {
            background: #e8f5e9;
            color: #4caf50;
        }
        
        .activity-icon.warning {
            background: #fff3e0;
            color: #ff9800;
        }
        
        .activity-icon.info {
            background: #e3f2fd;
            color: #2196f3;
        }
        
        .activity-content h4 {
            font-size: 16px;
            margin-bottom: 5px;
            color: #333;
        }
        
        body.dark-mode .activity-content h4 {
            color: #e0e0e0;
        }
        
        .activity-content p {
            color: #666;
            font-size: 14px;
        }
        
        body.dark-mode .activity-content p {
            color: #aaa;
        }
        
        .alert {
            padding: 15px;
            border-radius: 10px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .alert-error {
            background: #ffebee;
            color: #c62828;
            border-left: 4px solid #c62828;
        }
        
        .form-group {
            margin-bottom: 20px;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        
        body.dark-mode .form-group label {
            color: #e0e0e0;
        }
        
        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-family: 'Poppins', sans-serif;
            font-size: 14px;
            transition: border 0.3s;
        }
        
        body.dark-mode .form-group input,
        body.dark-mode .form-group select,
        body.dark-mode .form-group textarea {
            background: #2d2d2d;
            border-color: #444;
            color: #e0e0e0;
        }
        
        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #6a11cb;
        }
        
        .login-container {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 50px;
            align-items: center;
            min-height: 100vh;
            padding: 40px 0;
        }
        
        .login-form {
            padding: 40px;
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
        
        body.dark-mode .login-form {
            background: #1e1e1e;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .login-header .logo {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 36px;
        }
        
        .login-header h2 {
            font-size: 28px;
            margin-bottom: 10px;
            color: #333;
        }
        
        body.dark-mode .login-header h2 {
            color: #e0e0e0;
        }
        
        .login-header p {
            color: #666;
        }
        
        body.dark-mode .login-header p {
            color: #aaa;
        }
        
        .login-info {
            margin-top: 30px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 10px;
            font-size: 14px;
        }
        
        body.dark-mode .login-info {
            background: #2d2d2d;
        }
        
        .login-info h4 {
            margin-bottom: 10px;
            color: #333;
        }
        
        body.dark-mode .login-info h4 {
            color: #e0e0e0;
        }
        
        .login-footer {
            margin-top: 20px;
            text-align: center;
        }
        
        .login-image {
            height: 500px;
            position: relative;
        }
        
        @media (max-width: 768px) {
            .login-container {
                grid-template-columns: 1fr;
            }
            
            .login-image {
                display: none;
            }
            
            .dashboard-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html>
