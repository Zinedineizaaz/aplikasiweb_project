<?php
require_once 'libraries/database.php';
require_once 'models/invoiceModel.php';

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);

// Ambil daftar invoice dengan status pending atau failed
$query = "SELECT * FROM invoices WHERE payment_status IN ('pending', 'failed')";
$stmt = $db->prepare($query);
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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Menambahkan Font Awesome -->
    <title>Home</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <img src="/docs/5.0/assets/brand/bootstrap-logo.svg" alt="" width="30" height="24" class="d-inline-block align-text-top">
        <a class="navbar-brand" href="index.php?page=home">Aplikasi Tiket</a>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=login">Login</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=signup">Sign Up</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php?page=buy_ticket">Beli Tiket</a>
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
    <?php if (isset($_SESSION['name'])): ?>
        <div class="alert alert-success">
            Selamat datang, <?= htmlspecialchars($_SESSION['name']) ?>!
        </div>
    <?php else: ?>
        <div class="alert alert-info">Silakan login atau daftar untuk melanjutkan.</div>
    <?php endif; ?>
    <h1>Welcome to Flight Booking</h1>
    <p>Book your flight tickets easily and quickly.</p>
    <a href="index.php?page=buy_ticket" class="btn btn-primary">Buy Ticket</a>
</div>

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
                                <th>ID Pengguna</th>
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
                                    <td><?= htmlspecialchars($invoice['user_id']) ?></td>
                                    <td>Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></td>
                                    <td>
                                        <?= htmlspecialchars($invoice['payment_status']) ?>
                                    </td>
                                    <td>
                                        <a href="payment.php?invoice_id=<?= htmlspecialchars($invoice['id']) ?>" class="btn btn-success">Bayar</a>
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

<!-- Menambahkan Bootstrap JS dan Popper.js untuk Modal -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
