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
</head>
<body>
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
</body>
</html>
