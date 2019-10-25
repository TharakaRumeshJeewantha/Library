<?php
	require_once('db/db_connection.php');
	
	$id=$_GET['id'];
	
	$firstname=$_POST['firstname'];
	$lastname=$_POST['lastname'];
	$birthday=$_POST['birthday'];
	$nic=$_POST['nic'];
	$phone=$_POST['phone'];
	$address=$_POST['address'];
	$gender=$_POST['gender'];
	$subject=$_POST['subject'];
	$grade=$_POST['grade'];
	$class=$_POST['class'];
	// $day=$_POST['day'];
	// $period=$_POST['period'];
	$day_time=$_POST['day_time'];
	$students=$_POST['students'];
	
	mysqli_query($db,"update tbl_teachers set t_fname='$firstname', t_lname='$lastname', t_birthday='$birthday', t_nic='$nic', t_phone='$phone', t_address='$address', t_gender='$gender', t_subject='$subject', t_grade='$grade', t_class='$class', day_time='$day_time', t_students='$students' where t_id='$id'");

	mysqli_query($db,"update tbl_day_time set status='no' where tid='$nic'");

	mysqli_query($db,"update tbl_day_time set tid='$nic', grade='$grade',class='$class',students='$students',status='yes' where day_time='$day_time'");

	header('location:update_teacher.php');

?>