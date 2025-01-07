<?php
require_once('C:/xampp/htdocs/aplikasiweb_project/models/InvoiceModel.php');

class InvoiceController {
    private $invoiceModel;

    public function __construct($invoiceModel) {
        $this->invoiceModel = $invoiceModel;
    }

    public function getInvoiceById($invoice_id) {
        return $this->invoiceModel->getInvoiceById($invoice_id);
    }

    public function generateInvoice($booking_id, $total_price, $user_id) {
        return $this->invoiceModel->createInvoice($booking_id, $total_price, $user_id);
    }

    public function calculateTotalPrice($booking_id) {
        return $this->invoiceModel->getTotalPriceByBookingId($booking_id);
        return (float) $total_price;
    }

    public function updatePaymentStatus($invoice_id, $status) {
        return $this->invoiceModel->updatePaymentStatus($invoice_id, $status);
    }
}
