<?php
	require_once('db/db_connection.php');
?>

<?php

	if (isset($_POST['submit'])) {

		$errors = array();
		$errors1 = array();

	$fileinfo=PATHINFO($_FILES["image"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;

	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$tp = mysqli_real_escape_string($db, $_POST['tp']);
	$un = mysqli_real_escape_string($db, $_POST['un']);
	$nic = mysqli_real_escape_string($db, $_POST['nic']);
	$pw = mysqli_real_escape_string($db, $_POST['pw']);
	$pw_confirm = mysqli_real_escape_string($db, $_POST['pw_confirm']);
	$hashed_password = sha1($pw);

	$chk_username = "SELECT un FROM tbl_users WHERE un='".$un."'";
	$res    = mysqli_query($db, $chk_username);
    $count  = mysqli_num_rows($res);

    if($count > 0) {
    	$errors1 = "Username Already Exists. Try again with different username";
    }
    else {

	if ($pw != $pw_confirm) {
		$errors = "Password not Matched";
	}
	else {

	$query = "INSERT INTO tbl_users (first_name, last_name, email, tp, un, pw, image, nic) VALUES ('{$fname}','{$lname}','{$email}','{$tp}','{$un}','{$hashed_password}','$location', '{$nic}')";

	$result = mysqli_query($db, $query);

	if ($result) {
		header('Location: pages-signin.php');
	}
	else {
		echo "Data insert Failed";
	}
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
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

<!-- 		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>


		<script type="text/javascript">
		$(document).ready(function(){
	$('#username').keyup(function() {
	var usercheck = $(this).val();
	    $('#usercheck').html('<img src="assets/images/loading.gif" width="150" />');
		$.post("username_check.php", {user_name: usercheck} , function(data)
		{
		if (data.status == true)
		{
		$('#usercheck').parent('div').removeClass('has-error').addClass('has-success');
		
		} else {
		$('#usercheck').parent('div').removeClass('has-success').addClass('has-error');
		}
		$('#usercheck').html(data.msg);
		},'json');
	});
});
</script> -->

	</head>
	<body background="assets/images/bg1.jpg">
		<!-- start: page -->
		<section class="body-sign" style="opacity: 0.9;">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<img src="assets/images/logo.png" height="54" alt="Porto Admin" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
					</div>
					<div class="panel-body">
						<form action="pages-signup.php" method="POST"  enctype="multipart/form-data">
							<div class="form-group mb-lg">
								<label>First Name</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
								<input name="fname" type="text" class="form-control" required />
							</div>
						</div>

							<div class="form-group mb-lg">
								<label>Last Name</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user"></i>
										</span>
								<input name="lname" type="text" class="form-control" required />
							</div>
						</div>

							<div class="form-group mb-lg">
								<label>E-mail Address</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</span>
								<input name="email" type="email" class="form-control" required />
							</div>
							</div>

							<div class="form-group mb-lg">
								<label>Contact No</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-phone"></i>
										</span>
								<input name="tp" type="text" data-plugin-masked-input data-input-mask="(999) 999-9999" placeholder="(xxx) xxx-xxxx" class="form-control" required />
							</div>
							</div>

							<div class="form-group mb-lg">
								<label>NIC</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-key"></i>
										</span>
								<input name="nic" type="text" data-plugin-masked-input data-input-mask="99-9999-999 (v)" placeholder="xx-xxxx-xx (v)" class="form-control" required />
							</div>
						</div>

							<div class="form-group mb-lg">
								<label>Username</label>
								<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-user-md"></i>
										</span>
								<input name="un" id="username" type="text" class="form-control" maxlength="16" minlength="6" required />
								<!-- <span id="usercheck" class="help-block"></span> -->
							</div>
							</div>

<?php
	if (isset($errors1) && !empty($errors1)) {
		echo '<div class="alert alert-danger" style="text-align:center;"><strong>Warning! </strong> Username Already Exists. Try again with different username </div>';
	}
?>

							<div class="form-group mb-none">
								<div class="row">
									<div class="col-sm-6 mb-lg">
										<label>Password</label>
										<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-key"></i>
										</span>
										<input name="pw" type="password" maxlength="16" minlength="6" class="form-control" required />
									</div>
								</div>
									<div class="col-sm-6 mb-lg">
										<label>Password Confirmation</label>
										<div class="input-group">
										<span class="input-group-addon">
											<i class="fa fa-key"></i>
										</span>
										<input name="pw_confirm" type="password" class="form-control" required />
									</div>
								</div>
								</div>
							</div>

							<div class="form-group mb-lg">
										<label>Upload your Profile Image</label>
												<div class="col-md-14">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists">Change</span>
																<span class="fileupload-new">Select file</span>
																<input type="file" name="image" required />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
													</div>
												</div>
							</div>


<?php
	if (isset($errors) && !empty($errors)) {
		echo '<div class="alert alert-danger" style="text-align:center;"><strong>Warning! </strong> Password Not Matched </div>';
	}
?>


											

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<input id="AgreeTerms" name="agreeterms" type="checkbox"/>
										<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label>
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" name="submit" class="btn btn-primary hidden-xs">Sign Up</button>
									<button type="submit" name="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg">Sign Up</button>
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

							<p class="text-center">Already have an account? <a href="pages-signin.php">Sign In!</a>

						</form>
					</div>
				</div>

				<p class="text-center text-muted mt-md mb-md"><p style="color: white; text-align: center;">&copy; Copyright 2019. All rights reserved. Developed by <a style="color: white;" href="http://trumeshjeewantha@blogspot.com">Tharaka Rumesh Jeewantha</a>.</p></p>
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

		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		<script src="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>

						<!-- validations -->
						<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
						<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="assets/javascripts/forms/examples.validation.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>

	</body>
</html>

<?php
	mysqli_close($db);
?>