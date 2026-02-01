<?php
// --- DASHBOARD (INDEX) - HYP GARAGE ---
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!file_exists('koneksi.php')) {
    die('File koneksi.php tidak ditemukan!');
}
include 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php?pesan=Silahkan Login Dulu");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>HYP Garage - Cikarang Premium Rental</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* --- STYLE HYP GARAGE UTAMA --- */
        body { font-family: 'Poppins', sans-serif; background-color: #f4f6f9; color: #333; scroll-behavior: smooth; }

        /* Navbar */
        .navbar { background-color: #fff; box-shadow: 0 4px 12px rgba(0,0,0,0.05); padding: 15px 0; }
        .navbar-brand { font-weight: 800; font-size: 1.6rem; color: #1a1a1a !important; text-transform: uppercase; letter-spacing: 1px; }
        .text-accent { color: #d32f2f; } 
        .nav-link { color: #555 !important; font-weight: 600; margin-left: 20px; }
        .nav-link:hover, .nav-link.active { color: #d32f2f !important; }
        .btn-header-cta { background-color: #d32f2f; color: #fff; font-weight: 700; border-radius: 5px; padding: 8px 25px; border: none; transition: 0.3s; text-decoration: none;}
        .btn-header-cta:hover { background-color: #b71c1c; color: #fff; }

        /* Hero */
        .hero-section { background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%); color: white; padding: 100px 0; position: relative; }
        .hero-title { font-weight: 800; font-size: 3.5rem; line-height: 1.1; margin-bottom: 20px; text-transform: uppercase; }
        .hero-subtitle { font-weight: 300; font-size: 1.2rem; opacity: 0.9; margin-bottom: 30px; }
        .hero-img-container img { width: 100%; max-width: 550px; filter: drop-shadow(0 15px 30px rgba(0,0,0,0.5)); }

        /* Card Mobil */
        .section-header { text-align: center; margin-bottom: 50px; padding-top: 60px; }
        .section-header h2 { font-weight: 800; color: #1a1a1a; text-transform: uppercase; }
        .card-mobil { border: none; border-radius: 15px; background: #fff; box-shadow: 0 5px 15px rgba(0,0,0,0.05); transition: 0.3s; overflow: hidden; margin-bottom: 30px; }
        .card-mobil:hover { transform: translateY(-8px); box-shadow: 0 15px 40px rgba(0,0,0,0.15); }
        .img-mobil-wrap { padding: 20px; height: 190px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; }
        .img-mobil { max-height: 100%; max-width: 100%; object-fit: contain; }
        .card-body { padding: 25px; }
        .mobil-name { font-weight: 700; font-size: 1.2rem; color: #1a1a1a; }
        .harga-text { color: #d32f2f; font-weight: 800; font-size: 1.3rem; margin: 10px 0; }
        .fasilitas-box { background: #fff; border: 1px solid #eee; padding: 10px; border-radius: 8px; font-size: 0.8rem; color: #555; display: flex; justify-content: space-between; margin-bottom: 15px; }
        .btn-sewa { width: 100%; background-color: #1a1a1a; color: white; font-weight: 700; padding: 12px; border-radius: 8px; text-decoration: none; display: inline-block; text-align: center; transition: 0.3s; text-transform: uppercase; }
        .btn-sewa:hover { background-color: #d32f2f; color: #fff; }

        /* CTA Section */
        .cta-section { background-color: #1a1a1a; color: white; text-align: center; padding: 80px 0; margin-top: 50px; }
        .btn-cta-big { background-color: #d32f2f; color: white; padding: 15px 40px; font-size: 1.2rem; font-weight: 700; border-radius: 50px; text-decoration: none; transition: 0.3s; display: inline-block; margin-top: 20px; }
        .btn-cta-big:hover { background-color: white; color: #d32f2f; }

        /* Features Section */
        .features-section { padding: 80px 0; background: #fff; }
        .feature-box { text-align: center; padding: 20px; }
        .feature-icon { font-size: 3rem; color: #d32f2f; margin-bottom: 20px; }
        .feature-title { font-weight: 700; margin-bottom: 10px; }

        /* Testimonials */
        .testi-section { padding: 80px 0; background: #f4f6f9; }
        .testi-card { background: white; padding: 30px; border-radius: 15px; box-shadow: 0 5px 20px rgba(0,0,0,0.05); height: 100%; }
        .user-profile { display: flex; align-items: center; margin-top: 20px; }
        .user-img { width: 50px; height: 50px; border-radius: 50%; background: #ddd; margin-right: 15px; object-fit: cover; }

        /* Footer */
        .footer-section { background-color: #111; color: white; padding: 60px 0 30px 0; }
        .footer-link { color: #888; text-decoration: none; display: block; margin-bottom: 10px; }
        .footer-link:hover { color: #d32f2f; }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg sticky-top">
    <div class="container">
        <a class="navbar-brand" href="#">
            <i class="fa-solid fa-gauge-high text-accent me-2"></i> HYP <span class="text-accent">GARAGE</span>
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-center">
                <li class="nav-item"><a class="nav-link active" href="#">Home</a></li>
                <li class="nav-item"><a class="nav-link" href="about.php">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#armada">Garage</a></li>
                <li class="nav-item"><a class="nav-link" href="contact.php">Contact</a></li>
                <li class="nav-item ms-3">
                    <a href="#armada" class="btn-header-cta shadow-sm">BOOK NOW</a>
                </li>
                <li class="nav-item ms-2">
                    <a href="logout.php" class="nav-link text-danger fw-bold"><i class="fa-solid fa-power-off"></i></a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<section id="home" class="hero-section">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-6 mb-5 mb-md-0">
                <h1 class="hero-title">PREMIUM CARS <br><span class="text-accent">IN CIKARANG</span></h1>
                <p class="hero-subtitle">Sewa mobil sport & premium terbaik di Kawasan Industri Cikarang. Performa tinggi untuk perjalanan bisnis Anda.</p>
                <div class="mt-4">
                    <a href="#armada" class="btn btn-header-cta px-4 py-3 me-2">EXPLORE CARS</a>
                </div>
            </div>
            <div class="col-md-6 text-center hero-img-container">
                <img src="img/f1.jpg" alt="HYP Garage Hero Car">
            </div>
        </div>
    </div>
</section>

<section id="armada">
    <div class="container">
        <div class="section-header">
            <h2>Our Garage</h2>
            <p class="text-muted">Select your dream machine.</p>
        </div>

        <div class="row">
            <?php
            // KODE PHP DATABASE
            $query = "SELECT * FROM mobil ORDER BY harga_per_hari DESC";
            $data = mysqli_query($conn, $query);

            if (mysqli_num_rows($data) == 0) {
                echo '<div class="col-12 text-center text-muted">Garage Empty.</div>';
            } else {
                while($d = mysqli_fetch_array($data)){
                    $gambar = "https://via.placeholder.com/300x200?text=Car+Image"; 
                    if(isset($d['gambar']) && !empty($d['gambar']) && file_exists("img/".$d['gambar'])){
                        $gambar = "img/".$d['gambar'];
                    }
            ?>
            <div class="col-md-4 col-lg-3">
                <div class="card card-mobil h-100">
                    <div class="img-mobil-wrap">
                        <img src="<?php echo $gambar; ?>" class="img-mobil" alt="Foto Mobil">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="mobil-name mb-1"><?php echo $d['nama_mobil']; ?></h5>
                        <div class="text-warning mb-2">
                            <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                        </div>
                        <div class="harga-text">Rp <?php echo number_format($d['harga_per_hari']); ?></div>
                        <div class="fasilitas-box">
                            <span><i class="fa-solid fa-gas-pump text-accent"></i> Full Tank</span>
                            <span><i class="fa-solid fa-gears text-accent"></i> Auto</span>
                        </div>
                        <div class="mt-auto">
                            <?php if($d['status'] == 'Tersedia') { ?>
                                <a href="booking.php?id=<?php echo $d['id_mobil']; ?>" class="btn-sewa">RENT NOW</a>
                            <?php } else { ?>
                                <button class="btn btn-secondary w-100 py-2" disabled>BOOKED</button>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php } } ?>
        </div>
    </div>
</section>

<section class="cta-section">
    <div class="container">
        <h2 class="fw-bold display-5 mb-3">Siap Untuk Perjalanan Anda?</h2>
        <p class="lead opacity-75 mb-4">Jangan tunggu lagi! Booking sekarang dan nikmati pengalaman berkendara premium tak terlupakan di Cikarang.</p>
        <a href="contact.php" class="btn-cta-big shadow">Hubungi Kami Sekarang</a>
    </div>
</section>

<section class="features-section">
    <div class="container">
        <div class="section-header pt-0">
            <h2>Why Choose HYP Garage?</h2>
            <p class="text-muted">Komitmen layanan terbaik untuk setiap perjalanan Anda</p>
        </div>
        <div class="row">
            <div class="col-md-3 feature-box">
                <i class="fa-solid fa-shield-halved feature-icon"></i>
                <h5 class="feature-title">Terpercaya & Aman</h5>
                <p class="small text-muted">Armada terawat, dokumen lengkap, dan asuransi all-risk.</p>
            </div>
            <div class="col-md-3 feature-box">
                <i class="fa-solid fa-clock feature-icon"></i>
                <h5 class="feature-title">Pelayanan 24/7</h5>
                <p class="small text-muted">Siap melayani kapan saja sesuai kebutuhan perjalanan Anda.</p>
            </div>
            <div class="col-md-3 feature-box">
                <i class="fa-solid fa-map-location-dot feature-icon"></i>
                <h5 class="feature-title">Area Cikarang</h5>
                <p class="small text-muted">Spesialis area kawasan industri Cikarang & Jabodetabek.</p>
            </div>
            <div class="col-md-3 feature-box">
                <i class="fa-solid fa-tags feature-icon"></i>
                <h5 class="feature-title">Harga Kompetitif</h5>
                <p class="small text-muted">Harga sewa terbaik untuk kelas mobil premium.</p>
            </div>
        </div>
    </div>
</section>

<section class="testi-section">
    <div class="container">
        <div class="section-header pt-0">
            <h2>Apa Kata Pelanggan</h2>
            <p class="text-muted">Kepuasan pelanggan adalah prioritas kami</p>
        </div>
        <div class="row">
            <div class="col-md-4 mb-4">
                <div class="testi-card">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic">"Pelayanan mantap, mobil bersih dan wangi. Sangat recommended buat yang butuh mobil di Cikarang."</p>
                    <div class="user-profile">
                        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="user-img" alt="User">
                        <div><h6 class="fw-bold m-0">Budi Santoso</h6><small class="text-muted">Manager</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testi-card">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic">"Sewa Alphard buat tamu kantor, drivernya sopan banget dan on time. Sukses terus HYP Garage!"</p>
                    <div class="user-profile">
                        <img src="https://randomuser.me/api/portraits/women/44.jpg" class="user-img" alt="User">
                        <div><h6 class="fw-bold m-0">Siti Aminah</h6><small class="text-muted">HRD</small></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="testi-card">
                    <div class="text-warning mb-3">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <p class="text-muted fst-italic">"Booking gampang, harga masuk akal buat mobil sport. Civic Turbo-nya enak banget dibawa jalan."</p>
                    <div class="user-profile">
                        <img src="https://randomuser.me/api/portraits/men/85.jpg" class="user-img" alt="User">
                        <div><h6 class="fw-bold m-0">Rian Pratama</h6><small class="text-muted">Mahasiswa</small></div>
                    </div>
                </div>
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
                <a href="#" class="footer-link">Home</a>
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