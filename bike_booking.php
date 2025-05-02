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
  //  Check if required POST data exists
    if (!isset($_POST['bike_info']) || !isset($_POST['c_id']) || !isset($_POST['last_booking']) || 
        !isset($_POST['datePick']) || !isset($_POST['dateDrop']) || !isset($_POST['total_days'])) {
        echo "<script>
            alert('Please fill all required fields');
            window.location.href = 'bikes.php';
        </script>";
        exit;
    }


    $UserName = $_SESSION['username'];
    $bike_no = $_POST['bike_info'];
    $c_id = $_POST['c_id'];
    $lastBooking = $_POST['last_booking'];

    // Get bike details
    $sqlBikeBook = "SELECT * FROM bike WHERE bike_no = ?";
    $stmt = $conn->prepare($sqlBikeBook);
    $stmt->bind_param("s", $bike_no);
    $stmt->execute();
    $resultBikeBook = $stmt->get_result();
    
    if ($resultBikeBook->num_rows === 0) {
        echo "<script>
            alert('Selected bike not found');
            window.location.href = 'bikes.php';
        </script>";
        exit;
    }

    $rowBikeBook = $resultBikeBook->fetch_assoc();
    $v_id = $rowBikeBook['bike_no'];
    $bikeAmount = $rowBikeBook['bike_price'];
    $a_id = $rowBikeBook['agent_id'];

    // Insert booking record
    $sqlBooking = "INSERT INTO booking (c_id, a_id, b_amount, v_id, v_type) VALUES (?, ?, ?, ?, 'Bike')";
    $stmt = $conn->prepare($sqlBooking);
    $stmt->bind_param("iids", $c_id, $a_id, $bikeAmount, $v_id);

    if ($stmt->execute()) {
        // Update bike availability
        $sqlAvail = "UPDATE bike SET bike_avail = 0 WHERE bike_no = ?";
        $stmt = $conn->prepare($sqlAvail);
        $stmt->bind_param("s", $v_id);

        if ($stmt->execute()) {
            // Update user's booking count
            $newlastBooking = $lastBooking + 1;
            $sqlUpdateBookedBike = "UPDATE user SET booked_bike = ? WHERE user_id = ?";
            $stmt = $conn->prepare($sqlUpdateBookedBike);
            $stmt->bind_param("ii", $newlastBooking, $c_id);

            if ($stmt->execute()) {
                // Store bike details in session for payment page
                $_SESSION['selected_bike'] = array(
                    'bike_no' => $v_id,
                    'bike_name' => $rowBikeBook['bike_name'],
                    'bike_brand' => $rowBikeBook['bike_brand'],
                    'bike_type' => $rowBikeBook['bike_type'],
                    'bike_fuel' => $rowBikeBook['bike_fuel'],
                    'bike_price' => $rowBikeBook['bike_price'],
                    'bike_image' => $rowBikeBook['bike_img']
                );
                
                // Store booking details
                $_SESSION['booking_details'] = array(
                    'pick_date' => $_POST['datePick'],
                    'drop_date' => $_POST['dateDrop'],
                    'total_days' => $_POST['total_days']
                );

                header('Location: paymentDemoBike.php');
                exit;
            } else {
                echo "<script>
                    alert('Error updating user booking count');
                    window.location.href = 'bikes.php';
                </script>";
            }
        } else {
            echo "<script>
                alert('Error updating bike availability');
                window.location.href = 'bikes.php';
            </script>";
        }
    } else {
        echo "<script>
            alert('Error creating booking');
            window.location.href = 'bikes.php';
        </script>";
    }
}

// Get user data
$UserName = $_SESSION['username'];
$sqlUser = "SELECT * FROM user WHERE email = ?";
$stmt = $conn->prepare($sqlUser);
$stmt->bind_param("s", $UserName);
$stmt->execute();
$resultUser = $stmt->get_result();

$data = array();
while ($rowUser = $resultUser->fetch_assoc()) {
    $data[] = $rowUser;
}

