<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<title>RentARide - Contact Us</title>
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
			padding: 0;
			transition: var(--transition);
			min-height: calc(100vh - 60px);
		}

		/* Map Section */
		.map-container {
			width: 100%;
			height: 450px;
				border: none;
			margin-bottom: 3rem;
		}

		/* Contact Cards */
		.contact-cards {
			display: grid;
			grid-template-columns: repeat(3, 1fr);
			gap: 2rem;
			padding: 0 3rem;
			margin-bottom: 3rem;
		}

		.contact-card {
			background: white;
			border-radius: 10px;
			padding: 2rem;
			text-align: center;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			transition: var(--transition);
		}

		.contact-card:hover {
			transform: translateY(-10px);
			box-shadow: 0 15px 30px rgba(0,0,0,0.2);
		}

		.contact-card i {
			font-size: 3rem;
			color: var(--accent-color);
			margin-bottom: 1.5rem;
		}

		.contact-card h3 {
			font-size: 1.5rem;
			margin-bottom: 1rem;
			color: var(--primary-color);
		}

		.contact-card p {
			color: var(--text-color);
			font-size: 1rem;
		}

		/* Contact Form Section */
		.form-section {
			padding: 3rem;
			background: #f8f9fa;
		}

		.section-title {
				text-align: center;
			margin-bottom: 2rem;
			font-size: 2rem;
			color: var(--primary-color);
		}

		.contact-form {
			max-width: 800px;
			margin: 0 auto;
			background: white;
			border-radius: 10px;
			padding: 2rem;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
		}

		.form-row {
			display: grid;
			grid-template-columns: 1fr 1fr;
			gap: 1.5rem;
			margin-bottom: 1.5rem;
		}

		.form-group {
			margin-bottom: 1.5rem;
		}

		.form-label {
			display: block;
			margin-bottom: 0.5rem;
			font-weight: 600;
			color: var(--primary-color);
		}

		.form-control {
			width: 100%;
			padding: 0.75rem 1rem;
			font-size: 1rem;
			border: 1px solid #ddd;
			border-radius: 5px;
			transition: var(--transition);
		}

		.form-control:focus {
			border-color: var(--accent-color);
			outline: none;
			box-shadow: 0 0 0 2px rgba(255, 212, 59, 0.25);
		}

		textarea.form-control {
			min-height: 150px;
			resize: vertical;
		}

		.submit-btn {
			background: var(--accent-color);
			color: var(--primary-color);
			border: none;
			padding: 0.75rem 2rem;
			font-size: 1rem;
			font-weight: 600;
			border-radius: 5px;
			cursor: pointer;
			transition: var(--transition);
		}

		.submit-btn:hover {
			background: #f0c32c;
			transform: translateY(-3px);
		}

		/* Popup styles */
		.popup {
			opacity: 0;
			background-color: var(--primary-color);
			color: white;
			padding: 1rem;
			border-radius: 5px;
			margin-top: 1rem;
			position: relative;
			transition: var(--transition);
		}

		.popup::after {
			content: "";
			position: absolute;
			top: -10px;
			left: 20px;
			border-width: 5px;
			border-style: solid;
			border-color: transparent transparent var(--primary-color) transparent;
		}

		/* Vehicle Booking Form */
		#registration {
			display: none;
			background: white;
			border-radius: 10px;
			padding: 2rem;
			box-shadow: 0 5px 15px rgba(0,0,0,0.1);
			margin-bottom: 2rem;
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

			.contact-cards {
				grid-template-columns: 1fr;
				padding: 0 1.5rem;
			}

			.form-row {
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

		/* Form Message Styles */
		.form-message {
			margin: 1rem 0;
			padding: 1rem;
			border-radius: 5px;
			display: none;
		}

		.form-message.success {
			background-color: #d4edda;
			color: #155724;
			border: 1px solid #c3e6cb;
		}

		.form-message.error {
			background-color: #f8d7da;
			color: #721c24;
			border: 1px solid #f5c6cb;
		}

		.submit-btn:disabled {
			background-color: #cccccc;
			cursor: not-allowed;
			transform: none;
		}
		</style>
	</head>

	<body onload="Display()">
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
			<li class="nav-item"><a href="contact.php" class="nav-link active"><i class="fas fa-envelope"></i>Contact Us</a></li>
			<li class="nav-item"><a href="terms.php" class="nav-link"><i class="fas fa-file-contract"></i>Terms</a></li>
			<li class="nav-item"><a href="logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i>Logout</a></li>
			<li class="nav-item" style="background-color: red;"><a href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/01/12/20241101124511-I5H9O04S.json" target="_blank" class="nav-link"><i class="fas fa-question-circle"></i>Need a Help?</a></li>
				</ul>
				</nav>

	<!-- Overlay -->
	<div class="nav-overlay" id="navOverlay"></div>

	<!-- Main Content -->
	<main class="main-content">
		<!-- Map Section -->
		<iframe id="Sticky" class="map-container" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2264.767662719164!2d72.123896903668!3d21.760025443301746!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395f508e8713c861%3A0x30e53a30d08cfcf8!2sQ46F%2B4PM%2C%20R.T.O%20Rd%2C%20Vijayrajnagar%2C%20Bhavnagar%2C%20Gujarat%20364002!5e0!3m2!1sen!2sin!4v1730975513317!5m2!1sen!2sin" allowfullscreen="" loading="lazy"></iframe>

		<!-- Contact Cards -->
		<div class="contact-cards">
			<div class="contact-card">
				<i class="fas fa-map-marker-alt"></i>
				<h3>Visit Us</h3>
				<p>Vijayraj Nagar, Bhavanagar</p>
				<p>Gujarat, India</p>
			</div>
			
			<div class="contact-card">
				<i class="fas fa-envelope"></i>
				<h3>Email Us</h3>
				<p>rentAride@gmail.com</p>
				<p>Info@RentARide.in</p>
			</div>
			
			<div class="contact-card">
				<i class="fas fa-phone-alt"></i>
				<h3>Call Us</h3>
				<p>+91-7305010188</p>
				<p>+91-8384066726</p>
			</div>
		</div>

		<!-- Vehicle Booking Form - Only displayed when needed -->
		<div class="form-section" id="registration">
			<h2 class="section-title">Vehicle Booking</h2>
			<form method="post" enctype="multipart/form-data" class="contact-form">
				<div class="form-row">
					<div class="form-group">
						<label class="form-label">Vehicle:</label>
						<input type="text" name="vehicle" id="display1" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label class="form-label">Amount:</label>
						<input type="text" name="amount" id="display2" class="form-control" readonly>
					</div>
				</div>
				<div class="form-group">
					<label class="form-label">Booking Date:</label>
					<input type="date" name="date" id="date" class="form-control" onchange="CheckDate()">
					<div id="Popup" class="popup">
						<i class="fas fa-exclamation-circle"></i> Sorry! The vehicle is already booked on this date. Please select a different date or book another vehicle.
					</div>
				</div>
				<div class="form-group">
					<label class="form-label">Upload Driving License:</label>
					<input type="file" id="accept" accept="image/*" name="license" class="form-control">
				</div>
				<button type="submit" name="submit" class="submit-btn" onclick="DATE()">
					<i class="fas fa-paper-plane"></i> Submit Booking
				</button>
			</form>
		</div>

		<!-- Contact Form -->
		<div class="form-section">
			<h2 class="section-title">Get In Touch</h2>
			<form method="post" class="contact-form">
				<div class="form-row">
					<div class="form-group">
						<label for="name" class="form-label">Your Name</label>
						<input type="text" id="name" name="name" class="form-control" placeholder="Enter your name" required>
					</div>
					<div class="form-group">
						<label for="email" class="form-label">Your Email</label>
						<input type="email" id="email" name="email" class="form-control" placeholder="Enter your email" required>
					</div>
				</div>
				<div class="form-row">
					<div class="form-group">
						<label for="phone" class="form-label">Phone Number</label>
						<input type="text" id="phone" name="phone" class="form-control" placeholder="Enter your phone number" pattern="[0-9]{10}" required>
					</div>
					<div class="form-group">
						<label for="subject" class="form-label">Subject</label>
						<input type="text" id="subject" name="subject" class="form-control" placeholder="Enter subject">
					</div>
				</div>
				<div class="form-group">
					<label for="message" class="form-label">Message</label>
					<textarea id="message" name="message" class="form-control" placeholder="Enter your message" rows="5" required></textarea>
				</div>
				<button type="submit" name="submit" class="submit-btn">
					<i class="fas fa-paper-plane"></i> Send Message
				</button>
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
		// Display vehicle booking form if localStorage has data
		function Display() {
			if(localStorage.getItem("text") && localStorage.getItem("text").length != 0) {
				document.getElementById("registration").style.display = "block";
			}
		}

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
		const sticky = document.getElementById('Sticky').offsetTop;

		window.addEventListener('scroll', () => {
			const currentScroll = window.pageYOffset;
			
			// Sticky header effect
			if (currentScroll <= 0) {
				header.style.boxShadow = '0 2px 10px rgba(0,0,0,0.1)';
			} else {
				header.style.boxShadow = '0 2px 20px rgba(0,0,0,0.2)';
			}
			
			lastScroll = currentScroll;
		});

		// Check if date is available
		function CheckDate() {
			var text = document.getElementById("display1").value;
			var date = document.getElementById("date").value;
			var xmlhttp = new XMLHttpRequest();
			xmlhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					if(this.responseText == 1) {
						document.getElementById("Popup").style.opacity = "1";
					} else {
						document.getElementById("Popup").style.opacity = "0";
					}
				}
			};
			xmlhttp.open("GET", "checkdate.php?text=" + text + "&date=" + date, true);
			xmlhttp.send();
		}
		</script>
		
		<?php
		// Process form submission
		if(isset($_POST["submit"]) && !empty("$_POST[name]")) {
			$servername = "localhost";
			$username = "root";
			$password = "";
			$dbname = "rentaride";
			
			// Create connection
			$conn = mysqli_connect($servername, $username, $password, $dbname);
			
			// Check connection
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			}
			
			// Only process vehicle booking if vehicle and date are set
			if(isset($_POST["vehicle"]) && isset($_POST["date"])) {
				$sql = "SELECT `Vehicle`, `Date` FROM `package`";
				$result = mysqli_query($conn, $sql);
				$rowsnum = mysqli_num_rows($result);
				$i = 0;
				
				if ($rowsnum > 0) {
					while($row = mysqli_fetch_assoc($result)) {
						if($row["Vehicle"] == $_POST["vehicle"] && $row["Date"] == $_POST["date"]) {
							break;
						}
						$i++;
					}
				} 
				
				if($i == $rowsnum) {
					$image = addslashes(file_get_contents($_FILES['license']['tmp_name']));
					$sql = "INSERT INTO package(Name, Email, Phone, Message, Subject, Vehicle, Amount, Date, License) 
							VALUES ('$_POST[name]', '$_POST[email]', '$_POST[phone]', '$_POST[message]', '$_POST[subject]', 
									'$_POST[vehicle]', '$_POST[amount]', '$_POST[date]', '{$image}')";
					
					if (!mysqli_query($conn, $sql)) {
						echo "Error: " . $sql . "<br>" . mysqli_error($conn);
					}
					echo "<script>Location();ClearTable();</script>";
				} else {
					echo '<script>
						localStorage.removeItem("date");
						alert("Sorry! The vehicle is already booked on the corresponding date. Select a different date or book another vehicle.");
					</script>';
				}
			} else {
				// Process regular contact form
				$sql = "INSERT INTO contact(Name, Email, Phone, Message, Subject) 
						VALUES ('$_POST[name]', '$_POST[email]', '$_POST[phone]', '$_POST[message]', '$_POST[subject]')";
				
				if (!mysqli_query($conn, $sql)) {
					echo "Error: " . $sql . "<br>" . mysqli_error($conn);
				} else {
					echo '<script>alert("Thank you for contacting us. We will get back to you soon!");</script>';
				}
			}
			
			mysqli_close($conn);
		}
		?>
	</body>
</html>
