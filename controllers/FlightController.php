<?php
require_once 'models/flight.php';

class FlightController {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllFlights($search = '') {
        $flight = new Flight($this->db);
        return $flight->getFlights($search);
    }
}
?>
