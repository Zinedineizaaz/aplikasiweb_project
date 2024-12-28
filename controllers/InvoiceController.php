<?php
require_once 'models/InvoiceModel.php';

class InvoiceController {
    private $invoiceModel;

    public function __construct($invoiceModel) {
        $this->invoiceModel = $invoiceModel;
    }

    // Retrieve invoice by booking ID
    public function getInvoiceByBookingId($booking_id) {
        return $this->invoiceModel->getInvoiceByBookingId($booking_id);
    }

    // Generate a new invoice
    public function generateInvoice($booking_id, $total_price) {
        return $this->invoiceModel->createInvoice($booking_id, $total_price);
    }
}
