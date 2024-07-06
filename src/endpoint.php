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

// Ambil data dari POST request
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $tag = $_POST['tag'];
    
    // Siapkan dan bind
    $stmt = $conn->prepare("INSERT INTO rfid_readings (tag) VALUES (?)");
    $stmt->bind_param("s", $tag);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
