<?php
require_once 'models/invoiceModel.php';
require_once 'controllers/InvoiceController.php';

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);
$invoiceController = new InvoiceController($invoiceModel);

// Ambil invoice_id dari URL atau formulir
$invoice_id = $_GET['invoice_id'] ?? null;

if (!$invoice_id) {
    die('ID Invoice tidak ditemukan. Silakan coba lagi.');
}

// Ambil data invoice berdasarkan invoice_id
$invoice = $invoiceModel->getInvoiceById($invoice_id);  // Perbaikan di sini

if (!$invoice) {
    die('Detail invoice tidak ditemukan. Silakan coba lagi.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Proses pembayaran
    $payment_method = $_POST['payment_method'] ?? null;

    if (!$payment_method) {
        echo '<div class="alert alert-danger">Silakan pilih metode pembayaran.</div>';
    } else {
        // Perbarui status pembayaran di database
        $paymentUpdated = $invoiceModel->updatePaymentStatus($invoice_id, 'paid');

        if ($paymentUpdated) {
            header('Location: index.php?page=confirmation&invoice_id=' . $invoice_id);
            exit;
        } else {
            echo '<div class="alert alert-danger">Gagal memperbarui status pembayaran. Silakan coba lagi.</div>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Pembayaran</title>
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
    <h2>Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Invoice #<?= htmlspecialchars($invoice['id']) ?></h5>
            <p><strong>Total Harga:</strong> Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></p>
            <form method="POST">
                <div class="mb-3">
                    <label for="payment_method" class="form-label">Metode Pembayaran</label>
                    <select id="payment_method" name="payment_method" class="form-select" required>
                        <option value="">Pilih Metode</option>
                        <option value="credit_card">Kartu Kredit</option>
                        <option value="bank_transfer">Transfer Bank</option>
                        <option value="gerai_transfer">Gerai</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Bayar</button>
            </form>
        </div>
    </div>
</div>
 
</body>
</html>
