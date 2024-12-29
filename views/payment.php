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
$invoice = $invoiceController->getInvoiceById($invoice_id);

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
        $paymentUpdated = $invoiceController->updatePaymentStatus($invoice_id, 'paid');

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
</head>
<body>
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
                    </select>
                </div>
                <button type="submit" class="btn btn-success">Bayar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
