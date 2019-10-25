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
	$curr_date = date("Y-m-d");
	$issued_list2 = '';

	$query14 = "SELECT * FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_issued_date = '$curr_date')";
	$issue_students = mysqli_query($db, $query14);

	if ($issue_students) {
		while ($issue_student = mysqli_fetch_assoc($issue_students)) {

			$issued_list2 .=	"<li>";
			$issued_list2 .=	"<p class='clearfix mb-xs'>";
			$issued_list2 .=	"<span class='message pull-left'>{$issue_student['std_fname']} {$issue_student['std_lname']}</span>";
			$issued_list2 .=	"<span class='message pull-right text-dark'>{$issue_student['std_grade']} - {$issue_student['std_class']}</span>";
			$issued_list2 .=	"</p>";
			$issued_list2 .=	"</li>";
	
		}
	} else {
		echo "Database Query Failed";
	}	
?>

<?php
	$curr_date = date("Y-m-d");

	$query14_1 = "SELECT COUNT(sid) as student_issued FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_issued_date = '$curr_date')";
	$result14_1 = mysqli_query($db, $query14_1);
	$student_issued = mysqli_fetch_assoc($result14_1);
?>

<?php
	$curr_date = date("Y-m-d");
	$expired_list2 = '';

	$query16 = "SELECT std_fname,std_lname,std_reg_no,std_grade,std_class FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_should_return_date <= '$curr_date' AND t_status = 'no')";
	$expired_students = mysqli_query($db, $query16);

	if ($expired_students) {
		while ($expired_student = mysqli_fetch_assoc($expired_students)) {

			$expired_list2 .=	"<li>";
			$expired_list2 .=	"<a href='#' class='clearfix'>";
			$expired_list2 .=	"<figure class='image'>";
			$expired_list2 .=	"<img src='assets/images/!sample-user.jpg' alt='Joseph Doe Junior' class='img-circle' />";
			$expired_list2 .=	"</figure>";
			$expired_list2 .=	"<span class='title'>{$expired_student['std_fname']} {$expired_student['std_lname']}</span>";
			$expired_list2 .=	"<span class='message'>Reg No : {$expired_student['std_reg_no']} | Grade : {$expired_student['std_grade']} - {$expired_student['std_class']} |  </span>";
			$expired_list2 .=	"</a>";
			$expired_list2 .=	"</li>";
		
		}
	} else {
		echo "Database Query Failed";
	}	
?>	

<?php
	$curr_date = date("Y-m-d");

	$query16_1 = "SELECT COUNT(sid) as student_expired FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_should_return_date <= '$curr_date' AND t_status = 'no')";
	$result16_1 = mysqli_query($db, $query16_1);
	$student_expired = mysqli_fetch_assoc($result16_1);
?>	

<?php
	$curr_date = date("Y-m-d");
	$expired_list3 = '';

	$query16_a = "SELECT std_fname,std_lname,std_reg_no,std_grade,std_class FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_should_return_date = '$curr_date' AND t_status = 'no')";
	$expired_students_a = mysqli_query($db, $query16_a);

	if ($expired_students_a) {
		while ($expired_student_a = mysqli_fetch_assoc($expired_students_a)) {
										
			$expired_list3 .=		"<li>";
			$expired_list3 .=		"<li>";
			$expired_list3 .=		"<a href='#' class='clearfix'>";
			$expired_list3 .=		"<div class='image'>";
			$expired_list3 .=		"<i class='fa fa-thumbs-down bg-danger'></i>";
			$expired_list3 .=		"</div>";
			$expired_list3 .=		"<span class='title'>{$expired_student_a['std_fname']} {$expired_student_a['std_lname']}</span>";
			$expired_list3 .=		"<span class='message'>Reg No : {$expired_student_a['std_reg_no']} | Grade : {$expired_student_a['std_grade']} - {$expired_student_a['std_class']} |  </span>";
			$expired_list3 .=		"</a>";
			$expired_list3 .=		"</li>";

		}
	} else {
		echo "Database Query Failed";
	}	
?>	

