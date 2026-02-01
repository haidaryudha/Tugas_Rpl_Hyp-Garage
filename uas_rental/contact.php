<?php
// --- CONTACT PAGE ---
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
    <title>Hubungi Kami - HYP Garage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <style>
        /* Style Konsisten (HYP Garage Theme) */
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; color: #333; }
        
        /* Navbar */
        .navbar { background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.6rem; color: #1a1a1a !important; text-transform: uppercase; letter-spacing: 1px; }
        .text-accent { color: #d32f2f; }
        .nav-link { color: #555 !important; font-weight: 600; margin-left: 20px; }
        .nav-link:hover, .nav-link.active { color: #d32f2f !important; }
        .btn-header-cta { background-color: #d32f2f; color: #fff; font-weight: 700; border-radius: 5px; padding: 8px 25px; border: none; transition: 0.3s; text-decoration: none;}
        .btn-header-cta:hover { background-color: #b71c1c; color: #fff; }

        /* Header Page */
        .page-header {
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            padding: 60px 0;
            color: white;
            text-align: center;
        }

        /* Section 1: Butuh Saran (CTA) */
        .consult-section {
            background-color: #1a1a1a;
            color: white;
            padding: 60px 0;
            text-align: center;
            border-bottom: 5px solid #d32f2f;
        }
        .btn-consult {
            border: 2px solid #d32f2f;
            color: #d32f2f;
            padding: 10px 30px;
            font-weight: 700;
            border-radius: 50px;
            text-decoration: none;
            transition: 0.3s;
            display: inline-block;
            margin-top: 15px;
        }
        .btn-consult:hover { background-color: #d32f2f; color: white; }

        /* Section 2: Info Cards */
        .info-section { padding: 80px 0; }
        .info-card {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            text-align: center;
            height: 100%;
            border-bottom: 3px solid transparent;
            transition: 0.3s;
        }
        .info-card:hover { transform: translateY(-5px); border-bottom-color: #d32f2f; }
        .info-icon { font-size: 2.5rem; color: #d32f2f; margin-bottom: 20px; }
        .info-title { font-weight: 700; margin-bottom: 10px; font-size: 1.1rem; }
        .info-text { color: #666; font-size: 0.9rem; }

        /* Section 3: Map */
        .map-container {
            width: 100%;
            height: 450px;
            background: #ddd;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(0,0,0,0.1);
            margin-bottom: 50px;
        }

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
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="index.php#armada">Garage</a></li>
                <li class="nav-item"><a class="nav-link active" href="contact.php">Contact</a></li>
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
        <h1 class="fw-bold display-4">HUBUNGI KAMI</h1>
        <p class="lead opacity-75">Kami Siap Membantu Perjalanan Anda</p>
    </div>
</div>

<section class="consult-section">
    <div class="container">
        <h2 class="fw-bold">Butuh Saran Armada?</h2>
        <p class="text-muted mb-0">Tim kami siap membantu Anda memilih kendaraan yang tepat sesuai kebutuhan.</p>
        <a href="https://wa.me/6281234567890" target="_blank" class="btn-consult">
            <i class="fa-brands fa-whatsapp me-2"></i> Konsultasi Sekarang
        </a>
    </div>
</section>

<section class="info-section">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="fw-bold text-uppercase">Informasi Kontak</h2>
            <p class="text-muted">Jangan ragu untuk mengunjungi atau menghubungi kami.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-3">
                <div class="info-card">
                    <i class="fa-solid fa-location-dot info-icon"></i>
                    <h5 class="info-title">Alamat</h5>
                    <p class="info-text">
                        Jl. Flamboyan No. 14,<br>
                        Perum Mega Regency,<br>
                        Cikarang, Kab. Bekasi
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <i class="fa-solid fa-phone info-icon"></i>
                    <h5 class="info-title">Telepon / WA</h5>
                    <p class="info-text">
                        +62 812-9988-7766<br>
                        (Fast Response)
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <i class="fa-solid fa-envelope info-icon"></i>
                    <h5 class="info-title">Email</h5>
                    <p class="info-text">
                        booking@hypgarage.com<br>
                        support@hypgarage.com
                    </p>
                </div>
            </div>

            <div class="col-md-3">
                <div class="info-card">
                    <i class="fa-solid fa-clock info-icon"></i>
                    <h5 class="info-title">Jam Operasional</h5>
                    <p class="info-text">
                        Senin - Minggu<br>
                        <b>Buka 24 Jam</b>
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-5">
            <h4 class="fw-bold mb-3"><i class="fa-solid fa-map-location text-accent me-2"></i> Lokasi Kami</h4>
            <div class="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.239637762699!2d107.1084!3d-6.3630!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e6997f023456789%3A0x123456789abcdef!2sPerumahan%20Mega%20Regency%20Cikarang!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                    width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</section>

<footer class="footer-section">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mb-4">
                <h4 class="fw-bold mb-3 text-white">HYP <span class="text-accent">GARAGE</span></h4>
                <p class="small text-secondary">Rental mobil sport & premium terbaik di Cikarang. Melayani sepenuh hati 24 Jam.</p>
            </div>
            <div class="col-md-3 mb-4">
                <h5 class="fw-bold mb-3 text-white">Links</h5>
                <a href="index.php" class="footer-link">Home</a>
                <a href="about.php" class="footer-link">About</a>
                <a href="contact.php" class="footer-link">Contact</a>
            </div>
            <div class="col-md-4 mb-4">
                <h5 class="fw-bold mb-3 text-white">Find Us</h5>
                <p class="small text-secondary mb-2">Jl. Flamboyan No. 14, Mega Regency, Cikarang</p>
            </div>
        </div>
        <hr style="border-color: rgba(255,255,255,0.1);">
        <div class="text-center small text-secondary">
            &copy; 2026 HYP Garage Cikarang. All Rights Reserved.
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>