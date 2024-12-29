<?php
require_once 'models/invoiceModel.php';
require_once 'controllers/InvoiceController.php';

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);
$invoiceController = new InvoiceController($invoiceModel);

// Ambil invoice_id dari URL
$invoice_id = $_GET['invoice_id'] ?? null;

if (!$invoice_id) {
    die('ID Invoice tidak ditemukan. Silakan coba lagi.');
}

// Ambil data invoice berdasarkan invoice_id
$invoice = $invoiceController->getInvoiceById($invoice_id);

if (!$invoice) {
    die('Detail invoice tidak ditemukan. Silakan coba lagi.');
}

// Pastikan status pembayaran adalah "paid"
if ($invoice['payment_status'] !== 'paid') {
    die('Pembayaran belum selesai. Silakan lakukan pembayaran terlebih dahulu.');
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Konfirmasi Pembayaran</title>
</head>
<body>
<div class="container mt-5">
    <h2>Konfirmasi Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Pembayaran Berhasil</h5>
            <p>Terima kasih atas pembayaran Anda. Berikut adalah detail invoice:</p>
            <table class="table">
                <tr>
                    <th>ID Invoice</th>
                    <td><?= htmlspecialchars($invoice['id']) ?></td>
                </tr>
                <tr>
                    <th>ID Pemesanan</th>
                    <td><?= htmlspecialchars($invoice['booking_id']) ?></td>
                </tr>
                <tr>
                    <th>Tanggal Invoice</th>
                    <td><?= htmlspecialchars($invoice['invoice_date']) ?></td>
                </tr>
                <tr>
                    <th>Total Harga</th>
                    <td>Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></td>
                </tr>
                <tr>
                    <th>Status Pembayaran</th>
                    <td><span class="badge bg-success">Lunas</span></td>
                </tr>
            </table>
            <a href="index.php?page=home" class="btn btn-primary mt-3">Kembali ke Beranda</a>
        </div>
    </div>
</div>
</body>
</html>