<?php
	$query_bk_count = "SELECT COUNT(bid) as bk_count_available FROM tbl_books WHERE bk_available = 0";
	$result_bk_count = mysqli_query($db, $query_bk_count);
	$bk_count_available = mysqli_fetch_assoc($result_bk_count);
?>

<?php
	$bk_available_list = '';

	$query_bks_available = "SELECT * FROM tbl_books WHERE bk_available = 0";
	$bks_available_lists = mysqli_query($db, $query_bks_available);

	if ($bks_available_lists) {
		while ($bks_available_list = mysqli_fetch_assoc($bks_available_lists)) {
										
			$bk_available_list .=		"<li>";
			$bk_available_list .=		"<li>";
			$bk_available_list .=		"<a href='#' class='clearfix'>";
			$bk_available_list .=		"<div class='image'>";
			$bk_available_list .=		"<i class='fa fa-thumbs-down bg-danger'></i>";
			$bk_available_list .=		"</div>";
			$bk_available_list .=		"<span class='title'>{$bks_available_list['bk_name']} </span>";
			$bk_available_list .=		"<span class='message'>Book No : {$bks_available_list['bk_no']} | Category : {$bks_available_list['bk_category_no']} | {$bks_available_list['bk_author']} </span>";
			$bk_available_list .=		"</a>";
			$bk_available_list .=		"</li>";

		}
	} else {
		echo "Database Query Failed";
	}	
?>	

<?php
	$curr_date = date("Y-m-d");

	$query16_1_a = "SELECT COUNT(sid) as student_expired_a FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_should_return_date = '$curr_date' AND t_status = 'no')";
	$result16_1_a = mysqli_query($db, $query16_1_a);
	$student_expired_a = mysqli_fetch_assoc($result16_1_a);
?>

<?php
	$query_a = "SELECT COUNT(sid) as girls FROM tbl_students WHERE std_gender = 'Female'";
	$result_a = mysqli_query($db, $query_a);
	$girl = mysqli_fetch_assoc($result_a);
?>

<?php
	$query1_b = "SELECT COUNT(sid) as boys FROM tbl_students WHERE std_gender = 'Male'";
	$result1_b = mysqli_query($db, $query1_b);
	$boy = mysqli_fetch_assoc($result1_b);
?>

<?php
	$query2_c = "SELECT SUM(bk_qty) as qtys FROM tbl_books";
	$result2_c = mysqli_query($db, $query2_c);
	$qtys = mysqli_fetch_assoc($result2_c);
?>

<?php
	$query3_d = "SELECT SUM(bk_available) as availability FROM tbl_books";
	$result3_d = mysqli_query($db, $query3_d);
	$availability = mysqli_fetch_assoc($result3_d);
?>

<?php
	$query5_e = "SELECT SUM(t_students) as no_of_student FROM tbl_teachers";
	$result5_e = mysqli_query($db, $query5_e);
	$no_of_students = mysqli_fetch_assoc($result5_e);
?>

<?php
	$query6_f = "SELECT SUM(bk_damages) as damages FROM tbl_books";
	$result6_f = mysqli_query($db, $query6_f);
	$damage = mysqli_fetch_assoc($result6_f);
?>

<?php
	$query = "SELECT * FROM tbl_users WHERE uid = ". $_SESSION['uid'] ."";
	$result = mysqli_query($db, $query);
	$user_details = mysqli_fetch_assoc($result);
?>

<?php

	if (isset($_POST['profile_changed'])) {

$errors = array();

	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$email = mysqli_real_escape_string($db, $_POST['email']);
	$tp = mysqli_real_escape_string($db, $_POST['tp']);
	$birthday = mysqli_real_escape_string($db, $_POST['birthday']);
	$address = mysqli_real_escape_string($db, $_POST['address']);
	$school = mysqli_real_escape_string($db, $_POST['school']);
	$info = mysqli_real_escape_string($db, $_POST['info']);
	// $un = mysqli_real_escape_string($db, $_POST['un']);
	// $pwd = mysqli_real_escape_string($db, $_POST['pwd']);
	// $new_pwd = mysqli_real_escape_string($db, $_POST['new-pwd']);
	// $hashed_password = sha1($new_pwd);
 	// $pic = $_FILES['file']['name'];

	$query1 = "UPDATE tbl_users SET first_name='{$fname}',last_name='{$lname}',email='{$email}',tp='{$tp}', address='{$address}',info='{$info}',birthday='{$birthday}',school='{$school}' WHERE uid = ". $_SESSION['uid'] ."";

	$result1 = mysqli_query($db, $query1);

	if ($result1) {
		$errors[] = 'Book Issued Failed';
	}
	else {
		$errors[] = 'Book Issued Failed';
	}
}

