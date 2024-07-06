<?php
// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "userdb");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Username dan password untuk uji coba
$username = 'user';
$password = 'admin';

// Hash password
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Menambahkan pengguna ke database
$sql = "INSERT INTO users (username, password) VALUES ('$username', '$hashed_password')";

if ($conn->query($sql) === TRUE) {
    echo "Pengguna berhasil ditambahkan. Username: $username, Password: $password";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
