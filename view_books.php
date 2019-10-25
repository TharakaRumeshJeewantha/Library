<?php
	session_start();
?>

<?php
	require_once('db/db_connection.php');
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
	if (!isset($_SESSION['uid'])) {
		header('Location: pages-signin.php');
	}

	$books_list = '';

	$query = "SELECT * FROM tbl_books ORDER BY bk_name";
	$books = mysqli_query($db, $query);

	if ($books) {
		while ($book = mysqli_fetch_assoc($books)) {
			
			// ////////////////////////////////////////////
			$books_list .= 	"<div class='isotope-item {$book['bk_category_no']} col-sm-6 col-md-4 col-lg-3'>";
			$books_list .=	"<div class='thumbnail'>";
			$books_list .=	"<div class='thumb-preview'>";
			$books_list .=	"<a class='thumb-image' href='assets/images/projects/temp.jpg'>";
			$books_list .=	"<img src='assets/images/projects/temp.jpg' class='img-responsive' alt='Project'>";
			$books_list .=	"</a>";
			$books_list .=	"<div class='mg-thumb-options'>";
			$books_list .=	"<div class='mg-zoom'><i class='fa fa-search'></i></div>";
			$books_list .=	"<div class='mg-toolbar'>";
			$books_list .=	"<div class='mg-option checkbox-custom checkbox-inline'>";
			$books_list .=	"<input type='checkbox' id='file_1' value='1'>";
			$books_list .=	"<label for='file_1'>SELECT</label>";
			$books_list .=	"</div>";
			$books_list .=	"<div class='mg-group pull-right'>";
			$books_list .=	"<a href='#'>EDIT</a>";
			$books_list .=	"<button class='dropdown-toggle mg-toggle' type='button' data-toggle='dropdown'>";
			$books_list .=	"<i class='fa fa-caret-up'></i>";
			$books_list .=	"</button>";
			$books_list .=	"<ul class='dropdown-menu mg-menu' role='menu'>";
			$books_list .=	"<li><a href='#'><i class='fa fa-download'></i> Download</a></li>";
			$books_list .=	"<li><a href='#'><i class='fa fa-trash-o'></i> Delete</a></li>";
			$books_list .=	"</ul>";
			$books_list .=	"</div>";
			$books_list .=	"</div>";
			$books_list .=	"</div>";
			$books_list .=	"</div>";
			$books_list .=	"<h5 class='mg-title text-semibold'>{$book['bk_name']}<small> edition : {$book['bk_edition']}</small></h5>";
			$books_list .=	"<div class='mg-description'>";
			$books_list .=	"<small class='pull-left text-muted'>Category : {$book['bk_category_no']} ({$book['page']})</small>";
			$books_list .=	"<small class='pull-right text-muted'>Available : {$book['bk_available']}</small><br>";
			$books_list .=	"<small class='pull-left text-muted'>Author : {$book['bk_author']} ({$book['year']})</small>";
			$books_list .=	"<small class='pull-right text-muted'>Qty : {$book['bk_qty']}</small>";
			$books_list .=	"</div>";
			$books_list .=	"</div>";
			$books_list .=	"</div>";
			// ////////////////////////////////////////////
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
		<link rel="stylesheet" href="assets/vendor/isotope/jquery.isotope.css" />

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
									<li class="nav-parent nav-expanded nav-active">
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
											<li class="nav-active">
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
							<!-- 				<li>
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

						<!-- 			<li>
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
						<h2>View All Books Details</h2>
					
						<div class="right-wrapper pull-right">
							<ol class="breadcrumbs">
								<li>
									<a href="index.php">
										<i class="fa fa-home"></i>
									</a>
								</li>
								<li><span>Books</span></li>
								<li><span>View All Books</span></li>
							</ol>
					
							<a class="sidebar-right-toggle" data-open="sidebar-right"><i class="fa fa-chevron-left"></i></a>
						</div>
					</header>

						

					<!-- start: page -->
					<section class="content-with-menu content-with-menu-has-toolbar media-gallery">
						<div class="content-with-menu-container">
							
							<div class="inner-body mg-main">
							
								<div class="inner-toolbar clearfix">
									<ul>
										<li>
											<a href="#" id="mgSelectAll"><i class="fa fa-check-square"></i> <span data-all-text="Select All" data-none-text="Select None">Select All</span></a>
										</li>
										<li>
											<a href="#"><i class="fa fa-pencil"></i> Edit</a>
										</li>
										<li>
											<a href="#"><i class="fa fa-trash-o"></i> Delete</a>
										</li>
										<li class="right" data-sort-source data-sort-id="media-gallery">
											<ul class="nav nav-pills nav-pills-primary">
												<li>
													<label>Filter:</label>
												</li>
												<li class="active">
													<a data-option-value="*" href="#all">All</a>
												</li>
												<li>
													<a data-option-value=".Green" style="color: #83F66F;" href="#document">Green</a>
												</li>
												<li>
													<a data-option-value=".Red" style="color: #F78179;" href="#image">Red</a>
												</li>
												<li>
													<a data-option-value=".Orange" style="color: #FFCB6F;" href="#video">Orange</a>
												</li>
												<li>
													<a data-option-value=".White" style="color: #FFFFFF;" href="#video">White</a>
												</li>
												<li>
													<a data-option-value=".Blue" style="color: #9BE3FA;" href="#video">Blue</a>
												</li>
												<li>
													<a data-option-value=".Yellow" style="color: #EEF549;" href="#video">Yellow</a>
												</li>
											</ul>
										</li>
									</ul>
								</div>
								<div class="row mg-files" data-sort-destination data-sort-id="media-gallery">
									<?php echo $books_list; ?>

								</div>
							</div> 
						</div>
					</section>

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
								<!-- 	<li>
										<time datetime="2014-04-19T00:00+00:00">04/19/2014</time>
										<span>Company Meeting</span>
									</li> -->
								</ul>
							</div>
			
						<!-- 	<div class="sidebar-widget widget-friends">
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
		<script src="assets/vendor/isotope/jquery.isotope.js"></script>
		
		<!-- Theme Custom -->
		<script src="assets/javascripts/theme.custom.js"></script>
		
		<!-- Theme Initialization Files -->
		<script src="assets/javascripts/theme.init.js"></script>


		<!-- Examples -->
		<script src="assets/javascripts/forms/examples.wizard.js"></script>
		<!-- Examples -->
		<script src="assets/javascripts/pages/examples.mediagallery.js" /></script>
		<script src="assets/vendor/jquery-idletimer/dist/idle-timer.js"></script>
<script src="assets/javascripts/pages/examples.lockscreen.js"></script>
	</body>
</html>