?>

<?php

	if (isset($_POST['update_profile'])) {

		$errors_1 = array();

	$info = mysqli_real_escape_string($db, $_POST['info']);

	$query_info = "UPDATE tbl_users SET info='{$info}' WHERE uid = ". $_SESSION['uid'] ."";

	$result_info = mysqli_query($db, $query_info);

	if ($result_info) {
		$errors_1[] = 'Book Issued Failed';
	}
	else {
		$errors_1[] = 'Book Issued Failed';
	}
}

?>

<?php

if (isset($_POST['changed'])) {

	$errors_3 = array();
	$errors_4 = array();

	// move_uploaded_file($_FILES['file']['tmp_name'], "images/".$_FILES['file']['name']);
	// $un = mysqli_real_escape_string($db, $_POST['un']);
	$pwd = mysqli_real_escape_string($db, $_POST['pwd']);
	$new_pwd = mysqli_real_escape_string($db, $_POST['new-pwd']);
	$hashed_password = sha1($pwd);
 	// $pic = $_FILES['file']['name'];

 	if($pwd != $new_pwd) {

 		$errors_4[] = "Password not matched";
 	}
 	else {
 			$query2 = "UPDATE tbl_users SET pw = '{$hashed_password}' WHERE uid = ". $_SESSION['uid'] ."";

			$result2 = mysqli_query($db, $query2);

				if ($result2) {
					$errors_2[] = 'Book Issued Failed';
				}
				else {
					$errors_2[] = 'Book Issued Failed';
			}
 	}
}

?>

<?php

if (isset($_POST['edit_image'])) {

	$errors_3 = array();

	$fileinfo=PATHINFO($_FILES["image"]["name"]);
	$newFilename=$fileinfo['filename'] ."_". time() . "." . $fileinfo['extension'];
	move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $newFilename);
	$location="upload/" . $newFilename;


 			$query3 = "UPDATE tbl_users SET image = '$location' WHERE uid = ". $_SESSION['uid'] ."";

			$result3 = mysqli_query($db, $query3);

				if ($result3) {
					$errors_3[] = 'Book Issued Successfully';
				}
				else {
					$errors_3[] = 'Book Issued Failed';
			}
}

?>

