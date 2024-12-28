<?php
require_once 'libraries/database.php';

$db = (new Database())->getConnection();
$flight_id = $_GET['flight_id'] ?? null;
$flight = null;

if ($flight_id) {
    // Ambil detail penerbangan berdasarkan ID
    $query = "SELECT * FROM flights WHERE id = :flight_id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':flight_id', $flight_id);
    $stmt->execute();
    $flight = $stmt->fetch(PDO::FETCH_ASSOC);
}

if (!$flight) {
    die('Penerbangan tidak ditemukan. Silakan pilih penerbangan yang valid.');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Konfirmasi Tiket</title>
</head>
<body>
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
    <?php
    // Simpan data pemesanan
    $query = "INSERT INTO bookings (flight_id, user_id) VALUES (:flight_id, :user_id)";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':flight_id', $flight['id']);
    $stmt->bindParam(':user_id', $_SESSION['user_id']);
    $stmt->execute();

    $booking_id = $db->lastInsertId();
    ?>
    <form method="POST" action="index.php?page=payment">
        <input type="hidden" name="booking_id" value="<?= htmlspecialchars($booking_id) ?>">
        <button type="submit" class="btn btn-success mt-3">Lanjutkan ke Pembayaran</button>
    </form>
</div>
</body>
</html>
