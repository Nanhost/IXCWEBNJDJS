<?php
session_start();
require_once 'config/database.php';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelas IXC - SMP Negeri 1 Cipari</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/theme.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto+Slab:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<body class="light-mode">
    <div class="container">
        <!-- Header -->
        <header class="header">
            <div class="logo-container">
                <div class="logo">
                    <i class="fas fa-graduation-cap"></i>
                </div>
                <div class="school-info">
                    <h1>Kelas IXC</h1>
                    <p>SMP Negeri 1 Cipari</p>
                </div>
            </div>
            
            <div class="header-controls">
                <button id="themeToggle" class="theme-toggle">
                    <i class="fas fa-moon"></i> Mode Gelap
                </button>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="dashboard.php" class="btn btn-primary">
                        <i class="fas fa-tachometer-alt"></i> Dashboard
                    </a>
                    <a href="logout.php" class="btn btn-outline">
                        <i class="fas fa-sign-out-alt"></i> Logout
                    </a>
                <?php else: ?>
                    <a href="login.php" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Login Anggota
                    </a>
                <?php endif; ?>
            </div>
        </header>

        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-content">
                <h2>Selamat Datang di Website Kelas IXC</h2>
                <p>Tempat untuk informasi kelas, daftar hadir, piket, dan dokumentasi kegiatan</p>
                <div class="hero-stats">
                    <div class="stat">
                        <h3>36</h3>
                        <p>Jumlah Anggota</p>
                    </div>
                    <div class="stat">
                        <h3>12</h3>
                        <p>Anggota Inti</p>
                    </div>
                    <div class="stat">
                        <h3>24</h3>
                        <p>Kegiatan</p>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-elements">
                    <div class="floating-element el1"><i class="fas fa-book"></i></div>
                    <div class="floating-element el2"><i class="fas fa-users"></i></div>
                    <div class="floating-element el3"><i class="fas fa-calendar-check"></i></div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <main>
            <!-- Informasi Anggota -->
            <section class="section">
                <h2 class="section-title"><i class="fas fa-users"></i> Anggota Kelas</h2>
                <div class="members-grid" id="membersGrid">
                    <!-- Data anggota akan di-load via JavaScript -->
                </div>
            </section>

            <!-- Kegiatan Terbaru -->
            <section class="section">
                <h2 class="section-title"><i class="fas fa-calendar-alt"></i> Kegiatan Terbaru</h2>
                <div class="activities-grid" id="activitiesGrid">
                    <!-- Data kegiatan akan di-load via JavaScript -->
                </div>
            </section>

            <!-- Info Kelas -->
            <section class="section">
                <h2 class="section-title"><i class="fas fa-info-circle"></i> Informasi Kelas</h2>
                <div class="info-cards">
                    <div class="info-card">
                        <i class="fas fa-user-clock"></i>
                        <h3>Daftar Hadir</h3>
                        <p>Anggota kelas dapat mengisi daftar hadir setiap hari</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-broom"></i>
                        <h3>Piket</h3>
                        <p>Sistem piket kelas terjadwal dengan baik</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-camera"></i>
                        <h3>Dokumentasi</h3>
                        <p>Foto-foto kegiatan kelas tersimpan rapi</p>
                    </div>
                    <div class="info-card">
                        <i class="fas fa-star"></i>
                        <h3>Anggota Inti</h3>
                        <p>12 anggota inti yang mengelola kelas</p>
                    </div>
                </div>
            </section>
        </main>

        <!-- Footer -->
        <footer class="footer">
            <div class="footer-content">
                <div class="footer-logo">
                    <i class="fas fa-graduation-cap"></i>
                    <h3>Kelas IXC</h3>
                    <p>SMP Negeri 1 Cipari</p>
                </div>
                <div class="footer-links">
                    <h4>Tautan Cepat</h4>
                    <a href="#"><i class="fas fa-home"></i> Beranda</a>
                    <a href="login.php"><i class="fas fa-sign-in-alt"></i> Login</a>
                    <a href="#"><i class="fas fa-envelope"></i> Kontak</a>
                </div>
                <div class="footer-info">
                    <h4>Kontak</h4>
                    <p><i class="fas fa-map-marker-alt"></i> Jl. Pendidikan No. 123, Cipari</p>
                    <p><i class="fas fa-phone"></i> (0281) 123456</p>
                    <p><i class="fas fa-envelope"></i> kelasixc@smpn1cipari.sch.id</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2023 Kelas IXC SMP Negeri 1 Cipari. Semua Hak Dilindungi.</p>
            </div>
        </footer>
    </div>

    <!-- Modal untuk detail anggota -->
    <div id="memberModal" class="modal">
        <div class="modal-content">
            <span class="close-modal">&times;</span>
            <div id="modalContent"></div>
        </div>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