<?php
	$query_img = "SELECT image FROM tbl_users WHERE uid = ". $_SESSION['uid'] ."";
	$result_img = mysqli_query($db, $query_img);
	$user_img = mysqli_fetch_assoc($result_img);
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

		<link rel="stylesheet" href="assets/vendor/bootstrap-fileupload/bootstrap-fileupload.min.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

		<!-- Theme Custom CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme-custom.css">

		<!-- Head Libs -->
		<script src="assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/logo.png" height="35" alt="Porto Admin" />
					</a>
					<div class="visible-xs toggle-sidebar-left" data-toggle-class="sidebar-left-opened" data-target="html" data-fire-event="sidebar-left-opened">
						<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
					</div>
				</div>
			
				<!-- start: search & user box -->
				<div class="header-right">
			
					<form action="pages-search-results.php" class="search nav-form">
						<div class="input-group input-search">
							<input type="text" class="form-control" name="q" id="q" placeholder="Search...">
							<span class="input-group-btn">
								<button class="btn btn-default" type="submit"><i class="fa fa-search"></i></button>
							</span>
						</div>
					</form>
			
					<span class="separator"></span>
			
					<ul class="notifications">
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-mail-reply-all"></i>
								<span class="badge"><?= $student_issued['student_issued'] ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu large">
								<div class="notification-title">
									<span class="pull-right label label-default"><?= $student_issued['student_issued'] ?></span>
									Daily Issued
								</div>
			
								<div class="content">
									<ul>
										
										<?php echo $issued_list2; ?>

									</ul>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-cubes"></i>
								<span class="badge"><?= $student_expired['student_expired'] ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default"><?= $student_expired['student_expired'] ?></span>
									Transaction Expired
								</div>
			
								<div class="content">
									<ul>
										<?php echo $expired_list2; ?>
										
									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-cube"></i>
								<span class="badge"><?= $student_expired_a['student_expired_a'] ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default"><?= $student_expired_a['student_expired_a'] ?></span>
									Today Transaction Expired
								</div>
			
								<div class="content">
									<ul>

										<?php echo $expired_list3; ?>

									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
						<li>
							<a href="#" class="dropdown-toggle notification-icon" data-toggle="dropdown">
								<i class="fa fa-bell"></i>
								<span class="badge"><?= $bk_count_available['bk_count_available'] ?></span>
							</a>
			
							<div class="dropdown-menu notification-menu">
								<div class="notification-title">
									<span class="pull-right label label-default"><?= $bk_count_available['bk_count_available'] ?></span>
									Books out of Stock List
								</div>
			
								<div class="content">
									<ul>

										<?php echo $bk_available_list; ?>

									</ul>
			
									<hr />
			
									<div class="text-right">
										<a href="#" class="view-more">View All</a>
									</div>
								</div>
							</div>
						</li>
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="<?= $user_img['image'] ?>" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
							</figure>
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@okler.com">
								<span class="name"><?php echo ($_SESSION['first_name'] . " " . $_SESSION['last_name']) ?></span>
								<span class="role">administrator</span>
							</div>
			
							<i class="fa custom-caret"></i>
						</a>
			
						<div class="dropdown-menu">
							<ul class="list-unstyled">
								<li class="divider"></li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-user-profile.php"><i class="fa fa-user"></i> My Profile</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="pages-lock-screen.php"><i class="fa fa-lock"></i> Lock Screen</a>
								</li>
								<li>
									<a role="menuitem" tabindex="-1" href="logout.php"><i class="fa fa-power-off"></i> Logout</a>
								</li>
							</ul>
						</div>
					</div>
				</div>
				<!-- end: search & user box -->
			</header>
			<!-- end: header -->

			<div class="inner-wrapper">
				<!-- start: sidebar -->
				<aside id="sidebar-left" class="sidebar-left">
				
					<div class="sidebar-header">
						<div class="sidebar-title" style="color: white;">
							Navigation
						</div>
						<div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
							<i class="fa fa-bars" aria-label="Toggle sidebar"></i>
						</div>
					</div>
				
					<div class="nano">
						<div class="nano-content">
							<nav id="menu" class="nav-main" role="navigation">
								<ul class="nav nav-main">
									<li class="nav-active">
										<a href="index.php">
											<i class="fa fa-home" aria-hidden="true"></i>
											<span>Dashboard</span>
										</a>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Teachers</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="new_teacher.php">
													+ New Teacher
												</a>
											</li>
											<li>
												<a href="update_teacher.php">
													 Edit / Delete Teacher
												</a>
											</li>
											<li>
												<a href="view_teacher.php">
													 View All Teachers
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Students</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="new_students.php">
													+ New Student
												</a>
											</li>
											<li>
												<a href="update_students.php">
													 Edit / Delete Student
												</a>
											</li>
											<li>
												<a href="view_students.php">
													 View All Students
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-book" aria-hidden="true"></i>
											<span>Books</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="new_books.php">
													+ New Book
												</a>
											</li>
											<li>
												<a href="update_books.php">
													 Edit / Delete Book
												</a>
											</li>
											<li>
												<a href="view_books.php">
													 View All Books
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-reply" aria-hidden="true"></i>
											<span>Issue Books</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="issue_books.php">
													 Issue Book
												</a>
											</li>
											<li>
												<a href="update_issue.php">
													 Update Issue Details
												</a>
											</li>
											<li>
												<a href="issue_details.php">
													 All Issue Details
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-share" aria-hidden="true"></i>
											<span>Return Books</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="return_books.php">
													 Return Book
												</a>
											</li>
											<li>
												<a href="update_return.php">
													 Update Return Details
												</a>
											</li>
								<!-- 			<li>
												<a href="punishments.php">
													 Punishment Cost
												</a>
											</li> -->
											<li>
												<a href="return_details.php">
													 All Return Details
												</a>
											</li>
											
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-hand-o-down" aria-hidden="true"></i>
											<span>Remove Books</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="punishments.php">
													 Dismiss or Damage Books
												</a>
											</li>
											<li>
												<a href="view_damage_books.php">
													 View Remove Books
												</a>
											</li>
										</ul>
									</li>
									<li class="nav-parent">
										<a>
											<i class="fa fa-table" aria-hidden="true"></i>
											<span>Reports</span>
										</a>
										<ul class="nav nav-children">
											<li>
												<a href="reports.php">
													 Report
												</a>
											</li>
										</ul>
									</li>

					<!-- 				<li>
										<a href="mailbox-folder.php">
											<span class="pull-right label label-primary">182</span>
											<i class="fa fa-envelope" aria-hidden="true"></i>
											<span>Mailbox</span>
										</a>
									</li>

									<li class="nav-parent">
										<a>
											<i class="fa fa-comments-o" aria-hi></i>
											<span>Feedbacks</span>
										</a>
										
									</li> -->

								</ul>
							</nav>
				
							<hr class="separator" />
				

				
							<hr class="separator" />
				
							<div class="sidebar-widget widget-stats">
								<div class="widget-header">
									<h6 style="color: white;">Library Stats</h6>
									<div class="widget-toggle">+</div>
								</div>
								<div class="widget-content">
	<ul>
		<li>
			<span class="stats-title">Registered Students</span>
			<span class="stats-complete"><?= (($boy['boys'] + $girl['girls'])/($no_of_students['no_of_student']))*100 ?>%</span>
			<div class="progress">
				<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($boy['boys'] + $girl['girls'])/($no_of_students['no_of_student']))*100 ?>%;">
					<span class="sr-only"><?= (($boy['boys'] + $girl['girls'])/($no_of_students['no_of_student']))*100 ?>% Complete</span>
				</div>
			</div>
		</li>
		<li>
			<span class="stats-title">Books Issued</span>
			<span class="stats-complete"><?= (($qtys['qtys']-$availability['availability']-$damage['damages'])/($qtys['qtys']-$damage['damages']))*100 ?>%</span>
			<div class="progress">
				<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: <?= (($qtys['qtys']-$availability['availability']-$damage['damages'])/($qtys['qtys']-$damage['damages']))*100 ?>%;">
					<span class="sr-only"><?= (($qtys['qtys']-$availability['availability']-$damage['damages'])/($qtys['qtys']-$damage['damages']))*100 ?>% Complete</span>
				</div>
			</div>
		</li>
		<li>
			<span class="stats-title">Books Availability</span>
			<span class="stats-complete"><?= ($availability['availability']/($qtys['qtys']-$damage['damages']))*100 ?>%</span>
			<div class="progress">
				<div class="progress-bar progress-bar-primary progress-without-number" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="100" style="width: <?= ($availability['availability']/($qtys['qtys']-$damage['damages']))*100 ?>%;">
					<span class="sr-only"><?= ($availability['availability']/($qtys['qtys']-$damage['damages']))*100 ?>% Complete</span>
				</div>
			</div>
		</li>
	</ul>
