<?php
	session_start();
?>

<?php
	require_once('db/db_connection.php');
?>

<?php
	if (isset($_POST['submit'])) {

		$errors = array();

		if(!isset($_POST['username']) || strlen(trim($_POST['username'])) < 1) {
			$errors[] = 'Username is Missing or Invalid';
		}

		if(!isset($_POST['pwd']) || strlen(trim($_POST['pwd'])) < 1) {
			$errors[] = 'Password is Missing or Invalid';
		}

		if(empty($errors)) {
			$username = mysqli_real_escape_string($db,$_POST['username']);
			$pwd = mysqli_real_escape_string($db,$_POST['pwd']);
			$hashed_pwd = sha1($pwd);

			$query = "SELECT * FROM tbl_users WHERE un = '{$username}' AND pw = '{$hashed_pwd}' LIMIT 1";

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
					$errors[] = 'Invalid Username or Password';
				}
			}
			else {
				$errors[] = 'Database Query Failed';
			}
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
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />
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
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">

						<?php
							if (isset($errors) && !empty($errors)) {
								echo '<div class="alert alert-danger" style="text-align:center;"><strong>Warning!</strong> Invalid Username or Password</div>';
							}
						?>

						<form action="pages-signin.php" method="post">
							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group input-group-icon">
									<input name="username" type="text" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-user"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="form-group mb-lg">
								<div class="clearfix">
									<label class="pull-left">Password</label>
									<a href="pages-recover-password.php" class="pull-right">Forget Password?</a>
								</div>
								<div class="input-group input-group-icon">
									<input name="pwd" type="password" class="form-control input-lg" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="RememberMe" name="rememberme" type="checkbox"/>
										<label for="RememberMe">Remember Me</label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="submit" class="btn btn-primary hidden-xs">Sign In</button>
									<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign In</button>
								</div>
							</div>

							<hr>

<!-- 							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<a class="btn btn-facebook mb-md ml-xs mr-xs">Connect with <i class="fa fa-facebook"></i></a>
								<a class="btn btn-twitter mb-md ml-xs mr-xs">Connect with <i class="fa fa-twitter"></i></a>
							</div> -->

							<p class="text-center">Don't have an account yet? <a href="pages-signup.php">Sign Up!</a>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md"><p style="color: black; text-align: center;">&copy; Copyright 2019. All rights reserved. Developed By <a href="http://trumeshjeewantha@blogspot.com">Tharaka Rumesh Jeewantha</a>.</p></p>
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
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>
		<script src="assets/javascripts/ui-elements/examples.notifications.js"></script>

	</body>
</html>

<?php 
	mysqli_close($db);
?>