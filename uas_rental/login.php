<?php
// --- LOGIN PAGE - HYP GARAGE THEME ---
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!file_exists('koneksi.php')) {
    die('<div class="alert alert-danger">Fatal Error: File <b>koneksi.php</b> tidak ditemukan!</div>');
}

include 'koneksi.php';

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Kalau sudah login, lempar ke dashboard
if(isset($_SESSION['status']) && $_SESSION['status'] == "login"){
    header("location:index.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <title>Login Admin - HYP Garage</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            /* Background Hitam-Abu Gradasi (Khas HYP Garage) */
            background: linear-gradient(135deg, #1a1a1a 0%, #2c3e50 100%);
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card-login {
            background: #fff;
            border: none;
            border-radius: 15px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.5); /* Bayangan lebih gelap */
            width: 100%;
            max-width: 420px;
            overflow: hidden;
            border-top: 5px solid #d32f2f; /* Garis Merah Racing di atas */
        }

        .login-header {
            padding: 40px 30px 20px 30px;
            text-align: center;
        }

        .brand-logo {
            font-size: 2.5rem;
            color: #1a1a1a;
            margin-bottom: 10px;
        }
        
        /* Warna Merah untuk Aksen */
        .text-accent { color: #d32f2f; }

        .brand-text {
            font-weight: 800;
            color: #1a1a1a;
            letter-spacing: 2px;
            font-size: 1.8rem;
            text-transform: uppercase;
        }

        .card-body {
            padding: 20px 40px 50px 40px;
        }

        .form-control {
            border-radius: 8px;
            padding: 12px 15px;
            border: 2px solid #eee; /* Border lebih tebal */
            background-color: #f8f9fa;
            font-weight: 500;
            transition: 0.3s;
        }
        .form-control:focus {
            border-color: #d32f2f; /* Fokus jadi Merah */
            box-shadow: none;
            background-color: #fff;
        }

        .input-group-text {
            background: #fff;
            border: 2px solid #eee;
            border-right: none;
            color: #d32f2f; /* Ikon Merah */
        }
        .form-control { border-left: none; }

        .btn-login {
            background-color: #d32f2f; /* Merah HYP */
            border: none;
            border-radius: 50px; /* Tombol bulat lonjong */
            padding: 12px;
            font-weight: 700;
            width: 100%;
            margin-top: 20px;
            transition: 0.3s;
            text-transform: uppercase;
            letter-spacing: 1px;
            box-shadow: 0 5px 15px rgba(211, 47, 47, 0.3);
        }
        .btn-login:hover {
            background-color: #b71c1c; /* Merah Gelap saat hover */
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(211, 47, 47, 0.4);
        }

        .footer-text {
            font-size: 0.75rem;
            color: #888;
            margin-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>

<div class="card card-login">
    
    <div class="login-header">
        <div class="brand-logo">
            <i class="fa-solid fa-gauge-high text-accent"></i>
        </div>
        <h4 class="brand-text">HYP <span class="text-accent">GARAGE</span></h4>
        <p class="text-muted small mb-0">Admin Portal Access</p>
    </div>

    <div class="card-body">
        
        <?php if(isset($_GET['pesan'])) { ?>
            <div class="alert alert-danger text-center py-2 mb-4 shadow-sm" style="font-size: 0.9rem; border-left: 4px solid #b71c1c;">
                <i class="fa-solid fa-circle-exclamation me-1"></i> <?php echo $_GET['pesan']; ?>
            </div>
        <?php } ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label class="form-label fw-bold small text-muted text-uppercase">Username</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-regular fa-user"></i></span>
                    <input type="text" name="user" class="form-control" placeholder="Enter Username" required>
                </div>
            </div>
            
            <div class="mb-4">
                <label class="form-label fw-bold small text-muted text-uppercase">Password</label>
                <div class="input-group">
                    <span class="input-group-text"><i class="fa-solid fa-lock"></i></span>
                    <input type="password" name="pass" class="form-control" placeholder="Enter Password" required>
                </div>
            </div>

            <button type="submit" name="login" class="btn btn-primary btn-login">
                LOGIN SYSTEM <i class="fa-solid fa-arrow-right ms-2"></i>
            </button>
        </form>

        <div class="footer-text">
            &copy; 2026 HYP Garage Cikarang.<br>Premium Rental Management System.
        </div>
    </div>
</div>

<?php
if(isset($_POST['login'])){
    
    if(!isset($conn)){
        die("Error: Koneksi Database Terputus.");
    }

    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $pass = mysqli_real_escape_string($conn, $_POST['pass']);

    $cek = mysqli_query($conn, "SELECT * FROM admin WHERE username='$user' AND password='$pass'");
    
    if($cek && mysqli_num_rows($cek) > 0){
        $_SESSION['status'] = "login";
        echo "<script>
            alert('Welcome Back, Admin!');
            window.location='index.php';
        </script>";
    } else {
        echo "<script>
            window.location='login.php?pesan=Username atau Password Salah!';
        </script>";
    }
}
?>

</body>
</html>