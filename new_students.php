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
	if (isset($_POST['submit'])) {

		$errors = array();
		
	$fname = mysqli_real_escape_string($db, $_POST['fname']);
	$lname = mysqli_real_escape_string($db, $_POST['lname']);
	$reg_no = mysqli_real_escape_string($db, $_POST['reg_no']);
	$gender = mysqli_real_escape_string($db, $_POST['gender']);
	$grade = mysqli_real_escape_string($db, $_POST['grade']);
	$classes = mysqli_real_escape_string($db, $_POST['classes']);
	$teacher = mysqli_real_escape_string($db, $_POST['teacher']);

	 // $bk_category = mysqli_real_escape_string($db, $_POST['bk_category']);
	$bk_no = mysqli_real_escape_string($db, $_POST['bk_no']);
	$bk_issued_date = mysqli_real_escape_string($db, $_POST['bk_issued_date']);
	$bk_should_return_date = mysqli_real_escape_string($db, $_POST['bk_should_return_date']);

	$query = "INSERT INTO tbl_students (std_fname, std_lname, std_reg_no, std_gender, std_grade, std_class, teacher, std_read) VALUES ('{$fname}','{$lname}','{$reg_no}','{$gender}','{$grade}','{$classes}','{$teacher}', 1)";

	$query1 = "INSERT INTO tbl_transactions (bk_issued_date, bk_should_return_date, std_no, bk_no) VALUES ('{$bk_issued_date}','{$bk_should_return_date}','{$reg_no}','{$bk_no}')";

	$qrya = "UPDATE tbl_books SET bk_available = bk_available-1 WHERE bk_no = '{$bk_no}'";

	$result = mysqli_query($db, $query);
	$result1 = mysqli_query($db, $query1);
	$result2 = mysqli_query($db, $qrya);

if($result) {
	$errors[] = 'Student Added Successfully';
}
else {
	$errors[] = 'Student Adding Failed';
}

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

	$teacher_list = '';

	$query_t = "SELECT * FROM tbl_teachers";
	$teachers = mysqli_query($db, $query_t);

	if ($teachers) {
		while ($teacher = mysqli_fetch_assoc($teachers)) {
						
			$teacher_list .=	"<optgroup label='{$teacher['t_grade']} - {$teacher['t_class']}'>";
			$teacher_list .=	"<option value='{$teacher['t_fname']} {$teacher['t_lname']}'>{$teacher['t_fname']} {$teacher['t_lname']} ({$teacher['t_grade']} - {$teacher['t_class']})</option>";
			$teacher_list .=	"</optgroup>";
		
		}
	} else {
		echo "Database Query Failed";
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

				<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/jquery-ui/css/ui-lightness/jquery-ui-1.10.4.custom.css" />
		<link rel="stylesheet" href="assets/vendor/select2/select2.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-colorpicker/css/bootstrap-colorpicker.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-timepicker/css/bootstrap-timepicker.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/basic.css" />
		<link rel="stylesheet" href="assets/vendor/dropzone/css/dropzone.css" />
		<link rel="stylesheet" href="assets/vendor/bootstrap-markdown/css/bootstrap-markdown.min.css" />

		<link rel="stylesheet" href="assets/vendor/codemirror/lib/codemirror.css" />
		<link rel="stylesheet" href="assets/vendor/codemirror/theme/monokai.css" />

		<!-- Specific Page Vendor CSS -->
		<link rel="stylesheet" href="assets/vendor/pnotify/pnotify.custom.css" />

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
		<section class="body">

			<!-- start: header -->
			<header class="header">
				<div class="logo-container">
					<a href="../" class="logo">
						<img src="assets/images/logo.png" height="35" alt="JSOFT Admin" />
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
							<div class="profile-info" data-lock-name="John Doe" data-lock-email="johndoe@JSOFT.com">
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
									<li class="nav-parent nav-expanded nav-active"
>
										<a>
											<i class="fa fa-users" aria-hidden="true"></i>
											<span>Students</span>
										</a>
										<ul class="nav nav-children">
											<li class="nav-active">
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
					<!-- 						<li>
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

	<!-- 								<li>
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
						<h2>+ New Student</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Students</span></li>
								<li><span>+ New Student</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

						

					<!-- start: page -->
					<!-- start: page -->
						<div class="row">
							<div class="col-xs-12">
								<!-- //////////////////////////////////////// -->

								<section class="panel form-wizard" id="w1">
									<header class="panel-heading">
										<div class="panel-actions">
											<a href="#" class="fa fa-caret-down"></a>
											<a href="#" class="fa fa-times"></a>
										</div>
						
										<h2 class="panel-title">Add New Student</h2>
									</header>
									<div class="panel-body panel-body-nopadding">
										<div class="wizard-tabs">
											<ul class="wizard-steps">
												<li class="active">
													<a href="#w1-account" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">1</span>
														Student Profile
													</a>
												</li>
												<li>
													<a href="#w1-profile" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">2</span>
														Issue Books
													</a>
												</li>
												<!-- <li>
													<a href="#w1-confirm" data-toggle="tab" class="text-center">
														<span class="badge hidden-xs">3</span>
														Issued Confirmation 
													</a>
												</li> -->
											</ul>
										</div>
										<br>
										<br>
										<form class="form-horizontal" action="new_students.php" method="POST" novalidate="novalidate">
											<div class="tab-content">
												<div id="w1-account" class="tab-pane active">
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-fname">First Name</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-user"></i>
															</span>
															<input type="text" class="form-control input-sm" name="fname" id="w1-fname" required>
														</div>
													</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-lname">Last Name</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-user"></i>
															</span>
															<input type="text" class="form-control input-sm" name="lname" id="w1-lname" required>
														</div>
													</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-reg">Enrollment No (Registration No)</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-key"></i>
															</span>
															<input type="number" class="form-control input-sm" minlength="1" maxlength="5" name="reg_no" id="w1-reg" required>
														</div>
													</div>
													</div>
													<br>
													<div class="form-group">
														<label class="col-sm-4 control-label">Gender</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-user-md"></i>
															</span>
															<select id="gender" name="gender" class="form-control input-sm" required>
																<option value="">Choose a Gender</option>
																<option value="Male">Male</option>
																<option value="Female">Female</option>
															</select>
															<label class="error" for="gender"></label>
														</div>
													</div>
													</div>
													<br>
												
													<div class="form-group">
														<label class="col-sm-4 control-label">Grade</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-graduation-cap"></i>
															</span>
															<select id="grade" name="grade" class="form-control input-sm" required>
																<option value="">Choose a Grade</option>
																<option value="1">1</option>
																<option value="2">2</option>
																<option value="3">3</option>
																<option value="4">4</option>
																<option value="5">5</option>
															</select>
															<label class="error" for="grade"></label>
														</div>
													</div>
													</div>
													<br>

													<div class="form-group">
														<label class="col-sm-4 control-label">Class</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-graduation-cap"></i>
															</span>
															<select id="classes" name="classes" class="form-control input-sm" required>
																<option value="">Choose a Class</option>
																<option value="A">A</option>
																<option value="B">B</option>
															</select>
															<label class="error" for="classes"></label>
														</div>
													</div>
													</div>
													

											<hr>
											<div class="form-group">
												<label class="col-sm-4 control-label">Class Teacher Name</label>
												<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-qq"></i>
															</span>
													<select name="teacher" data-plugin-selectTwo class="form-control input-sm" style="text-align: left" data-plugin-options='{ "minimumInputLength": 1 }' required>
														<optgroup label="Please Select">
															<option value="">Choose Teacher name</option>
														</optgroup>
														<?php echo $teacher_list; ?>
													</select>
												</div>
											</div>
											</div>

												</div>
												<div id="w1-profile" class="tab-pane">

											<div class="form-group">
														<label class="col-sm-4 control-label" for="w1-book-no">Book No</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-book"></i>
															</span>
															<input type="number" class="form-control input-sm" maxlength="3" minlength="1" name="bk_no" id="w1-book-no" required>
														</div>
													</div>
												</div>

											<br>	

													<!-- <div class="form-group">
														<label class="col-sm-4 control-label">Book Category</label>
														<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa  fa-tasks"></i>
															</span>
															<select id="Category" name="bk_category" class="form-control input-sm" required>
																<option value="">Choose a Category</option>
																<option value="Green">Green</option>
																<option value="Red">Red</option>
																<option value="Orange">Orange</option>
																<option value="White">White</option>
																<option value="Blue">Blue</option>
																<option value="Yellow">Yellow</option>
															</select>
															<label class="error" for="Category"></label>
														</div>
													</div>
												</div>

											<br>	 -->

											<div class="form-group">
												<label class="col-sm-4 control-label" for="issuedDate">Issued Date</label>
												<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
													<input class="form-control input-sm" name="bk_issued_date" value="<?php echo date("Y-m-d"); ?>" id="issuedDate" type="text" placeholder="Issued Date" readonly="readonly">
												</div>
											</div>
											</div>

											<br>
						
											<div class="form-group">
												<label class="col-sm-4 control-label" for="returnDate">Should Return Date</label>
												<div class="col-md-4 control-label">
														<div class="input-group">
															<span class="input-group-addon">
																<i class="fa fa-calendar"></i>
															</span>
													<input type="text" name="bk_should_return_date" value="<?php $d=strtotime("+1 week"); echo date("Y-m-d", $d) ?>" id="returnDate" class="form-control input-sm" readonly="readonly">
												</div>
											</div>
											</div>

											<br>

													<div class="form-group">
														<div class="col-md-6"></div>
														<div class="col-md-4">
															<div class="checkbox-custom">
																<input type="checkbox" name="terms" id="w1-terms" required>
																<label for="w1-terms">I agree to the terms of service</label>
															</div>
														</div>
													</div>

													<br>

													<div class="form-group">
														<div style="text-align: center;" class="col-md-12">
															<button type="submit" name="submit" class="mb-xs mt-xs mr-xs btn btn-primary"><i class="fa fa-save "></i> Save </button>
														</div>
													</div>

													<br>

												</div>
												<br>
												<br>



<!-- 												<div id="w1-confirm" class="tab-pane">


													<!-- /////////////////////////////////////////////////////////////////////// -->
			<!-- 	<section class="panel">
						<div class="panel-body">
							<div class="invoice">
								<header class="clearfix">
									<div class="row">
										<div class="col-sm-6 mt-md">
											<h2 class="h2 mt-none mb-sm text-dark text-bold">Book Issue Invoice</h2>
											<h4 class="h4 m-none text-dark text-bold">#76598345</h4>
										</div>
										<div class="col-sm-6 text-right mt-md mb-md">
											<address class="ib mr-xlg">
												Okler Themes Ltd
												<br/>
												24 Henrietta Street, London, England
												<br/>
												Phone: +12 3 4567-8901
												<br/>
												okler@okler.net
											</address>
											<div class="ib">
												<img src="assets/images/invoice-logo.png" alt="OKLER Themes" />
											</div>
										</div>
									</div>
								</header>
								<div class="bill-info">
									<div class="row">
										<div class="col-md-6">
											<div class="bill-to">
												<p class="h5 mb-xs text-dark text-semibold">To:</p>
												<address>
													Envato
													<br/>
													121 King Street, Melbourne, Australia
													<br/>
													Phone: +61 3 8376 6284
													<br/>
													info@envato.com
												</address>
											</div>
										</div>
										<div class="col-md-6">
											<div class="bill-data text-right">
												<p class="mb-none">
													<span class="text-dark">Invoice Date:</span>
													<span class="value">05/20/2014</span>
												</p>
												<p class="mb-none">
													<span class="text-dark">Due Date:</span>
													<span class="value">06/20/2014</span>
												</p>
											</div>
										</div>
									</div>
								</div>
							
								<div class="table-responsive">
									<table class="table invoice-items">
										<thead>
											<tr class="h4 text-dark">
												<th id="cell-id"     class="text-semibold">#</th>
												<th id="cell-item"   class="text-semibold">Item</th>
												<th id="cell-desc"   class="text-semibold">Description</th>
												<th id="cell-price"  class="text-center text-semibold">Price</th>
												<th id="cell-qty"    class="text-center text-semibold">Quantity</th>
												<th id="cell-total"  class="text-center text-semibold">Total</th>
											</tr>
										</thead>
										<tbody>
											<tr>
												<td>123456</td>
												<td class="text-semibold text-dark">Porto HTML5 Template</td>
												<td>Multipourpouse Website Template</td>
												<td class="text-center">$14.00</td>
												<td class="text-center">2</td>
												<td class="text-center">$28.00</td>
											</tr>
											<tr>
												<td>654321</td>
												<td class="text-semibold text-dark">Tucson HTML5 Template</td>
												<td>Awesome Website Template</td>
												<td class="text-center">$17.00</td>
												<td class="text-center">1</td>
												<td class="text-center">$17.00</td>
											</tr>
										</tbody>
									</table>
								</div>
							
								<div class="invoice-summary">
									<div class="row">
										<div class="col-sm-4 col-sm-offset-8">
											<table class="table h5 text-dark">
												<tbody>
													<tr class="b-top-none">
														<td colspan="2">Subtotal</td>
														<td class="text-left">$73.00</td>
													</tr>
													<tr>
														<td colspan="2">Shipping</td>
														<td class="text-left">$0.00</td>
													</tr>
													<tr class="h4">
														<td colspan="2">Grand Total</td>
														<td class="text-left">$73.00</td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="text-right mr-lg">
								<a href="#" class="btn btn-default">Submit Invoice</a>
								<a href="pages-invoice-print.html" target="_blank" class="btn btn-primary ml-sm"><i class="fa fa-print"></i> Print</a>
							</div>
						</div>
					</section> -->
													<!-- /////////////////////////////////////////////////////////////////////// -->

								<!-- 					
													<br>
												</div>  -->
											</div>
										</form>
<?php
	if (isset($errors) && !empty($errors)) {
		echo '<div class="alert alert-success" style="text-align:center;"><strong>Success! </strong> Student Registered and Book Issued Successfully </div>';
	}
?>
									</div>
									<div class="panel-footer">
										<ul class="pager">
											<li class="previous disabled">
												<a><i class="fa fa-angle-left"></i> Previous</a>
											</li>
											<li class="finish hidden pull-right">
												<a>Finish</a>
											</li>
											<li class="next">
												<a>Next <i class="fa fa-angle-right"></i></a>
											</li>
										</ul>
									</div>
								</section>
				
								<!-- //////////////////////////////////////// -->
							</div>
						</div>
					<!-- end: page -->
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
					<!-- 				<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li> -->
								</ul>
							</div>
			
<!-- 							<div class="sidebar-widget widget-friends">
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
		
		<!-- Specific Page Vendor -->
		<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
		<script src="assets/vendor/bootstrap-wizard/jquery.bootstrap.wizard.js"></script>
		<script src="assets/vendor/pnotify/pnotify.custom.js"></script>


		<script src="assets/vendor/jquery-ui-touch-punch/jquery.ui.touch-punch.js"></script>
		<script src="assets/vendor/select2/select2.js"></script>
		<script src="assets/vendor/bootstrap-multiselect/bootstrap-multiselect.js"></script>
		<script src="assets/vendor/jquery-maskedinput/jquery.maskedinput.js"></script>
		<script src="assets/vendor/bootstrap-tagsinput/bootstrap-tagsinput.js"></script>
		<script src="assets/vendor/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
		<script src="assets/vendor/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
		<script src="assets/vendor/fuelux/js/spinner.js"></script>
		<script src="assets/vendor/dropzone/dropzone.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/to-markdown.js"></script>
		<script src="assets/vendor/bootstrap-markdown/js/bootstrap-markdown.js"></script>
		<script src="assets/vendor/codemirror/lib/codemirror.js"></script>
		<script src="assets/vendor/codemirror/addon/selection/active-line.js"></script>
		<script src="assets/vendor/codemirror/addon/edit/matchbrackets.js"></script>
		<script src="assets/vendor/codemirror/mode/javascript/javascript.js"></script>
		<script src="assets/vendor/codemirror/mode/xml/xml.js"></script>
		<script src="assets/vendor/codemirror/mode/htmlmixed/htmlmixed.js"></script>
		<script src="assets/vendor/codemirror/mode/css/css.js"></script>
		<script src="assets/vendor/summernote/summernote.js"></script>
		<script src="assets/vendor/bootstrap-maxlength/bootstrap-maxlength.js"></script>
		<script src="assets/vendor/ios7-switch/ios7-switch.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>

						<!-- validations -->
		<script src="assets/javascripts/forms/examples.advanced.form.js" /></script>
<script src="assets/vendor/jquery-validation/jquery.validate.js"></script>
<script src="assets/javascripts/forms/examples.validation.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.wizard.js"></script>
		<script src="assets/vendor/jquery-idletimer/dist/idle-timer.js"></script>
<script src="assets/javascripts/pages/examples.lockscreen.js"></script>
	</body>
</html>