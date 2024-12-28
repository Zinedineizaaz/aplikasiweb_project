<?php
class TicketController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAvailableFlights() {
        $stmt = $this->db->query("SELECT * FROM flights");
        return $stmt->fetchAll();
    }

    public function bookTicket($userId, $flightId) {
        $stmt = $this->db->prepare("INSERT INTO bookings (user_id, flight_id) VALUES (?, ?)");
        $stmt->execute([$userId, $flightId]);
        return $this->db->lastInsertId();
    }
}
?>