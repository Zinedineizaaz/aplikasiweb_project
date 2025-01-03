<?php
require_once 'models/invoiceModel.php';
require_once 'controllers/InvoiceController.php';

$db = (new Database())->getConnection();
$invoiceModel = new InvoiceModel($db);
$invoiceController = new InvoiceController($invoiceModel);

$booking_id = $_POST['booking_id'] ?? null;
$user_id = $_SESSION['user_id'] ?? null;

if (!$booking_id) {
    die('ID pemesanan tidak ditemukan. Silakan kembali ke halaman sebelumnya.');
}

if (!$user_id) {
    die('User ID tidak ditemukan. Silakan login kembali.');
}

// Ambil data invoice dari tabel invoices
$invoice = $invoiceController->getInvoiceByBookingId($booking_id);

// Jika invoice tidak ditemukan, buat invoice baru
if (!$invoice) {
    $total_price = $invoiceController->calculateTotalPrice($booking_id); // Hitung harga total

    if ($total_price <= 0) {
        die('Gagal menghitung total harga. Silakan coba lagi.');
    }

    $invoiceCreated = $invoiceController->generateInvoice($booking_id, $total_price, $user_id);

    if ($invoiceCreated) {
        $invoice = $invoiceController->getInvoiceByBookingId($booking_id);
    } else {
        die('Gagal membuat invoice. Silakan coba lagi.');
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Invoice</title>
</head>
<body>
<div class="container mt-5">
    <h2>Invoice Pemesanan</h2>
    <table class="table table-bordered mt-4">
        <thead>
            <tr>
                <th>ID Invoice</th>
                <th>ID Pemesanan</th>
                <th>Tanggal Invoice</th>
                <th>Total Harga</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><?= htmlspecialchars($invoice['id']) ?></td>
                <td><?= htmlspecialchars($invoice['booking_id']) ?></td>
                <td><?= htmlspecialchars($invoice['invoice_date']) ?></td>
                <td>Rp <?= number_format($invoice['total_price'], 2, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>
    <button onclick="window.print()" class="btn btn-secondary mt-3">Cetak Invoice</button>
    <a href="index.php?page=home" class="btn btn-primary mt-3">Kembali ke Beranda</a>
</div>
</body>
</html>
