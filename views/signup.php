<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Sign Up</title>
</head>
<body>
<div class="container mt-5">
    <h2>Sign Up</h2>
    <form method="POST" action="index.php?page=signup" enctype="multipart/form-data">
        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $username = $_POST['username'] ?? '';
            $name = $_POST['name'] ?? '';
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $profile_pic = $_FILES['profile_pic'] ?? null;

            if (empty($username) || empty($name) || empty($email) || empty($password) || !$profile_pic) {
                echo '<div class="alert alert-danger">Semua kolom wajib diisi.</div>';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo '<div class="alert alert-danger">Format email tidak valid.</div>';
            } else {
                $uploadDir = 'images/profile_pics';
                $uploadFile = $uploadDir . basename($profile_pic['name']);

                if (move_uploaded_file($profile_pic['tmp_name'], $uploadFile)) {
                    $userController = new UserController((new Database())->getConnection());
                    $message = $userController->signup($username, $name, $email, $password, $uploadFile);

                    echo '<div class="alert alert-info">' . $message . '</div>';

                    if (strpos($message, 'Selamat datang') !== false) {
                        header('Location: index.php?page=home');
                        exit;
                    }
                } else {
                    echo '<div class="alert alert-danger">Gagal mengunggah foto profil.</div>';
                }
            }
        }
        ?>
        <div class="mb-3">
            <label for="username" class="form-label">Username</label>
            <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Full Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <div class="mb-3">
            <label for="profile_pic" class="form-label">Profile Picture</label>
            <input type="file" class="form-control" id="profile_pic" name="profile_pic" required>
        </div>
        <button type="submit" class="btn btn-primary">Sign Up</button>
    </form>
</div>
</body>
</html>