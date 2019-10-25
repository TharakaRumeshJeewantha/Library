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
	$query = "SELECT COUNT(sid) as girls FROM tbl_students WHERE std_gender = 'Female'";
	$result = mysqli_query($db, $query);
	$girl = mysqli_fetch_assoc($result);
?>

<?php
	$query1 = "SELECT COUNT(sid) as boys FROM tbl_students WHERE std_gender = 'Male'";
	$result1 = mysqli_query($db, $query1);
	$boy = mysqli_fetch_assoc($result1);
?>

<?php
	$query2 = "SELECT SUM(bk_qty) as qtys FROM tbl_books";
	$result2 = mysqli_query($db, $query2);
	$qtys = mysqli_fetch_assoc($result2);
?>

<?php
	$query3 = "SELECT SUM(bk_available) as availability FROM tbl_books";
	$result3 = mysqli_query($db, $query3);
	$availability = mysqli_fetch_assoc($result3);
?>

<?php
	$t=date('d-m-Y');
	$curr_day = date("l",strtotime($t));

	$current_grade_list = '';

	$query4 = "SELECT * FROM tbl_teachers WHERE t_day = '$curr_day'";
	$currents = mysqli_query($db, $query4);

	if ($currents) {
		while ($current = mysqli_fetch_assoc($currents)) {
														
			$current_grade_list .=	"<strong class='amount'>{$current['t_grade']} - {$current['t_class']}</strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		
		}
	} else {
		echo "Database Query Failed";
	}
?>

<?php
	$query5 = "SELECT SUM(t_students) as no_of_student FROM tbl_teachers";
	$result5 = mysqli_query($db, $query5);
	$no_of_students = mysqli_fetch_assoc($result5);
?>

<?php
	$query6 = "SELECT SUM(bk_damages) as damages FROM tbl_books";
	$result6 = mysqli_query($db, $query6);
	$damage = mysqli_fetch_assoc($result6);
?>

<?php
	$query7 = "SELECT COUNT(tid) as status FROM tbl_transactions WHERE t_status = 'done'";
	$result7 = mysqli_query($db, $query7);
	$status = mysqli_fetch_assoc($result7);
?>

<?php
	$query8 = "SELECT COUNT(tid) as all_transactions FROM tbl_transactions";
	$result8 = mysqli_query($db, $query8);
	$all_transactions = mysqli_fetch_assoc($result8);
?>

<?php
	$query9 = "SELECT std_fname, std_lname, std_read FROM tbl_students where std_read = (select MAX(std_read) from tbl_students) Limit 1";
	$result9 = mysqli_query($db, $query9);
	$max_reader = mysqli_fetch_assoc($result9);
?>

<?php
	$query10 = "SELECT bk_category_no, (bk_qty-bk_available) as bk_cat FROM tbl_books WHERE (bk_qty-bk_available) = (SELECT MAX(bk_qty-bk_available) FROM tbl_books) Limit 1";
	$result10 = mysqli_query($db, $query10);
	$faviourite_cat = mysqli_fetch_assoc($result10);
?>

<?php
	$query11 = "SELECT sum(std_read) as grade_readers, std_grade FROM tbl_students GROUP BY std_grade Order by sum(std_read) Desc Limit 1";
	$result11 = mysqli_query($db, $query11);
	$best_grade = mysqli_fetch_assoc($result11);
?>

<?php
	$query12 = "SELECT sum(std_read) as class_readers, std_grade, std_class, teacher FROM tbl_students GROUP BY std_grade, std_class Order by sum(std_read) Desc Limit 1";
	$result12 = mysqli_query($db, $query12);
	$best_class = mysqli_fetch_assoc($result12);
?>

<?php

	$teacher_grade = $best_class['std_grade'];
	$teacher_class = $best_class['std_class'];

	$query13 = "SELECT t_fname, t_lname, t_students FROM tbl_teachers WHERE t_grade = '$teacher_grade' AND t_class = '$teacher_class'";
	$result13 = mysqli_query($db, $query13);
	$best_teacher = mysqli_fetch_assoc($result13);
?>
												
