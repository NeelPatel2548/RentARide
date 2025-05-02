<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>RentARide - Cars</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/poppins.css" type="text/css" media="all">
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
            margin-left: 745px;
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
            padding: 1rem;
            transition: var(--transition);
            min-height: calc(100vh - 60px);
        }

        /* Filter section */
        .filters-section {
            background: #f8f9fa;
            padding: 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }

        .filters-container {
            display: flex;
            flex-wrap: wrap;
            gap: 1.5rem;
            align-items: center;
        }

        .filter-group {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .filter-group label {
            font-weight: 600;
            color: var(--text-color);
        }

        .filter-group select {
            padding: 0.5rem 1rem;
            border-radius: 5px;
            border: 1px solid #ddd;
            background-color: white;
            font-family: 'Poppins', sans-serif;
            min-width: 120px;
            transition: var(--transition);
        }

        .filter-group select:focus {
            border-color: var(--accent-color);
            outline: none;
            box-shadow: 0 0 0 2px rgba(255, 212, 59, 0.25);
        }

        .filter-buttons {
            margin-left: auto;
            display: flex;
            gap: 1rem;
        }

        .filter-btn {
            padding: 0.6rem 1.5rem;
            border-radius: 5px;
            border: none;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
        }

        .filter-btn.primary {
            background: var(--accent-color);
            color: var(--primary-color);
        }

        .filter-btn.primary:hover {
            background: #f0c32c;
            transform: translateY(-2px);
        }

        .filter-btn.reset {
            background: #e2e2e2;
            color: var(--text-color);
        }

        .filter-btn.reset:hover {
            background: #d0d0d0;
        }

        /* Car grid */
        .car-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }

        .car-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
        }

        .car-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        .car-image {
            height: 200px;
            overflow: hidden;
        }

        .car-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .car-card:hover .car-image img {
            transform: scale(1.05);
        }

        .car-details {
            padding: 1.5rem;
        }

        .car-name {
            font-size: 1.5rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
            color: var(--primary-color);
        }

        .car-info {
            font-size: 1rem;
            margin-bottom: 1rem;
            color: var(--text-color);
        }

        .car-price {
            font-size: 1.2rem;
            font-weight: 600;
            color: var(--accent-color);
            margin-bottom: 1.5rem;
        }

        .book-btn {
            display: inline-block;
            padding: 0.6rem 1.5rem;
            background: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 5px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            cursor: pointer;
            width: 100%;
            text-align: center;
        }

        .book-btn:hover {
            background: #f0c32c;
            transform: translateY(-2px);
        }

        /* Footer Styles */
        .footer {
            background: var(--primary-color);
            color: var(--light-text);
            padding: 3rem 2rem;
            margin-left: 250px;
            margin-top: 3rem;
            transition: var(--transition);
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

        /* Responsive Design */
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

            .filters-container {
                flex-direction: column;
                align-items: stretch;
            }

            .filter-group {
                width: 100%;
            }

            .filter-buttons {
                width: 100%;
                margin-top: 1rem;
                justify-content: center;
            }

            .car-grid {
                grid-template-columns: 1fr;
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
        }
    </style>
</head>

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

// Get filter values from the form
$brand = isset($_POST['brand']) ? $_POST['brand'] : '';
$transmission = isset($_POST['engine']) ? $_POST['engine'] : ''; 
$fuel_type = isset($_POST['fuel']) ? $_POST['fuel'] : ''; 
$seats = isset($_POST['seat']) ? $_POST['seat'] : ''; 

$sql = "SELECT * FROM car";
$whereClause = [];
$orderBy = '';

$whereClause[] = "car_avail > 0";

if (!empty($brand) && $brand != 'any') {
    $whereClause[] = "car_brand = '$brand'";
}
if (!empty($transmission) && $transmission != 'any') {
    $whereClause[] = "car_trans = '$transmission'";
}

if (!empty($fuel_type) && $fuel_type != 'any') {
    $whereClause[] = "car_fuel = '$fuel_type'";
}
if (!empty($seats) && $seats != 'any') {
    $whereClause[] = "car_seat = '$seats'";
}

if (!empty($whereClause)) {
    $sql .= " WHERE " . implode(' AND ', $whereClause);
}

if (!empty($orderBy)) {
    $sql .= " ORDER BY " . $orderBy;
}
$result = $conn->query($sql);
?>

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
        <!-- Filters Section -->
        <section class="filters-section">
            <form action="" method="post">
                <div class="filters-container">
                    <div class="filter-group">
                        <label for="brand">Brand:</label>
                        <select id="brand" name="brand">
                            <option value="any">All Brands</option>
                            <option value="Maruti Suzuki">Maruti Suzuki</option>
                            <option value="Honda">Honda</option>
                            <option value="Bmw">BMW</option>
                            <option value="Mercedes">Mercedes</option>
                            <option value="Audi">Audi</option>
                            <option value="Toyota">Toyota</option>
                            <option value="Nissan">Nissan</option>
                            <option value="Hyundai">Hyundai</option>
                            <option value="Kia">Kia</option>
                            <option value="Volkswagen">Volkswagen</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="engine">Transmission:</label>
                        <select id="engine" name="engine">
                            <option value="any">All Types</option>
                            <option value="Manual">Manual</option>
                            <option value="Automatic">Automatic</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="fuel">Fuel Type:</label>
                        <select id="fuel" name="fuel">
                            <option value="any">All Types</option>
                            <option value="Petrol">Petrol</option>
                            <option value="Diesel">Diesel</option>
                            <option value="Ev">EV</option>
                        </select>
                    </div>
                    
                    <div class="filter-group">
                        <label for="seat">Seats:</label>
                        <select id="seat" name="seat">
                            <option value="any">All</option>
                            <option value="5">5 Seater</option>
                            <option value="7">7 Seater</option>
                            <option value="9">9 Seater</option>
                        </select>
                    </div>
                    
                    <div class="filter-buttons">
                        <button type="reset" class="filter-btn reset">Reset</button>
                        <button type="submit" name="filter" class="filter-btn primary">Apply Filters</button>
                    </div>
                </div>
            </form>
        </section>

        <!-- Cars Grid -->
        <div class="car-grid">
            <?php
            if ($result && $result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="car-card">';
                    echo '<div class="car-image">';
                    $imageName = $row['car_img'];
                    echo '<img src="car_img/' . $imageName . '" alt="' . $row["car_name"] . '">';
                    echo '</div>';
                    echo '<div class="car-details">';
                    echo '<h3 class="car-name">' . $row["car_name"] . '</h3>';
                    echo '<div class="car-info">' . $row["car_seat"] . ' Seater | ' . $row["car_milege"] . '</div>';
                    echo '<div class="car-price">₹' . $row["car_price"] . ' per day</div>';
                    
                    if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
                        echo '<a href="login.php" class="book-btn">LOGIN TO BOOK</a>';
                    } else {
                        echo '<form action="booking.php" method="POST">';
                        echo '<input type="hidden" name="car_info" value="' . $row['car_no'] . '">';
                        echo '<button type="submit" class="book-btn">CHECK OUT</button>';
                        echo '</form>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div style="grid-column: 1/-1; text-align: center; padding: 2rem;">No cars found matching your criteria.</div>';
            }
            ?>
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



