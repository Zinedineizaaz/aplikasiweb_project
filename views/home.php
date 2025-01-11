<?php
require_once 'libraries/database.php';
require_once 'models/invoiceModel.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$userId = $_SESSION['user_id'];

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);

// Ambil daftar invoice dengan status pending atau failed milik user yang sedang login
$query = "SELECT * FROM invoices WHERE user_id = :user_id AND payment_status IN ('pending', 'failed')";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $userId);
$stmt->execute();

// Ambil semua invoice yang sesuai
$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
$pendingInvoicesCount = count($invoices);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <title>Home</title>
    <style>
        body {
            background: #f2f3f5;
            font-family: 'Arial', sans-serif;
        }
        .navbar {
            background: rgb(0, 0, 0);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .navbar .navbar-brand {
            font-weight: bold;
            color: black !important;
        }
        .navbar .nav-link {
            color: black !important;
        }
        .navbar .nav-link:hover {
            color: #ffdd57 !important;
        }
        .promo-section img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .promo-section img:hover {
            transform: scale(1.1);
        }
        .promo-section h3 {
            font-size: 1.5rem;
            font-weight: bold;
            margin-top: 15px;
        }
        .promo-section p {
            font-size: 1rem;
            font-weight: 600;
            color: #555;
        }
        .card img {
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card img:hover {
            transform: scale(1.1);
        }
        .card {
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
            border-radius: 10px;
            transition: transform 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
        }
        .card-title {
            font-size: 1.2rem;
            font-weight: bold;
        }
        footer {
            background: #add8e6;
            color: black;
            padding: 20px 0;
            text-align: center;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }
        .alert {
            border-radius: 10px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="https://imgbb.com/">
            <img src="https://i.ibb.co.com/Ky6nmpt/logo-z.png" alt="Logo" width="30" height="24" class="d-inline-block align-text-top">
        </a>
        <a class="navbar-brand" href="index.php?page=home">ZiluyaTravel</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=signup">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=buy_ticket">Beli Tiket</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=about_me">Tentang Kami</a>
                </li>
                <!-- Tambahan Dropdown Dashboard -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Dashboard
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="index.php?page=profile">Profil Pengguna</a></li>
                        <li><a class="dropdown-item" href="index.php?page=history">Histori Pembelian</a></li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Simbol Lonceng dengan Notifikasi Angka -->
        <div class="d-flex align-items-center">
            <i class="fas fa-bell" style="font-size: 24px;" data-bs-toggle="modal" data-bs-target="#invoiceModal"></i> 
            <?php if ($pendingInvoicesCount > 0): ?>
                <span class="badge bg-danger ms-2"><?= $pendingInvoicesCount ?></span>
            <?php endif; ?>
        </div>
    </div>
</nav>

<div class="container mt-5">
    <div class="alert alert-success">
        Selamat datang, <?= htmlspecialchars($_SESSION['name']) ?>!
    </div>
    <h1>Welcome to ZiluyaTravel</h1>
    <p>Book your flight tickets easily and quickly.</p>
    <a href="index.php?page=buy_ticket" class="btn btn-primary">Buy Ticket</a>
</div>

<section class="promo-section mt-5 text-center">
        <div class="row">
            <div class="col-md-6">
                <img src="https://th.bing.com/th/id/OIP.7xB3aruyDEBgZVQz9UvxTgHaHa?w=187&h=187&c=7&r=0&o=5&pid=1.7" alt="Promo 30%">
                <h3>Promo 10%</h3>
                <p>Nikmati promo nya hanya sampai 20 Januari aja lohh!! Yuk langsung beli tiket sekarang dan dapatkan promonya!</p>
            </div>
            <div class="col-md-6">
                <img src="https://th.bing.com/th/id/OIP.7xB3aruyDEBgZVQz9UvxTgHaHa?w=187&h=187&c=7&r=0&o=5&pid=1.7" alt="Promo 50%">
                <h3>Promo 10%</h3>
                <p>Nikmati promo nya hanya sampai 20 Januari aja lohh!! Yuk langsung beli tiket sekarang dan dapatkan promonya!</p>
            </div>
        </div>
    </section>
    <section class="rekomendasi-wisata mt-5">
        <h2 class="text-center mb-4">Rekomendasi Wisata</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn-elle.ladmedia.fr/var/plain_site/storage/images/loisirs/evasion/plus-belles-iles-du-monde/bali-en-indonesie/64662514-1-fre-FR/Bali-en-Indonesie.jpg" class="card-img-top" alt="Bali">
                    <div class="card-body">
                        <h5 class="card-title">Bali</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://th.bing.com/th/id/OIP.olq7ecL65-F_beD0SdF7YwHaE7?rs=1&pid=ImgDetMain" class="card-img-top" alt="Bromo">
                    <div class="card-body">
                        <h5 class="card-title">Bromo</h5>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <img src="https://cdn.generationvoyage.fr/2023/05/visiter-raja-ampat-indonesie.jpg" class="card-img-top" alt="Raja Ampat">
                    <div class="card-body">
                        <h5 class="card-title">Raja Ampat</h5>
                    </div>
                </div>
            </div>
        </div>
    </section>

<!-- Modal untuk Menampilkan Daftar Invoice -->
<div class="modal fade" id="invoiceModal" tabindex="-1" aria-labelledby="invoiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="invoiceModalLabel">Daftar Invoice Pending dan Failed</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <?php if ($pendingInvoicesCount > 0): ?>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>ID Invoice</th>
                                <th>ID Pemesanan</th>
                                <th>Total Harga</th>
                                <th>Status Pembayaran</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($invoices as $invoice): ?>
                                <tr>
                                    <td><?= htmlspecialchars($invoice['id']) ?></td>
                                    <td><?= htmlspecialchars($invoice['booking_id']) ?></td>
                                    <td>Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></td>
                                    <td>
                                        <?= htmlspecialchars($invoice['payment_status']) ?>
                                    </td>
                                    <td>
                                        <a href="index.php?page=payment&invoice_id=<?= htmlspecialchars($invoice['id']) ?>" class="btn btn-success">Bayar</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                <?php else: ?>
                    <p>Tidak ada invoice dengan status pending atau failed.</p>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
<footer>
    <p>&copy; 2025 ZiluyaTravel. All rights reserved.</p>
</footer>

<!-- Menambahkan Bootstrap JS dan Popper.js untuk Modal -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
