<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>RentARide - Scrapping</title>
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
			<li class="nav-item"><a href="washing.php" class="nav-link"><i class="fas fa-soap"></i>Washing</a></li>
			<li class="nav-item"><a href="scrapping.php" class="nav-link active"><i class="fas fa-recycle"></i>Scrapping</a></li>
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
                <h1 class="section-title">Vehicle Scrapping Services</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-recycle"></i>
                    <div class="divider-line"></div>
                </div>
            </div>
            
            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; text-align: center;">
                <p style="margin-bottom: 1.5rem;">At RentARide, we offer comprehensive vehicle scrapping services designed to provide you with a hassle-free, eco-friendly, and legally compliant solution for disposing of your old vehicles. Our process ensures that your vehicle is recycled responsibly while maximizing the value you receive.</p>
                
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-bottom: 2rem;">
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-leaf" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Eco-Friendly Disposal</h3>
                        <p>Our scrapping process follows strict environmental guidelines to ensure that all vehicle components are properly recycled or disposed of. We recover reusable materials and safely handle hazardous substances, reducing the environmental impact of vehicle disposal.</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-check-circle" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Legal Compliance</h3>
                        <p>We handle all the legal paperwork associated with vehicle scrapping, including deregistration from RTO records and providing official certificates of destruction. Our process ensures full compliance with government regulations and frees you from future liabilities.</p>
                    </div>
                </div>
                
                <div style="display: flex; flex-wrap: wrap; gap: 2rem; justify-content: center; margin-bottom: 2rem;">
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-hand-holding-usd" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Best Value</h3>
                        <p>We offer competitive prices for your end-of-life vehicles based on their condition, weight, and salvageable parts. Our transparent valuation process ensures you get the best possible return on your old vehicle.</p>
                    </div>
                    
                    <div style="flex: 1; min-width: 300px; background: #f9f9f9; padding: 1.5rem; border-radius: 10px; box-shadow: 0 3px 10px rgba(0,0,0,0.08); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                        <div style="background-color: var(--accent-color); width: 70px; height: 70px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem auto;">
                            <i class="fas fa-clock" style="color: var(--primary-color); font-size: 2rem;"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">Hassle-Free Process</h3>
                        <p>Our streamlined process makes vehicle scrapping simple and convenient. We offer free vehicle pickup from your location, and our team handles everything from paperwork to final disposal, saving you time and effort.</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- How It Works Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">How It Works</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-cogs"></i>
                    <div class="divider-line"></div>
                </div>
                <p>Our simple 4-step process makes vehicle scrapping easy</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
                <div style="display: flex; flex-wrap: wrap; justify-content: center; gap: 2rem; margin-bottom: 2rem;">
                    <!-- Step 1 -->
                    <div style="flex: 1; min-width: 220px; max-width: 280px; position: relative; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;" class="service-card">
                        <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <span style="color: var(--primary-color); font-weight: bold;">1</span>
                        </div>
                        <div style="margin-top: 1rem; margin-bottom: 1rem;">
                            <i class="fas fa-car-alt" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem;">Submit Vehicle Details</h3>
                        <p style="color: #666;">Provide basic information about your vehicle including make, model, year, and its current condition.</p>
                    </div>

                    <!-- Step 2 -->
                    <div style="flex: 1; min-width: 220px; max-width: 280px; position: relative; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;" class="service-card">
                        <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <span style="color: var(--primary-color); font-weight: bold;">2</span>
                        </div>
                        <div style="margin-top: 1rem; margin-bottom: 1rem;">
                            <i class="fas fa-calculator" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem;">Get an Instant Quote</h3>
                        <p style="color: #666;">Receive a competitive, no-obligation quote based on current market rates for your vehicle's materials.</p>
                    </div>

                    <!-- Step 3 -->
                    <div style="flex: 1; min-width: 220px; max-width: 280px; position: relative; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;" class="service-card">
                        <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <span style="color: var(--primary-color); font-weight: bold;">3</span>
                        </div>
                        <div style="margin-top: 1rem; margin-bottom: 1rem;">
                            <i class="fas fa-calendar-alt" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem;">Schedule Pick-up/Drop-off</h3>
                        <p style="color: #666;">Choose a convenient time for free vehicle pick-up from your location or arrange to drop it off at our facility.</p>
                    </div>

                    <!-- Step 4 -->
                    <div style="flex: 1; min-width: 220px; max-width: 280px; position: relative; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;" class="service-card">
                        <div style="position: absolute; top: -20px; left: 50%; transform: translateX(-50%); background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <span style="color: var(--primary-color); font-weight: bold;">4</span>
                        </div>
                        <div style="margin-top: 1rem; margin-bottom: 1rem;">
                            <i class="fas fa-money-check-alt" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="color: var(--primary-color); margin-bottom: 1rem;">Get Paid & Documentation</h3>
                        <p style="color: #666;">Receive immediate payment and an official scrapping certificate that releases you from all future liabilities.</p>
                    </div>
                </div>
                
                <div style="text-align: center; margin-top: 1rem; margin-bottom: 2rem;">
                    <a href="#" class="btn" style="padding: 0.8rem 2rem; font-size: 1.1rem;">
                        <i class="fas fa-car" style="margin-right: 8px;"></i>Scrap Your Vehicle Now
                    </a>
                </div>
                
                <!-- Documents Required Section -->
                <div style="margin-top: 3rem; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <h3 style="color: var(--primary-color); margin-bottom: 1rem; text-align: center;">
                        <i class="fas fa-file-alt" style="color: var(--accent-color); margin-right: 10px;"></i>Documents Required
                    </h3>
                    <p style="text-align: center; margin-bottom: 1.5rem;">Please keep these documents ready to ensure a smooth scrapping process:</p>
                    
                    <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem;">
                        <div style="display: flex; align-items: flex-start; background: #f9f9f9; padding: 1rem; border-radius: 8px; transition: var(--transition);" class="document-item">
                            <div style="background-color: var(--accent-color); min-width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                <i class="fas fa-id-card" style="color: var(--primary-color);"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--primary-color);">Registration Certificate (RC)</h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Original RC book of the vehicle is mandatory for deregistration</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; align-items: flex-start; background: #f9f9f9; padding: 1rem; border-radius: 8px; transition: var(--transition);" class="document-item">
                            <div style="background-color: var(--accent-color); min-width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                <i class="fas fa-user-shield" style="color: var(--primary-color);"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--primary-color);">Owner ID Proof</h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Aadhar card, PAN card, Driving License, or any valid government-issued ID</p>
                            </div>
                        </div>
                        
                        <div style="display: flex; align-items: flex-start; background: #f9f9f9; padding: 1rem; border-radius: 8px; transition: var(--transition);" class="document-item">
                            <div style="background-color: var(--accent-color); min-width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                <i class="fas fa-file-contract" style="color: var(--primary-color);"></i>
                            </div>
                            <div>
                                <h4 style="margin: 0 0 0.5rem 0; color: var(--primary-color);">Insurance Papers</h4>
                                <p style="margin: 0; color: #666; font-size: 0.9rem;">Vehicle insurance documents (if applicable)</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Pricing & Valuation Section -->
        <section class="section">
            <div class="section-header">
                <h1 class="section-title">Pricing & Valuation</h1>
                <div class="section-divider">
                    <div class="divider-line"></div>
                    <i class="fas fa-coins"></i>
                    <div class="divider-line"></div>
                </div>
                <p>Understanding how we value your vehicle</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem;">
                <div style="margin-bottom: 2rem; text-align: center;">
                    <p style="max-width: 800px; margin: 0 auto 1.5rem auto;">At RentARide, we believe in complete transparency in our pricing process. The value of your vehicle is determined by several key factors that we carefully evaluate to offer you the best possible price.</p>
                </div>

                <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 2rem;">
                    <!-- Factor 1 -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);" class="service-card">
                        <div style="text-align: center; margin-bottom: 1rem;">
                            <i class="fas fa-chart-line" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="text-align: center; color: var(--primary-color); margin-bottom: 1rem;">Current Metal Prices</h3>
                        <p style="color: #666;">The base value of your vehicle is calculated according to current market rates for metals like steel, aluminum, copper, and other recoverable materials. Our prices adjust regularly to reflect market conditions.</p>
                    </div>

                    <!-- Factor 2 -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);" class="service-card">
                        <div style="text-align: center; margin-bottom: 1rem;">
                            <i class="fas fa-car-crash" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="text-align: center; color: var(--primary-color); margin-bottom: 1rem;">Vehicle Condition</h3>
                        <p style="color: #666;">The overall condition of your vehicle affects its value. We consider factors such as age, damage level, completeness of parts, and operational status when providing a quote for your vehicle.</p>
                    </div>

                    <!-- Factor 3 -->
                    <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);" class="service-card">
                        <div style="text-align: center; margin-bottom: 1rem;">
                            <i class="fas fa-cogs" style="font-size: 2.5rem; color: var(--accent-color);"></i>
                        </div>
                        <h3 style="text-align: center; color: var(--primary-color); margin-bottom: 1rem;">Salvageable Parts</h3>
                        <p style="color: #666;">Some components of your vehicle may have resale value. We evaluate functioning parts like engines, transmissions, electronics, and other components that can be refurbished and resold, increasing your vehicle's value.</p>
                    </div>
                </div>

                <!-- Valuation Tool Section -->
                <div style="background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%); padding: 2rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); margin-bottom: 2rem; position: relative; overflow: hidden;">
                    <div style="position: absolute; top: -30px; right: -30px; font-size: 180px; color: rgba(255, 212, 59, 0.1); transform: rotate(15deg); z-index: 0;">
                        <i class="fas fa-calculator"></i>
                    </div>
                    <div style="position: relative; z-index: 1;">
                        <div style="display: flex; align-items: center; margin-bottom: 1.5rem;">
                            <div style="background-color: var(--accent-color); width: 50px; height: 50px; border-radius: 50%; display: flex; align-items: center; justify-content: center; margin-right: 1rem;">
                                <i class="fas fa-search-dollar" style="color: var(--primary-color); font-size: 1.5rem;"></i>
                            </div>
                            <div>
                                <h3 style="margin: 0; color: var(--primary-color);">Free Online Valuation Tool</h3>
                                <p style="margin: 0.25rem 0 0 0; color: #666;">Get an instant estimate for your vehicle in seconds</p>
                            </div>
                        </div>
                        <p style="margin-bottom: 1.5rem;">Our transparent pricing policy means no hidden fees or last-minute price changes. Get a free, no-obligation valuation of your vehicle using our online tool below.</p>
                        
                        <div style="display: flex; flex-wrap: wrap; gap: 1rem;">
                            <div style="flex: 1; min-width: 200px;">
                                <label for="vehicle-make" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-car" style="color: var(--accent-color); margin-right: 8px;"></i>Vehicle Make</label>
                                <select id="vehicle-make" name="vehicle-make" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                                    <option value="">-- Select Make --</option>
                                    <option value="honda">Honda</option>
                                    <option value="toyota">Toyota</option>
                                    <option value="maruti">Maruti Suzuki</option>
                                    <option value="tata">Tata</option>
                                    <option value="mahindra">Mahindra</option>
                                    <option value="hyundai">Hyundai</option>
                                    <option value="other">Other</option>
                                </select>
                            </div>
                            <div style="flex: 1; min-width: 200px;">
                                <label for="vehicle-year" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-calendar-alt" style="color: var(--accent-color); margin-right: 8px;"></i>Manufacturing Year</label>
                                <select id="vehicle-year" name="vehicle-year" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                                    <option value="">-- Select Year --</option>
                                    <option value="2020">2020 or newer</option>
                                    <option value="2015">2015 - 2019</option>
                                    <option value="2010">2010 - 2014</option>
                                    <option value="2005">2005 - 2009</option>
                                    <option value="2000">2000 - 2004</option>
                                    <option value="older">Before 2000</option>
                                </select>
                            </div>
                            <div style="flex: 1; min-width: 200px;">
                                <label for="vehicle-condition" style="display: block; margin-bottom: 0.5rem; font-weight: 500;"><i class="fas fa-clipboard-check" style="color: var(--accent-color); margin-right: 8px;"></i>Overall Condition</label>
                                <select id="vehicle-condition" name="vehicle-condition" style="width: 100%; padding: 0.75rem; border: 1px solid #ddd; border-radius: 5px; font-family: inherit; transition: all 0.3s ease;">
                                    <option value="">-- Select Condition --</option>
                                    <option value="excellent">Excellent - Running</option>
                                    <option value="good">Good - Minor issues</option>
                                    <option value="fair">Fair - Major issues</option>
                                    <option value="poor">Poor - Not running</option>
                                    <option value="scrap">Complete scrap</option>
                                </select>
                            </div>
                        </div>
                        
                        <div style="text-align: center; margin-top: 1.5rem;">
                            <button id="calculate-btn" class="btn" style="padding: 0.8rem 2rem; font-size: 1.1rem;">
                                <i class="fas fa-calculator" style="margin-right: 8px;"></i>Calculate Value
                            </button>
                        </div>
                        
                        <!-- Calculation Result Section (initially hidden) -->
                        <div id="calculation-result" style="display: none; margin-top: 2rem; padding: 1.5rem; background: white; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center;">
                            <div style="margin-bottom: 1rem;">
                                <i class="fas fa-check-circle" style="font-size: 3rem; color: var(--accent-color);"></i>
                            </div>
                            <h3 style="color: var(--primary-color); margin-bottom: 0.5rem;">Estimated Value Range</h3>
                            <div id="value-amount" style="font-size: 2rem; font-weight: bold; color: var(--primary-color); margin-bottom: 1rem;">₹18,000 - ₹22,000</div>
                            <p style="color: #666; margin-bottom: 1.5rem;">This is an estimated range based on the information provided. Contact us for a precise valuation.</p>
                           
                        </div>

                        <script>
                            document.addEventListener('DOMContentLoaded', function() {
                                const calculateBtn = document.getElementById('calculate-btn');
                                const resultDiv = document.getElementById('calculation-result');
                                const valueAmount = document.getElementById('value-amount');
                                
                                calculateBtn.addEventListener('click', function() {
                                    const make = document.getElementById('vehicle-make').value;
                                    const year = document.getElementById('vehicle-year').value;
                                    const condition = document.getElementById('vehicle-condition').value;
                                    
                                    // Only calculate if all fields are filled
                                    if (make && year && condition) {
                                        // Simple calculation algorithm (for demonstration)
                                        let baseValue = 0;
                                        
                                        // Base value by year
                                        if (year === '2020') baseValue = 25000;
                                        else if (year === '2015') baseValue = 20000;
                                        else if (year === '2010') baseValue = 15000;
                                        else if (year === '2005') baseValue = 12000;
                                        else if (year === '2000') baseValue = 10000;
                                        else baseValue = 8000;
                                        
                                        // Adjustment for make
                                        const makeMultiplier = {
                                            'honda': 1.1,
                                            'toyota': 1.15,
                                            'maruti': 1.05,
                                            'tata': 1,
                                            'mahindra': 1.1,
                                            'hyundai': 1.05,
                                            'other': 0.95
                                        };
                                        
                                        baseValue *= makeMultiplier[make] || 1;
                                        
                                        // Adjustment for condition
                                        const conditionMultiplier = {
                                            'excellent': 1.2,
                                            'good': 1,
                                            'fair': 0.8,
                                            'poor': 0.6,
                                            'scrap': 0.4
                                        };
                                        
                                        baseValue *= conditionMultiplier[condition] || 1;
                                        
                                        // Create a range (±10%)
                                        const lowerValue = Math.round(baseValue * 0.9);
                                        const upperValue = Math.round(baseValue * 1.1);
                                        
                                        // Format the values with thousand separators
                                        const formattedLower = lowerValue.toLocaleString('en-IN');
                                        const formattedUpper = upperValue.toLocaleString('en-IN');
                                        
                                        // Update the value display
                                        valueAmount.textContent = `₹${formattedLower} - ₹${formattedUpper}`;
                                        
                                        // Show the result
                                        resultDiv.style.display = 'block';
                                        
                                        // Smooth scroll to the result
                                        resultDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                                    } else {
                                        alert('Please fill in all fields to calculate the value.');
                                    }
                                });
                            });
                        </script>
                    </div>
                </div>
                
                <div style="background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap;">
                    <div style="flex: 2; min-width: 200px;">
                        <h3 style="color: var(--primary-color); margin-bottom: 0.5rem;">Need a more precise valuation?</h3>
                        <p style="margin-bottom: 0; color: #666;">Contact our experts for a detailed assessment and personalized quote.</p>
                    </div>
                    <div style="flex: 1; min-width: 200px; text-align: right;">
                        <a href="#" class="btn" style="display: inline-block;">
                            <i class="fas fa-phone" style="margin-right: 8px;"></i>Contact Now
                        </a>
                    </div>
                </div>
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
                <p>See what our customers have to say about our scrapping services</p>
            </div>

            <div style="max-width: 1200px; margin: 0 auto; padding: 0 1rem; overflow-x: auto;">
                <div style="display: flex; gap: 1.5rem; padding: 1rem 0.5rem; flex-wrap: nowrap; min-width: min-content;">
                    
                    <!-- Review 1 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer1.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Amit+P&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Amit Patel</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"Incredible service from start to finish. The team made scrapping my 15-year-old Maruti hassle-free, handled all the paperwork, and gave me a fair price. Highly recommended!"</p>
                    </div>
                    
                    <!-- Review 2 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer2.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Priya+S&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Priya Sharma</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"I was worried about the deregistration process for my old Honda City, but RentARide took care of everything. The pick-up was prompt, and I received payment on the same day!"</p>
                    </div>
                    
                    <!-- Review 3 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer3.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Rahul+M&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Rahul Mehta</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"As a fleet owner, I needed to dispose of multiple vehicles efficiently. The team provided excellent service, offering competitive rates and completing all legal documentation properly."</p>
                    </div>
                    
                    <!-- Review 4 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer4.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Ananya+K&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Ananya Kumar</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"My old Hyundai was sitting unused for years, and I was concerned about the environmental impact. RentARide assured me it would be scrapped responsibly. They were professional and transparent throughout."</p>
                    </div>
                    
                    <!-- Review 5 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer5.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Vikram+S&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Vikram Singh</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"After my accident, I wasn't sure what to do with my damaged Tata Safari. RentARide offered me a fair value despite the condition and made the entire process straightforward. I appreciate their honesty."</p>
                    </div>
                    
                    <!-- Review 6 -->
                    <div style="min-width: 280px; background: white; padding: 1.5rem; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); text-align: center; transition: all 0.3s ease; position: relative;">
                        <div style="position: absolute; top: -15px; right: -15px; background-color: var(--accent-color); width: 40px; height: 40px; border-radius: 50%; display: flex; align-items: center; justify-content: center; box-shadow: 0 3px 10px rgba(0,0,0,0.1);">
                            <i class="fas fa-quote-right" style="color: var(--primary-color);"></i>
                        </div>
                        <div style="width: 80px; height: 80px; border-radius: 50%; overflow: hidden; margin: 0 auto 1rem auto; border: 3px solid var(--accent-color); transition: transform 0.3s ease;" class="reviewer-img">
                            <img src="images/customer6.jpg" alt="Customer" style="width: 100%; height: 100%; object-fit: cover;" onerror="this.src='https://ui-avatars.com/api/?name=Neha+D&background=random'">
                        </div>
                        <h3 style="margin-bottom: 0.5rem; color: var(--primary-color);">Neha Desai</h3>
                        <div style="color: var(--accent-color); font-size: 1.2rem; margin-bottom: 0.5rem;">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                        </div>
                        <p style="font-style: italic; color: #666;">"The valuation tool gave me a reasonable estimate, and the final offer was actually higher! The team was punctual for pickup and explained each step. Getting my certificate of destruction was seamless."</p>
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

        // Document item hover effects
        document.querySelectorAll('.document-item').forEach(item => {
            item.addEventListener('mouseenter', () => {
                item.style.transform = 'translateY(-5px)';
                item.style.boxShadow = '0 8px 15px rgba(0,0,0,0.1)';
            });
            item.addEventListener('mouseleave', () => {
                item.style.transform = 'translateY(0)';
                item.style.boxShadow = 'none';
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

