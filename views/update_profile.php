<?php
require_once 'libraries/database.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: index.php?page=login');
    exit;
}

$userId = $_SESSION['user_id'];
$db = (new Database())->getConnection();

// Ambil data pengguna saat ini
$query = "SELECT name, email, profile_pic FROM users WHERE id = :user_id";
$stmt = $db->prepare($query);
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    echo "<div class='container mt-5'><div class='alert alert-danger'>Data pengguna tidak ditemukan.</div></div>";
    exit;
}

// Proses pembaruan data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $profilePicture = $user['profile_pic'];

    // Validasi unggahan file
    if (!empty($_FILES['profile_pic']['name'])) {
        $fileExtension = pathinfo($_FILES['profile_pic']['tmp_name'], PATHINFO_EXTENSION);

        if ($_FILES['profile_pic']['size'] > 2 * 1024 * 1024) {
            echo "<div class='alert alert-danger'>Ukuran file terlalu besar. Maksimal 2MB.</div>";
        } else {
            // Pindahkan file ke folder uploads
            $uploadDir = 'images/';
            $newFileName = $uploadDir . uniqid() . '.' . $fileExtension;
            if (move_uploaded_file($_FILES['profile_pic']['tmp_name'], $newFileName)) {
                $profilePicture = $newFileName;
            } else {
                echo "<div class='alert alert-danger'>Gagal mengunggah foto profil.</div>";
            }
        }
    }

    // Perbarui data pengguna di database
    $updateQuery = "UPDATE users SET name = :name, email = :email, profile_pic = :profile_pic WHERE id = :user_id";
    $updateStmt = $db->prepare($updateQuery);
    $updateStmt->bindParam(':name', $name);
    $updateStmt->bindParam(':email', $email);
    $updateStmt->bindParam(':profile_pic', $profilePicture); // Sesuai dengan query
    $updateStmt->bindParam(':user_id', $userId);


    if ($updateStmt->execute()) {
        echo "<div class='alert alert-success'>Profil berhasil diperbarui.</div>";
        // Perbarui data di $user
        $user['name'] = $name;
        $user['email'] = $email;
        $user['profile_pic'] = $profilePicture;
    } else {
        echo "<div class='alert alert-danger'>Gagal memperbarui profil.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Update Profil</title>
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
    <h1>Update Profil</h1>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Nama</label>
            <input type="text" name="name" id="name" class="form-control" value="<?= htmlspecialchars($user['name']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>" required>
        </div>
        <div class="mb-3">
            <label for="profile_pic" class="form-label">Foto Profil</label>
            <input type="file" name="profile_pic" id="profile_pic" class="form-control">
            <?php if (!empty($user['profile_pic'])): ?>
                <img src="<?= htmlspecialchars($user['profile_pic']) ?>" alt="Foto Profil" class="img-thumbnail mt-2" width="150" height="150">
            <?php endif; ?>
        </div>
        <button type="submit" class="btn btn-primary">Simpan</button>
        <a href="index.php?page=profile" class="btn btn-secondary">Kembali</a>
    </form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
