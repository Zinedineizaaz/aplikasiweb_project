<?php
require_once 'libraries/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$userId = $_SESSION['user_id'];
$db = (new Database())->getConnection();

// Ambil data pengguna dari database
$query = "SELECT name, email, profile_pic FROM users WHERE id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $userId);
$stmt->execute();

$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Data pengguna tidak ditemukan.</div></div>";
    exit;
}

// Fungsi untuk menghapus profil
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete_profile'])) {
    $deleteQuery = "DELETE FROM users WHERE id = :user_id";
    $deleteStmt = $db->prepare($deleteQuery);
    $deleteStmt->bindParam(':user_id', $userId);

    if ($deleteStmt->execute()) {
        // Logout pengguna setelah profil dihapus
        session_destroy();
        header('Location: index.php?page=signup');
        exit;
    } else {
        echo "<div class='alert alert-danger'>Gagal menghapus profil. Silakan coba lagi.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Profil Pengguna</title>
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
    <h1>Profil Pengguna</h1>
    <!-- Tampilkan Foto Pengguna -->
    <div class="text-center mb-4">
        <?php if (!empty($user['profile_pic'])): ?>
            <img src="<?= htmlspecialchars($user['profile_pic']) ?>" alt="Foto Profil" class="img-thumbnail" width="150" height="150">
        <?php else: ?>
            <img src="images/profilepics" alt="Foto Default" class="img-thumbnail" width="150" height="150">
        <?php endif; ?>
    </div>
    <table class="table table-bordered">
        <tr>
            <th>Nama</th>
            <td><?= htmlspecialchars($user['name']) ?></td>
        </tr>
        <tr>
            <th>Email</th>
            <td><?= htmlspecialchars($user['email']) ?></td>
        </tr>
    </table>
    <div class="d-flex justify-content-between mt-4">
        <a href="index.php?page=update_profile" class="btn btn-warning">Update Profil</a>
        <form method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus profil ini?');">
            <button type="submit" name="delete_profile" class="btn btn-danger">Hapus Profil</button>
        </form>
    </div>
    <a href="index.php?page=home" class="btn btn-primary mt-3">Kembali ke Home</a>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
