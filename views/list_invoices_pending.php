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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet"> <!-- Menambahkan Font Awesome -->
    <title>Daftar Invoice Pending dan Failed</title>
</head>
<body>
<div class="container mt-5">
    <h2>Daftar Invoice (Pending dan Failed)</h2>
    
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
</div>

<!-- Menambahkan Bootstrap JS dan Popper.js untuk Modal -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
</body>
</html>