</div>

							</div>
						</div>
				
					</div>
				
				</aside>
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>User Profile</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>User Profile</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->

					<div class="row">
						<div class="col-md-3 col-lg-4">

							<section class="panel">
								<div class="panel-body">
									<div class="thumb-info mb-md">
										<img src="<?= $user_img['image'] ?>" class="rounded img-responsive" alt="John Doe">
										<div class="thumb-info-title">
											<span class="thumb-info-inner"><?= $user_details['first_name'] ?> <?= $user_details['last_name'] ?></span>
											<span class="thumb-info-type">Administrator</span>
										</div>
									</div>

									<div class="widget-toggle-expand mb-md">
										<div class="widget-header">
											<h6>Profile Completion</h6>
											<div class="widget-toggle">+</div>
										</div>
										<div class="widget-content-collapsed">
											<div class="progress progress-xs light">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
													60%
												</div>
											</div>
										</div>
										<div class="widget-content-expanded">
											<ul class="simple-todo-list">
												<li class="completed">Update Profile Picture</li>
												<li class="completed">Change Personal Information</li>
												<li>Change Password</li>
												<li>Update Profile</li>
											</ul>
										</div>
									</div>

									<hr class="dotted short">

									<h6 class="text-muted">About</h6>
									<p><?= $user_details['info'] ?></p>
									<div class="clearfix">
										<a class="text-uppercase text-muted pull-right" href="#">(View All)</a>
									</div>

									<hr class="dotted short">

									<div class="social-icons-list">
										<a rel="tooltip" data-placement="bottom" target="_blank" href="http://www.facebook.com" data-original-title="Facebook"><i class="fa fa-facebook"></i><span>Facebook</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.twitter.com" data-original-title="Twitter"><i class="fa fa-twitter"></i><span>Twitter</span></a>
										<a rel="tooltip" data-placement="bottom" href="http://www.linkedin.com" data-original-title="Linkedin"><i class="fa fa-linkedin"></i><span>Linkedin</span></a>
									</div>

								</div>
							</section>



						</div>
						<div class="col-md-8 col-lg-8">

							<div class="tabs">
								<ul class="nav nav-tabs tabs-primary">
									<li class="active">
										<a href="#overview" data-toggle="tab">Overview</a>
									</li>
									<li>
										<a href="#edit" data-toggle="tab">Edit Profile</a>
									</li>
								</ul>
								<div class="tab-content">
									<div id="overview" class="tab-pane active">
	

										<h4 class="mb-xlg">Administration Summary</h4>

										<div class="timeline timeline-simple mt-xlg mb-md">
											<div class="tm-body">
												<div class="tm-title">
													<h3 class="h5 text-uppercase">USER PROFILE</h3>
												</div>
												<ol class="tm-items">
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">First Name</p>
															<p>
																<?= $user_details['first_name'] ?>
															</p>
														</div>
													</li>
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">Last Name</p>
															<p>
																<?= $user_details['last_name'] ?>
															</p>
														</div>
													</li>
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">Email</p>
															<p>
																<?= $user_details['email'] ?>
															</p>
														</div>
													</li>
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">Telephone</p>
															<p>
																<?= $user_details['tp'] ?>
															</p>
														</div>
													</li>
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">Username</p>
															<p>
																<span class="text-primary"> @<?= $user_details['un'] ?> </span>
															</p>
														</div>
													</li>
													<li>
														<div class="tm-box">
															<p class="text-muted mb-none">User Image</p>
															<div class="thumbnail-gallery">
																<a class="img-thumbnail lightbox" href="<?= $user_img['image'] ?>" data-plugin-options='{ "type":"image" }'>
																	<img class="img-responsive" width="215" src="<?= $user_img['image'] ?>">
																	<span class="zoom">
																		<i class="fa fa-search"></i>
																	</span>
																</a>
															</div>
														</div>
													</li>
												</ol>
											</div>
										</div>
									</div>
									<div id="edit" class="tab-pane">

										<form class="form-horizontal" action="pages-user-profile.php" method="post" enctype="multipart/form-data">
											<h4 class="mb-xlg">Personal Information</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileFirstName">First Name</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														<input type="text" class="form-control input-sm" name="fname" id="profileFirstName" value="<?= $user_details['first_name'] ?>"  required>
													</div>
												</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileLastName">Last Name</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-user"></i>
															</span>
														<input type="text" class="form-control input-sm" name="lname" id="profileLastName" value="<?= $user_details['last_name'] ?>"  required>
													</div>
												</div>
												</div>
												
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileLastName">Email</label>
													<div class="col-md-6">
														<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-envelope"></i>
																</span>
														<input type="email" class="form-control input-sm" name="email" id="profileLastName" value="<?= $user_details['email'] ?>"  required>
													</div>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileLastName">Telephone</label>
													<div class="col-md-6">
														<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-phone"></i>
															</span>
														<input type="text" class="form-control input-sm"  data-plugin-masked-input data-input-mask="(999) 999-9999" placeholder="(xxx) xxx-xxxx" name="tp" id="profileLastName" value="<?= $user_details['tp'] ?>">
													</div>
												</div>
												</div>

												<div class="form-group">
												<label class="col-sm-3 control-label">Birthday</label>
												<div class="col-md-6">
													<div class="input-group">
														<span class="input-group-addon">
															<i class="fa fa-calendar"></i>
														</span>
														<input type="text" name="birthday" placeholder="yyyy-mm-dd" value="<?= $user_details['birthday'] ?>" data-plugin-datepicker data-date-format="yyyy-mm-dd" class="form-control input-sm">
													</div>
												</div>
												</div>

												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileAddress">Address</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-home"></i>
															</span>
														<textarea class="form-control input-sm" type="text" name="address" rows="3"  data-plugin-maxlength maxlength="140" id="profileBio"><?= $user_details['address'] ?></textarea>
													</div>
												</div>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileCompany">School</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-bank"></i>
															</span>
														<input type="text" class="form-control input-sm" name="school" value="<?= $user_details['school'] ?>" id="profileCompany">
													</div>
												</div>
											</div>


												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat"></label>
													<div class="col-sm-8 pull-right">
														<button type="submit" name="profile_changed" class="btn btn-default"><i class="fa fa-edit "></i>  Update </button>
													</div>
												</div>

