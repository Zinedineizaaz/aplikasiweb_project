<?php
require_once 'models/invoiceModel.php';
require_once 'controllers/InvoiceController.php';

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);
$invoiceController = new InvoiceController($invoiceModel);

// Ambil invoice_id dari URL
$invoice_id = $_GET['invoice_id'] ?? null;

if (!$invoice_id) {
    die('Invoice tidak ditemukan.');
}

// Ambil data invoice berdasarkan invoice_id
$invoice = $invoiceController->getInvoiceById($invoice_id);

if (!$invoice) {
    die('Detail invoice tidak ditemukan.');
}

?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Konfirmasi Pembayaran</title>
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
        footer {
            background-color: #f0f8ff;
            color: #004080;
            padding: 20px 0;
        }
        .alert {
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a href="https://imgbb.com/"><img src="https://i.ibb.co.com/Ky6nmpt/logo-z.png" alt="" width="30" height="24" class="d-inline-block align-text-top">
        <a class="navbar-brand" href="index.php?page=home">ZiluyaTravel</a>
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
    </div>
</nav>
<div class="container mt-5">
    <h2>Konfirmasi Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoice #<?= htmlspecialchars($invoice['id']) ?></h5>
            <p><strong>Total Harga:</strong> Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></p>
            <p><strong>Status Pembayaran:</strong> <?= htmlspecialchars($invoice['payment_status']) ?></p>
            <p><strong>Metode Pembayaran:</strong> <?= htmlspecialchars($invoice['payment_method']) ?></p>
            <p><strong>Waktu Pembayaran:</strong> <?= htmlspecialchars($invoice['invoice_date']) ?></p>
        </div>
    </div>
    <a href="index.php" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
<footer>
    <p>&copy; 2025 ZiluyaTravel. All rights reserved.</p>
</footer>
</body>
</html>