// Get the bike info from POST if it exists
$selected_bike_no = isset($_POST['bike_info']) ? $_POST['bike_info'] : '';
?>
<html>
<head>
    <title>Bike Booking</title>
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
        }

        .nav-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .nav-item {
            margin: 0;
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

        .form button:hover {
            background-color: #ffc107;
            transform: translateY(-2px);
        }

        /* Bike Preview Popup */
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

        .bike-preview-content {
            background-color: white;
            padding: 2rem;
            border-radius: 12px;
            width: 90%;
            max-width: 600px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
        }

        .bike-preview-content h2 {
            margin-bottom: 1.5rem;
            color: var(--primary-color);
                text-align: center;
            font-size: 1.5rem;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
        }

        .bike-preview-content img {
            width: 100%;
            height: auto;
            border-radius: 8px;
            margin-bottom: 1rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .bike-preview-content p {
            margin-bottom: 0.8rem;
            font-size: 1rem;
            color: var(--text-color);
        }

        .bike-preview-content p:last-child {
            margin-bottom: 0;
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
            <li class="nav-item"><a href="cars.php" class="nav-link"><i class="fas fa-car"></i>Cars</a></li>
            <li class="nav-item"><a href="bikes.php" class="nav-link active"><i class="fas fa-motorcycle"></i>Bikes</a></li>
            <li class="nav-item"><a href="washing.php" class="nav-link"><i class="fas fa-soap"></i>Washing</a></li>
            <li class="nav-item"><a href="scrapping.php" class="nav-link"><i class="fas fa-recycle"></i>Scrapping</a></li>
            <li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i>Contact Us</a></li>
            <li class="nav-item"><a href="terms.php" class="nav-link"><i class="fas fa-file-contract"></i>Terms</a></li>
            <li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
            <li class="nav-item" style="background-color: red;"><a href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/01/12/20241101124511-I5H9O04S.json" target="_blank" class="nav-link"><i class="fas fa-question-circle"></i>Need a Help?</a></li>
        </ul>
    </nav>

    <!-- Main Content -->
    <main class="main-content">
        <div class="clearfix">
    <div class="login">
        <div class="form-box">
                    <form class="form" method="post" action="new_bikeBooking.php">
                <span class="title">Thanks For Choosing Us!</span>
                        <span class="subtitle">You just need to fill the form and Your ride will be booked.</span>
                <div class="form-container">
                            <?php foreach ($data as $row): ?>
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="bike_info"><i class="fas fa-motorcycle"></i>Select Bike:</label>
                                    <select name="bike_info" id="bike_info" onchange="showBikePreview(this.value)">
                                        <option value="">Select an option</option>
                        <?php
                                        $sql = "SELECT * FROM bike WHERE bike_avail > 0";
                                        $result = $conn->query($sql);
                                        while ($bikeRow = $result->fetch_assoc()) {
                                            $selected = ($selected_bike_no == $bikeRow['bike_no']) ? 'selected' : '';
                                            echo "<option value='" . $bikeRow['bike_no'] . "' " . $selected . ">" . $bikeRow['bike_name'] . "</option>";
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
                            $lastBooking = $row['booked_bike'];
                            $_SESSION['forBike'] = $c_id;
                            ?>
                            <input type="hidden" name="c_id" value="<?php echo $_SESSION['forBike']; ?>">
                            <input type="hidden" name="last_booking" value="<?php echo $lastBooking; ?>">
                            <?php endforeach; ?>
                        </div>
                        <button type="submit" id="openForm"><i class="fas fa-credit-card"></i> Book Now</button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Bike Preview Popup -->
        <div id="bikePreviewPopup" class="popup-form">
            <div class="bike-preview-content">
                <h2><i class="fas fa-motorcycle"></i> Bike Details</h2>
                <div id="bikePreviewDetails"></div>
                <div class="payment-buttons">
                    <button id="closeBikePreview">Close</button>
                </div>
            </div>
        </div>
    </main>

                        <script>
        // Navigation Toggle
        const navToggle = document.getElementById('navToggle');
        const mainNav = document.getElementById('mainNav');
        const body = document.body;

        function toggleNav() {
            mainNav.classList.toggle('active');
            body.style.overflow = mainNav.classList.contains('active') ? 'hidden' : '';
        }

        navToggle.addEventListener('click', toggleNav);

        // Close nav when clicking a link
        const navLinks = document.querySelectorAll('.nav-link');
        navLinks.forEach(link => {
            link.addEventListener('click', () => {
                mainNav.classList.remove('active');
                body.style.overflow = '';
            });
        });

        // Bike preview functionality
        function showBikePreview(bikeNo) {
            if (!bikeNo) {
                document.getElementById('bikePreviewPopup').style.display = 'none';
                return;
            }

            // Fetch bike details using AJAX
            fetch('get_bike_details.php?bike_no=' + bikeNo)
                .then(response => response.text())
                .then(html => {
                    document.getElementById('bikePreviewDetails').innerHTML = html;
                    document.getElementById('bikePreviewPopup').style.display = 'flex';
                })
                .catch(error => console.error('Error:', error));
        }

        // Close bike preview popup
        document.getElementById('closeBikePreview').addEventListener('click', function() {
            document.getElementById('bikePreviewPopup').style.display = 'none';
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
