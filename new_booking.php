<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

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

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $UserName = $_SESSION['username'];
    $car_no = $_POST['car_info'];
    $c_id = $_POST['c_id']; // Hidden input field to store user_id
    $lastBooking = $_POST['last_booking']; // Hidden input field to store last booking count

    // Get car details
    $sqlCarBook = "SELECT * FROM car WHERE car_no = '$car_no'";
    $resultCarBook = $conn->query($sqlCarBook);
    $dataCar = array();

    while ($rowCarBook = $resultCarBook->fetch_assoc()) {
        $dataCar[] = $rowCarBook;
    }

    foreach ($dataCar as $rowCarBook):
        $v_id = $rowCarBook['car_no'];
        $carAmount = $rowCarBook['car_price'];
        $a_id = $rowCarBook['agent_id'];
    endforeach;

    // Insert booking record
    $sqlBooking = "INSERT INTO booking (c_id, a_id, b_amount, v_id, v_type) VALUES ('$c_id', '$a_id', '$carAmount', '$v_id', 'Car')";

    if ($conn->query($sqlBooking) === TRUE) {
        // Update car availability
        $sqlAvail = "UPDATE car SET car_avail = 0 WHERE car_no = '$v_id'";
        if ($conn->query($sqlAvail) === TRUE) {
            // Update user's booking count
            $newlastBooking = $lastBooking + 1;
            $sqlUpdateBookedCar = "UPDATE user SET booked_car = '$newlastBooking' WHERE user_id = '$c_id'";

            if ($conn->query($sqlUpdateBookedCar) === TRUE) {
                // Store car details in session for payment page
                $_SESSION['selected_car'] = array(
                    'car_no' => $v_id,
                    'car_name' => $rowCarBook['car_name'],
                    'car_brand' => $rowCarBook['car_brand'],
                    'car_type' => $rowCarBook['car_type'],
                    'car_fuel' => $rowCarBook['car_fuel'],
                    'car_price' => $rowCarBook['car_price'],
                    'car_seats' => $rowCarBook['car_seats'],
                    'car_image' => $rowCarBook['car_image']
                );
                
                // Store booking details
                $_SESSION['booking_details'] = array(
                    'pick_date' => $_POST['datePick'],
                    'drop_date' => $_POST['dateDrop'],
                    'total_days' => $_POST['total_days']
                );

                echo "<script>
                    window.location.href = 'paymentDemo.php';
                </script>";
            } else {
                echo "<script>
                    alert('There is something wrong, try again');
                </script>";
            }
        } else {
            echo "<script>
                alert('There is something wrong, try again');
            </script>";
        }
    } else {
        echo "<script>
            alert('There is something wrong, try again');
        </script>";
    }
}

$UserName = $_SESSION['username'];
$sqlUser = "SELECT * FROM user WHERE email = '$UserName'";
$resultUser = $conn->query($sqlUser);

$data = array();
while ($rowUser = $resultUser->fetch_assoc()) {
    $data[] = $rowUser;
}

// echo "Welcome to the dashboard!";
// echo $_SESSION['username'];
?>
<html>

