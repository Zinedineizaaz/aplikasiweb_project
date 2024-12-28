<?php
class Flight {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getFlights($search = '') {
        $query = "SELECT * FROM flights WHERE maskapai LIKE :search OR jadwal_keberangkatan LIKE :search OR destinasi LIKE :search";
        $stmt = $this->db->prepare($query);
        $searchTerm = "%$search%";
        $stmt->bindParam(':search', $searchTerm);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
