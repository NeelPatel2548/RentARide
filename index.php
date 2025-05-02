<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentARide - Home</title>
    <link rel="stylesheet" href="poppins.css" type="text/css" media="all">
    <link rel="stylesheet" href="montserrat.css" type="text/css" media="all">
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
            padding: 1rem;
            transition: var(--transition);
            min-height: calc(100vh - 60px);
        }

        /* Hero Section */
        .hero {
            position: relative;
            height: 60vh;
            overflow: hidden;
            margin-bottom: 2rem;
        }

        .hero-slide {
            position: absolute;
            top: 28px;
            left: 0;
            width: 100%;
            height: 100%;
            opacity: 0;
            transition: opacity 0.5s ease;
        }

        .hero-slide.active {
            opacity: 1;
        }

        .hero-slide img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        /* Section Styles */
        .section {
            padding: 2rem 0;
        }

        .section-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .section-title {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 0.5rem;
        }

        .section-divider {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .divider-line {
            width: 50px;
            height: 2px;
            background: #dddddd;
        }

        /* Service Cards */
        .service-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            padding: 1rem;
        }

        .service-card {
            background: white;
            padding: 1.5rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
            text-align: center;
        }

        .service-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2);
        }

        .service-card h2 {
            color: var(--text-color);
            margin-bottom: 1rem;
            transition: var(--transition);
        }

        .service-card:hover h2 {
            color: var(--accent-color);
        }

        .service-card i {
            font-size: 2rem;
            color: var(--text-color);
            margin-bottom: 1rem;
        }

        /* Fleet Section */
        .fleet-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            padding: 1rem;
        }

        .fleet-item {
            text-align: center;
            transition: var(--transition);
        }

        .fleet-item img {
            width: 100%;
            max-width: 300px;
            height: auto;
            transition: var(--transition);
        }

        .fleet-item:hover img {
            transform: scale(1.05);
        }

        /* Partner Section */
        .partner-section {
            background: #f8f9fa;
            padding: 4rem 0;
        }

        .partner-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 2rem;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 2rem;
        }

        .partner-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: var(--transition);
            display: flex;
            flex-direction: column;
            height: 100%;
        }

        .partner-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0,0,0,0.15);
        }

        .partner-image {
            width: 100%;
            height: 200px;
            overflow: hidden;
            background-color: #f8f9fa;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .partner-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: var(--transition);
        }

        .partner-card:hover .partner-image img {
            transform: scale(1.05);
        }

        .partner-details {
            padding: 1.5rem;
            text-align: center;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .partner-details h3 {
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            font-size: 1.2rem;
        }

        .partner-details p {
            color: var(--text-color);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
            line-height: 1.6;
        }

        .partner-details .partner-links {
            margin-top: 1rem;
            display: flex;
            justify-content: center;
            gap: 1rem;
        }

        .partner-details .partner-links a {
            color: var(--accent-color);
            font-size: 1rem;
            transition: var(--transition);
        }

        .partner-details .partner-links a:hover {
            color: var(--primary-color);
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

            .hero {
                height: 50vh;
            }

            .section-title {
                font-size: 1.75rem;
            }

            .service-grid, .service-grid.second-row {
                grid-template-columns: 1fr;
                padding: 0.5rem;
            }

            .fleet-grid {
                grid-template-columns: 1fr;
                padding: 0.5rem;
            }

            .partner-grid {
                grid-template-columns: repeat(2, 1fr);
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

        @media (max-width: 480px) {
            .hero {
                height: 40vh;
            }

            .section-title {
                font-size: 1.5rem;
            }

            .service-card,
            .fleet-item {
                padding: 1rem;
            }

            .partner-image {
                height: 200px;
            }
        }

        @media (max-width: 992px) {
            .partner-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 576px) {
            .partner-grid {
                grid-template-columns: 1fr;
            }

            .partner-image {
                height: 200px;
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
            <li class="nav-item"><a href="index.php" class="nav-link active"><i class="fas fa-home"></i>Home</a></li>
            <li class="nav-item"><a href="login.php" class="nav-link"><i class="fas fa-sign-in-alt"></i>Login</a></li>
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
        <!-- Hero Section -->
        <section class="hero">
            <div class="hero-slide active">
                <img src="images/slide1.jpg" alt="Slide 1">
            </div>
            <div class="hero-slide">
                <img src="images/slide2.jpg" alt="Slide 2">
            </div>
            <div class="hero-slide">
                <img src="images/slide3.jpg" alt="Slide 3">
            </div>
            <div class="hero-slide">
                <img src="images/slide4.jpg" alt="Slide 4">
            </div>
            <div class="hero-slide">
                <img src="images/slide5.jpg" alt="Slide 5">
            </div>
        </section>

        <!-- Services Section -->
        <section class="section">
            <div class="section-header">
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <h2 class="section-title">OUR SERVICE</h2>
                    <div class="divider-line"></div>
                </div>
            </div>
            <div class="service-grid">
                <div class="service-card">
                    <i class="fa-solid fa-car"></i>
                    <h2>Car Rental Service</h2>
                    <p>Discover freedom and flexibility with our car rental service. Choose from a wide range of vehicles, book effortlessly, and embark on your next adventure.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-motorcycle"></i>
                    <h2>Bike Rental Service</h2>
                    <p>Rent a bike and set your own pace. Enjoy convenient pickup and drop-off locations, affordable rates, and top-notch customer service.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-comment-nodes"></i>
                    <h2>Help With AI</h2>
                    <p>Let us be your AI partner. We offer personalized support, tailored solutions, and ongoing assistance to help you.</p>
                </div>
            </div>
            <div class="service-grid second-row" style="grid-template-columns: repeat(2, 1fr); margin-top: 1.5rem;">
                <div class="service-card">
                    <i class="fa-solid fa-recycle"></i>
                    <h2>Scrapping Service</h2>
                    <p>Dispose of your old vehicles responsibly. Our scrapping service ensures proper recycling and environmentally-friendly disposal of all vehicle parts.</p>
                </div>
                <div class="service-card">
                    <i class="fa-solid fa-shower"></i>
                    <h2>Washing Service</h2>
                    <p>Keep your vehicle looking its best with our professional washing service. We use high-quality products to clean and detail your car or bike.</p>
                </div>
            </div>
        </section>

        <!-- Fleet Section -->
        <section class="section">
            <div class="section-header">
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <h2 class="section-title">OUR FLEET</h2>
                    <div class="divider-line"></div>
                </div>
            </div>
            <div class="fleet-grid">
                <div class="fleet-item">
                    <a href="cars.php">
                        <img src="./car_img/HomeCar.png" alt="Car Fleet">
                    </a>
                </div>
                <div class="fleet-item">
                    <a href="bikes.php">
                        <img src="./bike_img/HomeBike.png" alt="Bike Fleet">
                    </a>
                </div>
            </div>
        </section>

        <!-- Partner Section -->
        <section class="section partner-section">
            <div class="section-header">
            <div class="section-divider">
                    <div class="divider-line"></div>
                    <h2 class="section-title">OUR PARTNERS</h2>
                    <div class="divider-line"></div>
                </div>
            </div>
            <div class="partner-grid">
                <!-- Partner 1 -->
                <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/male1.png" alt="Partner 1">
                    </div>
                    <div class="partner-details">
                        <h3>John Smith</h3>
                        <p>CEO, Auto Solutions</p>
                        <p>10+ years experience in car rental industry</p>
                    </div>
                </div>


                <!-- Partner 2 -->
                              <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/female_1.png" alt="Partner 6">
                    </div>
                    <div class="partner-details">
                        <h3>Lisa Anderson</h3>
                        <p>Business Development Manager</p>
                        <p>Strategic partnerships expert</p>
                    </div>
                </div>
                <!-- Partner 3 -->
                <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/male1.png" alt="Partner 3">
                    </div>
                    <div class="partner-details">
                        <h3>Michael Brown</h3>
                        <p>Customer Relations Director</p>
                        <p>Specialized in customer satisfaction</p>
                    </div>
                </div>

                <!-- Partner 4 -->
                <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/female_1.png" alt="Partner 4">
                    </div>
                    <div class="partner-details">
                        <h3>Emily Davis</h3>
                        <p>Marketing Head, Auto Brand</p>
                        <p>Digital marketing expert</p>
                    </div>
                </div>

                <!-- Partner 5 -->
                <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/female_1.png" alt="Partner 5">
                    </div>
                    <div class="partner-details">
                        <h3>David Wilson</h3>
                        <p>Technical Director</p>
                        <p>Vehicle maintenance specialist</p>
                    </div>
                </div>

                <!-- Partner 6 -->
                <div class="partner-card">
                    <div class="partner-image">
                        <img src="images/illustrations/male1.png" alt="Partner 2">
                    </div>
                    <div class="partner-details">
                        <h3>Sarah Johnson</h3>
                        <p>Operations Manager, Fleet Services</p>
                        <p>Expert in fleet management and logistics</p>
                    </div>
                </div>

                </div>
            </div>
        </section>
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

        // Hero Slider
        const heroSlides = document.querySelectorAll('.hero-slide');
        let currentSlide = 0;

        function nextSlide() {
            heroSlides[currentSlide].classList.remove('active');
            currentSlide = (currentSlide + 1) % heroSlides.length;
            heroSlides[currentSlide].classList.add('active');
        }

        setInterval(nextSlide, 3000);

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