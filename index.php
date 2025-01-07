<?php

require_once 'libraries/database.php';
require_once 'controllers/UserController.php';
require_once 'controllers/FlightController.php';
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
    case 'payment':
        require_once 'views/payment.php';
        break;
    case 'invoice':
        require_once 'views/invoice.php';
        break;
    case 'confirmation':
        require_once 'views/confirmation.php';
        break;
    case 'invoice_list':
        require_once 'views/list_invoices_pending.php';
        break;
    default:
        echo "404 Page Not Found";
        break;
}
?>
