<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <title>Beli Tiket</title>
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
                <li class="nav-item">
                    <a class="nav-link active" href="index.php?page=invoice_list">Daftar Invoice</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
    <div class="container mt-5">
        <h2>Beli Tiket</h2>
        <form method="GET" action="index.php" class="mb-3">
            <input type="hidden" name="page" value="buy_ticket">
            <div class="row">
                <div class="col-md-10">
                    <input type="text" class="form-control" name="search" placeholder="Cari berdasarkan keberangkatan, tujuan, atau maskapai" value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
                </div>
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Cari</button>
                </div>
            </div>
        </form>

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Maskapai</th>
                    <th>Keberangkatan</th>
                    <th>Tujuan</th>
                    <th>Waktu Keberangkatan</th>
                    <th>Harga</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require_once 'libraries/database.php';

                $db = (new Database())->getConnection();
                $search = $_GET['search'] ?? '';

                // Query dengan filter pencarian
                $query = "SELECT * FROM flights WHERE 
                          maskapai LIKE :search OR 
                          jadwal_keberangkatan LIKE :search OR 
                          destinasi LIKE :search";
                $stmt = $db->prepare($query);
                $searchTerm = "%$search%";
                $stmt->bindParam(':search', $searchTerm);
                $stmt->execute();

                $flights = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($flights):
                    foreach ($flights as $flight): ?>
                        <tr>
                            <td><?= htmlspecialchars($flight['maskapai']) ?></td>
                            <td><?= htmlspecialchars($flight['jadwal_keberangkatan']) ?></td>
                            <td><?= htmlspecialchars($flight['destinasi']) ?></td>
                            <td><?= htmlspecialchars($flight['jadwal_kedatangan']) ?></td>
                            <td>Rp <?= number_format($flight['harga'], 2, ',', '.') ?></td>
                            <td>
                                <a href="index.php?page=confirm_ticket&flight_id=<?= $flight['id'] ?>" class="btn btn-success btn-sm">Pesan</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">Penerbangan tidak ditemukan.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>