<head>
    <title>Cars</title>
    <link rel="icon" type="image/png" href="images/wheelzonrent-logo.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="poppins.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
    <link rel="stylesheet" href="montserrat.css" type="text/css" media="all">
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
            overflow-x: hidden;
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
            margin-left: 750px;
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
            margin-top: 65px;
            padding: 2rem;
            transition: var(--transition);
            min-height: calc(100vh - 60px);
        }

        /* Footer Styles */
        .footer {
            background: var(--primary-color);
            color: var(--light-text);
            padding: 3rem 2rem;
            margin-left: 250px;
            transition: var(--transition);
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 2rem;
            max-width: 1390px;
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

        /* Form Styles */
        .login {
            padding: 2rem;
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
        }

        .form-box {
            background: #f1f7fe;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 2.5rem;
            width: 100%;
        }

        .form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .title {
            font-size: 2rem;
            font-weight: bold;
            color: var(--primary-color);
            text-align: center;
            margin-bottom: 0.5rem;
        }

        .subtitle {
            font-size: 1.1rem;
            color: #666;
            text-align: center;
            margin-bottom: 2rem;
        }

        .form-container {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        /* Two-column layout */
        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 1.5rem;
            margin-bottom: 0.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            position: relative;
        }

        .form-group label {
            font-weight: 500;
            color: var(--primary-color);
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group label i {
            color: var(--accent-color);
            font-size: 1.1rem;
        }

        .form-group select,
        .form-group input {
            padding: 0.6rem 0.6rem 0.6rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
            height: 2.8rem;
        }

        .form-group i.input-icon {
            position: absolute;
            bottom: 0.7rem;
            left: 0.9rem;
            color: #666;
            font-size: 1.1rem;
        }

        #result {
            padding: 0.6rem 0.6rem 0.6rem 2.5rem !important;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f8f9fa;
            position: relative;
            height: 2.8rem;
            display: flex;
            align-items: center;
        }

        .form button {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.8rem 1.5rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.8rem;
            margin-top: 1rem;
            height: 3rem;
        }

        /* Car Details Styles */
        .carDetails {
            float: right;
            width: 50%;
            margin: 2rem 0 0 0;
            padding: 1.5rem;
            background: #f1f7fe;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
                display: none;
            }

        .carDetails.active {
            display: block;
        }

        .carDetails h1 {
            color: var(--primary-color);
            margin-bottom: 1rem;
            font-size: 1.6rem;
        }

        .carDetails img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .carDetails p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
            color: var(--text-color);
        }

        .carDetails p:last-child {
            margin-bottom: 0;
        }

        /* Clear float */
        .clearfix {
            display: flex;
            flex-wrap: wrap;
            gap: 2rem;
        }

        .clearfix::after {
            content: "";
            clear: both;
            display: table;
        }

        /* Popup Form */
        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.7);
            z-index: 1001;
            align-items: center;
            justify-content: center;
        }

        .popup-form form {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 100%;
            max-width: 500px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .popup-form h2 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            text-align: center;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        /* Responsive Design */
        @media (max-width: 1200px) {
            .login {
                padding: 1.5rem;
            }

            .form-box {
                padding: 2rem;
            }

            .form-row {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 768px) {
            .nav {
                left: -250px;
            }

            .nav.active {
                left: 0;
            }

            .main-content {
                margin-left: 0;
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
            }

            .footer-grid {
                grid-template-columns: 1fr;
                text-align: center;
            }

            .footer-section:last-child {
                text-align: center;
            }

            .footer-section:last-child .social-links {
                justify-content: center;
            }
            
            .login {
                padding: 1rem;
            }

            .form-box {
                padding: 1.5rem;
            }

            .title {
                font-size: 1.8rem;
            }

            .subtitle {
                font-size: 1rem;
            }

            .form-row {
                grid-template-columns: 1fr;
            }

            .form-group select,
            .form-group input {
                height: 3rem;
                padding: 0.7rem 0.7rem 0.7rem 2.2rem;
            }

            .form-group i.input-icon {
                bottom: 0.8rem;
                left: 0.8rem;
            }
        }

        @media (max-width: 992px) {
            .form-row {
                grid-template-columns: 1fr;
                gap: 1.5rem;
            }
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-bottom: 1rem;
        }

        .payment-option label {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            margin-right: 1rem;
            cursor: pointer;
        }

        .payment-option input[type="checkbox"] {
            cursor: pointer;
        }

        .payment-details {
            margin-top: 1rem;
        }

        .payment-field {
            margin-bottom: 1rem;
            position: relative;
        }

        .payment-field label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-field input {
            width: 100%;
            padding: 0.6rem 0.6rem 0.6rem 2rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.9rem;
        }

        .payment-field i.input-icon {
            position: absolute;
            bottom: 0.7rem;
            left: 0.7rem;
            color: #666;
            font-size: 0.9rem;
        }

        .payment-buttons {
            display: flex;
            justify-content: center;
            margin-top: 1.5rem;
        }

        .payment-buttons button,
        .payment-buttons input[type="submit"] {
            padding: 0.6rem 1rem;
            border-radius: 8px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            min-width: 120px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .payment-buttons input[type="submit"] {
            background-color: var(--accent-color);
            color: var(--primary-color);
        }

        .payment-buttons input[type="submit"]:hover {
            background-color: #ffc107;
            transform: translateY(-2px);
        }

        .payment-buttons button {
            background-color: #f1f1f1;
            color: #555;
        }

        .payment-buttons button:hover {
            background-color: #e0e0e0;
            transform: translateY(-2px);
        }

        .car-preview-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .car-preview-content h2 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
            text-align: center;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .car-preview-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .car-preview-content p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
            color: var(--text-color);
        }

        .car-preview-content p:last-child {
            margin-bottom: 0;
        }

        #closeCarPreview {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 0.8rem 2rem;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        #closeCarPreview:hover {
            background-color: #ffc107;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.15);
        }

        #closeCarPreview:active {
            transform: translateY(0);
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
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
            <li class="nav-item"><a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i>Login</a></li>
            <li class="nav-item"><a href="cars.php" class="nav-link active"><i class="fas fa-car"></i>Cars</a></li>
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
        <div class="clearfix">
            <div class="login">
                <div class="form-box">
                    <form class="form" method="post">
                        <span class="title">Thanks For Choosing Us!</span>
                        <span class="subtitle">You just need to fill the form and Your ride will be booked.</span>
                        <div class="form-container">
                            <?php foreach ($data as $row): ?>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="car_info"><i class="fas fa-car"></i>Select Car:</label>
                                    <select name="car_info" id="car_info" onchange="showCarPreview(this.value)">
                                        <option value="">Select an option</option>
                                        <?php
                                        $sql = "SELECT * FROM car WHERE car_avail > 0";
                                        $result = $conn->query($sql);
                                        while ($carRow = $result->fetch_assoc()) {
                                            echo "<option value='" . $carRow['car_no'] . "'>" . $carRow['car_name'] . "</option>";
                                        }
                                        ?>
                                    </select>
                                    <i class="fas fa-chevron-down input-icon"></i>
                                </div>
                                <div class="form-group">
                                    <label for="name"><i class="fas fa-user"></i>Name</label>
                                    <input type="text" id="name" name="name" value="<?php echo $row['user_name']; ?>" required>
                                    <i class="fas fa-user input-icon"></i>
                                </div>
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i>Email</label>
                                    <input type="email" id="email" name="email" value="<?php echo $row['email']; ?>" required>
                                    <i class="fas fa-envelope input-icon"></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="cno"><i class="fas fa-phone"></i>Contact No.</label>
                                    <input type="text" id="cno" name="cno" value="<?php echo $row['contact']; ?>" maxlength="10" required>
                                    <i class="fas fa-phone input-icon"></i>
                                </div>
                                <div class="form-group">
                                    <label for="datePick"><i class="fas fa-calendar-alt"></i>Date to Pick:</label>
                                    <input type="date" id="datePick" name="datePick" min="<?php echo date('Y-m-d'); ?>" required>
                                    <i class="fas fa-calendar-alt input-icon"></i>
                                </div>
                                <div class="form-group">
                                    <label for="dateDrop"><i class="fas fa-calendar-check"></i>Date to Drop:</label>
                                    <input type="date" id="dateDrop" name="dateDrop" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" onchange="calculateDays()" required>
                                    <i class="fas fa-calendar-check input-icon"></i>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group">
                                    <label><i class="fas fa-clock"></i>Rental Duration</label>
                                    <div id="result" style="padding: 0.6rem 0.6rem 0.6rem 2.5rem !important;">Total Days: 0</div>
                                    <i class="fas fa-clock input-icon"></i>
                                    <input type="hidden" name="total_days" id="total_days" value="0">
                                </div>
                            </div>
                            <?php 
                            $c_id = $row['user_id'];
                            $lastBooking = $row['booked_car'];
                            $_SESSION['forCar'] = $c_id; // Store user_id in session
                            ?>
                            <input type="hidden" name="c_id" value="<?php echo $_SESSION['forCar']; ?>">
                            <input type="hidden" name="last_booking" value="<?php echo $lastBooking; ?>">
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" id="openForm"><i class="fas fa-credit-card"></i> Book Now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Car Preview Popup -->
        <div id="carPreviewPopup" class="popup-form">
            <div class="car-preview-content">
                <h2><i class="fas fa-car"></i> Car Details</h2>
                <div id="carPreviewDetails"></div>
                <div class="payment-buttons">
                    <button id="closeCarPreview"><i class="fas fa-times"></i> Close</button>
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

        // Form Related Scripts
        const openFormButton = document.getElementById('openForm');
        const carPreviewPopup = document.getElementById('carPreviewPopup');
        const closeCarPreviewButton = document.getElementById('closeCarPreview');

        // Car preview functionality
        function showCarPreview(carNo) {
            if (!carNo) {
                carPreviewPopup.style.display = 'none';
                return;
            }

            // Fetch car details using AJAX
            fetch('get_car_details.php?car_no=' + carNo)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('carPreviewDetails').innerHTML = html;
                    carPreviewPopup.style.display = 'flex';
                })
                .catch(error => console.error('Error:', error));
        }

        // Close car preview popup
        closeCarPreviewButton.addEventListener('click', function() {
            carPreviewPopup.style.display = 'none';
        });

        // Close car preview when clicking outside
        carPreviewPopup.addEventListener('click', function(e) {
            if (e.target === this) {
                this.style.display = 'none';
            }
        });

        // Calculate days function
        function calculateDays() {
            const startDateInput = document.getElementById('datePick');
            const endDateInput = document.getElementById('dateDrop');
            const resultElement = document.getElementById('result');
            const totalDaysInput = document.getElementById('total_days');

            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            const oneDay = 24 * 60 * 60 * 1000; // milliseconds in a day
            const diffInMs = Math.abs(endDate - startDate);
            const diffInDays = Math.round(diffInMs / oneDay);

            resultElement.textContent = `Total Days: ${diffInDays}`;
            totalDaysInput.value = diffInDays;
            window.globalVariable = diffInDays;
        }

        // Initialize date fields
        document.addEventListener('DOMContentLoaded', function() {
            const today = new Date();
            const tomorrow = new Date(today);
            tomorrow.setDate(tomorrow.getDate() + 1);
            
            const datePickInput = document.getElementById('datePick');
            const dateDropInput = document.getElementById('dateDrop');
            
            // Format dates to YYYY-MM-DD for the input fields
            const formatDate = (date) => {
                const year = date.getFullYear();
                const month = String(date.getMonth() + 1).padStart(2, '0');
                const day = String(date.getDate()).padStart(2, '0');
                return `${year}-${month}-${day}`;
            };
            
            // Set default values
            datePickInput.value = formatDate(today);
            dateDropInput.value = formatDate(tomorrow);
            
            // Update drop-off date minimum when pick-up date changes
            datePickInput.addEventListener('change', function() {
                const newPickDate = new Date(this.value);
                const newDropMinDate = new Date(newPickDate);
                newDropMinDate.setDate(newPickDate.getDate() + 1);
                
                dateDropInput.min = formatDate(newDropMinDate);
                
                // If drop-off date is before new minimum, update it
                if (new Date(dateDropInput.value) < newDropMinDate) {
                    dateDropInput.value = formatDate(newDropMinDate);
                }
                
                calculateDays();
            });
            
            // Calculate initial days
            calculateDays();
        });
    </script>
</body>

</html>