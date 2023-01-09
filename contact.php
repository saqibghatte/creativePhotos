<!-- HEADER START -->
<?php require "./required/header.php" ?>
<!-- HEADER END -->




<section class="breadcrumb">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="">
					<span class="fa-2x fw-bold text-dark">Creative Photos</span><i class="fas fa-long-arrow-alt-right fa-lg mx-2 text-dark"></i><span class="fa-lg fw-bold text-dark">Contact</span>
				</div>
			</div>
		</div>
	</div>
</section>

<?php
if (isset($_POST['submitform'])) {
	$fName = ($_POST['fName']);
	$phone = ($_POST['phone']);
	$email = ($_POST['email']);
	$message = ($_POST['message']);
	if (!empty($fName) && !empty($phone)) {
		$sql = "INSERT INTO `contact`(`fName`,`phone`, `email`, `message`) VALUE ('$fName','$phone', '$email', '$message')";
		$result = $mysqli->query($sql);
		unset($_POST);
	}
	header("location:contact.php");
}
?>


<!-- contact-section  -->
<section class="contact-section padding-top-5">
	<!-- <div class="contact-box">
				<div class="contact-title">
					<h1>CONTACT</h1>
					<ul class="social-icons">
						<li><a class="facebook" href="#"><i class="fa fa-facebook-square"></i></a></li>
						<li><a class="twitter" href="#"><i class="fa fa-twitter-square"></i></a></li>
						<li><a class="instagram" href="#"><i class="fa fa-instagram"></i></a></li>
						<li><a class="vimeo" href="#"><i class="fa fa-vimeo-square"></i></a></li>
						<li><a class="youtube" href="#"><i class="fa fa-youtube-play"></i></a></li>
					</ul>
				</div>

				<p class="desc">I have a passion for nature photography. I want to share with you my search for
					capturing a photo-of-a-lifetime that, when enlarged and hung on the wall, </p>

				<p>
					<span>Hansom Rob</span>
					<span>hansom.rob@shuttertemplate.com</span>
					<span>+386 49 100 200</span>
					<span>Nr. 12 / Grey House, Brooklyn NY, USA</span>
					<a href="#">Get Directions via Google Maps</a>
				</p>
				<form id="contact-form">
					<div class="row">
						<div class="col-md-6">
							<input name="name" id="name" type="text" placeholder="Name">
						</div>
						<div class="col-md-6">
							<input name="mail" id="mail" type="text" placeholder="Email">
						</div>
					</div>
					<textarea name="comment" id="comment" placeholder="Message"></textarea>
					<input type="submit" id="submit_contact" value="Submit">
					<div id="msg" class="message"></div>
				</form>
			</div>
			<div class="image-holder">
				<img src="upload/others/con.jpg" alt="">
			</div> -->

	<div class="container">
		<div class="row d-flex justify-content-center ">
			<div class="col-lg-6">
				<div class="text-center">
					<p class="fw-bold fa-2x text-dark">Contact</p>
					<p>I have a passion for nature photography. I want to share with you my search for capturing a photo-of-a-lifetime that, when enlarged and hung on the wall,</p>
				</div>
			</div>
		</div>
		<div class="row my-3">
			<div class="col-lg-6">
				<div class="text-center">
					<img src="./assets/img/contact/contact.png" class="img-fluid" width="300" alt="">
				</div>
			</div>
			<div class="col-lg-6">
				<div class="border rounded border-dark p-3 bg-light contact_div">

					<form method="POST" action="" enctype="multipart/form-data">
						<div class="form-group">
							<label for="fullName" class="text-dark">Full Name</label>
							<input type="text" name="fName" class="form-control" id="fullName" value="John Doe">
						</div>

						<div class="container p-0">
							<div class="row">

								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="form-group ">
										<label for="email" class="text-dark">Email address</label>
										<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" value="name@domain.com">
									</div>
								</div>

								<div class="col-lg-6 col-md-12 col-sm-12">
									<div class="form-group ">
										<label for="number" class="text-dark">Phone Number</label>
										<input type="number" name="phone" class="form-control" id="number" value="1234567890">
									</div>
								</div>
							</div>
						</div>

						<div class="form-group ">
							<label for="message" class="text-dark">Message</label>
							<textarea class="w-100 form-control" name="message" id="message" cols="5" rows="3" style="resize: none;"></textarea>
						</div>

						<div class="text-center">
							<button type="submit" name="submitform" class="btn bg-white text-dark fw-bold w-100">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>

		<div class="row my-5">
			<div class="col-lg-12">
				<div class="info d-flex justify-content-center">

					<div class="mx-2 border border-grey shadow px-3 py-2 rounded text-center w-100">
						<i class="fas fa-signature fa-2x"></i>
						<h4 class="text-secondary">Name : </h4>
						<p class="text-dark">John Doe</p>
					</div>
					<div class="mx-2 border border-grey shadow px-3 py-2 rounded text-center w-100">
						<i class="fas fa-envelope fa-2x"></i>
						<h4 class="text-secondary">Email : </h4>
						<p class="text-dark"><a class="text-dark" target="_blank" href="mailto: abc@example.com">john.doe@gmail.com</a></p>
					</div>
					<div class="mx-2 border border-grey shadow px-3 py-2 rounded text-center w-100">
						<i class="fas fa-mobile-alt fa-2x"></i>
						<h4 class="text-secondary">Call : </h4>
						<p class="text-dark"><a class="text-dark" target="_blank" href="tel:+4733378901">+33 3214 6547</a></p>
					</div>
					<div class="mx-2 border border-grey shadow px-3 py-2 rounded text-center w-100">
						<i class="fas fa-comment fa-2x"></i>
						<h4 class="text-secondary">Chat : </h4>
						<p class="text-dark"><a class="text-dark" target="_blank" href="https://wa.me/+918879761416">+91 12345 67890</a></p>
					</div>


				</div>
			</div>
		</div>
		<div class="row my-5">
			<div class="col-lg-12">
				<div class="">
					<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d241316.6433315265!2d72.74110156892756!3d19.08252231790604!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3be7c6306644edc1%3A0x5da4ed8f8d648c69!2sMumbai%2C%20Maharashtra!5e0!3m2!1sen!2sin!4v1670143442758!5m2!1sen!2sin" width="100%" height="300" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
				</div>
			</div>
		</div>
	</div>
</section>
<!-- End contact section -->



<!-- FOOTER START -->
<?php require "./required/footer.php" ?>
<!-- FOOTER END -->