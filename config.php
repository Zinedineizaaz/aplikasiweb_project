<?php
// Konfigurasi koneksi database
$host = 'localhost';
$dbname = 'ticket_booking';
$username = 'root';
$password = '';

try {
    // Membuat koneksi ke database
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Memuat file JSON
    $jsonFile = 'data/flights_data.json'; //
    $flightsData = json_decode(file_get_contents($jsonFile), true);

    // Query untuk memasukkan data
    $query = "
        INSERT INTO flights (id, maskapai, jadwal_keberangkatan, jadwal_kedatangan, estimasi_penerbangan, harga, destinasi) 
        VALUES (:id, :maskapai, :jadwal_keberangkatan, :jadwal_kedatangan, :estimasi_penerbangan, :harga, :destinasi)
    ";

    $stmt = $pdo->prepare($query);

    // Memasukkan data JSON ke database
    foreach ($flightsData as $flight) {
        $stmt->execute([
            ':id' => $flight['id'],
            ':maskapai' => $flight['maskapai'],
            ':jadwal_keberangkatan' => $flight['jadwal_keberangkatan'],
            ':jadwal_kedatangan' => $flight['jadwal_kedatangan'],
            ':estimasi_penerbangan' => $flight['estimasi_penerbangan'],
            ':harga' => $flight['harga'],
            ':destinasi' => $flight['destinasi'] ?? 'N/A'
        ]);
    }

    echo "Data berhasil dimasukkan ke database.\n";

} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
