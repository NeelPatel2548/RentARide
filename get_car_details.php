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

if (isset($_GET['car_no'])) {
    $carNo = $_GET['car_no'];
    
    $sql = "SELECT * FROM car WHERE car_no = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $carNo);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        echo '<img src="car_img/' . $row['car_img'] . '" alt="' . $row['car_name'] . '">';
        echo "<p><strong>Car Name:</strong> " . $row['car_name'] . "</p>";
        echo "<p><strong>Car Brand:</strong> " . $row['car_brand'] . "</p>";
        echo "<p><strong>Car Fuel:</strong> " . $row['car_fuel'] . "</p>";
        echo "<p><strong>Price per Day:</strong> ₹" . $row['car_price'] . "</p>";
        echo "<p><strong>Car Number:</strong> " . $row['car_no'] . "</p>";
        echo "<p><strong>Seating Capacity:</strong> " . $row['car_seat'] . " seats</p>";
    } else {
        echo "<p>No car details found.</p>";
    }
    
    $stmt->close();
}

$conn->close();
?> 