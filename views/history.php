<?php
require_once 'libraries/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

// Koneksi ke database
$db = (new Database())->getConnection();
$userId = $_SESSION['user_id'];

// Proses penghapusan invoice
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_invoice_id'])) {
    $invoiceId = $_POST['delete_invoice_id'];

    // Query untuk menghapus invoice
    $deleteQuery = "DELETE FROM invoices WHERE id = :invoice_id AND user_id = :user_id";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bindParam(':invoice_id', $invoiceId, PDO::PARAM_INT);
    $deleteStmt->bindParam(':user_id', $userId, PDO::PARAM_INT);

    if ($deleteStmt->execute()) {
        $message = "Invoice berhasil dihapus.";
    } else {
        $message = "Gagal menghapus invoice. Silakan coba lagi.";
    }
}

// Ambil data invoice dari tabel invoices
$query = "SELECT 
            id AS invoice_id, 
            booking_id, 
            total_price, 
            payment_status, 
            invoice_date
          FROM invoices 
          WHERE user_id = :user_id
          ORDER BY invoice_date DESC";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Histori Pembelian</title>
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
        .alert {
            border-radius: 10px;
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
    <h1>Histori Pembelian</h1>
    <?php if (count($invoices) > 0): ?>
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>ID Invoice</th>
                    <th>ID Pemesanan</th>
                    <th>Total Harga</th>
                    <th>Status Pembayaran</th>
                    <th>Tanggal Dibuat</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($invoices as $invoice): ?>
                    <tr>
                        <td><?= htmlspecialchars($invoice['invoice_id']) ?></td>
                        <td><?= htmlspecialchars($invoice['booking_id']) ?></td>
                        <td>Rp <?= number_format($invoice['total_price'], 0, ',', '.') ?></td>
                        <td><?= htmlspecialchars($invoice['payment_status']) ?></td>
                        <td><?= htmlspecialchars($invoice['invoice_date']) ?></td>
                        <td>
                            <form method="POST" onsubmit="return confirm('Yakin ingin menghapus invoice ini?');">
                                <input type="hidden" name="delete_invoice_id" value="<?= htmlspecialchars($invoice['invoice_id']) ?>">
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <div class="alert alert-info">Anda belum memiliki riwayat pembelian.</div>
    <?php endif; ?>
    <a href="index.php?page=home" class="btn btn-primary">Kembali ke Home</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
