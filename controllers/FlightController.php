<?php
require_once 'models/FlightModel.php';

class FlightController {
    private $flightModel;
    private $db; // Tambahkan properti $db

    public function __construct($flightModel, $db) {
        $this->flightModel = $flightModel;
        $this->db = $db; // Inisialisasi properti $db
    }

    // Ambil daftar penerbangan berdasarkan kata kunci pencarian
    public function getFlights($search = '') {
        return $this->flightModel->getFlights($search);
    }

    // Ambil detail penerbangan berdasarkan ID
    public function getFlightById($flight_id) {
        $query = "SELECT * FROM flights WHERE id = :flight_id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':flight_id', $flight_id, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
?>
