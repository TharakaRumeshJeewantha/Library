<?php
	session_start();
?>

<?php
	require_once('db/db_connection.php');
?>

<?php

	if (isset($_POST['submit'])) {

			$username = mysqli_real_escape_string($db,$_POST['un']);
			$email = mysqli_real_escape_string($db,$_POST['email']);
			$pwd = mysqli_real_escape_string($db,$_POST['password']);

			$query = "SELECT * FROM tbl_users WHERE un = '{$username}' AND nic = '{$pwd}' AND email = '{$email}' LIMIT 1";

			$result_set = mysqli_query($db, $query);

			if ($result_set) {
				if (mysqli_num_rows($result_set) == 1) {

					$user = mysqli_fetch_assoc($result_set);
					$_SESSION['uid'] = $user['uid'];
					$_SESSION['first_name'] = $user['first_name'];
					$_SESSION['last_name'] = $user['last_name'];

					header('Location: index.php');
				}
				else {
					echo 'Invalid Username or Password';
				}
			}
			else {
				echo 'Database Query Failed';
			}
}

?>

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Room 2 Read</title>
		<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />

		<meta name="keywords" content="HTML5 Admin Template" />
		<meta name="description" content="Porto Admin - Responsive HTML5 Template">
		<meta name="author" content="okler.net">

		<!-- Mobile Metas -->
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

		<!-- Web Fonts  -->
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

		<!-- Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-datepicker/css/datepicker3.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body background="assets/images/bg1.jpg">
		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Recover Password</h2>
					</div>
					<div class="panel-body">
						<div class="alert alert-info">
							<p class="m-none text-semibold h6">Enter your some sensitive data to reset password!</p>
						</div>

						<form action="pages-recover-password.php" method="POST">
							<div class="form-group  mb-none">
								<div class="col-md-14">
									<input type="text" class="form-control  input-lg" placeholder="username" name="un" id="profileCompany" required>
								</div>
							</div>

							<br>

							<div class="form-group  mb-none">
								<div class="col-md-14">
									<input type="email" class="form-control  input-lg" placeholder="email" name="email" id="profileCompany" required>
								</div>
							</div>

							<br>

							<div class="form-group mb-none">
								<div class="input-group">
									<input name="password" type="text"  data-plugin-masked-input data-input-mask="99-9999-999 (v)" placeholder="nic"  class="form-control input-lg" required />

									<span class="input-group-btn">
										<button class="btn btn-primary btn-lg" name="submit" type="submit">Reset!</button>
									</span>
								</div>
							</div>

							<p class="text-center mt-lg">Remembered? <a href="pages-signin.php">Sign In!</a>
						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md"><p style="color: black; text-align: center;"> &copy; Copyright 2019. All rights reserved. Developed by <a href="https:trumeshjeewantha@blogspot.com">Tharaka Rumesh Jeewantha</a>.</p></p>
			</div>
		</section>
		<!-- end: page -->

		<!-- Vendor -->
		<script src="assets/vendor/jquery/jquery.js"></script>
		<script src="assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>

								<!-- validations -->
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="assets/javascripts/forms/examples.validation.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>