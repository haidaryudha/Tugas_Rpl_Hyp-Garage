<?php
// --- SETTING & KONEKSI ---
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!file_exists('koneksi.php')) {
    die('File koneksi.php tidak ditemukan!');
}
include 'koneksi.php';

// Cek Login
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['status']) || $_SESSION['status'] != "login"){
    header("location:login.php?pesan=Silahkan Login Dulu");
    exit();
}

// Ambil Data Mobil yang dipilih
$id_mobil = $_GET['id'];
$query = mysqli_query($conn, "SELECT * FROM mobil WHERE id_mobil = '$id_mobil'");
$data = mysqli_fetch_array($query);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Booking - HYP Garage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #1a1a1a; /* Background Hitam Garage */
            color: #333;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Kartu Form */
        .card-booking {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 20px 50px rgba(0,0,0,0.5); /* Bayangan tebal biar pop-up */
            width: 100%;
            max-width: 500px;
            overflow: hidden;
            border-top: 5px solid #d32f2f; /* Garis Merah di atas */
        }

        .card-header {
            background-color: #fff;
            padding: 30px 30px 10px 30px;
            border-bottom: none;
            text-align: center;
        }

        .title-text {
            font-weight: 800;
            text-transform: uppercase;
            font-size: 1.5rem;
            color: #1a1a1a;
            letter-spacing: 1px;
        }
        
        .subtitle-text {
            font-size: 0.9rem;
            color: #777;
        }

        .card-body {
            padding: 20px 40px 40px 40px;
        }

        /* Style Input */
        .form-label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #555;
            text-transform: uppercase;
        }
        
        .form-control {
            background-color: #f8f9fa;
            border: 2px solid #eee;
            border-radius: 8px;
            padding: 12px;
            font-weight: 500;
            transition: 0.3s;
        }
        .form-control:focus {
            background-color: #fff;
            border-color: #d32f2f; /* Fokus warna merah */
            box-shadow: none;
        }
        .form-control[readonly] {
            background-color: #e9ecef;
            color: #1a1a1a;
            font-weight: 700;
            border-color: #ddd;
        }

        /* Tombol */
        .btn-confirm {
            background-color: #d32f2f; /* Merah Racing */
            color: white;
            font-weight: 700;
            border: none;
            padding: 12px;
            border-radius: 8px;
            text-transform: uppercase;
            letter-spacing: 1px;
            width: 100%;
            margin-top: 10px;
            transition: 0.3s;
        }
        .btn-confirm:hover {
            background-color: #b71c1c;
            transform: translateY(-2px);
        }

        .btn-cancel {
            background-color: #333;
            color: white;
            font-weight: 600;
            border: none;
            padding: 12px;
            border-radius: 8px;
            width: 100%;
            margin-top: 10px;
            text-decoration: none;
            display: block;
            text-align: center;
            transition: 0.3s;
        }
        .btn-cancel:hover {
            background-color: #000;
            color: #fff;
        }

        .car-preview {
            display: flex;
            align-items: center;
            background: #f1f1f1;
            padding: 10px;
            border-radius: 8px;
            margin-bottom: 20px;
        }
        .car-icon {
            font-size: 1.5rem;
            color: #d32f2f;
            margin-right: 15px;
            margin-left: 10px;
        }
    </style>
</head>
<body>

<div class="card card-booking">
    <div class="card-header">
        <h3 class="title-text">Booking Confirmation</h3>
        <p class="subtitle-text">Complete the form to secure your ride.</p>
    </div>

    <div class="card-body">
        <form action="" method="POST">
            
            <div class="car-preview">
                <i class="fa-solid fa-car car-icon"></i>
                <div>
                    <small class="text-muted d-block">Selected Unit:</small>
                    <span class="fw-bold text-dark"><?php echo $data['nama_mobil']; ?></span>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Customer Name</label>
                <input type="text" name="nama" class="form-control" placeholder="Enter full name" required autocomplete="off">
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label class="form-label">Rental Date</label>
                    <input type="date" name="tanggal" class="form-control" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label class="form-label">Duration (Days)</label>
                    <input type="number" name="lama" class="form-control" placeholder="1" min="1" required>
                </div>
            </div>

            <button type="submit" name="sewa" class="btn btn-confirm">
                CONFIRM BOOKING <i class="fa-solid fa-check ms-1"></i>
            </button>
            <a href="index.php" class="btn btn-cancel">CANCEL</a>
        </form>

        <?php
        if(isset($_POST['sewa'])){
            $nama = $_POST['nama'];
            $tgl  = $_POST['tanggal'];
            $lama = $_POST['lama'];

            // Masukkan ke tabel sewa
            $insert = mysqli_query($conn, "INSERT INTO sewa VALUES (NULL, '$nama', '$id_mobil', '$tgl', '$lama')");

            // Update status mobil jadi 'Disewa' (Atau 'Booked' jika mau konsisten bahasa Inggris)
            $update = mysqli_query($conn, "UPDATE mobil SET status='Disewa' WHERE id_mobil='$id_mobil'");

            if($insert && $update){
                echo "<script>
                    alert('Booking Success! Unit secured.'); 
                    window.location='index.php';
                </script>";
            } else {
                echo "<script>alert('Booking Failed. Please try again.');</script>";
            }
        }
        ?>
    </div>
</div>

</body>
</html>