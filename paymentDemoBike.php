<?php
session_start();

if (!isset($_SESSION['logged_in']) || !$_SESSION['logged_in']) {
    header('Location: login.php');
    exit;
}

// Check if bike and booking details are set
if (!isset($_SESSION['selected_bike']) || !isset($_SESSION['booking_details'])) {
    header('Location: bikes.php');
    exit;
}

$bike = $_SESSION['selected_bike'];
$booking = $_SESSION['booking_details'];

// Calculate total amount
$total_amount = $bike['bike_price'] * $booking['total_days'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment - RentARide</title>
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
            --success-color: #4CAF50;
            --error-color: #f44336;
            --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
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
            background-color: #f8f9fa;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            padding: 2rem;
        }

        /* Main Content Styles */
        .main-content {
            width: 100%;
            max-width: 1200px;
            transition: var(--transition);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Payment Container */
        .payment-container {
            width: 100%;
            max-width: 1200px;
            background-color: white;
            border-radius: 16px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
            display: flex;
            flex-direction: column;
            margin-bottom: 2rem;
        }

        .payment-header {
            background-color: var(--primary-color);
            color: white;
            padding: 2rem;
            text-align: center;
        }

        .payment-header h1 {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--accent-color);
        }

        .payment-header p {
            color: var(--light-text);
            font-size: 1rem;
        }

        .payment-body {
            display: flex;
            flex-wrap: wrap;
            padding: 0;
        }

        /* Order Summary */
        .order-summary {
            flex: 1;
            min-width: 300px;
            padding: 2rem;
            background-color: #f8f9fa;
            border-right: 1px solid #eee;
        }

        .order-summary h2 {
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .order-summary h2 i {
            color: var(--accent-color);
        }

        .order-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 1rem;
            padding-bottom: 1rem;
            border-bottom: 1px solid #eee;
        }

        .order-item:last-child {
            border-bottom: none;
        }

        .item-details {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .item-image {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            object-fit: cover;
            background-color: #eee;
        }

        .item-info h3 {
            font-size: 1rem;
            margin-bottom: 0.25rem;
        }

        .item-info p {
            font-size: 0.9rem;
            color: #666;
        }

        .order-total {
            margin-top: 2rem;
            border-top: 2px dashed #ddd;
            padding-top: 1rem;
        }

        .total-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 0.5rem;
        }

        .total-row.final {
            font-weight: bold;
            font-size: 1.2rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid #ddd;
        }

        /* Payment Form */
        .payment-form {
            flex: 2;
            min-width: 400px;
            padding: 2rem;
        }

        .payment-form h2 {
            margin-bottom: 1.5rem;
            border-bottom: 2px solid var(--accent-color);
            padding-bottom: 0.5rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .payment-form h2 i {
            color: var(--accent-color);
        }

        .payment-methods {
            display: flex;
            gap: 1rem;
            margin-bottom: 2rem;
        }

        .payment-method {
            flex: 1;
            padding: 1rem;
            border: 2px solid #ddd;
            border-radius: 10px;
            text-align: center;
            cursor: pointer;
            transition: var(--transition);
        }

        .payment-method:hover {
            border-color: var(--accent-color);
            background-color: #f9f9f9;
            transform: translateY(-3px);
        }

        .payment-method.active {
            border-color: var(--accent-color);
            background-color: #fffdf0;
        }

        .payment-method i {
            font-size: 2rem;
            margin-bottom: 0.5rem;
            color: var(--text-color);
        }

        .payment-method.active i {
            color: var(--accent-color);
        }

        .payment-form form {
            margin-top: 2rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
            position: relative;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .form-group label i {
            color: var(--accent-color);
        }

        .form-group input,
        .form-group select {
            width: 100%;
            padding: 0.8rem 1rem 0.8rem 2.5rem;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 1rem;
            transition: var(--transition);
        }

        .form-group i.input-icon {
            position: absolute;
            left: 1rem;
            bottom: 1rem;
            color: #999;
        }

        .form-group input:focus,
        .form-group select:focus {
            border-color: var(--accent-color);
            box-shadow: 0 0 0 2px rgba(255, 212, 59, 0.2);
            outline: none;
        }

        .form-group input:focus+i.input-icon,
        .form-group select:focus+i.input-icon {
            color: var(--accent-color);
        }

        .form-row {
            display: flex;
            gap: 1rem;
        }

        .form-row .form-group {
            flex: 1;
        }

        .btn {
            background-color: var(--accent-color);
            color: var(--primary-color);
            border: none;
            border-radius: 8px;
            padding: 1rem 2rem;
            font-size: 1.1rem;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            width: 100%;
        }

        .btn:hover {
            background-color: #ffc107;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }

        .payment-footer {
            background-color: #f8f9fa;
            padding: 1.5rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
        }

        .secure-badge {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: #666;
            font-size: 0.9rem;
        }

        .secure-badge i {
            color: var(--success-color);
        }

        .payment-logos {
            display: flex;
            gap: 1rem;
        }

        .payment-logos i {
            font-size: 2rem;
            color: #666;
        }

        /* Responsive Design */
        @media (max-width: 900px) {
            .payment-body {
                flex-direction: column;
            }

            .order-summary,
            .payment-form {
                min-width: 100%;
            }

            .order-summary {
                border-right: none;
                border-bottom: 1px solid #eee;
            }

            .form-row {
                flex-direction: column;
                gap: 0;
            }

            .payment-methods {
                flex-direction: column;
            }
        }

        .order-summary {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .bike-details {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
        }

        .bike-details img {
            width: 200px;
            height: 150px;
            object-fit: cover;
            border-radius: 8px;
        }

        .bike-info {
            flex: 1;
        }

        .bike-info h4 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .bike-info p {
            margin: 5px 0;
            color: #666;
        }

        .booking-details {
            border-top: 1px solid #ddd;
            padding-top: 15px;
        }

        .booking-details h4 {
            margin: 0 0 10px 0;
            color: #333;
        }

        .booking-details p {
            margin: 5px 0;
            color: #666;
        }

        .total-amount {
            font-size: 1.2em;
            color: #333;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #ddd;
        }
    </style>
</head>

<body>
    <!-- Main Content -->
    <main class="main-content">
        <div class="payment-container">
            <div class="payment-header">
                <h1>Payment Details</h1>
                <p>Please review your booking and proceed with payment</p>
            </div>
            <div class="payment-body">
                <!-- Order Summary Section -->
                <div class="order-summary">
                    <h2><i class="fas fa-shopping-cart"></i> Order Summary</h2>

                    <?php if(isset($_SESSION['selected_bike'])): ?>
                        <div class="bike-details">
                            <div class="bike-info">
                                <p><strong>Bike Name:</strong> <?php echo $_SESSION['selected_bike']['bike_name']; ?></p>
                                <p><strong>Brand:</strong> <?php echo $_SESSION['selected_bike']['bike_brand']; ?></p>
                                <p><strong>Type:</strong> <?php echo $_SESSION['selected_bike']['bike_type']; ?></p>
                                <p><strong>Fuel:</strong> <?php echo $_SESSION['selected_bike']['bike_fuel']; ?></p>
                                <p><strong>Price per day:</strong> ₹<?php echo $_SESSION['selected_bike']['bike_price']; ?></p>
                            </div>
                        </div>
                        <?php if(isset($_SESSION['booking_details'])): ?>
                            <div class="booking-details">
                                <h4>Booking Details</h4>
                                <p><strong>Pick-up Date:</strong> <?php echo date('d M Y', strtotime($_SESSION['booking_details']['pick_date'])); ?></p>
                                <p><strong>Drop-off Date:</strong> <?php echo date('d M Y', strtotime($_SESSION['booking_details']['drop_date'])); ?></p>
                                <p><strong>Total Days:</strong> <?php echo $_SESSION['booking_details']['total_days']; ?></p>
                                <?php 
                                $total_amount = $_SESSION['selected_bike']['bike_price'] * $_SESSION['booking_details']['total_days'];
                                ?>
                                <p class="total-amount"><strong>Total Amount:</strong> ₹<?php echo number_format($total_amount, 2); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php else: ?>
                        <p>No bike selected. Please go back to select a bike.</p>
                    <?php endif; ?>
                </div>

                <!-- Payment Form Section -->
                <div class="payment-form">
                    <h2><i class="fas fa-credit-card"></i> Payment Details</h2>

                    <div class="payment-methods">
                        <div class="payment-method active" id="card-method">
                            <i class="fas fa-credit-card"></i>
                            <h3>Credit Card</h3>
                        </div>
                        <div class="payment-method" id="upi-method">
                            <i class="fas fa-mobile-alt"></i>
                            <h3>UPI</h3>
                        </div>
                        <div class="payment-method" id="bank-method">
                            <i class="fas fa-university"></i>
                            <h3>Net Banking</h3>
                        </div>
                    </div>

                    <form id="payment-form">
                        <div class="form-group">
                            <label for="card-holder"><i class="fas fa-user"></i> Card Holder Name</label>
                            <input type="text" id="card-holder" name="card-holder" placeholder="Enter your full name">
                            <i class="fas fa-user input-icon"></i>
                        </div>

                        <div class="form-group">
                            <label for="card-number"><i class="fas fa-credit-card"></i> Card Number</label>
                            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456">
                            <i class="fas fa-credit-card input-icon"></i>
                        </div>

                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiry-date"><i class="fas fa-calendar"></i> Expiry Date</label>
                                <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY">
                                <i class="fas fa-calendar input-icon"></i>
                            </div>

                            <div class="form-group">
                                <label for="cvv"><i class="fas fa-lock"></i> CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123">
                                <i class="fas fa-lock input-icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="billing-address"><i class="fas fa-map-marker-alt"></i> Billing Address</label>
                            <input type="text" id="billing-address" name="billing-address" placeholder="Enter your billing address">
                            <i class="fas fa-map-marker-alt input-icon"></i>
                        </div>

                        <button type="submit" class="btn">
                            <i class="fas fa-lock"></i> Pay Now ₹<?php echo number_format($total_amount, 2); ?>
                        </button>
                    </form>
                </div>
            </div>
            <div class="payment-footer">
                <div class="secure-badge">
                    <i class="fas fa-shield-alt"></i>
                    <span>Secure Payment. Your data is protected by 256-bit SSL encryption.</span>
                </div>
                <div class="payment-logos">
                    <i class="fab fa-cc-visa"></i>
                    <i class="fab fa-cc-mastercard"></i>
                    <i class="fab fa-cc-amex"></i>
                    <i class="fab fa-cc-discover"></i>
                </div>
            </div>
        </div>
    </main>

    <script>
        // Payment Method Selection
        const paymentMethods = document.querySelectorAll('.payment-method');
        const cardMethod = document.getElementById('card-method');
        const upiMethod = document.getElementById('upi-method');
        const bankMethod = document.getElementById('bank-method');
        const paymentForm = document.getElementById('payment-form');

        paymentMethods.forEach(method => {
            method.addEventListener('click', () => {
                // Remove active class from all methods
                paymentMethods.forEach(m => m.classList.remove('active'));

                // Add active class to clicked method
                method.classList.add('active');

                // Get the total amount from PHP
                const totalAmount = <?php echo isset($total_amount) ? $total_amount : 0; ?>;

                // Update form based on selected payment method
                if (method === upiMethod) {
                    paymentForm.innerHTML = `
                        <div class="form-group">
                            <label for="upi-id"><i class="fas fa-at"></i> UPI ID</label>
                            <input type="text" id="upi-id" name="upi-id" placeholder="yourname@upi">
                            <i class="fas fa-at input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="upi-mobile"><i class="fas fa-mobile-alt"></i> Mobile Number</label>
                            <input type="text" id="upi-mobile" name="upi-mobile" placeholder="Enter mobile number linked to UPI">
                            <i class="fas fa-mobile-alt input-icon"></i>
                        </div>
                        
                        <button type="submit" class="btn">
                            <i class="fas fa-lock"></i> Pay Now ₹${totalAmount.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                        </button>
                    `;
                } else if (method === bankMethod) {
                    paymentForm.innerHTML = `
                        <div class="form-group">
                            <label for="bank-name"><i class="fas fa-university"></i> Select Bank</label>
                            <select id="bank-name" name="bank-name">
                                <option value="" selected disabled>Choose your bank</option>
                                <option value="hdfc">HDFC Bank</option>
                                <option value="sbi">State Bank of India</option>
                                <option value="icici">ICICI Bank</option>
                                <option value="axis">Axis Bank</option>
                                <option value="kotak">Kotak Mahindra Bank</option>
                            </select>
                            <i class="fas fa-university input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="account-number"><i class="fas fa-file-invoice"></i> Account Number</label>
                            <input type="text" id="account-number" name="account-number" placeholder="Enter your account number">
                            <i class="fas fa-file-invoice input-icon"></i>
                        </div>
                        
                        <button type="submit" class="btn">
                            <i class="fas fa-lock"></i> Pay Now ₹${totalAmount.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                        </button>
                    `;
                } else {
                    paymentForm.innerHTML = `
                        <div class="form-group">
                            <label for="card-holder"><i class="fas fa-user"></i> Card Holder Name</label>
                            <input type="text" id="card-holder" name="card-holder" placeholder="Enter your full name">
                            <i class="fas fa-user input-icon"></i>
                        </div>
                        
                        <div class="form-group">
                            <label for="card-number"><i class="fas fa-credit-card"></i> Card Number</label>
                            <input type="text" id="card-number" name="card-number" placeholder="1234 5678 9012 3456">
                            <i class="fas fa-credit-card input-icon"></i>
                        </div>
                        
                        <div class="form-row">
                            <div class="form-group">
                                <label for="expiry-date"><i class="fas fa-calendar"></i> Expiry Date</label>
                                <input type="text" id="expiry-date" name="expiry-date" placeholder="MM/YY">
                                <i class="fas fa-calendar input-icon"></i>
                            </div>
                            
                            <div class="form-group">
                                <label for="cvv"><i class="fas fa-lock"></i> CVV</label>
                                <input type="text" id="cvv" name="cvv" placeholder="123">
                                <i class="fas fa-lock input-icon"></i>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label for="billing-address"><i class="fas fa-map-marker-alt"></i> Billing Address</label>
                            <input type="text" id="billing-address" name="billing-address" placeholder="Enter your billing address">
                            <i class="fas fa-map-marker-alt input-icon"></i>
                        </div>
                        
                        <button type="submit" class="btn">
                            <i class="fas fa-lock"></i> Pay Now ₹${totalAmount.toLocaleString('en-IN', {minimumFractionDigits: 2, maximumFractionDigits: 2})}
                        </button>
                    `;
                }
            });
        });

        // Form Submission
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            event.preventDefault();
            alert('Payment successful! Thank you for your order!');
            window.location.href = 'index.php';
        });
    </script>
</body>

</html> 