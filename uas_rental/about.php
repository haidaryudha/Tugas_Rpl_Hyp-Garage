<?php
// --- ABOUT PAGE ---
include 'koneksi.php';
session_start();
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Tentang Kami - HYP Garage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Menggunakan Style yang SAMA dengan Index biar konsisten */
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; color: #333; }
        
        /* Navbar */
        .navbar { background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.6rem; color: #1a1a1a !important; text-transform: uppercase; letter-spacing: 1px; }
        .text-accent { color: #d32f2f; }
        .nav-link { color: #555 !important; font-weight: 600; margin-left: 20px; }
        .nav-link:hover, .nav-link.active { color: #d32f2f !important; }
        .btn-header-cta { background-color: #d32f2f; color: #fff; font-weight: 700; border-radius: 5px; padding: 8px 25px; border: none; transition: 0.3s; text-decoration: none;}
        .btn-header-cta:hover { background-color: #b71c1c; color: #fff; }

        /* Header Khusus Halaman About */
        .page-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            padding: 60px 0;
            color: white;
            text-align: center;
            margin-bottom: 50px;
        }

        /* Layout About (Mirip Video) */
        .about-content { padding-bottom: 80px; }
        .about-img-box { position: relative; border-radius: 15px; overflow: hidden; box-shadow: 0 10px 30px rgba(0,0,0,0.15); }
        .about-img { width: 100%; height: 400px; object-fit: cover; filter: grayscale(100%); transition: 0.5s; }
        .about-img-box:hover .about-img { filter: grayscale(0%); }
        
        .year-badge {
            position: absolute; bottom: 0; right: 0;
            background-color: #d32f2f; color: white;
            padding: 20px 30px; text-align: center;
            border-top-left-radius: 20px;
        }
        .year-number { font-size: 2rem; font-weight: 800; line-height: 1; }
        .year-text { font-size: 0.8rem; text-transform: uppercase; letter-spacing: 1px; }

        /* Statistik Bar */
        .stats-section { background: #1a1a1a; padding: 60px 0; color: white; margin: 50px 0; border-top: 5px solid #d32f2f; }
        .stat-icon { font-size: 2.5rem; color: #d32f2f; margin-bottom: 15px; }
        .stat-number { font-size: 2.5rem; font-weight: 800; }

        /* Visi Misi */
        .vm-card { background: white; padding: 40px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); height: 100%; border-bottom: 4px solid #d32f2f; transition: 0.3s; }
        .vm-card:hover { transform: translateY(-5px); }
        .vm-icon { font-size: 2.5rem; color: #1a1a1a; margin-bottom: 20px; }

        /* Footer */
        .footer-section { background-color: #111; color: white; padding: 60px 0 30px 0; margin-top: 0; }
        .footer-link { color: #888; text-decoration: none; display: block; margin-bottom: 10px; }
        .footer-link:hover { color: #d32f2f; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <i class="fa-solid fa-gauge-high text-accent me-2"></i> HYP <span class="text-accent">GARAGE</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                <li class="nav-item"><a class="nav-link active" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#armada">Garage</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#contact">Contact</a></li>
                <li class="nav-item ms-3">
                    <a href="index.php#armada" class="btn-header-cta shadow-sm">BOOK NOW</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="logout.php" class="nav-link text-danger fw-bold"><i class="fa-solid fa-power-off"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<div class="page-header">
    <div class="container">
        <h1 class="fw-bold display-4">WHO WE ARE</h1>
        <p class="lead opacity-75">Mengenal Lebih Dekat HYP Garage Cikarang</p>
    </div>
</div>

<section class="about-content">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5">
                <h4 class="text-accent fw-bold text-uppercase mb-3">Tentang Kami</h4>
                <h2 class="fw-bold mb-4 display-6">Premium Mobility Solution in Cikarang</h2>
                <p class="text-muted lead" style="font-size: 1.1rem;">
                    HYP Garage adalah pionir penyedia layanan sewa mobil sport dan premium di kawasan industri <b>Cikarang & Jababeka</b>.
                </p>
                <p class="text-muted">
                    Kami memahami kebutuhan eksekutif dan pebisnis akan transportasi yang tidak hanya nyaman, tapi juga memiliki performa tinggi dan prestise. Sejak 2026, kami berkomitmen menghadirkan unit-unit JDM Legend dan Supercar terbaik dengan perawatan standar internasional.
                </p>
                
                <div class="row mt-4">
                    <div class="col-6 mb-3">
                        <i class="fa-solid fa-shield-halved text-accent me-2"></i> <b>Full Insurance</b>
                    </div>
                    <div class="col-6 mb-3">
                        <i class="fa-solid fa-clock text-accent me-2"></i> <b>24/7 Service</b>
                    </div>
                    <div class="col-6 mb-3">
                        <i class="fa-solid fa-user-tie text-accent me-2"></i> <b>VIP Driver</b>
                    </div>
                    <div class="col-6 mb-3">
                        <i class="fa-solid fa-map-location-dot text-accent me-2"></i> <b>Jabodetabek</b>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="about-img-box">
                    <img src="https://img.freepik.com/free-photo/man-red-suit-standing-near-car_1157-22923.jpg" class="about-img" alt="Garage Team">
                    <div class="year-badge">
                        <div class="year-number">2026</div>
                        <div class="year-text">ESTABLISHED</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="stats-section">
        <div class="container">
            <div class="row text-center">
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <i class="fa-solid fa-users stat-icon"></i>
                    <div class="stat-number">500+</div>
                    <div class="text-uppercase small mt-2">Happy Clients</div>
                </div>
                <div class="col-md-3 col-6 mb-4 mb-md-0">
                    <i class="fa-solid fa-car stat-icon"></i>
                    <div class="stat-number">25+</div>
                    <div class="text-uppercase small mt-2">Premium Units</div>
                </div>
                <div class="col-md-3 col-6">
                    <i class="fa-solid fa-trophy stat-icon"></i>
                    <div class="stat-number">#1</div>
                    <div class="text-uppercase small mt-2">In Cikarang</div>
                </div>
                <div class="col-md-3 col-6">
                    <i class="fa-solid fa-route stat-icon"></i>
                    <div class="stat-number">100%</div>
                    <div class="text-uppercase small mt-2">Satisfaction</div>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="vm-card text-center">
                    <i class="fa-solid fa-eye vm-icon"></i>
                    <h3 class="fw-bold mb-3">Visi Kami</h3>
                    <p class="text-muted">Menjadi ikon transportasi premium terdepan di Cikarang yang menggabungkan kemewahan, kecepatan, dan keamanan dalam satu layanan eksklusif.</p>
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="vm-card text-center">
                    <i class="fa-solid fa-rocket vm-icon"></i>
                    <h3 class="fw-bold mb-3">Misi Kami</h3>
                    <p class="text-muted">Menyediakan akses mudah ke kendaraan impian (Dream Cars) bagi para penggemar otomotif dan eksekutif muda dengan proses sewa yang cepat dan transparan.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<footer class="footer-section">
    <div class="container">
        <div class="text-center small text-secondary">
            &copy; 2026 HYP Garage Cikarang. All Rights Reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>