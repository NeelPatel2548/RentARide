<?php
session_start();
?>
<html>

<head>
	<title>Home Page</title>
	<!-- <link rel = "icon" type = "image/png" href = "images/logo1_B.png"> -->
	<link rel="stylesheet" href="assets/css/poppins.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/montserrat.css" type="text/css" media="all">
	<link rel="stylesheet" href="assets/css/main.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css">
	<style>
		  .card-containerR {
  display: flex;
  justify-content: space-around;
}

.cardR {
  width: 20%; /* Adjust width as needed */
  border: 1px solid #ccc;
  padding: 20px;
  text-align: center;
  box-shadow: rgba(50, 50, 93, 0.25) 0px 50px 100px -20px, rgba(0, 0, 0, 0.3) 0px 30px 60px -30px, rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
}
	</style>	
</head>

<body>
	<div class="up" id="up">
		<div class="logo"><img src="images/logo1_B.png" height="100%" width="9.7%" style="float: left;margin: -5% 0 0 6.5%;height: 185px;width: 213px;">
		<i class="fa-solid fa-user fa-xl" style="color: #FFD43B;"></i><font style="font-size:1.254vw; color:beige">&ensp;Welcome, <?php 
		
		if(isset($_SESSION["nameTodisplay"]))
		{
			echo $_SESSION["nameTodisplay"];
		}
        else
        {
            echo "Guest";
        }	?>&ensp;</font> <i class="fa-solid fa-phone fa-xl" style="color: #FFD43B;"></i>
			<font style="font-size:1.254vw; color:beige">&ensp;+91-7305010188&emsp;</font>
			<i class="fa-solid fa-envelope fa-xl" style="color: #FFD43B;"></i>
			<font style="font-size:1.254vw; color:beige">&ensp;Info@RentARide.in</font>
		</div>
		<div class="logo1">
			<center><img src="images/wheelzonrent-logo.png" height="50%" width="30%"></center>
			<div class="call"><img height="25%" width="2.5%" src="images/phone.png" style="height:auto;">
				<font>+91-7305010188&emsp;</font>
			</div>
			<div class="mail"><img height="21%" width="2.5%" src="images/message.png" style="height:auto;">
				<font>&ensp;Info@RentARide.in</font>
			</div>
		</div>
		<nav>
			<ul>
				<li><a class="active" href="index.php">Home</a></li>
				<li><a class="navi" href="login.php">Login</a></li>
				<li><a class="navi" href="cars.php">Cars</a></li>
				<li><a class="navi" href="bikes.php">Bikes</a></li>
				<li><a class="navi" href="contact.php">Contact Us</a></li>
				<li><a class="navi" href="terms.php">Terms</a></li>
				<!-- <li><a class="navi" href="feedback.php">Feedback</a></li> -->
				<li><a class="navi" href="logout.php">Logout</a></li>
				<li><a class="navi" href="https://cdn.botpress.cloud/webchat/v2.2/shareable.html?configUrl=https://files.bpcontent.cloud/2024/11/01/12/20241101124511-I5H9O04S.json" target="_blank">Need a Help?</a></li>
			</ul>
		</nav>
	</div>
	<div class="slide">
		<img class="slides" src="images/slide1.jpg" height="100%" width="100%">
		<img class="slides" src="images/slide2.jpg" height="100%" width="100%"> 
		<img class="slides" src="images/slide3.jpg" height="100%" width="100%">
		<img class="slides" src="images/slide4.jpg" height="100%" width="100%">
		<img class="slides" src="images/slide5.jpg" height="100%" width="100%">
	</div>
	<script>
		function Glow3() {
			document.getElementById("glow3").className = "active";
		}

		function Initial3() {
			document.getElementById("glow3").className = "navi";
		}
	</script>

	<script>
			var myIndex1 = 0;
		carousell();

		function carousell() {
			var i;
			var x = document.getElementsByClassName("slides");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			myIndex1++;
			if (myIndex1 > x.length) {
				myIndex1 = 1
			}
			x[myIndex1 - 1].style.display = "block";
			setTimeout(carousell, 3000);
		}
	</script>
	<div id="Sticky"></div>
	<script>
		window.onscroll = function() {
			myFunction()
		};
		var navbar = document.getElementById("up");
		var sticky = Sticky.offsetTop;

		function myFunction() {

			if (window.pageYOffset >= sticky) {
				document.getElementById("up").style.opacity = "1";
			} else {
				document.getElementById("up").style.opacity = "0.7";
			}
		}
	</script>
	<div style="text-align:center;padding:0% 0 1% 0"><img src="images/logo1_B.png" style="height:90%; width:50%;" height="25%" width="25%"></div>
	<div>
		<h1 style="font-size:2vw;color:#292929;margin:3% 0 0 28%;">&lt;</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 32%;">
		<h1 style="font-size:2vw;color:#292929;text-align:center;margin:-1.3% 0 0 0;">OUR SERVICE</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 59%;">
		<h1 style="font-size:2vw;color:#292929;margin:-1.3% 0 0 71%">&gt;</h1>
	</div>
	<br><br><br><br>
	<div class="ServiceDetails">
	<div class="card-containerR">
    <div class="cardR">
      <h2><i class="fa-solid fa-car fa-xl" style="color: #000000;"></i>&nbsp;&nbsp;Car Rental Service</h2>
      <p>Discover freedom and flexibility with our car rental service. Choose from a wide range of vehicles, book effortlessly, and embark on your next adventure.</p>
    </div>
    <div class="cardR">
      <h2><i class="fa-solid fa-motorcycle fa-xl" style="color: #000000;"></i>&nbsp;&nbsp;Bike Rental Service</h2>
      <p>Rent a bike and set your own pace. Enjoy convenient pickup and drop-off locations, affordable rates, and top-notch customer service.</p>
    </div>
    <div class="cardR">
      <h2><i class="fa-solid fa-comment-nodes fa-xl" style="color: #000000;"></i>&nbsp;&nbsp;Help With Ai</h2>
      <p>Let us be your AI partner. We offer personalized support, tailored solutions, and ongoing assistance to help you.</p>
    </div>
  </div>
	</div>
	<br><br>
	<div>
		<h1 style="font-size:2vw;color:#292929;margin:3% 0 0 28%;">&lt;</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 32%;">
		<h1 style="font-size:2vw;color:#292929;text-align:center;margin:-1.3% 0 0 0;">OUR FLEET</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 59%;">
		<h1 style="font-size:2vw;color:#292929;margin:-1.3% 0 0 71%">&gt;</h1>
	</div>
	<table class="tabl">
		<tr>
			<td>
				<div class="wid">
					<a href="cars.php" onmouseover="Glow1()" onmouseout="Initial1()">
						<img src="./car_img/HomeCar.png" width="70%" height="28%" style="height:auto;">
					</a>
				</div>
			</td>
			<td>
				<div class="wid" id="resp">
					<a href="bikes.php" onmouseover="Glow2()" onmouseout="Initial2()">
						<img src="./bike_img/HomeBike.png" width="90%" height="38%" style="height:auto;">
					</a>
				</div>
			</td>
		</tr>
	</table>
	<script>
		function Glow1() {
			document.getElementById("glow1").style.color = "#00afe5";
			document.getElementById("glow1").style.transitionDuration = "0.5s";
		}

		function Initial1() {
			document.getElementById("glow1").style.color = "white";
		}

		function Glow2() {
			document.getElementById("glow2").style.color = "#00afe5";
			document.getElementById("glow2").style.transitionDuration = "0.5s";
		}

		function Initial2() {
			document.getElementById("glow2").style.color = "white";
		}
	</script>
	<br><br>
	<div class="adv" style=" width:auto; height:auto; padding-left:15px;margin-bottom:20px">
	<div>
		<h1 style="font-size:2vw;color:#292929;margin:3% 0 0 28%;">&lt;</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 32%;">
		<h1 style="font-size:2vw;color:#292929;text-align:center;margin:-1.3% 0 0 0;">OUR PARTNER</h1>
		<hr align="left" width="9%" color="#dddddd" style="margin:-1.3% 0 0 59%;">
		<h1 style="font-size:2vw;color:#292929;margin:-1.3% 0 0 71%">&gt;</h1>
	</div>
	<br><br>
	<div class="slide2" style="    width: 80%;
    height: auto;
    align-items: center;
    display: inline;">
		<img class="slides2" src="images/slide1.jpg" height="100%" width="100%">
		<img class="slides2" src="images/slide2.jpg" height="100%" width="100%">
		<img class="slides2" src="images/slide3.jpg" height="100%" width="100%">
		<img class="slides2" src="images/slide4.jpg" height="100%" width="100%">
		<img class="slides2" src="images/slide5.jpg" height="100%" width="100%">
	</div>
	<script>
		var myIndex = 0;
		carousel();

		function carousel() {
			var i;
			var x = document.getElementsByClassName("slides2");
			for (i = 0; i < x.length; i++) {
				x[i].style.display = "none";
			}
			myIndex++;
			if (myIndex > x.length) {
				myIndex = 1
			}
			x[myIndex - 1].style.display = "block";
			setTimeout(carousel, 3000);
		}
	</script>
	</div>
	<footer>
		<table style="height:10%;">
			<tr bgcolor="#252525">
				<td class="widget">
					<h3>About Us</h3>
				</td>
				<td class="widget">
					<h3>Contact Info</h3>
				</td>
			</tr>
			<tr bgcolor="#252525">
				<td class="widget">
					<p class="text">Rent From RentARide, Rent with ease,<br>
						explore with confidence. Our streamlined booking process<br>
						and exceptional customer service make it easy to find <br>
						the perfect vehicle and hit the road.</p>
				</td>
				<td class="widget">
					<p class="text1">Address: Gujarat,India<br>
					<i class="fa-solid fa-phone fa-xl" style="color: #FFD43B;"></i>&emsp;+91-7305010188<br>
					<i class="fa-solid fa-envelope fa-xl" style="color: #FFD43B;"></i>&emsp;rentAride@gmail.com
					<br>
					<i class="fa-brands fa-instagram fa-xl" style="color: #ff7172;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-brands fa-facebook fa-xl" style="color: #ff7172;"></i>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa-brands fa-youtube fa-xl" style="color: #ff7172;"></i>
					</p>
				</td>
			</tr>
		</table>
	</footer>
</body>

</html>
