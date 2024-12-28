<?php

require_once 'models/paymentModel.php';

class PaymentController {
    private $paymentModel;

    public function __construct($paymentModel) {
        $this->paymentModel = $paymentModel;
    }

    public function processPayment($booking_id) {
        $booking = $this->paymentModel->getBookingById($booking_id);
        if (!$booking) {
            return ['error' => 'Detail pemesanan tidak ditemukan.'];
        }

        $flight = $this->paymentModel->getFlightById($booking['flight_id']);
        if (!$flight) {
            return ['error' => 'Detail penerbangan tidak ditemukan.'];
        }

        return ['booking' => $booking, 'flight' => $flight];
    }

    public function confirmPayment($booking_id, $status = 'paid') {
        return $this->paymentModel->updatePaymentStatus($booking_id, $status);
    }

    public function getInvoice($booking_id) {
        return $this->paymentModel->getInvoiceData($booking_id);
    }
}
?>
