<?php
class PaymentModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getBookingById($booking_id) {
        $query = "SELECT * FROM bookings WHERE id = :booking_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getFlightById($flight_id) {
        $query = "SELECT * FROM flights WHERE id = :flight_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':flight_id', $flight_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function updatePaymentStatus($booking_id, $status) {
        $query = "UPDATE bookings SET payment_status = :status WHERE id = :booking_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':booking_id', $booking_id);
        return $stmt->execute();
    }

    public function getInvoiceData($booking_id) {
        $query = "
            SELECT b.id AS booking_id, b.booking_date, b.payment_status,
                   f.maskapai, f.jadwal_keberangkatan, f.destinasi, f.jadwal_kedatangan, f.harga
            FROM bookings b
            JOIN flights f ON b.flight_id = f.id
            WHERE b.id = :booking_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    
}
?>
