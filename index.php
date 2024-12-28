<?php

require_once 'libraries/database.php';
require_once 'controllers/UserController.php';
require_once 'controllers/TicketController.php';
require_once 'controllers/FlightController.php';
require_once 'controllers/PaymentController.php';
require_once 'controllers/InvoiceController.php';

session_start();

$page = $_GET['page'] ?? 'home';

switch ($page) {
    case 'home':
        require_once 'views/home.php';
        break;
    case 'login':
        require_once 'views/login.php';
        break;
    case 'signup':
        require_once 'views/signup.php';
        break;
    case 'buy_ticket':
        require_once 'views/buy_ticket.php';
        break;
    case 'confirm_ticket':
        require_once 'views/confirm_ticket.php';
        break;
    case 'invoice':
        require_once 'views/invoice.php';
        break;
    case 'payment':
        require_once 'views/payment.php';
        break;
    case 'invoice':
        require_once 'views/invoice.php';
        break;
    default:
        echo "404 Page Not Found";
        break;
}
?>