<?php
	if (isset($errors) && !empty($errors)) {
		echo '<div class="alert alert-success" style="text-align:center;"><strong>Success! </strong> User Profile Update Successfully </div>';
	}
?>

											</fieldset>

											<form action="pages-user-profile.php" method="POST" enctype="multipart/form-data">
											<hr class="dotted tall">
											<h4 class="mb-xlg">About Yourself</h4>
											<fieldset>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileBio">Biographical Info</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-send"></i>
															</span>
														<textarea class="form-control input-sm"  data-plugin-maxlength maxlength="300" name="info" rows="3" id="profileBio"><?= $user_details['info'] ?></textarea>
													</div>
												</div>
											</div>

												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat"></label>
													<div class="col-sm-8 pull-right">
														<button type="submit" name="update_profile" class="btn btn-default"><i class="fa fa-edit "></i>  Update </button>
													</div>
												</div>

<?php
	if (isset($errors_1) && !empty($errors_1)) {
		echo '<div class="alert alert-success" style="text-align:center;"><strong>Success! </strong> Bio Data Update Successfully </div>';
	}
?>

											</fieldset>
										</form>

												<form action="pages-user-profile.php" method="POST" enctype="multipart/form-data">
													<hr class="dotted tall">
											<h4 class="mb-xlg">Change Profile Image</h4>
											<fieldset>	
												<div class="form-group">
												<label class="col-sm-3 control-label">File Upload</label>
												<div class="col-md-6">
													<div class="fileupload fileupload-new" data-provides="fileupload">
														<div class="input-append">
															<div class="uneditable-input">
																<i class="fa fa-file fileupload-exists"></i>
																<span class="fileupload-preview"></span>
															</div>
															<span class="btn btn-default btn-file">
																<span class="fileupload-exists input-sm">Change</span>
																<span class="fileupload-new input-sm">Select file</span>
																<input type="file" name="image" />
															</span>
															<a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
														</div>
													</div>
												</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat"></label>
													<div class="col-sm-8 pull-right">
														<button type="submit" name="edit_image" class="btn btn-default"><i class="fa fa-edit "></i>  Update</button>
													</div>
												</div>

