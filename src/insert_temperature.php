<?php
$servername = "localhost";
$username = "root";
$password = ""; // Update with your MySQL root password
$dbname = "temperature_data";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle POST request to insert new temperature reading
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['temperature'])) {
    $temperature = $_POST['temperature'];
    
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO temperature_readings (temperature) VALUES (?)");
    $stmt->bind_param("d", $temperature);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Handle GET request to fetch the latest temperature reading
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $sql = "SELECT temperature FROM temperature_readings ORDER BY id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo json_encode($row);
    } else {
        echo json_encode(["temperature" => null]);
    }
}

// Close the connection
$conn->close();
?>
