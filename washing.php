<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentARide - Washing</title>
    <link rel="stylesheet" href="assets/css/poppins.css" type="text/css" media="all">
    <link rel="stylesheet" href="assets/css/montserrat.css" type="text/css" media="all">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
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

        /* Animation Styles */
        @keyframes float {
            0% { transform: translateY(0px); }
            50% { transform: translateY(-10px); }
            100% { transform: translateY(0px); }
        }
        
        @keyframes shine {
            0% { background-position: -100px; }
            100% { background-position: 320px; }
        }

        .float-icon {
            animation: float 3s ease-in-out infinite;
            display: inline-block;
        }
        
        .shine-effect {
            position: relative;
            overflow: hidden;
        }
        
        .shine-effect::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(to right, rgba(255,255,255,0) 0%, rgba(255,255,255,0.3) 50%, rgba(255,255,255,0) 100%);
            transform: skewX(-25deg);
            animation: shine 3s infinite;
        }
        
        /* Input focus effects */
        input:focus, select:focus, textarea:focus {
            outline: none;
            border-color: var(--accent-color) !important;
            box-shadow: 0 0 0 3px rgba(255, 212, 59, 0.25) !important;
        }
        
        /* Checkbox styling */
        .checkbox-option {
            transition: var(--transition);
        }
        
        .checkbox-option:hover {
            transform: translateX(5px);
        }
        
        /* Service card hover animations */
        .service-card {
            transition: transform 0.3s ease, box-shadow 0.3s ease !important;
        }
        
        .service-card:hover {
            transform: translateY(-10px) !important;
            box-shadow: 0 15px 30px rgba(0,0,0,0.15) !important;
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
            color: var(--accent-color);
            margin-bottom: 1rem;
        }

        .service-card p {
            color: #666;
            margin-bottom: 1.5rem;
        }

        .btn {
            display: inline-block;
            background: var(--accent-color);
            color: var(--primary-color);
            padding: 0.75rem 1.5rem;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 600;
            transition: var(--transition);
            border: 2px solid var(--accent-color);
        }

        .btn:hover {
            background: transparent;
            color: var(--accent-color);
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
			<li class="nav-item"><a href="bikes.php" class="nav-link"><i class="fas fa-motorcycle"></i>Bikes</a></li>
			<li class="nav-item"><a href="washing.php" class="nav-link active"><i class="fas fa-soap"></i>Washing</a></li>
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
        <!-- Introduction Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Professional Washing Services</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-water"></i>
                    <div class="divider-line"></div>
                </div>
            </div>
            
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center;">
                <p style="margin-bottom: 1.5rem;">At RentARide, we understand that keeping your vehicles clean is essential for both appearance and longevity. Our professional washing services for cars and bikes are designed to provide thorough cleaning while protecting your vehicle's finish.</p>
                
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-bottom: 2rem;">
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-car" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Car Washing</h3>
                        <p>Our car washing services use premium cleaning agents that remove dirt, grime, and contaminants without damaging your vehicle's paint. From compact cars to luxury vehicles, we tailor our approach to each vehicle's specific needs.</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-motorcycle" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Bike Washing</h3>
                        <p>Our specialized bike washing service pays careful attention to the unique requirements of motorcycles. We clean hard-to-reach areas and sensitive components with precision, ensuring your bike looks great and performs optimally.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Service Packages Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Service Packages</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-tags"></i>
                    <div class="divider-line"></div>
                </div>
                <p>Choose the perfect package for your vehicle's needs</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem; margin-bottom: 1.5rem;">
                    <!-- Basic Wash -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;" class="service-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem;">
                            <h2 style="color: var(--primary-color); margin: 0; font-size: 1.5rem;">
                                <div style="display: inline-block; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; vertical-align: middle;">
                                    <i class="fas fa-car-wash" style="color: var(--primary-color);"></i>
                                </div>
                                Basic Wash
                            </h2>
                            <span style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color);">₹499</span>
                        </div>
                        <ul style="list-style-type: none; margin: 0; padding: 0;">
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Exterior cleaning
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Wheel cleaning
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Windows and mirrors
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Tire dressing
                            </li>
                        </ul>
                        <a href="#" class="btn" style="margin-top: 1rem; display: inline-block;">
                            <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> Book Now
                        </a>
                    </div>

                    <!-- Standard Wash -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;" class="service-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem;">
                            <h2 style="color: var(--primary-color); margin: 0; font-size: 1.5rem;">
                                <div style="display: inline-block; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; vertical-align: middle;">
                                    <i class="fas fa-car" style="color: var(--primary-color);"></i>
                                </div>
                                Standard Wash
                            </h2>
                            <span style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color);">₹899</span>
                        </div>
                        <ul style="list-style-type: none; margin: 0; padding: 0;">
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Complete exterior wash
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Interior vacuuming
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Dashboard and console cleaning
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Door jambs cleaning
                            </li>
                        </ul>
                        <a href="#" class="btn" style="margin-top: 1rem; display: inline-block;">
                            <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> Book Now
                        </a>
                    </div>

                    <!-- Premium Wash -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;" class="service-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem;">
                            <h2 style="color: var(--primary-color); margin: 0; font-size: 1.5rem;">
                                <div style="display: inline-block; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; vertical-align: middle;">
                                    <i class="fas fa-gem" style="color: var(--primary-color);"></i>
                                </div>
                                Premium Wash
                            </h2>
                            <span style="font-size: 1.5rem; font-weight: bold; color: var(--accent-color);">₹1499</span>
                        </div>
                        <ul style="list-style-type: none; margin: 0; padding: 0;">
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Deep cleaning interior & exterior
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Waxing and paint protection
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Leather conditioning
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; transition: transform 0.3s ease;" class="package-feature">
                                <i class="fas fa-check" style="color: var(--accent-color); position: absolute; left: 0; top: 0.3rem;"></i>
                                Air freshening
                            </li>
                        </ul>
                        <a href="#" class="btn" style="margin-top: 1rem; display: inline-block;">
                            <i class="fas fa-shopping-cart" style="margin-right: 5px;"></i> Book Now
                        </a>
                    </div>

                    <!-- Add-ons -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;" class="service-card">
                        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1rem; border-bottom: 1px solid #eee; padding-bottom: 0.5rem;">
                            <h2 style="color: var(--primary-color); margin: 0; font-size: 1.5rem;">
                                <div style="display: inline-block; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: inline-flex; align-items: center; justify-content: center; margin-right: 10px; vertical-align: middle;">
                                    <i class="fas fa-plus-circle" style="color: var(--primary-color);"></i>
                                </div>
                                Add-ons
                            </h2>
                            <span style="font-size: 1rem; font-weight: bold; color: var(--accent-color);">Additional Services</span>
                        </div>
                        <ul style="list-style-type: none; margin: 0; padding: 0;">
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; display: flex; justify-content: space-between; transition: transform 0.3s ease;" class="package-feature">
                                <span><i class="fas fa-cog" style="color: var(--accent-color); margin-right: 0.5rem;"></i>Engine cleaning</span>
                                <span style="font-weight: bold;">₹599</span>
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; display: flex; justify-content: space-between; transition: transform 0.3s ease;" class="package-feature">
                                <span><i class="fas fa-tint" style="color: var(--accent-color); margin-right: 0.5rem;"></i>Ceramic coating</span>
                                <span style="font-weight: bold;">₹3999</span>
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; display: flex; justify-content: space-between; transition: transform 0.3s ease;" class="package-feature">
                                <span><i class="fas fa-couch" style="color: var(--accent-color); margin-right: 0.5rem;"></i>Upholstery deep clean</span>
                                <span style="font-weight: bold;">₹799</span>
                            </li>
                            <li style="margin-bottom: 0.5rem; padding-left: 1.5rem; position: relative; display: flex; justify-content: space-between; transition: transform 0.3s ease;" class="package-feature">
                                <span><i class="fas fa-spray-can" style="color: var(--accent-color); margin-right: 0.5rem;"></i>Headlight restoration</span>
                                <span style="font-weight: bold;">₹499</span>
                            </li>
                        </ul>
                        <a href="#" class="btn" style="margin-top: 1rem; display: inline-block;">
                            <i class="fas fa-plus" style="margin-right: 5px;"></i> Add to Service
                        </a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Booking Form Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Book a Wash</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-calendar-check"></i>
                    <div class="divider-line"></div>
                </div>
                <p>Schedule your washing service now</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
                <form action="process_booking.php" method="POST" style="background: white; padding: 2rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); position: relative; overflow: hidden;" class="booking-form">
                    <div class="form-bg-icon" style="position: absolute; right: -20px; bottom: -20px; font-size: 180px; color: rgba(255, 212, 59, 0.05); transform: rotate(-15deg); z-index: 0;">
                        <i class="fas fa-car-wash"></i>
                    </div>
                    <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem; position: relative; z-index: 1;">
                        <div style="flex: 1; min-width: 200px;">
                            <label for="name" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-user" style="color: var(--accent-color); margin-right: 8px;"></i>Full Name</label>
                            <input type="text" id="name" name="name" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label for="email" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-envelope" style="color: var(--accent-color); margin-right: 8px;"></i>Email Address</label>
                            <input type="email" id="email" name="email" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label for="contact" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-phone" style="color: var(--accent-color); margin-right: 8px;"></i>Contact Number</label>
                            <input type="tel" id="contact" name="contact" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                        </div>
                    </div>
                    
                    <div style="display: flex; flex-wrap: wrap; gap: 1.5rem; margin-bottom: 1.5rem; position: relative; z-index: 1;">
                        <div style="flex: 1; min-width: 200px;">
                            <label for="package" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-tag" style="color: var(--accent-color); margin-right: 8px;"></i>Select Package</label>
                            <select id="package" name="package" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                                <option value="">-- Select a Package --</option>
                                <option value="basic">Basic Wash - ₹499</option>
                                <option value="standard">Standard Wash - ₹899</option>
                                <option value="premium">Premium Wash - ₹1499</option>
                            </select>
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label for="date" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-calendar-alt" style="color: var(--accent-color); margin-right: 8px;"></i>Preferred Date</label>
                            <input type="date" id="date" name="date" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                        </div>
                        
                        <div style="flex: 1; min-width: 200px;">
                            <label for="time" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-clock" style="color: var(--accent-color); margin-right: 8px;"></i>Preferred Time</label>
                            <select id="time" name="time" required style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                                <option value="">-- Select Time --</option>
                                <option value="morning">Morning (9AM - 12PM)</option>
                                <option value="afternoon">Afternoon (12PM - 3PM)</option>
                                <option value="evening">Evening (3PM - 6PM)</option>
                            </select>
                        </div>
                    </div>
                    
                    <div style="margin-bottom: 1.5rem; position: relative; z-index: 1;">
                        <label style="display: block; margin-bottom: 0.75rem; font-weight: 500;"><i class="fas fa-plus-circle" style="color: var(--accent-color); margin-right: 8px;"></i>Add-on Services (Optional)</label>
                        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem;">
                            <div style="display: flex; align-items: center;" class="checkbox-option">
                                <input type="checkbox" id="engine_cleaning" name="add_ons[]" value="engine_cleaning" style="margin-right: 0.5rem;">
                                <label for="engine_cleaning">Engine Cleaning (₹599)</label>
                            </div>
                            <div style="display: flex; align-items: center;" class="checkbox-option">
                                <input type="checkbox" id="ceramic_coating" name="add_ons[]" value="ceramic_coating" style="margin-right: 0.5rem;">
                                <label for="ceramic_coating">Ceramic Coating (₹3999)</label>
                            </div>
                            <div style="display: flex; align-items: center;" class="checkbox-option">
                                <input type="checkbox" id="upholstery" name="add_ons[]" value="upholstery" style="margin-right: 0.5rem;">
                                <label for="upholstery">Upholstery Clean (₹799)</label>
                            </div>
                            <div style="display: flex; align-items: center;" class="checkbox-option">
                                <input type="checkbox" id="headlight" name="add_ons[]" value="headlight" style="margin-right: 0.5rem;">
                                <label for="headlight">Headlight Restoration (₹499)</label>
                            </div>
                        </div>
                    </div>
                    
                    <div style="display: flex; gap: 1.5rem; margin-bottom: 1.5rem; position: relative; z-index: 1;">
                        <div style="flex: 2;">
                            <label for="message" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-comment" style="color: var(--accent-color); margin-right: 8px;"></i>Additional Notes (Optional)</label>
                            <textarea id="message" name="message" rows="3" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;"></textarea>
                        </div>
                        <div style="flex: 1; display: flex; align-items: flex-end;">
                            <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem; border: none; cursor: pointer; position: relative; overflow: hidden;">
                                <i class="fas fa-calendar-check" style="margin-right: 8px;"></i>Book Now
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </section>

        <!-- Customer Reviews Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Customer Reviews</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-star"></i>
                    <div class="divider-line"></div>
                </div>
                <p>See what our customers have to say about our washing services</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; overflow-x: auto;">
                <div style="display: flex; gap: 1.5rem; padding: 1rem 0.5rem; flex-wrap: nowrap; min-width: min-content;">
                    
                    <!-- Review 1 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer1.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=John+D&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">John Doe</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"The premium wash service was incredible! My car looks brand new. The attention to detail was impressive, especially the interior cleaning."</p>
                    </div>
                    
                    <!-- Review 2 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer2.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Sarah+M&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Sarah Miller</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"I've tried many bike washing services but RentARide's special attention to the chain and sensitive components was exceptional. Highly recommend!"</p>
                    </div>
                    
                    <!-- Review 3 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer3.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Raj+P&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Raj Patel</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"The ceramic coating add-on was worth every penny! Six months later and my car still repels water and dirt like it's brand new. Great investment!"</p>
                    </div>
                    
                    <!-- Review 4 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer4.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Aisha+K&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Aisha Khan</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"Quick service and friendly staff. I got the basic wash and it was thorough and well done. The tire dressing made my car look especially sharp."</p>
                    </div>
                    
                    <!-- Review 5 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer5.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=James+W&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">James Wilson</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"I brought in my SUV for the Premium Wash after an off-road trip, and they completely transformed it! The leather conditioning made the interior look and smell like new again."</p>
                    </div>
                    
                    <!-- Review 6 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer6.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Meera+P&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Meera Patel</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"The Standard Wash service is excellent value for money. My 5-year-old car looks rejuvenated, and the staff was very thorough with the interior vacuuming. Will definitely return!"</p>
                    </div>
                    
                    <!-- Additional reviews collapsed for brevity in this edit -->
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

        // Package feature hover effects
        document.querySelectorAll('.package-feature').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateX(5px)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateX(0)';
            });
        });

        // Reviewer image hover effects
        document.querySelectorAll('.reviewer-img').forEach(img => {
            img.addEventListener('mouseenter', () => {
                img.style.transform = 'scale(1.1)';
            });
            img.addEventListener('mouseleave', () => {
                img.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>

