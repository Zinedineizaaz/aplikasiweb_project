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
    
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getInvoiceById($invoice_id) {
        // Menghapus referensi ke properti $this->table, dan langsung menggunakan nama tabel "invoices"
        $query = "SELECT * FROM invoices WHERE id = :invoice_id LIMIT 1";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':invoice_id', $invoice_id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createInvoice($booking_id, $total_price, $user_id) {
        $query = "INSERT INTO invoices (booking_id, total_price, user_id) VALUES (:booking_id, :total_price, :user_id)";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->bindParam(':total_price', $total_price);
        $stmt->bindParam(':user_id', $user_id);
        return $stmt->execute();
    }

    public function getTotalPriceByBookingId($booking_id) {
        $query = "
            SELECT f.harga
            FROM bookings b
            JOIN flights f ON b.flight_id = f.id
            WHERE b.id = :booking_id
        ";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':booking_id', $booking_id);
        $stmt->execute();
    
        // Ambil harga
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['harga'] ?? 0; // Kembalikan harga atau 0 jika tidak ditemukan
    }

    public function updatePaymentStatus($invoice_id, $status) {
        $query = "UPDATE invoices SET payment_status = :status WHERE id = :invoice_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':invoice_id', $invoice_id);
        return $stmt->execute();
    }
}
?>
