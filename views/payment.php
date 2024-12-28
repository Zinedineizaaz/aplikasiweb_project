<?php
require_once 'models/paymentModel.php';
require_once 'controllers/PaymentController.php';

$db = (new Database())->getConnection();
$paymentModel = new PaymentModel($db);
$paymentController = new PaymentController($paymentModel);

$booking_id = $_POST['booking_id'] ?? null;
if (!$booking_id) {
    die('ID pemesanan tidak ditemukan. Silakan kembali ke halaman sebelumnya.');
}

// Proses data pemesanan
$data = $paymentController->processPayment($booking_id);
if (isset($data['error'])) {
    die($data['error']);
}

$booking = $data['booking'];
$flight = $data['flight'];
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <title>Pembayaran</title>
</head>
<body>
<div class="container mt-5">
    <h2>Pembayaran</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($flight['maskapai']) ?></h5>
            <p>Keberangkatan: <?= htmlspecialchars($flight['jadwal_keberangkatan']) ?></p>
            <p>Tujuan: <?= htmlspecialchars($flight['destinasi']) ?></p>
            <p>Harga: Rp <?= number_format($flight['harga'], 2, ',', '.') ?></p>
        </div>
    </div>
    <form method="POST" action="index.php?page=invoice">
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking['id']) ?>">
        <input type="hidden" name="amount" value="<?= htmlspecialchars($flight['harga']) ?>">
        <div class="mb-3">
            <label for="payment_method" class="form-label">Metode Pembayaran</label>
            <select id="payment_method" name="payment_method" class="form-select" required>
                <option value="">Pilih Metode</option>
                <option value="credit_card">Kartu Kredit</option>
                <option value="bank_transfer">Transfer Bank</option>
            </select>
        </div>
        <div class="mb-3">
            <label for="card_number" class="form-label">Nomor Kartu Kredit</label>
            <input type="text" id="card_number" name="card_number" class="form-control" placeholder="16 digit" required>
        </div>
        <button type="submit" class="btn btn-primary">Bayar</button>
    </form>
</div>
</body>
</html>
