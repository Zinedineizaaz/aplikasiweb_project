<?php
class InvoiceModel {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getInvoiceByBookingId($booking_id) {
        $query = "SELECT * FROM invoices WHERE booking_id = :booking_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->execute();
        var_dump($stmt->errorInfo()); // Tambahkan ini
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createInvoice($booking_id, $total_price) {
        $query = "INSERT INTO invoices (booking_id, total_price) VALUES (:booking_id, :total_price)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':total_price', $total_price);
        return $stmt->execute();
    }
}
?>