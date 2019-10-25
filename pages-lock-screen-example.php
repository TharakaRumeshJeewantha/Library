<?php
	session_start();
?>

<?php
	require_once('db/db_connection.php');
?>

<?php
	if (!isset($_SESSION['uid'])) {
		header('Location: pages-signin.php');
	}
?>

<?php
	$query_img = "SELECT image FROM tbl_users WHERE uid = ". $_SESSION['uid'] ."";
	$result_img = mysqli_query($db, $query_img);
	$user_img = mysqli_fetch_assoc($result_img);
?>

<?php
	$query = "SELECT * FROM tbl_users WHERE uid = ". $_SESSION['uid'] ."";
	$result = mysqli_query($db, $query);
	$user_details = mysqli_fetch_assoc($result);
?>

<?php

	if (isset($_POST['submit'])) {

			$pwd = mysqli_real_escape_string($db,$_POST['pwd']);
			$hashed_pwd = sha1($pwd);

			$query = "SELECT * FROM tbl_users WHERE pw = '{$hashed_pwd}' LIMIT 1";

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
		<section class="body-sign body-locked">
			<div class="center-sign">
				<div class="panel panel-sign">
					<div class="panel-body">
						<form action="index.php">
							<div class="current-user text-center">
								<img src="<?= $user_img['image'] ?>" alt="John Doe" class="img-circle user-image" />
								<h2 class="user-name text-dark m-none"><?= $user_details['un'] ?></h2>
								<p class="user-email m-none"><?= $user_details['email'] ?></p>
							</div>
							<div class="form-group mb-lg">
								<div class="input-group input-group-icon">
									<input id="pwd" name="pwd" type="password" class="form-control input-lg" required placeholder="Password" />
									<span class="input-group-addon">
										<span class="icon icon-lg">
											<i class="fa fa-lock"></i>
										</span>
									</span>
								</div>
							</div>

							<div class="row">
								<div class="col-xs-6">
									<p class="mt-xs mb-none">
										<a href="#">Not <?= $user_details['un'] ?>?</a>
									</p>
								</div>
								<div class="col-xs-6 text-right">
									<button type="submit" name="submit" class="btn btn-primary">Unlock</button>
								</div>
							</div>
						</form>
					</div>
				</div>
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
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

		<!-- validations -->
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/javascripts/forms/examples.validation.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>