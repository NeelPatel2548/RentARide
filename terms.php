<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>RentARide - Terms and Conditions</title>
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
			padding: 2rem;
			transition: var(--transition);
			min-height: calc(100vh - 60px);
		}

		.page-title {
			color: var(--primary-color);
			font-size: 2.5rem;
			font-weight: 700;
			margin-bottom: 2rem;
			text-align: center;
			font-family: "Montserrat", sans-serif;
			position: relative;
			padding-bottom: 1rem;
		}

		.page-title::after {
			content: '';
			position: absolute;
			bottom: 0;
			left: 50%;
			transform: translateX(-50%);
			width: 100px;
			height: 3px;
			background-color: var(--accent-color);
		}

		/* Terms sections */
		.terms-section {
			background-color: white;
			border-radius: 10px;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			padding: 2rem;
			margin-bottom: 2rem;
		}

		.section-title {
			color: var(--primary-color);
			font-size: 1.5rem;
			font-weight: 600;
			margin-bottom: 1.5rem;
			display: flex;
			align-items: center;
		}

		.section-title i {
			color: var(--accent-color);
			margin-right: 0.75rem;
			font-size: 1.5rem;
		}

		.terms-list {
			list-style: none;
			margin-bottom: 1.5rem;
		}

		.term-item {
			position: relative;
			padding-left: 2.5rem;
			margin-bottom: 1rem;
			font-size: 1rem;
			color: #4a4a4a;
		}

		.term-item::before {
			content: '\f00c';
			font-family: 'Font Awesome 5 Free';
			font-weight: 900;
                position: absolute;
			left: 0;
			top: 0.15rem;
			color: var(--accent-color);
			background-color: rgba(255, 212, 59, 0.2);
			width: 1.75rem;
			height: 1.75rem;
			border-radius: 50%;
			display: flex;
			align-items: center;
			justify-content: center;
			font-size: 0.9rem;
		}

		.term-note {
			background-color: #f8f9fa;
			border-left: 4px solid var(--accent-color);
			padding: 1.5rem;
			margin: 2rem 0;
			border-radius: 0 5px 5px 0;
		}

		.term-note p {
			margin: 0;
			color: #4a4a4a;
		}

		.term-note strong {
			color: var(--primary-color);
			font-weight: 600;
		}

		/* Agreement section */
		.agreement-section {
			background-color: rgba(255, 212, 59, 0.1);
			padding: 2rem;
			border-radius: 10px;
			margin-top: 3rem;
			text-align: center;
		}

		.agreement-title {
			font-size: 1.3rem;
			color: var(--primary-color);
			margin-bottom: 1rem;
			font-weight: 600;
		}

		.agreement-text {
			font-size: 1rem;
			color: #4a4a4a;
			margin-bottom: 0;
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
				padding: 1.5rem;
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

			.page-title {
				font-size: 2rem;
			}

			.section-title {
				font-size: 1.3rem;
			}

			.term-item {
				font-size: 0.95rem;
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
			<li class="nav-item"><a href="scrapping.php" class="nav-link"><i class="fas fa-recycle"></i>Scrapping</a></li>
			<li class="nav-item"><a href="contact.php" class="nav-link"><i class="fas fa-envelope"></i>Contact Us</a></li>
			<li class="nav-item"><a href="terms.php" class="nav-link active"><i class="fas fa-file-contract"></i>Terms</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
			<li class="nav-item" style="background-color: red;"><a href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/01/12/20241101124511-I5H9O04S.json" target="_blank" class="nav-link"><i class="fas fa-question-circle"></i>Need a Help?</a></li>
				</ul>
				</nav>

	<!-- Overlay -->
	<div class="nav-overlay" id="navOverlay"></div>

	<!-- Main Content -->
	<main class="main-content">
		<h1 class="page-title">Terms and Conditions</h1>

		<!-- Booking Terms Section -->
		<section class="terms-section">
			<h2 class="section-title"><i class="fas fa-calendar-check"></i>Booking Terms</h2>
			<ul class="terms-list">
				<li class="term-item">30% of total booking amount should be given in advance as a booking confirmation. This deposit is required to secure your reservation.</li>
				<li class="term-item">In case of cancellation, no refund will be provided for the advance payment, regardless of the circumstances.</li>
				<li class="term-item">Booking amendments must be requested at least 48 hours prior to the scheduled pickup time and are subject to availability.</li>
				<li class="term-item">For extensions of rental periods, prior approval is required and will be subject to availability and additional charges.</li>
				<li class="term-item">Late returns without prior notice will incur additional charges calculated at 1.5 times the daily rate for each additional day or part thereof.</li>
			</ul>
		</section>

		<!-- Customer Responsibility Section -->
		<section class="terms-section">
			<h2 class="section-title"><i class="fas fa-user-shield"></i>Customer Responsibility</h2>
			<ul class="terms-list">
				<li class="term-item">The customer agrees and accepts that the use of services provided by RentARide is at the sole risk of the customer. In case of any incident during the journey, the company will not be liable.</li>
				<li class="term-item">Customers must carry their original ID proofs (driving license, Aadhar card, etc.) during the entire booking period, and these may be verified at the time of vehicle handover.</li>
				<li class="term-item">Soiling or damaging the seats or any other interior or exterior parts of the vehicle will result in additional charges that must be paid by the customer.</li>
				<li class="term-item">The vehicle must be returned with the same fuel level as at the time of pickup, unless otherwise agreed upon in advance.</li>
				<li class="term-item">The customer is responsible for any traffic violations, penalties, or fines incurred during the rental period.</li>
			</ul>
		</section>

		<!-- Driving Rules Section -->
		<section class="terms-section">
			<h2 class="section-title"><i class="fas fa-traffic-light"></i>Driving Rules</h2>
			<ul class="terms-list">
				<li class="term-item">Asking the chauffeur to break any traffic/RTO or government rules for any purpose (especially reaching the destination earlier) is prohibited, and the driver has the right to refuse such requests.</li>
				<li class="term-item">Driving under the influence of alcohol or drugs is strictly prohibited and will result in immediate termination of the rental without refund.</li>
				<li class="term-item">The vehicle must not be used for any illegal activities, racing, or any activities that may cause damage to the vehicle.</li>
				<li class="term-item">Smoking is strictly prohibited inside all rental vehicles. A cleaning fee of ₹2,000 will be charged for violations.</li>
				<li class="term-item">The number of passengers must not exceed the vehicle's specified capacity as mentioned in the registration certificate.</li>
			</ul>
		</section>

		<!-- Trip Rules Section -->
		<section class="terms-section">
			<h2 class="section-title"><i class="fas fa-route"></i>Trip Rules</h2>
			<ul class="terms-list">
				<li class="term-item">The trip will be conducted according to your mentioned itinerary. If you wish to visit additional locations, additional charges will apply.</li>
				<li class="term-item">By any chance, if your flight, train, or bus is missed, RentARide will not be liable for that.</li>
				<li class="term-item">Daily kilometer limits apply as per your selected package. Additional kilometers will be charged at the rate specified at the time of booking.</li>
				<li class="term-item">For overnight trips, driver accommodation and meals are to be arranged by the customer or additional charges will apply.</li>
				<li class="term-item">Off-road driving is strictly prohibited unless specifically agreed upon in writing prior to the rental.</li>
			</ul>
		</section>

		<!-- Vehicle Return Section -->
		<section class="terms-section">
			<h2 class="section-title"><i class="fas fa-undo-alt"></i>Vehicle Return</h2>
			<ul class="terms-list">
				<li class="term-item">The vehicle must be returned at the agreed location and time. Late returns without prior notification will incur additional charges.</li>
				<li class="term-item">The vehicle should be returned in the same condition as received, except for normal wear and tear.</li>
				<li class="term-item">A vehicle inspection will be conducted upon return, and any damages beyond normal wear and tear will be charged to the customer.</li>
				<li class="term-item">Personal belongings left in the vehicle after return are not the responsibility of RentARide.</li>
				<li class="term-item">The final payment settlement, including any additional charges, must be completed at the time of vehicle return.</li>
			</ul>
		</section>

		<div class="term-note">
			<p><strong>Note:</strong> RentARide reserves the right to modify, amend, or update these terms and conditions at any time without prior notice. It is the customer's responsibility to review these terms before each rental. By proceeding with a booking, you acknowledge that you have read, understood, and agree to abide by these terms and conditions.</p>
		</div>

		<!-- Agreement Section -->
		<div class="agreement-section">
			<h3 class="agreement-title">Legal Agreement</h3>
			<p class="agreement-text">The above-mentioned terms and conditions of use and the Privacy Policy constitute the entire agreement between the User(s) and RentARide with respect to access to and use of the website and the Services offered by RentARide, superseding any prior written or oral agreements in relation to the same subject matter herein.</p>
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