<?php
	if (isset($error_3) && !empty($errors_3)) {
		echo '<div class="alert alert-success" style="text-align:center;"><strong>Success! </strong> Profile Image Changed Successfully </div>';
	}
?>

											</fieldset>

											</form>
<!-- 												<div class="form-group">
													<label class="col-xs-3 control-label mt-xs pt-none">Public</label>
													<div class="col-md-8">
														<div class="checkbox-custom checkbox-default checkbox-inline mt-xs">
															<input type="checkbox" checked="" id="profilePublic">
															<label for="profilePublic"></label>
														</div>
													</div>
												</div> -->
											<form action="pages-user-profile.php" method="POST">	
											
											<hr class="dotted tall">
											<h4 class="mb-xlg">Change Password</h4>
											<fieldset class="mb-xl">
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileNewPassword">New Password</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-key"></i>
															</span>
														<input type="Password" class="form-control input-sm" name="pwd" id="pwd" >
													</div>
												</div>
													<span toggle="#chk_password" class="fa fa-fw fa-eye field_icon toggle-password"></span>
												</div>
												<div class="form-group">
													<label class="col-sm-3 control-label" for="profileNewPasswordRepeat">Repeat New Password</label>
													<div class="col-md-6 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-key"></i>
															</span>
														<input type="Password" class="form-control input-sm" name="new-pwd" id="new-pwd" >
													</div>
												</div>
												</div>

												<div class="form-group">
													<label class="col-md-3 control-label" for="profileNewPasswordRepeat"></label>
													<div class="col-sm-8 pull-right">
														<button type="submit" name="changed" class="btn btn-default"><i class="fa fa-edit "></i>  Update </button>
													</div>
												</div>

