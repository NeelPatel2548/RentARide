<?php
session_start();

// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentaride";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Get data from the form
    $email = $_POST['email'];
    $password = sha1($_POST['password']);

    // Fetch data from database
    $sql = "SELECT * FROM user WHERE email = '$email' AND user_pass = '$password'";
    $result = $conn->query($sql);

    $sql1 = "SELECT * FROM rental_agent WHERE agent_email = '$email' AND agent_pass = '$password'";
    $result1 = $conn->query($sql1);

    if ($result->num_rows > 0) {
        // User exists, redirect to home page
        $row = $result->fetch_assoc();
        $_SESSION['username'] = $_POST['email'];
        $_SESSION['nameTodisplay'] = $row['user_name'];
        $_SESSION['logged_in'] = true;
        header("Location: user_dashboard.php");
        exit();
    } else if ($result1->num_rows > 0) {
        // Rental Agent exists, redirect to home page
        $row = $result1->fetch_assoc();
        $_SESSION['agent_email'] = $_POST['email'];
        $_SESSION['nameTodisplay'] = $row['agent_name'];
        $_SESSION['logged_inAgent'] = true;
        header("Location: rental_agent_dashboard.php");
        exit();
    } else {
        // User does not exist, set error message
        $error_message = "Invalid Email or Password.";
    }

    // Close connection
    $conn->close();
}

// Redirect if already logged in
if (isset($_SESSION['logged_in'])) {
    header('Location: user_dashboard.php');
    exit();
}
if (isset($_SESSION['logged_inAgent'])) {
    header('Location: rental_agent_dashboard.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentARide - Login</title>

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
            min-height: calc(100vh - 60px - 300px); /* Subtract header and footer height */
            display: flex;
            align-items: center;
            justify-content: center;
            width: calc(100% - 250px); /* Account for sidebar width */
        }

        /* Login Form Styles */
        .login-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            width: 100%;
            max-width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .login-header h2 {
            color: var(--primary-color);
            font-size: 2rem;
            margin-bottom: 0.5rem;
        }

        .login-form {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }

        .form-group label {
            color: var(--text-color);
            font-size: 0.9rem;
        }

        .form-group input {
            padding: 0.75rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group input:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 212, 59, 0.2);
        }

        .login-btn {
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 0.75rem;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .login-btn:hover {
            background: #ffd43b;
            transform: translateY(-2px);
        }

        .form-footer {
            text-align: center;
            margin-top: 1rem;
        }

        .form-footer a {
            color: var(--accent-color);
            text-decoration: none;
            font-size: 0.9rem;
        }

        .form-footer a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: #ff7172;
            color: white;
            padding: 0.75rem;
            border-radius: 5px;
            margin-bottom: 1rem;
            text-align: center;
        }

        /* Footer Styles */
        .footer {
            background: var(--primary-color);
            color: var(--light-text);
            padding: 3rem 2rem;
            margin-left: 250px;
            transition: var(--transition);
            width: calc(100% - 250px); /* Account for sidebar width */
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

        /* Update responsive styles */
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
                text-align: center;
            }

            .footer-section:last-child {
                text-align: center;
            }

            .footer-section:last-child .social-links {
                justify-content: center;
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
            <li class="nav-item"><a href="login.php" class="nav-link active"><i class="fas fa-sign-in-alt"></i>Login</a></li>
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
        <div class="login-container">
            <div class="login-header">
                <h2>Login</h2>
                <p>Welcome back! Please login to your account.</p>
            </div>
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            <form class="login-form" action="login.php" method="POST">
                <div class="form-group">
                    <label for="email">Email Address</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="login-btn">Login</button>
                <div class="form-footer">
                    <p>Don't have an account? <a href="signup.php">Register here</a></p>
                </div>
            </form>
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
