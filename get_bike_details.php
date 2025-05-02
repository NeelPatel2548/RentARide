<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentaride";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['bike_no'])) {
    $bike_no = $_GET['bike_no'];
    
    // Get bike details
    $sql = "SELECT * FROM bike WHERE bike_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $bike_no);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $bike = $result->fetch_assoc();
        
        // Display bike details
        echo '<img src="bike_img/' . $bike['bike_img'] . '" alt="' . $bike['bike_name'] . '">';
        echo '<p><strong>Bike Name:</strong> ' . $bike['bike_name'] . '</p>';
        echo '<p><strong>Brand:</strong> ' . $bike['bike_brand'] . '</p>';
        echo '<p><strong>Type:</strong> ' . $bike['bike_type'] . '</p>';
        echo '<p><strong>Fuel:</strong> ' . $bike['bike_fuel'] . '</p>';
        echo '<p><strong>Price per day:</strong> ₹' . $bike['bike_price'] . '</p>';
        echo '<p><strong>Bike Number:</strong> ' . $bike['bike_no'] . '</p>';
    } else {
        echo '<p>Bike not found.</p>';
    }
} else {
    echo '<p>No bike selected.</p>';
}

$conn->close();
?> 