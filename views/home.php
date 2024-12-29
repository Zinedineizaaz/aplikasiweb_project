<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css">
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <title>Home</title>
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
    <div class="container mt-5">
    <?php if (isset($_SESSION['name'])): ?>
        <div class="alert alert-success">
            Selamat datang, <?= htmlspecialchars($_SESSION['name']) ?>!
        </div>
        <?php else: ?>
            <div class="alert alert-info">Silakan login atau daftar untuk melanjutkan.</div>
            <?php endif; ?>
        </div>
        <h1>Welcome to Flight Booking</h1>
        <p>Book your flight tickets easily and quickly.</p>
        <a href="index.php?page=buy_ticket" class="btn btn-primary">Buy Ticket</a>
    </div>
</body>
</html>
