<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentaride";
// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn1 = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query to fetch data from the rental_agent table
$sqlAgent = "SELECT * FROM rental_agent";

// Execute the query
$resultAgent = $conn->query($sqlAgent);
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

        /* Add CSS for popup forms */
        .popup-form,
        .popup-formR,
        .popup-formRBS {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100vh;
            background-color: rgba(0, 0, 0, 0.6);
            justify-content: center;
            align-items: center;
            z-index: 9999;
            backdrop-filter: blur(8px);
            -webkit-backdrop-filter: blur(8px);
        }

        .popup-form form,
        .popup-formR form,
        .popup-formRBS form {
            background-color: white;
            padding: 40px;
            border-radius: 10px;
            max-width: 700px;
            width: 90%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.4);
            animation: fadeIn 0.3s ease;
            position: relative;
            margin: auto;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(-20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .popup-form h1, 
        .popup-formR h2, 
        .popup-formRBS h2 {
            margin-bottom: 25px;
            text-align: center;
            color: var(--primary-color);
            font-size: 2rem;
            border-bottom: 2px solid #f2f2f2;
            padding-bottom: 15px;
        }

        .popup-form input[type="text"],
        .popup-form select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            margin-top: 5px;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            transition: all 0.2s ease;
        }
        
        .popup-form input[type="text"]:focus,
        .popup-form select:focus {
            border-color: var(--accent-color);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 212, 59, 0.25);
            outline: none;
        }

        .popup-form select {
            height: 42px;
            width: 100% !important;
        }

        .popup-form input[type="file"] {
            margin-top: 5px;
            padding: 8px 0;
        }

        .popup-form label {
            font-weight: 500;
            color: var(--primary-color);
            display: block;
            margin-bottom: 5px;
        }

        .form-row {
            display: flex;
            gap: 20px;
            margin-bottom: 15px;
        }
        
        .form-group {
            flex: 1;
        }

        .vehicle-type-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-bottom: 25px;
        }

        .vehicle-checkbox {
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .popup-form button,
        .popup-formR button,
        .popup-formRBS button {
            padding: 12px 30px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 15px;
            font-weight: 600;
            transition: all 0.2s ease;
            font-size: 1rem;
        }

        .popup-form button[type="submit"],
        .popup-formR button[type="submit"],
        .popup-formRBS button[type="submit"] {
            background-color: var(--accent-color);
            border: none;
            color: var(--primary-color);
            margin-right: 10px;
        }

        .popup-form button[type="submit"]:hover {
            background-color: #ffca28;
            transform: translateY(-2px);
        }

        .popup-form button#closeForm,
        .popup-formR button#closeFormR,
        .popup-formRBS button#closeFormRBS {
            background-color: #f2f2f2;
            border: 1px solid #ddd;
        }

        .popup-form button#closeForm:hover {
            background-color: #e6e6e6;
        }

        .button-container {
            display: flex;
            justify-content: center;
            margin-top: 30px;
        }

        /* Additional styling for the file input */
        .form-group.file-input {
            margin-top: 10px;
            margin-bottom: 15px;
        }

        .form-group.file-input label {
            margin-bottom: 10px;
        }

        /* Styling for the select vehicle dropdown */
        .select-vehicle {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9f9;
            transition: all 0.2s ease;
            height: 45px;
            margin-top: 8px;
        }

        .select-vehicle:focus {
            border-color: var(--accent-color);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(255, 212, 59, 0.25);
            outline: none;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 9999;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.6);
            backdrop-filter: blur(5px);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 5% auto;
            padding: 30px;
            border-radius: 10px;
            width: 80%;
            max-width: 900px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            animation: fadeIn 0.3s ease;
        }

        .modal-content table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 20px;
        }

        .modal-content th,
        .modal-content td {
            border: 1px solid #eee;
            padding: 12px 15px;
            text-align: left;
        }

        .modal-content th {
            background-color: var(--primary-color);
            color: white;
            font-weight: 600;
            position: sticky;
            top: 0;
        }

        .modal-content tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        .modal-content tr:hover {
            background-color: #f2f2f2;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
            transition: color 0.3s;
        }

        .close:hover,
        .close:focus {
            color: var(--primary-color);
            text-decoration: none;
            cursor: pointer;
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
            <li class="nav-item"><a href="cars.php" class="nav-link"><i class="fas fa-car-side"></i>Book Car</a></li>
            <li class="nav-item"><a href="bikes.php" class="nav-link"><i class="fas fa-motorcycle"></i>Book Bike</a></li>
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
                if ($resultAgent->num_rows > 0) {
                    while ($rowAgent = $resultAgent->fetch_assoc()) {
                        echo '<div class="profile-image">';
                        echo '<img src="./temp_imgs/profile_jpg.jpg" alt="Profile">';
                        echo '</div>';
                        echo '<div class="profile-info">';
                        echo "<p><span>Name:</span> <span>" . $rowAgent["agent_name"] . "</span></p>";
                        echo "<p><span>WebID:</span> <span>" . $rowAgent["agent_id"] . "</span></p>";
                        echo "<p><span>Email:</span> <span>" . $rowAgent["agent_email"] . "</span></p>";
                        echo "<p><span>Contact:</span> <span>" . $rowAgent["agent_contact"] . "</span></p>";
                        echo "<p><span>State:</span> <span>" . $rowAgent["agent_state"] . "</span></p>";
                        echo "<p><span>City:</span> <span>" . $rowAgent["agent_city"] . "</span></p>";
                        echo '</div>';
                        
                        $_SESSION['agent_ID'] = $rowAgent["agent_id"];
                    }
                } else {
                    echo "No profile data found.";
                }
                
                ?>
                
                <a href="#" class="action-btn" id="openCustomerModal" style="display: block; text-align: center; margin-top: 1rem;">
                    <i class="fas fa-eye"></i> View Customers
                </a>
                <a href="#" class="action-btn" id="openForm" style="display: block; text-align: center; margin-top: 0.8rem;">
                    <i class="fas fa-plus-circle"></i> Add Vehicle
                </a>
                <a href="#" class="action-btn" id="openFormRemove" style="display: block; text-align: center; margin-top: 0.8rem;">
                    <i class="fas fa-trash-alt"></i> Remove Vehicle
                </a>
            </div>
            
            <div class="dashboard-content">
                <div class="dashboard-stats">
                    <div class="stat-card">
                        <i class="fas fa-car"></i>
                        <h3>Total Cars Listed</h3>
                        <p><?php
                            $sqlTC = "SELECT COUNT(*) AS total_cars FROM car";
                            $resultTC = mysqli_query($conn, $sqlTC);

                            if ($resultTC) {
                                $rowTC = mysqli_fetch_assoc($resultTC);
                                $total_cars = $rowTC['total_cars'];
                                echo $total_cars;
                            } else {
                                echo "0";
                            }
                        ?></p>
                        <small>Total cars available in our inventory</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-motorcycle"></i>
                        <h3>Total Bikes Listed</h3>
                        <p><?php
                            $sqlTB = "SELECT COUNT(*) AS total_bike FROM bike";
                            $resultTB = mysqli_query($conn, $sqlTB);

                            if ($resultTB) {
                                $rowTB = mysqli_fetch_assoc($resultTB);
                                $total_bike = $rowTB['total_bike'];
                                echo $total_bike;
                            } else {
                                echo "0";
                            }
                        ?></p>
                        <small>Total bikes available in our inventory</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-calendar-check"></i>
                        <h3>Total Bookings</h3>
                        <p><?php
                            $sqlTB = "SELECT COUNT(*) AS total_book FROM booking";
                            $resultTB = mysqli_query($conn, $sqlTB);

                            if ($resultTB) {
                                $rowTB = mysqli_fetch_assoc($resultTB);
                                $total_book = $rowTB['total_book'];
                                echo $total_book;
                            } else {
                                echo "0";
                            }
                        ?></p>
                        <small>Total vehicle bookings across all users</small>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-users"></i>
                        <h3>Total Users</h3>
                        <p><?php
                            $sqlTU = "SELECT COUNT(*) AS total_user FROM user";
                            $resultTU = mysqli_query($conn, $sqlTU);

                            if ($resultTU) {
                                $rowTU = mysqli_fetch_assoc($resultTU);
                                $total_user = $rowTU['total_user'];
                                echo $total_user;
                            } else {
                                echo "0";
                            }
                        ?></p>
                        <small>Registered users on our platform</small>
                    </div>
                </div>

                <div class="dashboard-title">
                    <div class="divider-line"></div>
                    <h2>Owned Vehicle</h2>
                    <div class="divider-line"></div>
                </div>
                
                <div class="history-container">
                    <?php
                    if ($conn->connect_error) {
                        die("Connection failed: " . $conn->connect_error);
                    }

                    // Get the current agent's ID
                    $agentId = $_SESSION['agent_ID'];
                    
                    // Create a combined query to get both cars and bikes owned by this agent
                    $sql = "SELECT 
                        car_name AS name,
                        car_brand AS model,
                        car_trans AS type,
                        car_fuel AS fuel,
                        car_price AS price,
                        car_no AS VNumber,
                        'Car' AS vehicle_category
                    FROM 
                        car 
                    WHERE 
                        agent_id = '$agentId'
                    UNION
                    SELECT 
                        bike_name AS name,
                        bike_brand AS model,
                        bike_type AS type,
                        bike_fuel AS fuel,
                        bike_price AS price,
                        bike_no AS VNumber,
                        'Bike' AS vehicle_category
                    FROM 
                        bike 
                    WHERE 
                        agent_id = '$agentId'";
                    
                    $result = $conn->query($sql);
                    
                    if ($result->num_rows > 0) {
                        echo "<table class='history-table'>";
                        echo "<thead>";
                        echo "<tr><th>Vehicle Name</th><th>Brand</th><th>Vehicle Type/Transmission</th><th>Fuel</th><th>Price</th><th>Vehicle No</th><th>Category</th></tr>";
                        echo "</thead>";
                        echo "<tbody>";
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["model"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["fuel"] . "</td>";
                            echo "<td>₹" . $row["price"] . "/day</td>";
                            echo "<td>" . $row["VNumber"] . "</td>";
                            echo "<td>" . $row["vehicle_category"] . "</td>";
                            echo "</tr>";
                        }
                        echo "</tbody>";
                        echo "</table>";
                    } else {
                        echo "<p style='text-align: center; padding: 2rem;'>No vehicles owned by you.</p>";
                    }
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

    <!-- Add Car Popup Form - Moved outside to cover the entire screen -->
    <div id="popupForm" class="popup-form">
        <form method="post" enctype="multipart/form-data">
            <h1>Add Vehicle</h1>
            <div class="vehicle-type-container">
                <div class="vehicle-checkbox">
                    <input
                        type="checkbox"
                        id="vehicleTypeBike"
                        name="vehicleType"
                        value="bike" />
                    <label for="vehicleTypeBike">Bike</label>
                </div>
                <div class="vehicle-checkbox">
                    <input
                        type="checkbox"
                        id="vehicleTypeCar"
                        name="vehicleType"
                        value="car" />
                    <label for="vehicleTypeCar">Car</label>
                </div>
            </div>

            <div id="bikeDetails" style="display: none">
                <div class="form-row">
                    <div class="form-group">
                        <label for="bikeName">Bike Name:</label>
                        <input type="text" id="bikeName" name="bikeName" />
                    </div>
                    <div class="form-group">
                        <label for="brand">Brand:</label>
                        <input type="text" id="brand" name="brand" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="fuelType">Fuel Type:</label>
                        <select name="fuelType" id="fuelType">
                            <option value="Petrol">Petrol</option>
                            <option value="EV">EV</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="Type">Type:</label>
                        <select name="Type" id="Type">
                            <option value="Bike">Bike</option>
                            <option value="Scooter">Scooter</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="bikeNo">Bike No.:</label>
                        <input type="text" id="bikeNo" name="bikeNo" />
                    </div>
                    <div class="form-group">
                        <label for="price">Price per Day:</label>
                        <input type="text" id="price" name="price" />
                    </div>
                </div>

                <div class="form-group file-input">
                    <label for="bikeImg">Upload Bike Image:</label>
                    <input type="file" name="bikeImg" id="bikeImg" />
                </div>
            </div>

            <div id="carDetails" style="display: none">
                <div class="form-row">
                    <div class="form-group">
                        <label for="carName">Car Name:</label>
                        <input type="text" id="carName" name="carName" />
                    </div>
                    <div class="form-group">
                        <label for="carBrand">Car Brand:</label>
                        <input type="text" id="carBrand" name="carBrand" />
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="carTrans">Transmission:</label>
                        <select name="carTrans" id="carTrans">
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="carFuel">Fuel Type:</label>
                        <select name="carFuel" id="carFuel">
                            <option value="Petrol">Petrol</option>
                            <option value="EV">EV</option>
                            <option value="Disel">Disel</option>
                        </select>
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="carSeat">Car Seat:</label>
                        <input type="text" id="carSeat" name="carSeat" />
                    </div>
                    <div class="form-group">
                        <label for="carMilege">Car Mileage:</label>
                        <input type="text" id="carMilege" name="carMilege" />
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group">
                        <label for="carNo">Car No.:</label>
                        <input type="text" id="carNo" name="carNo" />
                    </div>
                    <div class="form-group">
                        <label for="carPrice">Car Price per Day:</label>
                        <input type="text" id="carPrice" name="carPrice" />
                    </div>
                </div>
                
                <div class="form-group file-input">
                    <label for="carImg">Upload Car Image:</label>
                    <input type="file" name="carImg" id="carImg" />
                </div>
            </div>

            <div class="button-container">
                <button type="submit" value="Submit" name="AddForm">Submit</button>
                <button type="button" id="closeForm">Close</button>
            </div>
        </form>
    </div>

    <!-- Remove Vehicle Popup Form -->
    <div id="popupFormRemove" class="popup-form">
        <form method="post">
            <h1>Remove Vehicle</h1>
            <div class="vehicle-type-container">
                <div class="vehicle-checkbox">
                    <input
                        type="checkbox"
                        id="removeTypeBike"
                        name="removeType"
                        value="bike" />
                    <label for="removeTypeBike">Bike</label>
                </div>
                <div class="vehicle-checkbox">
                    <input
                        type="checkbox"
                        id="removeTypeCar"
                        name="removeType"
                        value="car" />
                    <label for="removeTypeCar">Car</label>
                </div>
            </div>

            <div id="removeBikeDetails" style="display: none">
                <div class="form-group">
                    <label for="bikeRemove_info">Select Bike to Remove:</label>
                    <select name="bikeRemove_info" id="bikeRemove_info" class="select-vehicle">
                        <option value="any">Select an option</option>
                        <?php
                        // Get bikes for this agent
                        $findAgentBike = $_SESSION['agent_ID'];
                        $sqlRBS = "SELECT * FROM bike WHERE agent_id = '$findAgentBike'";
                        $resultRBS = $conn->query($sqlRBS);
                        
                        while ($rowRBS = $resultRBS->fetch_assoc()) {
                            echo "<option value='" . $rowRBS['bike_name'] . "'>" . $rowRBS['bike_name'] . " (" . $rowRBS['bike_no'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div id="removeCarDetails" style="display: none">
                <div class="form-group">
                    <label for="carRemove_info">Select Car to Remove:</label>
                    <select name="carRemove_info" id="carRemove_info" class="select-vehicle">
                        <option value="any">Select an option</option>
                        <?php
                        // Get cars for this agent
                        $findAgentCar = $_SESSION['agent_ID'];
                        $sqlR = "SELECT * FROM car WHERE agent_id = '$findAgentCar'";
                        $resultR = $conn->query($sqlR);
                        
                        while ($rowR = $resultR->fetch_assoc()) {
                            echo "<option value='" . $rowR['car_name'] . "'>" . $rowR['car_name'] . " (" . $rowR['car_no'] . ")</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>

            <div class="button-container">
                <button type="submit" name="RemoveBike" id="removeBikeBtn" style="display: none;">Remove Bike</button>
                <button type="submit" name="RemoveCar" id="removeCarBtn" style="display: none;">Remove Car</button>
                <button type="button" id="closeFormRemove">Close</button>
            </div>
        </form>
    </div>

    <!-- Customer View Modal -->
    <div id="customerModal" class="modal">
        <div class="modal-content">
            <span class="close" id="closeCustomerModal">&times;</span>
            <h2>Frequent Customers</h2>
            <p>Showing customers who have booked more than one vehicle</p>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Booked Car</th>
                        <th>Booked Bike</th>
                        <th>Total Vehicles</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Fetch user data for those who booked more than 1 vehicle (car or bike combined)
                    $sqlView = "SELECT *, (booked_car + booked_bike) AS total_vehicles 
                                FROM user 
                                WHERE (booked_car > 0 AND booked_bike > 0) 
                                   OR booked_car > 1 
                                   OR booked_bike > 1 
                                ORDER BY total_vehicles DESC";
                    $resultView = mysqli_query($conn, $sqlView);

                    if (mysqli_num_rows($resultView) > 0) {
                        // Output data of each row
                        while ($rowView = mysqli_fetch_assoc($resultView)) {
                            echo "<tr>";
                            echo "<td>" . $rowView["user_id"] . "</td>";
                            echo "<td>" . $rowView["user_name"] . "</td>";
                            echo "<td>" . $rowView["email"] . "</td>";
                            echo "<td>" . $rowView["booked_car"] . "</td>";
                            echo "<td>" . $rowView["booked_bike"] . "</td>";
                            echo "<td><strong>" . $rowView["total_vehicles"] . "</strong></td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan=\"6\">No users found who booked more than one vehicle.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

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

        // Popup form handling
        const openFormButton = document.getElementById('openForm');
        const popupForm = document.getElementById('popupForm');
        const closeFormButton = document.getElementById('closeForm');
        const bikeDetails = document.getElementById('bikeDetails');
        const carDetails = document.getElementById('carDetails');
        const vehicleTypeCheckboxes = document.querySelectorAll('input[name="vehicleType"]');
        const bikeCheckbox = document.getElementById('vehicleTypeBike');
        const carCheckbox = document.getElementById('vehicleTypeCar');

        openFormButton.addEventListener('click', (e) => {
            e.preventDefault();
            popupForm.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when popup is open
        });

        closeFormButton.addEventListener('click', () => {
            popupForm.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
            // Reset form
            bikeDetails.style.display = 'none';
            carDetails.style.display = 'none';
            bikeCheckbox.checked = false;
            carCheckbox.checked = false;
        });

        // Close popup when clicking outside the form
        popupForm.addEventListener('click', (e) => {
            if (e.target === popupForm) {
                popupForm.style.display = 'none';
                document.body.style.overflow = '';
                // Reset form
                bikeDetails.style.display = 'none';
                carDetails.style.display = 'none';
                bikeCheckbox.checked = false;
                carCheckbox.checked = false;
            }
        });

        // Prevent form from closing when clicking inside it
        popupForm.querySelector('form').addEventListener('click', (e) => {
            e.stopPropagation();
        });

        vehicleTypeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    // Uncheck the other checkbox
                    vehicleTypeCheckboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });

                    // Show the corresponding details div
                    if (checkbox.value === 'bike') {
                        bikeDetails.style.display = 'block';
                        carDetails.style.display = 'none';
                    } else if (checkbox.value === 'car') {
                        carDetails.style.display = 'block';
                        bikeDetails.style.display = 'none';
                    }
                } else {
                    // Hide the corresponding details div
                    if (checkbox.value === 'bike') {
                        bikeDetails.style.display = 'none';
                    } else if (checkbox.value === 'car') {
                        carDetails.style.display = 'none';
                    }
                }
            });
        });

        // Remove Vehicle popup form handling
        const openFormRemoveButton = document.getElementById('openFormRemove');
        const popupFormRemove = document.getElementById('popupFormRemove');
        const closeFormRemoveButton = document.getElementById('closeFormRemove');
        const removeBikeDetails = document.getElementById('removeBikeDetails');
        const removeCarDetails = document.getElementById('removeCarDetails');
        const removeTypeCheckboxes = document.querySelectorAll('input[name="removeType"]');
        const bikeRemoveButton = document.getElementById('removeBikeBtn');
        const carRemoveButton = document.getElementById('removeCarBtn');
        const removeTypeBike = document.getElementById('removeTypeBike');
        const removeTypeCar = document.getElementById('removeTypeCar');

        openFormRemoveButton.addEventListener('click', (e) => {
            e.preventDefault();
            popupFormRemove.style.display = 'flex';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when popup is open
        });

        closeFormRemoveButton.addEventListener('click', () => {
            popupFormRemove.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
            resetRemoveForm();
        });

        // Close popup when clicking outside the form
        popupFormRemove.addEventListener('click', (e) => {
            if (e.target === popupFormRemove) {
                popupFormRemove.style.display = 'none';
                document.body.style.overflow = '';
                resetRemoveForm();
            }
        });

        // Reset remove form function
        function resetRemoveForm() {
            removeBikeDetails.style.display = 'none';
            removeCarDetails.style.display = 'none';
            bikeRemoveButton.style.display = 'none';
            carRemoveButton.style.display = 'none';
            removeTypeBike.checked = false;
            removeTypeCar.checked = false;
        }

        // Prevent form from closing when clicking inside it
        popupFormRemove.querySelector('form').addEventListener('click', (e) => {
            e.stopPropagation();
        });

        removeTypeCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', () => {
                if (checkbox.checked) {
                    // Uncheck the other checkbox
                    removeTypeCheckboxes.forEach(otherCheckbox => {
                        if (otherCheckbox !== checkbox) {
                            otherCheckbox.checked = false;
                        }
                    });

                    // Show the corresponding details div and button
                    if (checkbox.value === 'bike') {
                        removeBikeDetails.style.display = 'block';
                        removeCarDetails.style.display = 'none';
                        bikeRemoveButton.style.display = 'block';
                        carRemoveButton.style.display = 'none';
                    } else if (checkbox.value === 'car') {
                        removeCarDetails.style.display = 'block';
                        removeBikeDetails.style.display = 'none';
                        carRemoveButton.style.display = 'block';
                        bikeRemoveButton.style.display = 'none';
                    }
                } else {
                    // Hide the corresponding details div and button
                    if (checkbox.value === 'bike') {
                        removeBikeDetails.style.display = 'none';
                        bikeRemoveButton.style.display = 'none';
                    } else if (checkbox.value === 'car') {
                        removeCarDetails.style.display = 'none';
                        carRemoveButton.style.display = 'none';
                    }
                }
            });
        });

        // Customer modal handling
        const customerModal = document.getElementById('customerModal');
        const openCustomerModalBtn = document.getElementById('openCustomerModal');
        const closeCustomerModalBtn = document.getElementById('closeCustomerModal');

        openCustomerModalBtn.addEventListener('click', (e) => {
            e.preventDefault();
            customerModal.style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevent scrolling when modal is open
        });

        closeCustomerModalBtn.addEventListener('click', () => {
            customerModal.style.display = 'none';
            document.body.style.overflow = ''; // Restore scrolling
        });

        // Close modal when clicking outside of it
        window.addEventListener('click', (e) => {
            if (e.target === customerModal) {
                customerModal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    </script>
</body>

</html>

<?php
// Process the form submission
if (isset($_POST['AddForm'])) {
    if (isset($_POST['vehicleType'])) {
        if ($_POST['vehicleType'] == 'bike') {
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $bikeName = $_POST['bikeName'];
            $brand = $_POST['brand'];
            $fuelType = $_POST['fuelType'];
            $type = $_POST['Type'];
            $bikeNo = $_POST['bikeNo'];
            $price = $_POST['price'];

            // Handle image upload
            $targetDir = "bike_img/";
            $targetFile = $targetDir . basename($_FILES["bikeImg"]["name"]);
            $fileName = basename($_FILES["bikeImg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.')</script>";
            } else {
                if (move_uploaded_file($_FILES["bikeImg"]["tmp_name"], $targetFile)) {
                    // Insert bike data into the database
                    $sql = "INSERT INTO bike (bike_name, bike_brand, bike_type, bike_fuel, bike_no, bike_price, bike_img, agent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssssss", $bikeName, $brand, $type, $fuelType, $bikeNo, $price, $fileName, $_SESSION['agent_ID']);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('Vehicle Added Successfully');
                        window.location = 'new_rental.php';</script>";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        } elseif ($_POST['vehicleType'] == 'car') {
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $carName = $_POST['carName'];
            $carBrand = $_POST['carBrand'];
            $carTrans = $_POST['carTrans'];
            $carFuelType = $_POST['carFuel'];
            $carSeat = $_POST['carSeat'];
            $carMileage = $_POST['carMilege'];
            $carNo = $_POST['carNo'];
            $carPrice = $_POST['carPrice'];

            // Handle image upload
            $targetDir = "car_img/";
            $targetFile = $targetDir . basename($_FILES["carImg"]["name"]);
            $uploadOk = 1;
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            $fileNameCar = basename($_FILES["carImg"]["name"]);

            if ($uploadOk == 0) {
                echo "<script>alert('Sorry, your file was not uploaded.');</script>";
            } else {
                if (move_uploaded_file($_FILES["carImg"]["tmp_name"], $targetFile)) {
                    // Insert car data into the database
                    $sql = "INSERT INTO car (car_name, car_brand, caR_trans, car_fuel, car_seat, car_milege, car_no, car_price, car_img, agent_id) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ssssssssss", $carName, $carBrand, $carTrans, $carFuelType, $carSeat, $carMileage, $carNo, $carPrice, $fileNameCar, $_SESSION['agent_ID']);

                    if (mysqli_stmt_execute($stmt)) {
                        echo "<script>alert('Vehicle Added Successfully');
                        window.location = 'new_rental.php';</script>";
                    } else {
                        echo "Error: " . mysqli_error($conn);
                    }

                    mysqli_stmt_close($stmt);
                } else {
                    echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                }
            }
        }
    }
}

// Process Remove Bike
if (isset($_POST['RemoveBike'])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $selectedBike = $_POST['bikeRemove_info'];
    
    if ($selectedBike != 'any') {
        $sqlRemoveB = "DELETE FROM bike WHERE bike_name = ? AND agent_id = ?";
        $stmtRemoveB = mysqli_prepare($conn, $sqlRemoveB);
        mysqli_stmt_bind_param($stmtRemoveB, "ss", $selectedBike, $_SESSION['agent_ID']);
        
        if (mysqli_stmt_execute($stmtRemoveB)) {
            echo "<script>alert('Bike removed successfully!');
            window.location = 'new_rental.php';</script>";
        } else {
            echo "<script>alert('Error removing bike: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please select a bike to remove');</script>";
    }
}

// Process Remove Car
if (isset($_POST['RemoveCar'])) {
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    
    $selectedCar = $_POST['carRemove_info'];
    
    if ($selectedCar != 'any') {
        $sqlRemove = "DELETE FROM car WHERE car_name = ? AND agent_id = ?";
        $stmtRemove = mysqli_prepare($conn, $sqlRemove);
        mysqli_stmt_bind_param($stmtRemove, "ss", $selectedCar, $_SESSION['agent_ID']);
        
        if (mysqli_stmt_execute($stmtRemove)) {
            echo "<script>alert('Car removed successfully!');
            window.location = 'new_rental.php';</script>";
        } else {
            echo "<script>alert('Error removing car: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        echo "<script>alert('Please select a car to remove');</script>";
    }
}

// Close the connection
$conn->close();
?>
