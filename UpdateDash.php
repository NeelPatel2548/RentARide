<?php
session_start();

if (!isset($_SESSION['logged_in'])) {
    header('Location: login.php');
    exit;
}

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentaride";
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn1 = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn1->connect_error) {
    die("Connection failed: " . $conn1->connect_error);
}

$email = $_SESSION['username'];
// SQL query to fetch data from the user table
$sql1 = "SELECT * FROM user WHERE email = '$email'";

// Execute the query
$result1 = $conn1->query($sql1);
$result2 = $conn1->query($sql1);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentARide - User Dashboard</title>
    <link rel="icon" type="image/png" href="images/wheelzonrent-logo.png">
    <link rel="stylesheet" href="assets/css/poppins.css" type="text/css" media="all">
    <link rel="stylesheet" href="assets/css/main.css">
    <link rel="stylesheet" href="assets/css/montserrat.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <style>
        :root {
            --primary-color: #252525;
            --accent-color: #FFD43B;
            --text-color: #292929;
            --light-text: beige;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--text-color);
            background: #f8f9fa;
        }

        /* Header Styles */
        .header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background: var(--primary-color);
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .header-top {
            padding: 0.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .logo img {
            height: 120px;
            width: auto;
            margin-top: -15px;
            margin-bottom: -15px;
            margin-left: 30px;
        }

        .contact-info {
            display: flex;
            align-items: center;
            gap: 2rem;
            color: var(--light-text);
            font-size: 1rem;
            margin-left: 320px;
        }

        .contact-info i {
            color: var(--accent-color);
            font-size: 1.2rem;
            margin-right: 0.5rem;
        }

        .contact-info span {
            display: inline-flex;
            align-items: center;
        }

        .nav-toggle {
            display: none;
            background: transparent;
            border: none;
            color: var(--accent-color);
            font-size: 1.5rem;
            cursor: pointer;
            padding: 0.5rem;
        }

        /* Navigation Styles */
        .nav {
            position: fixed;
            top: 100px;
            left: 0;
            width: 250px;
            height: calc(100vh - 60px);
            background: var(--primary-color);
            padding: 1rem 0;
            transition: var(--transition);
            z-index: 999;
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
            display: flex;
            flex-direction: column;
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .nav-item {
            margin: 0;
            width: 100%;
        }

        .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            color: white;
            text-decoration: none;
            transition: var(--transition);
            border-left: 3px solid transparent;
            font-size: 0.95rem;
            width: 100%;
        }

        .nav-link i {
            margin-right: 1rem;
            width: 20px;
            text-align: center;
        }

        .nav-link:hover,
        .nav-link.active {
            color: var(--accent-color);
            background: rgba(255,255,255,0.1);
            border-left-color: var(--accent-color);
        }

        /* Main Content Styles */
        .main-content {
            margin-left: 250px;
            margin-top: 100px;
            padding: 2rem;
            transition: var(--transition);
            min-height: calc(100vh - 60px - 300px);
            width: calc(100% - 250px);
        }

        /* Dashboard Styles */
        .dashboard-container {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .profile-card {
            background: white;
            border-radius: 15px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            padding: 2rem;
            width: 300px;
            transition: transform 0.3s ease;
        }

        .profile-card:hover {
            transform: translateY(-5px);
        }

        .profile-image {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            margin: 0 auto 1.5rem;
            overflow: hidden;
            border: 5px solid var(--accent-color);
        }

        .profile-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .profile-info {
            text-align: center;
        }

        .profile-info p {
            margin-bottom: 1.2rem;
            display: flex;
            justify-content: space-between;
        }

        .profile-info p span:first-child {
            font-weight: bold;
            color: var(--primary-color);
        }

        .profile-info p:last-child {
            margin-bottom: 0.5rem;
        }

        .dashboard-content {
            flex: 1;
        }

        .dashboard-stats {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .stat-card {
            background: white;
            padding: 1rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            text-align: center;
            transition: transform 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-card i {
            font-size: 2.5rem;
            color: var(--accent-color);
            margin-bottom: 0.1rem;
        }

        .stat-card h3 {
            font-size: 1.1rem;
            margin-bottom: 0.3rem;
            font-weight: 600;
        }
        
        .stat-card p {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 0.3rem;
        }

        .stat-card small {
            display: block;
            color: #666;
            font-size: 0.8rem;
            line-height: 1.3;
            padding: 0 0.5rem;
        }

        .dashboard-title {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .dashboard-title h2 {
            margin: 0 1rem;
        }

        .divider-line {
            width: 50px;
            height: 2px;
            background: #dddddd;
        }

        .history-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            table-layout: fixed;
        }

        .history-table th, 
        .history-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #eee;
            word-wrap: break-word;
        }

        .history-table th {
            background: var(--primary-color);
            color: white;
            position: sticky;
            top: 0;
            z-index: 10;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }

        .history-table th::after {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 2px;
            background: var(--accent-color);
        }

        .history-table tr:hover {
            background: #f9f9f9;
        }

        .action-btn {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 5px;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: var(--transition);
            margin: 0.3rem;
        }

        .action-btn:hover {
            background: #FFD43B;
            transform: translateY(-2px);
        }

        .history-container {
            max-height: 400px;
            overflow-y: auto;
            border-radius: 10px;
            scrollbar-width: none; /* Firefox */
            -ms-overflow-style: none; /* IE and Edge */
            position: relative;
            background: white;
        }
        
        .history-container::-webkit-scrollbar {
            display: none; /* Chrome, Safari, Opera */
        }

        /* Footer Styles */
        .footer {
            background: var(--primary-color);
            color: var(--light-text);
            padding: 3rem 2rem;
            margin-left: 250px;
            transition: var(--transition);
            width: calc(100% - 250px);
            position: relative;
            bottom: 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }

        .footer-section:last-child {
            text-align: right;
        }

        .footer-section:last-child .social-links {
            justify-content: flex-end;
        }

        .footer-section h3 {
            color: var(--accent-color);
            margin-bottom: 1.5rem;
            font-size: 1.5rem;
        }

        .footer-section p {
            margin-bottom: 1rem;
            line-height: 1.8;
        }

        .social-links {
            display: flex;
            gap: 1.5rem;
            margin-top: 1.5rem;
        }

        .social-links i {
            color: var(--accent-color);
            font-size: 1.8rem;
            transition: var(--transition);
            cursor: pointer;
        }

        .social-links i:hover {
            transform: translateY(-3px);
            color: #ff7172;
        }

        /* Overlay */
        .nav-overlay {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 998;
        }

        .nav-overlay.active {
            display: block;
        }

        /* Responsive styles */
        @media (max-width: 768px) {
            .nav {
                left: -250px;
            }

            .nav.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
                width: 100%;
                padding: 1rem;
            }

            .header-top {
                padding: 0.5rem 1rem;
            }

            .logo img {
                height: 60px;
            }

            .contact-info {
                display: none;
            }

            .nav-toggle {
                display: block;
            }

            .footer {
                margin-left: 0;
                width: 100%;
            }

            .footer-grid {
                grid-template-columns: 1fr;
            }

            .footer-section:last-child {
                text-align: center;
            }

            .footer-section:last-child .social-links {
                justify-content: center;
            }

            .dashboard-container {
                flex-direction: column;
            }

            .profile-card {
                width: 100%;
            }
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="header">
        <div class="header-top">
            <div class="logo-container">
                <button class="nav-toggle" id="navToggle">
                    <i class="fas fa-bars"></i>
                </button>
                <div class="logo">
                    <img src="images/logo1_B.png" alt="RentARide Logo">
                </div>
                <div class="contact-info">
                    <i class="fa-solid fa-user"></i>
                    <span>Welcome, <?php echo isset($_SESSION["nameTodisplay"]) ? $_SESSION["nameTodisplay"] : "Guest"; ?></span>
                    <i class="fa-solid fa-phone"></i>
                    <span>+91-7305010188</span>
                    <i class="fa-solid fa-envelope"></i>
                    <span>Info@RentARide.in</span>
                </div>
            </div>
        </div>
    </header>

    <!-- Navigation -->
    <nav class="nav" id="mainNav">
        <ul class="nav-list">
            <li class="nav-item"><a href="index.php" class="nav-link"><i class="fas fa-home"></i>Home</a></li>
            <li class="nav-item"><a href="user_dashboard.php" class="nav-link active"><i class="fas fa-tachometer-alt"></i>Dashboard</a></li>
            <li class="nav-item"><a href="update.php" class="nav-link"><i class="fas fa-user-edit"></i>Update Profile</a></li>
            <li class="nav-item"><a href="cars.php" class="nav-link"><i class="fas fa-car"></i>Cars</a></li>
            <li class="nav-item"><a href="bikes.php" class="nav-link"><i class="fas fa-motorcycle"></i>Bikes</a></li>
            <li class="nav-item"><a href="washing.php" class="nav-link"><i class="fas fa-soap"></i>Washing</a></li>
            <li class="nav-item"><a href="scrapping.php" class="nav-link"><i class="fas fa-recycle"></i>Scrapping</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i>Contact Us</a></li>
            <li class="nav-item"><a href="terms.php" class="nav-link"><i class="fas fa-file-contract"></i>Terms</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class="nav-item" style="background-color: red;"><a href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/01/12/20241101124511-I5H9O04S.json" target="_blank" class="nav-link"><i class="fas fa-question-circle"></i>Need a Help?</a></li>
        </ul>
    </nav>

    <!-- Overlay -->
    <div class="nav-overlay" id="navOverlay"></div>

    <!-- Main Content -->
    <main class="main-content">
        <div class="dashboard-container">
            <div class="profile-card">
                <?php
                // Check if any rows were returned
                if ($result1->num_rows > 0) {
                    while ($row1 = $result1->fetch_assoc()) {
                        echo '<div class="profile-image">';
                        echo '<img src="images\illustrations\profleFemale.png" alt="Profile">';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo "<p><span>Name:</span> <span>" . $row1["user_name"] . "</span></p>";
                        echo "<p><span>WebID:</span> <span>" . $row1["user_id"] . "</span></p>";
                        echo "<p><span>Email:</span> <span>" . $row1["email"] . "</span></p>";
                        echo "<p><span>Contact:</span> <span>" . $row1["contact"] . "</span></p>";
                        echo "<p><span>State:</span> <span>" . $row1["user_state"] . "</span></p>";
                        echo "<p><span>City:</span> <span>" . $row1["user_city"] . "</span></p>";
                        echo '</div>';
                        
                        $bookedCar = $row1["booked_car"];
                        $bookedBike = $row1["booked_bike"];
                        $c_id = $row1["user_id"];
                        $_SESSION['forCar'] = $c_id;
                    }
                } else {
                    echo "No profile data found.";
                }
                ?>
                <a href="update.php" class="action-btn" style="display: block; text-align: center; margin-top: 1rem;">
                    <i class="fas fa-user-edit"></i> Update Profile
                </a>
                <a href="cars.php" class="action-btn" style="display: block; text-align: center; margin-top: 0.8rem;">
                    <i class="fas fa-car"></i> Book Car
                </a>
                <a href="bikes.php" class="action-btn" style="display: block; text-align: center; margin-top: 0.8rem;">
                    <i class="fas fa-motorcycle"></i> Book Bike
                </a>
            </div>
            
            <div class="dashboard-content">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <i class="fas fa-car"></i>
                        <h3>Cars Booked</h3>
                        <p><?php echo isset($bookedCar) ? $bookedCar : 0; ?></p>
                        <small>Cars you've rented from our premium collection</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-motorcycle"></i>
                        <h3>Bikes Booked</h3>
                        <p><?php echo isset($bookedBike) ? $bookedBike : 0; ?></p>
                        <small>Two-wheelers you've enjoyed for your journeys</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-car-side"></i>
                        <h3>Total Booked Vehicles</h3>
                        <p><?php echo isset($bookedCar) && isset($bookedBike) ? $bookedBike + $bookedCar : 0; ?></p>
                        <small>Your complete rental history with us</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-coins"></i>
                        <h3>Total Savings</h3>
                        <p>₹18,000/-</p>
                        <small>Money saved compared to other services</small>
                    </div>
                </div>
                
                <div class="dashboard-title">
                    <div class="divider-line"></div>
                    <h2>Booking History</h2>
                    <div class="divider-line"></div>
                </div>
                
                <div class="history-container">
                    <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Get the current user's ID from the session
                    $currentUserId = $_SESSION['forCar'];
                    echo "<script>console.log('Current User ID: " . $currentUserId . "');</script>";
                    
                    // Prepare and execute the query for cars
                    $carStmt = $conn->prepare("SELECT 
                        b.b_id,
                        b.c_id,
                        b.v_id,
                        c.car_name AS vehicle_model,
                        c.car_brand AS vehicle_color,
                        c.car_trans AS vehicle_type,
                        c.car_fuel AS fuel,
                        c.car_price AS price,
                        c.car_no AS vehicle_no,
                        'Car' as vehicle_category
                    FROM 
                        booking b
                    INNER JOIN car c ON b.v_id = c.car_no
                    WHERE b.c_id = ?");
                    
                    $carStmt->bind_param("i", $currentUserId);
                    $carStmt->execute();
                    $carResult = $carStmt->get_result();

                    // Prepare and execute the query for bikes
                    $bikeStmt = $conn->prepare("SELECT 
                        b.b_id,
                        b.c_id,
                        b.v_id,
                        b1.bike_name AS vehicle_model,
                        b1.bike_brand AS vehicle_color,
                        b1.bike_type AS vehicle_type,
                        b1.bike_fuel AS fuel,
                        b1.bike_price AS price,
                        b1.bike_no AS vehicle_no,
                        'Bike' as vehicle_category
                    FROM 
                        booking b
                    INNER JOIN bike b1 ON b.v_id = b1.bike_no
                    WHERE b.c_id = ?");
                    
                    $bikeStmt->bind_param("i", $currentUserId);
                    $bikeStmt->execute();
                    $bikeResult = $bikeStmt->get_result();

                    // Combine results
                    $allBookings = array();
                    while ($row = $carResult->fetch_assoc()) {
                        $allBookings[] = $row;
                    }
                    while ($row = $bikeResult->fetch_assoc()) {
                        $allBookings[] = $row;
                    }

                    if (count($allBookings) > 0) {
                        echo "<table class='history-table'>";
                        echo "<thead>";
                        echo "<tr><th>Vehicle Category</th><th>Vehicle Name</th><th>Brand</th><th>Vehicle Type</th><th>Fuel</th><th>Price</th><th>Vehicle No</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        foreach ($allBookings as $booking) {
                            echo "<tr>";
                            echo "<td>" . $booking["vehicle_category"] . "</td>";
                            echo "<td>" . $booking["vehicle_model"] . "</td>";
                            echo "<td>" . $booking["vehicle_color"] . "</td>";
                            echo "<td>" . $booking["vehicle_type"] . "</td>";
                            echo "<td>" . $booking["fuel"] . "</td>";
                            echo "<td>₹" . $booking["price"] . "/day</td>";
                            echo "<td>" . $booking["vehicle_no"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p style='text-align: center; padding: 2rem;'>No booking history found.</p>";
                    }

                    // Close the prepared statements
                    $carStmt->close();
                    $bikeStmt->close();
                    ?>
                </div>
            </div>
        </div>
    </main>

    <!-- Footer -->
    <footer class="footer">
        <div class="footer-grid">
            <div class="footer-section">
                <h3>About Us</h3>
                <p>Rent From RentARide, Rent with ease, explore with confidence. Our streamlined booking process and exceptional customer service make it easy to find the perfect vehicle and hit the road.</p>
            </div>
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p>Address: Gujarat, India</p>
                <p><i class="fa-solid fa-phone"></i> +91-7305010188</p>
                <p><i class="fa-solid fa-envelope"></i> rentAride@gmail.com</p>
                <div class="social-links">
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-facebook"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');
        const navOverlay = document.getElementById('navOverlay');
        const body = document.body;

        function toggleNav() {
            mainNav.classList.toggle('active');
            navOverlay.classList.toggle('active');
            body.style.overflow = mainNav.classList.contains('active') ? 'hidden' : '';
        }

        navToggle.addEventListener('click', toggleNav);
        navOverlay.addEventListener('click', toggleNav);

        // Close nav when clicking a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('active');
                navOverlay.classList.remove('active');
                body.style.overflow = '';
            });
        });

        // Header Scroll Effect
        let lastScroll = 0;
        const header = document.querySelector('.header');

        window.addEventListener('scroll', () => {
            const currentScroll = window.pageYOffset;
            
            if (currentScroll <= 0) {
                header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
            } else {
                header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.2)';
            }
            
            lastScroll = currentScroll;
        });
    </script>
</body>

</html>

<?php
// Close the connection
$conn->close();
?>