<?php
	if (isset($errors_4) && !empty($errors_4)) {
		echo '<div class="alert alert-danger" style="text-align:center;"><strong>Warning! </strong> Password not Matched</div>';
	}
?>

<?php
	if (isset($errors_2) && !empty($errors_2)) {
		echo '<div class="alert alert-success" style="text-align:center;"><strong>Success! </strong> Password Reset Successfully </div>';
	}
?>

											</fieldset>
										</form>

										</form>

									</div>
								</div>
							</div>
						</div>
						<div class="col-md-12 col-lg-3">

						</div>

					</div>
					<!-- end: page -->
				</section>
			</div>

			<aside id="sidebar-right" class="sidebar-right">
				<div class="nano">
					<div class="nano-content">
						<a href="#" class="mobile-close visible-xs">
							Collapse <i class="fa fa-chevron-right"></i>
						</a>
			
						<div class="sidebar-right-wrapper">
			
							<div class="sidebar-widget widget-calendar">
								<h6>Upcoming Tasks</h6>
								<div data-plugin-datepicker data-plugin-skin="dark" ></div>
			
								<ul>
						<!-- 			<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li> -->
								</ul>
							</div>
			
							<!-- <div class="sidebar-widget widget-friends">
								<h6>Friends</h6>
								<ul>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-online">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
									<li class="status-offline">
										<figure class="profile-picture">
											<img src="assets/images/!sample-user.jpg" alt="Joseph Doe" class="img-circle">
										</figure>
										<div class="profile-info">
											<span class="name">Joseph Doe Junior</span>
											<span class="title">Hey, how are you?</span>
										</div>
									</li>
								</ul>
							</div> -->
			
						</div>
					</div>
				</div>
			</aside>
		</section>

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

		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-autosize/jquery.autosize.js"></script>
		
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
		<script src="assets/vendor/jquery-idletimer/dist/idle-timer.js"></script>
<script src="assets/javascripts/pages/examples.lockscreen.js"></script>


		<script>

		$("body").on('click', '.toggle-password', function() {
  			$(this).toggleClass("fa-eye fa-eye-slash");
  					var input = $("#pwd");
  						if (input.attr("type") === "password") {
    						input.attr("type", "text");
  						} else {
    						input.attr("type", "password");
 					 }
				});
		</script>

	</body>
</html>