<?php
$servername = "localhost";
$username = "root";
$password = ""; // Update dengan password MySQL Anda
$dbname = "rfid_data";

// Buat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Ambil data dari database
$sql = "SELECT id, timestamp, tag FROM rfid_readings";
$result = $conn->query($sql);

$data = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Kembalikan data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);

// Tutup koneksi
$conn->close();
?>
