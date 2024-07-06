<?php
session_start();

// Koneksi ke database
$conn = new mysqli("localhost", "root", "", "userdb");

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Mencegah SQL Injection
    $username = stripslashes($username);
    $password = stripslashes($password);
    $username = $conn->real_escape_string($username);
    $password = $conn->real_escape_string($password);

    // Mengambil password yang tersimpan di database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        // Verifikasi password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $username;
            header("Location: index.html");
            exit();
        } else {
            echo "<script>alert('Password salah!'); window.location.href='login.html';</script>";
        }
    } else {
        echo "<script>alert('Username tidak ditemukan!'); window.location.href='login.html';</script>";
    }
}

$conn->close();
?>