<?php
	$curr_date = date("Y-m-d");
	$issued_list = '';
	$issued_list2 = '';

	$query14 = "SELECT * FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_issued_date = '$curr_date')";
	$issue_students = mysqli_query($db, $query14);

	if ($issue_students) {
		while ($issue_student = mysqli_fetch_assoc($issue_students)) {
										
			$issued_list .=	"<li>";
			$issued_list .=	"<figure class='image rounded'>";
			$issued_list .=	"<img src='assets/images/!sample-user.jpg' alt='Joseph Doe Junior' class='img-circle'>";
			$issued_list .=	"</figure>";											
			$issued_list .=	"<span class='title'>{$issue_student['std_fname']} {$issue_student['std_lname']}</span>";
			$issued_list .=	"<span class='message truncate'>Reg No : {$issue_student['std_reg_no']} | Grade : {$issue_student['std_grade']} - {$issue_student['std_class']} </span>";
			$issued_list .=	"</li>";

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
	$returning_list = '';

	$query15 = "SELECT * FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_returned_date = '$curr_date')";
	$return_students = mysqli_query($db, $query15);

	if ($return_students) {
		while ($return_student = mysqli_fetch_assoc($return_students)) {
										
			$returning_list .=	"<li>";
			$returning_list .=	"<figure class='image rounded'>";
			$returning_list .=	"<img src='assets/images/!sample-user.jpg' alt='Joseph Doe Junior' class='img-circle'>";
			$returning_list .=	"</figure>";											
			$returning_list .=	"<span class='title'>{$return_student['std_fname']} {$return_student['std_lname']}</span>";
			$returning_list .=	"<span class='message truncate'>Reg No : {$return_student['std_reg_no']} | Grade : {$return_student['std_grade']} - {$return_student['std_class']} </span>";
			$returning_list .=	"</li>";
		
		}
	} else {
		echo "Database Query Failed";
	}	
?>	

<?php
	$curr_date = date("Y-m-d");

	$query15_1 = "SELECT COUNT(sid) as student_returned FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_returned_date = '$curr_date')";
	$result15_1 = mysqli_query($db, $query15_1);
	$student_returned = mysqli_fetch_assoc($result15_1);
?>	

<?php
	$curr_date = date("Y-m-d");
	$expired_list = '';
	$expired_list2 = '';

	$query16 = "SELECT std_fname,std_lname,std_reg_no,std_grade,std_class FROM tbl_students WHERE std_reg_no = ANY (SELECT std_no FROM tbl_transactions WHERE bk_should_return_date <= '$curr_date' AND t_status = 'no')";
	$expired_students = mysqli_query($db, $query16);

	if ($expired_students) {
		while ($expired_student = mysqli_fetch_assoc($expired_students)) {
										
			$expired_list .=	"<li>";
			$expired_list .=	"<figure class='image rounded'>";
			$expired_list .=	"<img src='assets/images/!sample-user.jpg' alt='Joseph Doe Junior' class='img-circle'>";
			$expired_list .=	"</figure>";											
			$expired_list .=	"<span class='title'>{$expired_student['std_fname']} {$expired_student['std_lname']}</span>";
			$expired_list .=	"<span class='message truncate'>Reg No : {$expired_student['std_reg_no']} | Grade : {$expired_student['std_grade']} - {$expired_student['std_class']} |  </span>";
			$expired_list .=	"</li>";


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
	$query17 = "SELECT bk_name, (bk_qty-bk_available-bk_damages) as fav_book FROM tbl_books WHERE (bk_qty-bk_available-bk_damages) = (SELECT MAX(bk_qty-bk_available-bk_damages) from tbl_books LIMIT 1)";
	$result17 = mysqli_query($db, $query17);
	$fav_book = mysqli_fetch_assoc($result17);
?>																

<?php
	$d = date('Y-m-d');
	$curr_days = date("l",strtotime($d));
	$p_day = $d .' , '.$curr_days;

	$d1 = date('Y-m-d',strtotime("-1 days"));
	$curr_day1 = date("l",strtotime($d1));
	$p_day1 = $d1 .' , '.$curr_day1;

	$d2 = date('Y-m-d',strtotime("-2 days"));
	$curr_day2 = date("l",strtotime($d2));
	$p_day2 = $d2 .' , '.$curr_day2;

	$d3 = date('Y-m-d',strtotime("-3 days"));
	$curr_day3 = date("l",strtotime($d3));
	$p_day3 = $d3 .' , '.$curr_day3;

	$d4 = date('Y-m-d',strtotime("-4 days"));
	$curr_day4 = date("l",strtotime($d4));
	$p_day4 = $d4 .' , '.$curr_day4;

	$d5 = date('Y-m-d',strtotime("-5 days"));
	$curr_day5 = date("l",strtotime($d5));
	$p_day5 = $d5 .' , '.$curr_day5;

	$d6 = date('Y-m-d',strtotime("-6 days"));
	$curr_day6 = date("l",strtotime($d6));
	$p_day6 = $d6 .' , '.$curr_day6;
?>

<?php
	$query18 = "SELECT COUNT(tid) as day0 FROM tbl_transactions WHERE bk_issued_date = '$d'";
	$result18 = mysqli_query($db, $query18);
	$day0 = mysqli_fetch_assoc($result18);
?>	

<?php
	$query19 = "SELECT COUNT(tid) as day1 FROM tbl_transactions WHERE bk_issued_date = '$d1'";
	$result19 = mysqli_query($db, $query19);
	$day1 = mysqli_fetch_assoc($result19);
?>	

<?php
	$query20 = "SELECT COUNT(tid) as day2 FROM tbl_transactions WHERE bk_issued_date = '$d2'";
	$result20 = mysqli_query($db, $query20);
	$day2 = mysqli_fetch_assoc($result20);
?>	

<?php
	$query21 = "SELECT COUNT(tid) as day3 FROM tbl_transactions WHERE bk_issued_date = '$d3'";
	$result21 = mysqli_query($db, $query21);
	$day3 = mysqli_fetch_assoc($result21);
?>	

<?php
	$query22 = "SELECT COUNT(tid) as day4 FROM tbl_transactions WHERE bk_issued_date = '$d4'";
	$result22 = mysqli_query($db, $query22);
	$day4 = mysqli_fetch_assoc($result22);
?>	

<?php
	$query23 = "SELECT COUNT(tid) as day5 FROM tbl_transactions WHERE bk_issued_date = '$d5'";
	$result23 = mysqli_query($db, $query23);
	$day5 = mysqli_fetch_assoc($result23);
?>

<?php
	$query24 = "SELECT COUNT(tid) as day6 FROM tbl_transactions WHERE bk_issued_date = '$d6'";
	$result24 = mysqli_query($db, $query24);
	$day6 = mysqli_fetch_assoc($result24);
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

<!doctype html>
<html class="fixed">
	<head>

		<!-- Basic -->
		<meta charset="UTF-8">

		<title>Charts | Okler Themes | Porto-Admin</title>
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
		<link rel="stylesheet" href="assets/vendor/morris/morris.css" />

		<!-- Theme CSS -->
		<link rel="stylesheet" href="assets/stylesheets/theme.css" />

		<!-- Skin CSS -->
		<link rel="stylesheet" href="assets/stylesheets/skins/default.css" />

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
								<i class="fa fa-tasks"></i>
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
								<i class="fa fa-envelope"></i>
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
								<i class="fa fa-bell"></i>
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
					</ul>
			
					<span class="separator"></span>
			
					<div id="userbox" class="userbox">
						<a href="#" data-toggle="dropdown">
							<figure class="profile-picture">
								<img src="assets/images/!logged-user.jpg" alt="Joseph Doe" class="img-circle" data-lock-picture="assets/images/!logged-user.jpg" />
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
									<a role="menuitem" tabindex="-1" href="#" data-lock-screen="true"><i class="fa fa-lock"></i> Lock Screen</a>
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
		<!-- 									<li>
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

<!-- 									<li>
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
				<!-- end: sidebar -->

				<section role="main" class="content-body">
					<header class="page-header">
						<h2>Dashboard</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>

							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

					<!-- start: page -->


					<!-- start Gauge -->
							<div class="row">
									<div class="col-md-12">
										<section class="panel">
											<div class="panel-body">
												<div class="row text-center">
													<div class="col-md-3">
														<div class="circular-bar">
															<div class="circular-bar-chart" data-percent="<?= (($girl['girls'])/($girl['girls']+$boy['boys']))*100 ?>" data-plugin-options='{ "barColor": "#F93AB9", "delay": 300 }'>
																<strong>Girls</strong>
																<label><span class="percent"><?= (($girl['girls'])/($girl['girls']+$boy['boys']))*100 ?></span>%</label>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="circular-bar">
															<div class="circular-bar-chart" data-percent="<?= (($boy['boys'])/($girl['girls']+$boy['boys']))*100 ?>" data-plugin-options='{ "barColor": "#0088CC", "delay": 600 }'>
																<strong>Boys</strong>
																<label><span class="percent"><?= (($boy['boys'])/($girl['girls']+$boy['boys']))*100 ?></span>%</label>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="circular-bar">
															<div class="circular-bar-chart" data-percent="<?= (($qtys['qtys']-$availability['availability'])/$qtys['qtys'])*100 ?>" data-plugin-options='{ "barColor": "#F5110A", "delay": 300 }'>
																<strong>Issued</strong>
																<label><span class="percent"><?= (($qtys['qtys']-$availability['availability']-$damage['damages'])/($qtys['qtys']-$damage['damages']))*100 ?></span>%</label>
															</div>
														</div>
													</div>
													<div class="col-md-3">
														<div class="circular-bar">
															<div class="circular-bar-chart" data-percent="<?= ($availability['availability']/$qtys['qtys'])*100 ?>" data-plugin-options='{ "barColor": "#2BAAB1", "delay": 600 }'>
																<strong>Available</strong>
																<label><span class="percent"><?= ($availability['availability']/($qtys['qtys']-$damage['damages']))*100 ?></span>%</label>
															</div>
														</div>
													</div>
												</div>
											</div>
										</section>
									</div>
								</div>
					<!-- end Gauge -->

					<!-- widgets -->

						<div class="row">


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-tertiary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-history"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
														 	<h4 class="title">Today Schedule</h4>
															<div class="info">
															<?php echo $current_grade_list; ?>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase"><?= $curr_day; ?></a>
														</div> 
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-secondary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-child"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Most Reader</h4>
															<div class="info">
																<strong class="amount"><?=  $max_reader['std_fname'] ?></strong>
																<strong class="amount"><?=  $max_reader['std_lname'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Books Read : <?=  $max_reader['std_read'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-book"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Most Popular Book</h4>
															<div class="info">
																<strong class="amount"><?= $fav_book['bk_name'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Students read : <?= $fav_book['fav_book'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-stack-exchange"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Most Popular Category</h4>
															<div class="info">
																<strong class="amount"><?= $faviourite_cat['bk_category_no'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Lending Books : <?= $faviourite_cat['bk_cat'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


						</div>


						<div class="row">



							<div class="col-md-6 col-lg-6 col-xl-3">
								<section class="panel">
									<div class="panel-body bg-primary">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon">
													<div class="circular-bar circular-bar-xs m-none mt-xs mr-md">
														<div class="circular-bar-chart" data-percent="<?= (($boy['boys'] + $girl['girls'])/($no_of_students['no_of_student']))*100 ?>" data-plugin-options='{ "barColor": "#F9913A", "delay": 300, "size": 90, "lineWidth": 5 }'>
															<strong>All Registered Users</strong>
															<label><span class="percent"><!--  --></span>%</label>
														</div>
													</div>
												</div>
											</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">All Registered Users</h4>
															<div class="info">
																<strong class="amount"><?= ($boy['boys'] + $girl['girls']) ?></strong>
															</div>
													</div>
													<div class="summary-footer">
														<a class="text-uppercase">Whole Students : <?= $no_of_students['no_of_student'] ?></a>
													</div>
												</div>
										</div>
									</div>
								</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
								<section class="panel">
									<div class="panel-body bg-quartenary">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon">
													<div class="circular-bar circular-bar-xs m-none mt-xs mr-md">
														<div class="circular-bar-chart" data-percent="<?= (($qtys['qtys']-$damage['damages'])/$qtys['qtys'])*100 ?>" data-plugin-options='{ "barColor": "#F9913A", "delay": 300, "size": 90, "lineWidth": 5 }'>
															<strong>All Books in Stock</strong>
															<label><span class="percent"><!--  --></span>%</label>
														</div>
													</div>
												</div>
											</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">All Books in Stock</h4>
															<div class="info">
																<strong class="amount"><?= ($qtys['qtys']-$damage['damages']) ?></strong>
															</div>
													</div>
													<div class="summary-footer">
														<a class="text-uppercase">Whole Books : <?= $qtys['qtys'] ?></a>
													</div>
												</div>
										</div>
									</div>
								</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
								<section class="panel">
									<div class="panel-body bg-secondary">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon">
													<div class="circular-bar circular-bar-xs m-none mt-xs mr-md">
														<div class="circular-bar-chart" data-percent="<?= ($damage['damages']/$qtys['qtys'])*100 ?>" data-plugin-options='{ "barColor": "#F9913A", "delay": 300, "size": 90, "lineWidth": 5 }'>
															<strong>Dismiss or Damage Books</strong>
															<label><span class="percent"><!--  --></span>%</label>
														</div>
													</div>
												</div>
											</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Dismiss or Damage Books</h4>
															<div class="info">
																<strong class="amount"><?= $damage['damages'] ?></strong>
															</div>
													</div>
													<div class="summary-footer">
														<a class="text-uppercase">Whole Books : <?= $qtys['qtys'] ?></a>
													</div>
												</div>
										</div>
									</div>
								</section>
							</div>

							<div class="col-md-6 col-lg-6 col-xl-3">
								<section class="panel">
									<div class="panel-body bg-tertiary">
										<div class="widget-summary">
											<div class="widget-summary-col widget-summary-col-icon">
												<div class="summary-icon">
													<div class="circular-bar circular-bar-xs m-none mt-xs mr-md">
														<div class="circular-bar-chart" data-percent="<?= ($status['status']/$all_transactions['all_transactions'])*100 ?>" data-plugin-options='{ "barColor": "#F9913A", "delay": 300, "size": 90, "lineWidth": 5 }'>
															<strong>Completed Transactions</strong>
															<label><span class="percent"><!--  --></span>%</label>
														</div>
													</div>
												</div>
											</div>
												<div class="widget-summary-col">
													<div class="summary">
														<h4 class="title">Completed Transactions</h4>
															<div class="info">
																<strong class="amount"><?= $status['status'] ?></strong>
															</div>
													</div>
													<div class="summary-footer">
														<a class="text-uppercase">Whole Transactions : <?= $all_transactions['all_transactions'] ?></a>
													</div>
												</div>
										</div>
									</div>
								</section>
							</div>


						</div>


						<div class="row">


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-quartenary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-group"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Most Reading Grade</h4>
															<div class="info">
																<strong class="amount">Grade <?= $best_grade['std_grade'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Students : <?= $best_grade['grade_readers'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-tertiary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-star"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Most Reading Class</h4>
															<div class="info">
																<strong class="amount">Grade <?= $best_class['std_grade'] ?> - <?= $best_class['std_class'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Students : <?= $best_class['class_readers'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-primary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-user"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Class Teacher</h4>
															<div class="info">
																<strong class="amount"><?= $best_teacher['t_fname'] ?></strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase"><?= $best_teacher['t_fname'] ?> <?= $best_teacher['t_lname'] ?> | <?= $best_teacher['t_students'] ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


							<div class="col-md-6 col-lg-6 col-xl-3">
										<section class="panel">
											<div class="panel-body bg-secondary">
												<div class="widget-summary">
													<div class="widget-summary-col widget-summary-col-icon">
														<div class="summary-icon">
															<i class="fa fa-usd"></i>
														</div>
													</div>
													<div class="widget-summary-col">
														<div class="summary">
															<h4 class="title">Cost Amount</h4>
															<div class="info">
																<strong class="amount">LKR   0.00</strong>
															</div>
														</div>
														<div class="summary-footer">
															<a class="text-uppercase">Registered Students : <?= ($boy['boys'] + $girl['girls']) ?></a>
														</div>
													</div>
												</div>
											</div>
										</section>
							</div>


						</div>

						<!-- end of widgets -->


						<!-- start graph -->
						<div class="row">

									<div class="col-md-12 col-xl-12">
										<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">
										<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= ($day6['day6'] + $day5['day5'] + $day4['day4'] + $day3['day3'] + $day2['day2'] + $day1['day1'] + $day0['day0']) ?></span>
										<span class="va-middle">Previously Issued Summary</span>
									</h2>
								</header>
											<div class="panel-body">
												<div class="chart chart-sm" id="flotWidgetsSales1"></div>
												<script>
						
													var flotWidgetsSales1Data = [{
													    data: [
													    	["<?php echo $p_day6 ?>", <?= $day6['day6'] ?>],
													    	["<?php echo $p_day5 ?>", <?= $day5['day5'] ?>],
													        ["<?php echo $p_day4 ?>", <?= $day4['day4'] ?>],
													        ["<?php echo $p_day3 ?>", <?= $day3['day3'] ?>],
													        ["<?php echo $p_day2 ?>", <?= $day2['day2'] ?>],
													        ["<?php echo $p_day1 ?>", <?= $day1['day1'] ?>],
													        ["<?php echo $p_day ?>", <?= $day0['day0'] ?>]],
													    color: "#0088cc"
													}];
						
												</script>
											</div>
										</section>
									</div>

								</div>
						<!-- end graph -->

						<!-- start issued list -->
						<div class="col-md-12 col-xl-4">
						<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">
										<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= $student_issued['student_issued'] ?></span>
										<span class="va-middle">Daily Issued List</span>
									</h2>
								</header>		
								<div class="panel-body">
									<div class="content">
										<ul class="simple-user-list">
											
												<?php echo $issued_list; ?>
											
										</ul>
										<hr class="dotted short">
										<div class="text-right">
											<a class="text-uppercase text-muted" href="#"><?= $curr_date ?> , <?= $curr_day ?> | Issued <?= $student_issued['student_issued'] ?> Book(s) </a>
										</div>
									</div>
								</div>
					</section>
				</div>
						<!-- end issued list -->

						<!-- start return list -->
						<div class="col-md-12 col-xl-4">
						<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">
										<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= $student_returned['student_returned'] ?></span>
										<span class="va-middle">Daily Returning List</span>
									</h2>
								</header>		
								<div class="panel-body">
									<div class="content">
										<ul class="simple-user-list">
											<?php echo $returning_list ?>
										</ul>
										<hr class="dotted short">
										<div class="text-right">
											<a class="text-uppercase text-muted" href="#"><?= $curr_date ?> , <?= $curr_day ?> | Returned <?= $student_returned['student_returned'] ?> Book(s) </a>
										</div>
									</div>
								</div>
					</section>
				</div>
						<!-- end return list -->

						<!-- start expired list -->
					<div class="col-md-12 col-xl-4">
						<section class="panel">
								<header class="panel-heading">
									<div class="panel-actions">
										<a href="#" class="fa fa-caret-down"></a>
										<a href="#" class="fa fa-times"></a>
									</div>

									<h2 class="panel-title">
										<span class="label label-primary label-sm text-normal va-middle mr-sm"><?= $student_expired['student_expired'] ?></span>
										<span class="va-middle">Returns Expired List</span>
									</h2>
								</header>		
								<div class="panel-body">
									<div class="content">
										<ul class="simple-user-list">
											<?php echo $expired_list ?>
										</ul>
										<hr class="dotted short">
										<div class="text-right">
											<a class="text-uppercase text-muted" href="#"><?= $curr_date ?> , <?= $curr_day ?> | Expired <?= $student_expired['student_expired'] ?> Transaction(s) </a>
										</div>
									</div>
								</div>
					</section>
				</div>
						<!-- end expired list -->
						

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
									<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li>
								</ul>
							</div>
			
							<div class="sidebar-widget widget-friends">
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
							</div>
			
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
		<script src="assets/vendor/jquery-appear/jquery.appear.js"></script>
		<script src="assets/vendor/jquery-easypiechart/jquery.easypiechart.js"></script>
		<script src="assets/vendor/flot/jquery.flot.js"></script>
		<script src="assets/vendor/flot-tooltip/jquery.flot.tooltip.js"></script>
		<script src="assets/vendor/flot/jquery.flot.pie.js"></script>
		<script src="assets/vendor/flot/jquery.flot.categories.js"></script>
		<script src="assets/vendor/flot/jquery.flot.resize.js"></script>
		<script src="assets/vendor/jquery-sparkline/jquery.sparkline.js"></script>
		<script src="assets/vendor/raphael/raphael.js"></script>
		<script src="assets/vendor/morris/morris.js"></script>
		<script src="assets/vendor/gauge/gauge.js"></script>
		<script src="assets/vendor/snap-svg/snap.svg.js"></script>
		<script src="assets/vendor/liquid-meter/liquid.meter.js"></script>
		
		<!-- Theme Base, Components and Settings -->
		<script src="assets/javascripts/theme.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/ui-elements/examples.charts.js"></script>
		<script src="assets/javascripts/ui-elements/examples.widgets.js"></script>
	</body>
</html>