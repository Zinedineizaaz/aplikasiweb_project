<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/bootstrap.min.css"/>
    <script type="text/javascript" src="assets/js/bootstrap.js"></script>
    <title>Home</title>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">Flight Booking</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=buy_ticket">Buy Ticket</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=login">Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=signup">Sign Up</a>
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
