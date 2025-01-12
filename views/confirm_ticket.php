<?php
require_once 'libraries/database.php';
require_once 'models/invoiceModel.php'; // Pastikan Anda memuat InvoiceModel

$db = (new Database())->getConnection();

// Ambil data penerbangan berdasarkan ID
$flight_id = $_GET['flight_id'] ?? null;
$flight = null;

if ($flight_id) {
    $query = "SELECT * FROM flights WHERE id = :flight_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':flight_id', $flight_id);
    $stmt->execute();
    $flight = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$flight) {
    die('Penerbangan tidak ditemukan. Silakan pilih penerbangan yang valid.');
}

// Simpan data pemesanan
$query = "INSERT INTO bookings (flight_id, user_id) VALUES (:flight_id, :user_id)";
$stmt = $db->prepare($query);
$stmt->bindParam(':flight_id', $flight['id']);
$stmt->bindParam(':user_id', $_SESSION['user_id']);
$stmt->execute();

$booking_id = $db->lastInsertId();

// Membuat instance InvoiceModel dan membuat invoice
$invoiceModel = new InvoiceModel($db);
$total_price = $invoiceModel->getTotalPriceByBookingId($booking_id);
$invoiceModel->createInvoice($booking_id, $total_price, $_SESSION['user_id']);

// Ambil invoice ID untuk melanjutkan ke pembayaran
$query = "SELECT * FROM invoices WHERE booking_id = :booking_id ORDER BY id DESC LIMIT 1";
$stmt = $db->prepare($query);
$stmt->bindParam(':booking_id', $booking_id);
$stmt->execute();
$invoice = $stmt->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Konfirmasi Tiket</title>
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
    <h2>Konfirmasi Tiket</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title"><?= htmlspecialchars($flight['maskapai']) ?></h5>
            <p>Keberangkatan: <?= htmlspecialchars($flight['jadwal_keberangkatan']) ?></p>
            <p>Tiba: <?= htmlspecialchars($flight['jadwal_kedatangan']) ?></p>
            <p>Tujuan: <?= htmlspecialchars($flight['destinasi']) ?></p>
            <p>Harga: Rp <?= number_format($flight['harga'], 2, ',', '.') ?></p>
        </div>
    </div>
    <form method="POST" action="index.php?page=payment&invoice_id=<?= htmlspecialchars($invoice['id']) ?>">
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_id) ?>">
        <button type="submit" class="btn btn-success mt-3">Lanjutkan ke Pembayaran</button>
    </form>
    <a href="index.php?page=buy_ticket" class="btn btn-primary">Kembali ke Beli Tiket</a>
</div>
</body>
</html>
